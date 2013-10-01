<?php

/**
 * Class NewsSection
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class NewsSection extends ActiveRecord
{
    public $id;
    public $ps_id;
    public $name;
    public $created_at;
    public $updated_at;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'news_section';
    }

    public function relations()
    {
        return array(
            'ps' => [self::BELONGS_TO, 'NewsSection', 'ps_id'],
        );
    }

    public static function getOptionList()
    {
        return CHtml::listData(static::model()->findAll(), 'id', 'name');
    }
}
