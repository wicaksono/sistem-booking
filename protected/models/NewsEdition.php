<?php

/**
 * Class NewsEdition
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class NewsEdition extends ActiveRecord {
    public $id;
    public $name;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'news_edition';
    }

    public function relations()
    {
        return array();
    }

    public function rules()
    {
        return array(
            ['name', 'length', 'max' => 255],
            ['id,name', 'safe', 'on' => 'manage'],
        );
    }

    public static function getOptionList()
    {
        return CHtml::listData(self::model()->findAll(), 'id', 'name');
    }
}
