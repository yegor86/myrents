<?php
class HelloWord extends CApplicationComponent{
    public function init(){
	parent::init();
    }
    
    public function hello(){
	print_r('Hello');
    }
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
