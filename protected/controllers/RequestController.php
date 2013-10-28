<?php

/**
 * Class RequestController
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class RequestController extends Controller {
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
                'actions' => ['manage', 'browse', 'create', 'update', 'delete']
            ),
            array(
                'deny',
                'users' => ['*']
            )
        );
    }

    public function actionCreate($id)
    {
        $request = new CommBookingRequest('create');
        $request->unsetAttributes();

        $request->ua_id = Yii::app()->user->id;
        $request->cb_id = $id;

        if(isset($_POST['CommBookingRequest'])) {
            $request->setAttributes($_POST['CommBookingRequest']);

            if($request->save()) {}
        }

        if(isset($_POST['ajax'])) {
            echo CActiveForm::validate($request);
            Yii::app()->end();
        }

        if(Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('create', [
                'request' => $request
            ], false, true);
        } else {
            $this->render('create', [
                'request' => $request
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $request = CommBookingRequest::model()->findByPk($id);
        if(is_null($request)) throw new CHttpException(403, 'Not Found');

        if(isset($_POST['CommBookingRequest'])) {
            $request->setAttributes($_POST['CommBookingRequest']);
            $request->ua_id = Yii::app()->user->id;
            $request->save();
        }

        if(isset($_POST['ajax'])) {
            echo CActiveForm::validate($request);
            Yii::app()->end();
        }

        if(Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('update', [
                'request' => $request
            ], false, true);
        } else {
            $this->render('update', [
                'request' => $request
            ]);
        }
    }

    public function actionDelete($id)
    {
        $booking = CommBookingRequest::model()->findByPk($id);
        if(!is_object($booking)) throw new CHttpException('Not Found');
        if($booking->stat === CommBookingRequest::STAT_DONE) throw new CHttpException('Request yang sudah dicetak tidak dapat dihapus', 403);

        CommBookingRequest::model()->deleteByPk($id);
    }

    public function actionManage($id)
    {
        $request = new CommBookingRequest('manage');
        $request->unsetAttributes();

        if(isset($_GET['CommBookingRequest'])) {
            $request->setAttributes($_GET['CommBookingRequest']);
        }

        $request->cb_id = $id;

        if(Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('manage', [
                'request' => $request
            ], false, true);
        } else {
            $this->render('manage', [
                'request' => $request
            ]);
        }
    }

    public function actionBrowse()
    {
        $request = new CommBookingRequest('browse');
        $request->unsetAttributes();

        if(isset($_GET['CommBookingRequest'])) {
            $request->setAttributes($_GET['CommBookingRequest']);
        }

        if(Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('browse', [
                'request' => $request
            ], false, true);
        } else {
            $this->render('browse', [
                'request' => $request
            ]);
        }
    }
}
