<?php
class WebUser extends CWebUser
{
    private $_account = NULL;

    public function getAccount()
    {
        if(!$this->isGuest && $this->_account === NULL) {
            $this->_account = UserAccount::model()->findByPk($this->id);
        }
        return $this->_account;
    }

    public function __get($name)
    {
        if($name === 'account')
            return $this->getAccount();
        else
            return parent::__get($name);
    }

    /**
     * Performs access check for this user.
     * @param string $operation the name of the operation that need access check.
     * @param array $params name-value pairs that would be passed to business rules associated
     * with the tasks and roles assigned to the user.
     * Since version 1.1.11 a param with name 'userId' is added to this array, which holds the value of
     * {@link getId()} when {@link CDbAuthManager} or {@link CPhpAuthManager} is used.
     * @param boolean $allowCaching whether to allow caching the result of access check.
     * When this parameter
     * is true (default), if the access check of an operation was performed before,
     * its result will be directly returned when calling this method to check the same operation.
     * If this parameter is false, this method will always call {@link CAuthManager::checkAccess}
     * to obtain the up-to-date access result. Note that this caching is effective
     * only within the same request and only works when <code>$params=array()</code>.
     * @return boolean whether the operations can be performed by this user.
     */
    public function checkAccess($operation,$params=array(),$allowCaching=true)
    {
        if(empty($this->id))
            return FALSE;

        return ($operation === (int) $this->getState('division'));
    }
}
