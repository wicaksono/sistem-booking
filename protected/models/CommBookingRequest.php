<?php

/**
 * Class CommBookingRequest
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class CommBookingRequest extends ActiveRecord {
    public $id;
    public $ua_id;
    public $cb_id;
    public $ns_id;
    public $page;
    public $stat;
    public $note;
    public $sizex;
    public $sizey;
    public $color;
    public $publish_at;
    public $created_at;
    public $updated_at;

    const STAT_HOLD = 0;
    const STAT_PROC = 1;
    const STAT_DONE = 2;

    const COLOR_BW = 0;
    const COLOR_FC = 1;

    // relation
    public $ns_name;
    public $cb_name;
    public $ua_username;
    public $sa_username;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'comm_booking_request';
    }

    public function relations()
    {
        return array(
            'ua' => [static::BELONGS_TO, 'UserAccount', 'ua_id'],
            'cb' => [static::BELONGS_TO, 'CommBooking', 'cb_id'],
            'ns' => [static::BELONGS_TO, 'NewsSection', 'ns_id']
        );
    }

    public function rules()
    {
        return array(
            ['ua_id,cb_id,ns_id,page,stat,sizex,sizey,color,publish_at', 'required', 'on' => 'create,update'],
            ['ua_id,cb_id,ns_id,cb_name,ns_name,page,stat,sizex,sizey,color,publish_at', 'safe', 'on' => 'manage,browse']
        );
    }

    public function attributeLabels() {
        return array(
            'ua_id' => 'User ID',
            'cb_id' => 'Booking ID',
            'ns_id' => 'Section ID',
            'page' => 'Halaman',
            'stat' => 'Status',
            'sizex' => 'Kolom',
            'sizey' => 'Baris',
            'color' => 'Warna',
            'publish_at' => 'Terbit',

            // relations
            'cb_name' => 'Iklan',
            'ns_name' => 'Section',
            'ua_username' => 'PIC',
            'sa_username' => 'SIC'
        );
    }

    public function manage()
    {
        $criteria = new CDbCriteria();
        $criteria->together = true;
        $criteria->with = [
            'cb' => [
                'with' => ['sa']
            ],
            'ns'
        ];
        $criteria->compare('t.cb_id', $this->cb_id, TRUE);
        $criteria->compare('ns.name', $this->ns_name, TRUE);
        $criteria->compare('ua.username', $this->ua_username, TRUE);
        $criteria->compare('t.page', $this->page, TRUE);
        $criteria->compare('t.stat', $this->stat, TRUE);
        $criteria->compare('t.sizex', $this->sizex, TRUE);
        $criteria->compare('t.sizey', $this->sizey, TRUE);
        $criteria->compare('t.color', $this->color, TRUE);
        $criteria->compare('t.publish_at', $this->publish_at, TRUE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'ns_name' => array(
                        'asc'  => 'ns.name',
                        'desc' => 'ns.name DESC',
                    ),
                    'ua_username' => array(
                        'asc'  => 'ua.username',
                        'desc' => 'ua.username DESC',
                    ),
                    'page' => array(
                        'asc'  => 't.page',
                        'desc' => 't.page DESC',
                    ),
                    'sizex' => array(
                        'asc'  => 't.sizex',
                        'desc' => 't.sizex DESC',
                    ),
                    'sizey' => array(
                        'asc'  => 't.sizey',
                        'desc' => 't.sizey DESC',
                    ),
                    'color' => array(
                        'asc'  => 't.color',
                        'desc' => 't.color DESC',
                    ),
                    'publish_at' => array(
                        'asc'  => 't.publish_at',
                        'desc' => 't.publish_at DESC',
                    ),
                    'stat' => array(
                        'asc'  => 't.stat',
                        'desc' => 't.stat DESC',
                    ),
                ),
            ),
            'pagination' => array(
                'pageSize' => 10
            ),
        ));
    }

    public function browse()
    {
        $criteria = new CDbCriteria();
        $criteria->together = true;
        $criteria->with = ['cb', 'ns'];
        $criteria->compare('t.id', $this->id, TRUE);
        $criteria->compare('t.cb_id', $this->cb_id, TRUE);
        $criteria->compare('ns.name', $this->ns_name, TRUE);
        $criteria->compare('ua.username', $this->ua_username, TRUE);
        $criteria->compare('sa.username', $this->sa_username, TRUE);
        $criteria->compare('t.page', $this->page, TRUE);
        $criteria->compare('t.stat', $this->stat, TRUE);
        $criteria->compare('t.sizex', $this->sizex, TRUE);
        $criteria->compare('t.sizey', $this->sizey, TRUE);
        $criteria->compare('t.color', $this->color, TRUE);
        $criteria->compare('t.publish_at', $this->publish_at, TRUE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'id' => array(
                        'asc'  => 't.id',
                        'desc' => 't.id DESC',
                    ),
                    'cb_id' => array(
                        'asc'  => 't.cb_id',
                        'desc' => 't.cb_id DESC',
                    ),
                    'cb_name' => array(
                        'asc'  => 'cb.name',
                        'desc' => 'cb.name DESC',
                    ),
                    'ns_name' => array(
                        'asc'  => 'ns.name',
                        'desc' => 'ns.name DESC',
                    ),
                    'ua_username' => array(
                        'asc'  => 'ua.username',
                        'desc' => 'ua.username DESC',
                    ),
                    'sa_username' => array(
                        'asc'  => 'sa.username',
                        'desc' => 'sa.username DESC',
                    ),
                    'page' => array(
                        'asc'  => 't.page',
                        'desc' => 't.page DESC',
                    ),
                    'stat' => array(
                        'asc'  => 't.stat',
                        'desc' => 't.stat DESC',
                    ),
                    'sizex' => array(
                        'asc'  => 't.sizex',
                        'desc' => 't.sizex DESC',
                    ),
                    'sizey' => array(
                        'asc'  => 't.sizey',
                        'desc' => 't.sizey DESC',
                    ),
                    'color' => array(
                        'asc'  => 't.color',
                        'desc' => 't.color DESC',
                    ),
                    'publish_at' => array(
                        'asc'  => 't.publish_at',
                        'desc' => 't.publish_at DESC',
                    ),
                ),
            ),
            'pagination' => array(
                'pageSize' => 10
            ),
        ));
    }

    public static function getStatList()
    {
        return array(
            static::STAT_HOLD => 'TENTATIVE',
            static::STAT_PROC => 'APPROVED',
            static::STAT_DONE => 'FINISHED'
        );
    }

    public static function getStatName($stat)
    {
        foreach(static::getStatList() as $key => $value) {
            if($stat == $key) return $value;
        }
        return 'UNKNOWN';
    }

    public static function getStatHtml($stat)
    {
        switch($stat) {
            case static::STAT_HOLD:
                return CHtml::tag('span', ['class' => 'label label-warning'], static::getStatName($stat));
            case static::STAT_PROC:
                return CHtml::tag('span', ['class' => 'label label-success'], static::getStatName($stat));
            case static::STAT_DONE:
                return CHtml::tag('span', ['class' => 'label label-primary'], static::getStatName($stat));
        }
        return CHtml::tag('span', ['class' => 'label label-default'], static::getStatName($stat));
    }

    public static function getColorList()
    {
        return array(
            static::COLOR_BW => 'BW',
            static::COLOR_FC => 'FC'
        );
    }

    public static function getColorName($color)
    {
        foreach(static::getColorList() as $key => $value) {
            if($color == $key) return $value;
        }
        return 'UNKNOWN';
    }
}
