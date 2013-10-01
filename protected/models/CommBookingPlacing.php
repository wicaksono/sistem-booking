<?php

/**
 * Class CommBookingPlacing
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class CommBookingPlacing extends ActiveRecord {
    public $id;
    public $ua_id;
    public $br_id;
    public $ne_id;
    public $ns_id;
    public $page;
    public $posx;
    public $posy;
    public $created_at;
    public $updated_at;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'comm_booking_placing';
    }

    public function relations()
    {
        return array(
            'ua' => [static::BELONGS_TO, 'UserAccount', 'ua_id'],
            'br' => [static::BELONGS_TO, 'CommBookingRequest', 'br_id'],
            'ne' => [static::BELONGS_TO, 'NewsEdition', 'ne_id'],
            'ns' => [static::BELONGS_TO, 'NewsSection', 'ns_id']
        );
    }

    public function rules()
    {
        return array(
            ['ua_id,br_id,ne_id,ns_id,page,posx,posy', 'required', 'on' => 'create,update'],
            ['page,posx,posy', 'safe', 'on' => 'getter']
        );
    }

    public function attributeLabels()
    {
        return array(
            'ns_id' => 'Rubrik',
            'page' => 'Halaman',
            'posx' => 'Koordinat Awal',
            'posy' => 'Koordinat Akhir'
        );
    }

    protected function beforeSave()
    {
        $this->posx = hexdec($this->posx);
        $this->posy = hexdec($this->posy);

        return parent::beforeSave();
    }

    protected function beforeFind()
    {
        $this->posx = hexdec($this->posx);
        $this->posy = hexdec($this->posy);

        parent::beforeFind();
    }

    protected function afterFind()
    {
        //$this->posx = sprintf('%02x', $this->posx);
        //$this->posy = sprintf('%02x', $this->posy);

        return parent::afterSave();
    }
}
