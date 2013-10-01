<?php
class Controller extends CController
{
    public $layout = '/layouts/main';
    public $breadcrumbs = array();

    protected function beforeAction($action)
    {
        if(Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = FALSE;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = FALSE;

            Yii::app()->clientScript->scriptMap['jquery-ui.css'] = FALSE;

            Yii::app()->clientScript->scriptMap['jquery-ui.js'] = FALSE;
            Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = FALSE;

            Yii::app()->clientScript->scriptMap['jquery.ba-bbq.js'] = FALSE;
            Yii::app()->clientScript->scriptMap['jquery.yiiactiveform.js'] = FALSE;
        }

        return parent::beforeAction($action);
    }
}
