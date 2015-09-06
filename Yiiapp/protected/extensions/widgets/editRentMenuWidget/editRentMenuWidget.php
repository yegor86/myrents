<?php
Yii::import('application.extensions.widgets.editRentMenuWidget.MenuItem');

class editRentMenuWidget extends BaseWidget {
    public $active;
    public $rentid;
    public $in_show;
    
    public function init() {
	    parent::init(__FILE__);
	    $this->addClientCsriptFiles();
	// этот метод будет вызван методом CController::beginWidget()
    }
    
    
    /**
     *Список элеметнов меню
     * @return array[] 
     */
    public  function getmenuList() {
	$menuArray = require dirname( __FILE__ ) . '/Menu.php';
	$menuList = array();
	foreach ($menuArray as $menuitem){
	 $menuList[] = new MenuItem($this->rentid, $menuitem[0], $menuitem[1], $menuitem[2]);    
	}
	return $menuList;
   }

    public function run() {
	$this->render('rentMenuView', array('rentid' => $this->rentid,'active'=>$this->active, 'in_show'=>$this->in_show, 'menuItems'=>  $this->menuList));
    }
    
   private function addClientCsriptFiles(){
	$cs = Yii::app()->clientScript;
	$cs->registerCssFile($this->_assetsUrl . '/css/menu.css');
    }


}

?>
