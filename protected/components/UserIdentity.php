<?php
class UserIdentity extends CUserIdentity
{
    protected $_id;
    protected $_identity;
    protected $_division;

    public function authenticate()
    {
        $account = UserAccount::model()->findByAttributes(array(
            'username' => $this->username
        ));

        if(is_null($account) || $account->division === UserAccount::GT)
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
        elseif($account->password != sha1($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;

        else {
            $this->_id = $account->id;
            $this->setState('identity', $account->identity);
            $this->setState('division', $account->division);
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getIdentity()
    {
        return $this->_identity;
    }

    public function getDivision()
    {
        return $this->_division;
    }
}
