<?php
/*
 */

/**
 * Class CommMigrateAccount
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class CommMigrateAccount extends ActiveRecord
{
    public $user_id;
    public $code;
    public $created_at;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'comm_migrate_account';
    }
}
