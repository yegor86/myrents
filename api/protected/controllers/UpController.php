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
                    $viewparams['rent'] = Rent::model()->with(array(
                                'descriptions' => array(
                                    'joinType' => 'LEFT OUTER JOIN',
                                    'select' => 'name',
                                    'on' => 'language=' . $lang->id,
                                    )))->findByPk($_POST['id'],'`is_deleted` <> 1');
                    $this->renderPartial('_place_top', $viewparams, false, true);
                } else {
                    $viewparams['rentsList'] = $this->user->rents;
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
                    $viewparams['rent'] = Rent::model()->with(array(
                                'descriptions' => array(
                                    'joinType' => 'LEFT OUTER JOIN',
                                    'select' => 'name',
                                    'on' => 'language=' . $lang->id,
                                    )))->findByPk($_POST['id'] ,'`is_deleted` <> 1');
                    $this->renderPartial('_place_main', $viewparams, false, true);
                } else {
                    $viewparams['prices'] = Yii::app()->params['current_price'];
                    $viewparams['rentsList'] = $this->user->rents;
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
                    $viewparams['rent'] = Rent::model()->with(array(
                                'descriptions' => array(
                                    'joinType' => 'LEFT OUTER JOIN',
                                    'select' => 'name',
                                    'on' => 'language=' . $lang->id,
                                    )))->findByPk($_POST['id'] ,'`is_deleted` <> 1');
                    $this->renderPartial('_place_main', $viewparams, false, true);
                } else {
                    $viewparams['prices'] = Yii::app()->params['current_price'];
                    $viewparams['rentsList'] = $this->user->rents;
                    $this->assignControllerJsCss(array('jquery.jscrollpane.css'), array('jquery.jscrollpane.min.js', 'jScrollPaneSelect.js', 'jquery.jcarousel.min.js'));
                    $this->renderPartial('_free', $viewparams, false, true);
                }
            }
        }
    }

    
    public function actionToUp($id) {
        if (!Yii::app()->user->isGuest) { //только если пользователь существует
            $criteria = new CDbCriteria();
            $criteria->condition = 'user=:creator AND `is_deleted` <> 1 ';
            $criteria->params = array(':creator' => Yii::app()->user->id);
            $rent = Rent::model()->with(array(
                        'descriptions' => array(
                            'joinType' => 'LEFT OUTER JOIN',
                            'select' => 'name',
                            'on' => 'language=' . $this->curlang->id,
                            )))->findByPk($id, $criteria);
            if ($rent) {
                $view = '_up_notes';
                $params = array();
                $params['description'] = (isset($rent->descriptions[0])) ? $rent->descriptions[0] : RentDescription::model()->findByPk(array('rent' => $rent->id, 'language' => 1));
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
