<?php

class SetApiKeysCommand extends CConsoleCommand {
    
    public function run() {
$uid = 117;
    $criteria = new CDbCriteria();
    $criteria->condition = '`user` = :uid ';
    $criteria->params=array(':uid'=>$uid);
    $count = Rent::model()->count($criteria);
    $criteria->limit =1;
    echo "found $count rents \n";
	for ($i=1; $i<=$count;$i++){
	    echo "Job $i :";
	    $criteria->offset=$i-1;
	    $rent = Rent::model()->find($criteria);
	    if(!$rent){
		echo " Rent not found \n";	continue;
	    }
	    echo " Rent $rent->id \n";
	    $description = RentDescription::model()->findByPk(array('rent'=>$rent->id,'language'=>1));
	    if(!$description) {
		echo "Description for rent $rent->id not found \n"; continue;
	    }
	    echo "Description for rent $rent->id founded, getting ID: ";
	    $pattern = '/Код объекта на сайте Агентства \&quot\;ЭКСПЕРТ Недвижимость\&quot\;\:\s*([\d]+)\s/u';
	    if(!preg_match($pattern, $description->overview,$matches)){
		echo "key not found \n"; continue;
	    } 
		echo($matches[1]."\n");
	    echo "generating api key: ";
	    $apiKey =  (int) ((string) $uid .'00' .(string) $matches[1]);
	    echo "$apiKey \n";
	    $rent->api_key = $apiKey;
	    echo "saving Rent:";
	    if(!$rent->save()){
		echo "error saving\n";continue;
	    }
	    echo "rent saved";
	}
    
    }

}

