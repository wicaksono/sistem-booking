<?php

/**
 * Class DatesetController
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class DatesetController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl'
        );
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'roles'   => [UserAccount::IT, UserAccount::TF, UserAccount::AI],
                'actions' => ['manage', 'create', 'update', 'delete']
            ),
            array(
                'deny',
                'users' => ['*']
            )
        );
    }

    public function actionManage()
    {
        $dateset = new CommPlacingDateset('manage');
        $dateset->unsetAttributes();

        if(isset($_GET['CommPlacingDateset'])) {
            $dateset->setAttributes($_GET['CommPlacingDateset']);
        }

        $this->render('manage', array(
            'dateset' => $dateset
        ));
    }

    public function actionCreate()
    {
        $dateset = new CommPlacingDateset('create');
        $dateset->unsetAttributes();

        if(isset($_POST['CommPlacingDateset'])) {
            $dateset->setAttributes($_POST['CommPlacingDateset']);
            $dateset->ua_id = 1;

            if(!isset($_POST['ajax']) && $dateset->save()) {
                $this->redirect(['dateset/create']);
            }
        }

        if(isset($_POST['ajax'])) {
            echo CActiveForm::validate($dateset);
            Yii::app()->end();
        }

        $this->render('create', [
            'dateset' => $dateset
        ]);

        if(Yii::app()->request->isAjaxRequest) {
            //
        } else {
        }
    }

    public function actionUpdate($id)
    {
        $dateset = CommPlacingDateset::model()->findByPk($id);
        if(!is_object($dateset)) throw new CHttpException(403, 'Not Found');

        if(isset($_POST['CommPlacingDateset'])) {
            $dateset->setAttributes($_POST['CommPlacingDateset']);
            $dateset->ua_id = 1;

            if(!isset($_POST['ajax']) && $dateset->save()) {
                $this->redirect(['dateset/manage']);
            }
        }

        if(isset($_POST['ajax'])) {
            echo CActiveForm::validate($dateset);
            Yii::app()->end();
        }

        $this->render('create', [
            'dateset' => $dateset
        ]);
    }

    public function actionDelete($id)
    {
        $dateset = CommPlacingDateset::model()->findByPk($id);
        if(!is_object($dateset)) throw new CHttpException(403, 'Not Found');

        CommPlacingDateset::model()->deleteByPk($id);
    }
}
