<?php

/**
 * Class CommPlacingDateset
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class CommPlacingDateset extends ActiveRecord
{
    public $id;
    public $ua_id;
    public $date;
    public $type;
    public $created_at;
    public $updated_at;

    public $ua_username;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'comm_placing_dateset';
    }

    public function relations()
    {
        return array(
            'ua' => [static::BELONGS_TO, 'UserAccount', 'ua_id']
        );
    }

    public function rules()
    {
        return array(
            ['ua_id,date,type', 'required', 'on' => 'create,update'],
            ['ua_id,date,type', 'safe', 'on' => 'manage,browse'],

            ['date', 'unique']
        );
    }

    public function manage()
    {
        $criteria = new CDbCriteria();
        $criteria->together = true;
        $criteria->with = ['ua'];

        $criteria->compare('t.date', $this->date, TRUE);
        $criteria->compare('t.type', $this->type, TRUE);
        $criteria->compare('ua.username', $this->ua_username, TRUE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'ua_username' => array(
                        'asc'  => 'ua.username',
                        'desc' => 'ua.username DESC',
                    ),
                    'date' => array(
                        'asc'  => 't.date',
                        'desc' => 't.date DESC',
                    ),
                    'type' => array(
                        'asc'  => 't.type',
                        'desc' => 't.type DESC',
                    ),
                    'created_at' => array(
                        'asc'  => 't.created_at',
                        'desc' => 't.created_at DESC',
                    ),
                ),
            ),
            'pagination' => array(
                'pageSize' => 10
            ),
        ));
    }
}
