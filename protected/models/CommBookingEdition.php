<?php

/**
 * Class CommBookingEdition
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class CommBookingEdition extends ActiveRecord {
    public $cb_id;
    public $ne_id;
    public $created_at;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'comm_booking_edition';
    }

    public function relations()
    {
        return array(
            'cb' => [static::BELONGS_TO, 'CommBooking', 'cb_id'],
            'ne' => [static::BELONGS_TO, 'NewsEdition', 'ne_id']
        );
    }
}
