<?php
class adminMailerComponent extends CComponent{

    /**
     * общий обработчик
     * @return type 
     */
    public function run() {
	$sleeptime = Yii::app()->params['mailersleep'];
	$filename= dirname(__FILE__).'/../..'.''.Yii::app()->params['TEMPDIR'].Yii::app()->params['MAILERFILENAME'];
	if(!is_file($filename))
	{
	     echo("no file $filename founded\n");
	    $this->status = 'disabled';
	    return ;
	}
	$mailcontent = file_get_contents($filename);
	echo "content geted\n";
    	$maillist  = Yii::app()->db->createCommand()
		->select('email')
		->from('User')
		->where('service=:service AND subscribed =1',array(':service'=>'local'))
		->queryAll();
	$count = count($maillist);
	echo "count mail $count\n";
	if(!$count){
	    echo("no mails founded\n");
	    $this->status = 'disabled';
	    return ;
	}else{
	    $this->status = 'progress';
	    foreach ($maillist as $key=>$mail){
		//выбираем статус
		//если была комманда на остановку, то завершаем работу
		$jobStatus = $this->status;
		if($jobStatus=='stopping'){
		    	     echo("stopping \n");
		    $this->status = 'disabled'; return;
		}
		
		$this->progress = ($key+1).'\\'.$count;
		
		$headers = 
		    "From: ".Yii::app()->params['noreplyEmail']."\r\n"
		    ."Mime-Version: 1.0r\n"
		    ."Content-type: text/html; charset=utf-8\r\n"
		    ."Precedence: bulk\r\n"
		    ."List-Unsubscribe: http://dev.myrents.com.ua/unsubscribe/?email=".$mail."&secret=".CustomFunctions::createSecret($mail['email']). "\r\n";
		mail($mail['email'], 'MyRents notification, no-reply', $mailcontent, $headers);
		//задержка перед следущей отправкой
		usleep($sleeptime);
	    }
	    echo "sended  \n";
	    $this->progress="completed($count)";
	    $this->status='disabled';
	}

    }

    

    
    public function getStatus(){
		$jobStatus = Yii::app()->db->createCommand()
		->select('value')
		->from('DBVariables')
		->where('name = :param',array(':param'=>'DJobStatus'))->queryRow();
		return $jobStatus['value'];
    }
    
    public function setStatus($status){
		    $DBcommand = Yii::app()->db->createCommand()
		    ->update('DBVariables', array('value'=>$status), 'name="DJobStatus"');
    }
    
    public function setProgress($progress){
		    $DBcommand = Yii::app()->db->createCommand()
		    ->update('DBVariables', array('value'=>$progress), 'name="DJobProgress"');
    }
    
    
    
}