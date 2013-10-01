<?php

/**
 * Class UserAccount
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class UserAccount extends ActiveRecord {
    public $id;
    public $username;
    public $password;
    public $identity;
    public $realname;
    public $division;
    public $created_at;
    public $updated_at;

    protected $_identity;

    const GT = 0; // guest
    const IT = 1; // it
    const SL = 2; // sales
    const TF = 3; // traffic
    const AI = 4; // admin iklan

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user_account';
    }

    public function relations()
    {
        return array();
    }

    public function rules()
    {
        return array(
            ['username,password,identity,division,realname', 'required', 'on' => 'create,update'],
            ['username', 'unique', 'on' => 'create,update'],
            ['username,password', 'required', 'on' => 'login'],
            ['password', 'authenticate', 'on' => 'login'],
            ['username,password,identity,division,realname', 'safe', 'on' => 'manage']
        );
    }

    public function authenticate($attribute, $params)
    {
        if(!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            if(!$this->_identity->authenticate()) {
                switch($this->_identity->errorCode) {
                    case UserIdentity::ERROR_UNKNOWN_IDENTITY:
                        $this->addError('username', 'Unknown Identity');
                        break;
                    case UserIdentity::ERROR_USERNAME_INVALID:
                        $this->addError('username', 'Username Invalid');
                        break;
                    case UserIdentity::ERROR_PASSWORD_INVALID:
                        $this->addError('password', 'Password Invalid');
                        break;
                }
            }
        }
    }

    public function login()
    {
        if($this->_identity === NULL) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }

        if($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            Yii::app()->user->login($this->_identity);
            return TRUE;
        }

        return FALSE;
    }

    public function manage()
    {
        $criteria = new CDbCriteria();
        $criteria->together = true;
        $criteria->with = [];
        $criteria->compare('t.username', $this->username, TRUE);
        $criteria->compare('t.identity', $this->identity, TRUE);
        $criteria->compare('t.division', $this->division, TRUE);
        $criteria->compare('t.realname', $this->realname, TRUE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'username' => array(
                        'asc'  => 't.username',
                        'desc' => 't.username DESC',
                    ),
                    'identity' => array(
                        'asc'  => 't.identity',
                        'desc' => 't.identity DESC',
                    ),
                    'division' => array(
                        'asc'  => 't.division',
                        'desc' => 't.division DESC',
                    ),
                    'realname' => array(
                        'asc'  => 't.realname',
                        'desc' => 't.realname DESC',
                    )
                ),
            ),
            'pagination' => array(
                'pageSize' => 10
            ),
        ));
    }

    public static function getDivisionList()
    {
        return array(
            static::GT => 'Guest',
            static::IT => 'IT',
            static::SL => 'Sales',
            static::TF => 'Traffic',
            static::AI => 'Admin Iklan'
        );
    }

    public static function getDivisionName($id)
    {
        foreach(static::getDivisionList() as $key => $name) {
            if($key == $id) {
                return $name;
            }
        }

        return 'Unknown';
    }
}
