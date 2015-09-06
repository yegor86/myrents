<?php

class BitMask{
    
    static function ArrToIntBitMask($valuesArray=array()){
	$gmp = gmp_init(0);
	foreach ($valuesArray as $vaule){
	    gmp_setbit($gmp,$vaule-1);
	}
	return gmp_intval($gmp);
    }
}

?>
