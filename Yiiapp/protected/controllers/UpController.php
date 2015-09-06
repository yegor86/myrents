<?php
Yii::import('application.controllers.MyRentsController');
class UpController extends MyRentsController {

    public function actionToPlaceTop() {
        if (!Yii::app()->user->isGuest) {
            if (Yii::app()->request->isAjaxRequest) {
                $lang = $this->curlang;
                $viewparams = array();
                $viewparams['userid'] = $this->user->id;
                if (isset($_POST['id'])) {
                    $viewparams['rent'] = Rent::model()->texted($lang->id)
                            ->findByPk($_POST['id']);
                    $this->renderPartial('_place_top', $viewparams, false, true);
                } else {
                    $user = User::model()
                            ->with(array('rents'=>array('scopes'=>array('texted'=>$lang->id))))
                            ->findByPk(Yii::app()->user->id);
                    $viewparams['rentsList'] = $user->rents;
                    $viewparams['prices'] = Yii::app()->params['current_price'];
                    $this->assignControllerJsCss(array('jquery.jscrollpane.css'), array('jquery.jscrollpane.min.js', 'jScrollPaneSelect.js', 'jquery.jcarousel.min.js'));
                    $this->renderPartial('_place_top_1', $viewparams, false, true);
                }
            }
        }
    }

    public function actionToPlaceMain() {
        if (!Yii::app()->user->isGuest) {
            if (Yii::app()->request->isAjaxRequest) {
                $lang = $this->curlang;
                $viewparams = array();
                $viewparams['userid'] = $this->user->id;
                if (isset($_POST['id'])) {
                    $viewparams['rent'] = Rent::model()->texted($lang->id)
                            ->findByPk($_POST['id'] );
                    $this->renderPartial('_place_main', $viewparams, false, true);
                } else {
                    $viewparams['prices'] = Yii::app()->params['current_price'];
                    $user = User::model()
                            ->with(array('rents'=>array('scopes'=>array('texted'=>$lang->id))))
                            ->findByPk(Yii::app()->user->id);
                    $viewparams['rentsList'] = $user->rents;
                    $this->assignControllerJsCss(array('jquery.jscrollpane.css'), array('jquery.jscrollpane.min.js', 'jScrollPaneSelect.js', 'jquery.jcarousel.min.js'));
                    $this->renderPartial('_place_main_1', $viewparams, false, true);
                }
            }
        }
    }

    public function actionToUpGlobal() {
            if (Yii::app()->request->isAjaxRequest) {
                $viewparams = array();
                $viewparams['userid'] = $this->user->id;
                $this->renderPartial('_up', $viewparams, false, true);
            }

    }
    public function actionToNoaccess() {
            if (Yii::app()->request->isAjaxRequest) {
                $viewparams = array();
                $viewparams['userid'] = $this->user->id;
                $this->renderPartial('_noaccess', $viewparams, false, true);
            }

    }
    public function actionToFree() {
        if (!Yii::app()->user->isGuest) {
            if (Yii::app()->request->isAjaxRequest) {
                $lang = $this->curlang;
                $viewparams = array();
                $viewparams['userid'] = $this->user->id;
                if (isset($_POST['id'])) {
                    $viewparams['rent'] = Rent::model()->texted($lang->id)->findByPk($_POST['id']);
                    $this->renderPartial('_place_main', $viewparams, false, true);
                } else {
                    $viewparams['prices'] = Yii::app()->params['current_price'];
                    $user = User::model()
                            ->with(array('rents'=>array('scopes'=>array('texted'=>$lang->id))))
                            ->findByPk(Yii::app()->user->id);
                    $viewparams['rentsList'] = $user->rents;
                    $this->assignControllerJsCss(array('jquery.jscrollpane.css'), array('jquery.jscrollpane.min.js', 'jScrollPaneSelect.js', 'jquery.jcarousel.min.js'));
                    $this->renderPartial('_free', $viewparams, false, true);
                }
            }
        }
    }

    
    public function actionToUp($id) {
        if (!Yii::app()->user->isGuest) { //только если пользователь существует
            $criteria = new CDbCriteria();
            $criteria->condition = 'user=:creator ';
            $criteria->params = array(':creator' => Yii::app()->user->id);
            $rent = Rent::model()->texted($this->curlang->id)
                    ->findByPk($id, $criteria);
            if ($rent) {
                $view = '_up_notes';
                $params = array();
                $params['description'] = $rent->description;
                $params['userUpsCount'] = $this->user->getActiveUpsCount();
                $params['rent'] = $rent;
                $params['userid'] = Yii::app()->user->id;

                //если было подтверждение апа  и есть свободные апы, выполняем ап
                if (isset($_POST['confrmed']) && ($params['userUpsCount'])) {
                    $up = new OperationLog();
                    $up->user_id = Yii::app()->user->id;
                    $up->operation_id = 1;
                    $up->comment = 'Up ad ' . $rent->id;
                    if ($up->save()) {
                        $params['userUpsCount'] = $this->user->getActiveUpsCount();
                        $rent->last_up = $up->date;
                        if ($rent->save()) {
                            $view = '_up_upped';
                        }
                    } else {
                        print_r($up->getErrors());
                        $view = '_up_error';
                    };
                }

                if (Yii::app()->request->isAjaxRequest) {
                    $this->renderPartial($view, $params);
                }
            }else
                throw new CHttpException(404, 'page not found');
        } else
            throw new CHttpException(404, 'page not found');
    }
}

?>
