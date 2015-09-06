<?php
/**
 * класс для работы с деревом вручную (удаление, изменение)
 */
class AddressTreeCommand extends CConsoleCommand {
    public function run($args) {
        if(isset($args[0]))
        switch ($args[0]){
            case 'deletename':
            case 'deln':
                if(isset($args[1]))
                $this->DropFromTree($args[1],'name');
                else $this->showHelp();
                break;
            case 'deleteid':
            case 'delid':
                if(isset($args[1])&&ctype_digit($args[1]))
                $this->DropFromTree($args[1],'id');
                else $this->showHelp();
                break;
            case 'shiftleftname':
            case 'sln':
                if(isset($args[1]))
                $this->shiftLeft($args[1],'name');
                else $this->showHelp();
                break;
            case 'shiftleftid':
            case 'slid':
                if(isset($args[1])&&ctype_digit($args[1]))
                $this->shiftLeft($args[1],'id');
                else $this->showHelp();
                break;
            case 'help': case 'h': default;
                $this->showHelp();break;
        }
        else $this->showHelp();
        
    }
    
 /**
  * вывод help
  */   
    public function showHelp(){
        echo "Usage: \n";
        echo "php yiic.php addresstree <command> <value> \n";
        echo "CommandList\n";
        echo "  help				- show this help\n";
        echo "  deletename <name> | deln <name>	- deleteing tre branch by name\n";
        echo "  deleteid <id> | delid <id>		- deleteing tre branch by id, id must be integer\n";
        echo "  shiftleftname <name> | sln <name>	- shilft left selected by name  branch\n";
        echo "  shiftleftid <id> | slid <id>		- shilft left selected by id  branch\n";
    }
    
    /**
     * Сдвиг ветки горизонтально в начало
     * алгоритм:
     * 1. выбираем головной узел для смещения ветки по полученным параметрам
     * 2. заносим ключи lft и rgt головного узла сдвигаемой ветки в переменные  $sblft и $sbrgt
     * 3. получаем ключи lft и rgt родительского для сдвигаемой ветки узла в переменные $mlft и  $mrgt
     * 4. получаем все id ветки и вложенных узлов в массив $shiftBranch
     * 5. сдвигаем все ветки, расположенные правее сдвигаемой на место сдвигаемой, 
     *     поскольку количество узлов не изменится, то вне родительской ветки изменений не будет
     *     по-этому смена ключей ограничена $sbrgt слева и $mrgt справа
     * 6. изменяем ключи сдвигаемой ветки (ставим их в начало)
     * 7. сдвигаем все ветки, исключая обрабатываему на количество узлов обрабатываемой ветки
     * @param type $value
     * @param type $column 
     */
    public function shiftLeft($value, $column='name'){
	echo("shifting $value\n");
	
	echo ("stage 1: select head of selected brunch \n");
	//1. выбор головного узла перемещаемой ветки
	$queryResult = Yii::app()->db->createCommand('SELECT id, level, name , lft, rgt
		FROM `address_tree` `t` 
		WHERE `'.$column.'` = \''. $value.'\'' )
		    ->queryRow();
	if(!$queryResult){
	    echo ("$value not founded\n");return;	    
	}
	print_r($queryResult);
	
	echo ("stage 2: init vars \n");
	//2. заносим ключи в переменные
	$sbrgt = $queryResult['rgt'];
	$sblft = $queryResult['lft'];
	$level = $queryResult['level'];
	
	echo ("stage 3: select pdrent node \n");
	//3. выбор родительского нода
	$queryResult = Yii::app()->db->createCommand("SELECT id, name , lft, rgt
		FROM `address_tree` `t` 
		WHERE lft < $sblft AND rgt > $sbrgt AND level = $level -1;" )
		    ->queryRow();
	if(!$queryResult){
	    echo ("parent node not founded, maybe node is root?\n");return;
	}
		print_r($queryResult);
	$mlft = $queryResult['lft'];
	$mrgt = $queryResult['rgt'];
	
	echo ("stage 1: select ids  of selected brunch`s nodes \n");
	//4.выбор всех IDшников в сдвигаемой ветке
	$queryResult = Yii::app()->db->createCommand("SELECT id
		FROM `address_tree` `t` 
		WHERE lft >= $sblft AND rgt <= $sbrgt;" )
		    ->queryAll();
	$branch =  implode(',', CustomFunctions::ArrayFromSubitems($queryResult,'id'));
	
	echo ("stage 1: shift leftside branches \n");
	//5. сдвигаем все ветки, расположенные правее выбранной на её место
	$queryResult =  Yii::app()->db->createCommand("
	    UPDATE `address_tree`
		SET lft = lft - ($sbrgt - $sblft +1),
		        rgt = rgt - ($sbrgt - $sblft +1)
		WHERE lft > $sblft AND rgt < $mrgt
	    ")->execute();
	
	echo ("stage 1: shift selected branch to fist place \n");
	// 6. изменяем ключи сдвигаемой ветки (ставим их в начало)
	$queryResult =  Yii::app()->db->createCommand("
	    UPDATE `address_tree`
		SET lft = lft - ($sblft - $mlft - 1),
		        rgt = rgt - ($sblft - $mlft - 1)
		WHERE id IN ($branch)
	    ")->execute();
	
	echo ("stage 1: shift other brances \n");
	//7. сдвигаем все ветки, исключая обрабатываему на количество узлов обрабатываемой ветки
	$queryResult =  Yii::app()->db->createCommand("
	    UPDATE `address_tree`
		SET lft = lft + ($sbrgt - $sblft +1),
		        rgt = rgt + ($sbrgt - $sblft +1)
		WHERE id NOT IN ($branch) AND lft > $mlft AND rgt < $mrgt
	    ")->execute();
	echo ("completed \n");
    }
    
    
    /**
     * Удаление ветки из дерева
     * @param mixed $value значение поиска
     * @param string $searchcolumn поле для поиска, по умолчанию name
     * @return type
     */
    public function dropFromTree($value,$searchcolumn='name'){
        echo "deleting $value:\n";
        $point = Yii::app()->db->createCommand('SELECT id, name , lft, rgt
		FROM `address_tree` `t` 
		WHERE `'.$searchcolumn.'` = \''. $value.'\'' )
		    ->queryRow();
        if(!count($point)){
            echo ("$value not founded\n");return;
        }
        $rgt = $point['rgt'];
        $lft = $point['lft'];
        $query = "DELETE FROM address_tree WHERE lft >= $lft AND rgt <= $rgt ";
        $affectedRows = Yii::app()->db->createCommand($query)->execute();
        echo("Deleted $affectedRows rows\n");
        
        $diap = $rgt - $lft +1;
        $query = "UPDATE address_tree SET `rgt` = (`rgt`-$diap) WHERE rgt > $rgt AND lft < $lft ";
         $affectedRows = Yii::app()->db->createCommand($query)->execute();
        echo("Shuffled $affectedRows rows\n");       
        $query = "UPDATE address_tree SET `lft` = (`lft`-$diap) , `rgt` = (`rgt`-$diap) WHERE `lft` > $rgt  ";
        $affectedRows = Yii::app()->db->createCommand($query)->execute();
        echo("Shuffled $affectedRows rows\n");
    }
}
?>