<?php
Yii::import('application.controllers.MyRentsController');
class NotPermittedController extends MyRentsController
{    

       
        public function actionIndex(){
            throw new CHttpException(403, 'access denied');
            $this->assignAndRender('notPermitted');
        }
        }
        ?>