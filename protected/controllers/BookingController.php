<?php

/**
 * Class BookingController
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class BookingController extends Controller
{
    public $defaultAction = 'manage';

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

    public function actionCreate()
    {
        $booking = new CommBooking('create');
        $booking->unsetAttributes();

        if(isset($_POST['CommBooking'])) {
            $booking->setAttributes($_POST['CommBooking']);

            // @fixme ua_id
            $booking->ua_id = Yii::app()->user->id;
        }

        if(isset($_POST['ajax'])) {
            echo CActiveForm::validate($booking);
            Yii::app()->end();
        }

        if(isset($_POST['CommBooking']) && !isset($_POST['ajax'])) {
            if($booking->save()) {
                $this->redirect(['booking/update', 'id' => $booking->id]);
            }
        }

        if(Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('create', [
                'booking' => $booking
            ], false, true);
        } else {
            $this->render('create', [
                'booking' => $booking
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $booking = CommBooking::model()->findByPk($id);
        if(is_null($booking)) throw new CHttpException(403, 'Not Found');
        if($booking->stat == CommBooking::STAT_DONE) $this->redirect(['/booking/manage']);

        if(isset($_POST['CommBooking'])) {
            $booking->setAttributes($_POST['CommBooking']);
            $booking->ua_id = Yii::app()->user->id;

            $booking->save();
        }

        if(isset($_POST['ajax'])) {
            echo CActiveForm::validate($booking);
            Yii::app()->end();
        }

        if(Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('update', [
                'booking' => $booking
            ], false, true);
        } else {
            $this->render('update', [
                'booking' => $booking
            ]);
        }
    }

    public function actionDelete($id)
    {
        $booking = CommBooking::model()->findByPk($id);
        if(!is_object($booking)) throw new CHttpException('Not Found');

        CommBooking::model()->deleteByPk($id);
    }

    public function actionManage()
    {
        $booking = new CommBooking('manage');
        $booking->unsetAttributes();

        if(isset($_GET['CommBooking'])) {
            $booking->setAttributes($_GET['CommBooking']);
        }

        if(Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('manage', [
                'booking' => $booking
            ], false, true);
        } else {
            $this->render('manage', [
                'booking' => $booking
            ]);
        }
    }
}
