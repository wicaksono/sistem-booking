<?php

/**
 * Class CommMigrateCompany
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class CommMigrateCompany extends ActiveRecord{
    public $id;
    public $code;
    public $name;
    public $created_at;
    public $updated_at;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'comm_migrate_company';
    }
}
