<?php

/**
 * Class AccountController
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class AccountController extends Controller
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
                'roles'   => [UserAccount::IT],
                'actions' => ['manage', 'create', 'update', 'delete']
            ),
            array(
                'allow',
                'roles'   => [UserAccount::IT, UserAccount::TF, UserAccount::AI],
                'actions' => ['sales']
            ),
            array(
                'allow',
                'users' => ['?'],
                'actions' => ['login']
            ),
            array(
                'allow',
                'users' => ['@'],
                'actions' => ['index', 'logout']
            ),
            array(
                'allow',
                'users' => ['*'],
                'actions' => ['error']
            ),
            array(
                'deny',
                'users' => ['*']
            )
        );
    }

    public function actionManage()
    {
        $account = new UserAccount('manage');
        $account->unsetAttributes();

        if(isset($_GET['UserAccount'])) {
            $account->setAttributes($_GET['UserAccount']);
        }

        $this->render('manage', array(
            'account' => $account
        ));
    }

    public function actionCreate()
    {
        $account = new UserAccount('create');
        $account->unsetAttributes();

        if(isset($_POST['UserAccount'])) {
            $account->setAttributes($_POST['UserAccount']);
            $account->password = sha1($account->password);
            if(!Yii::app()->request->isAjaxRequest && $account->save()) {
                $this->redirect(['account/manage']);
            }
        }

        if(Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($account);
            Yii::app()->end();
        }

        $this->render('create', array(
            'account' => $account
        ));
    }

    public function actionUpdate($id)
    {
        $account = UserAccount::model()->findByPk($id);
        if(!is_object($account)) throw new CHttpException(403, 'Not Found');

        if(isset($_POST['UserAccount'])) {
            $account->setAttributes($_POST['UserAccount']);

            if($account->new_password != '') {
                $account->password = sha1($account->new_password);
            }

            if(!Yii::app()->request->isAjaxRequest && $account->save()) {
                $this->redirect(['account/manage']);
            }
        }

        if(Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($account);
            Yii::app()->end();
        }

        $this->render('create', array(
            'account' => $account
        ));
    }

    public function actionIndex()
    {
        $this->redirect(['booking/manage']);
    }

    public function actionAbout()
    {
        echo 'test';
    }

    public function actionError()
    {
        $error = Yii::app()->errorHandler->error;
        if(Yii::app()->request->isAjaxRequest)
            echo $error['message'];
        else
            $this->render('error', $error, FALSE, TRUE);
    }

    public function actionLogin()
    {
        $account = new UserAccount('login');
        $account->unsetAttributes();

        if(isset($_POST['ajax'])) {
            echo CActiveForm::validate($account);
            Yii::app()->end();
        }

        if(isset($_POST['UserAccount'])) {
            $account->setAttributes($_POST['UserAccount']);
            if($account->validate() && $account->login()) {
                $this->redirect(['account/index']);
            }
        }

        $this->render('login', array(
            'account' => $account
        ));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(array('account/index'));
    }

    public function actionSales()
    {
        $query = null;
        if(isset($_GET['query'])) {
            $query = $_GET['query'];
        }

        $criteria = new CDbCriteria();
        $criteria->condition = 'realname LIKE :query AND division = 2';
        $criteria->params = [':query' => "%$query%"];
        $account = UserAccount::model()->findAll($criteria);

        $result = array();
        foreach($account as $a) {
            $result[] = [
                'name' => $a->realname,
                'code' => $a->identity,
                'value' => $a->id
            ];
        }

        header('Content-type: application/json');
        echo json_encode($result);
    }
}
