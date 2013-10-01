<?php

/**
 * Class CommBooking
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class CommBooking extends ActiveRecord {
    public $id;
    public $ua_id;
    public $sa_id;
    public $co_id;
    public $name;
    public $stat;
    public $note;
    public $created_at;
    public $updated_at;

    // custom form
    public $editions;

    // relations
    public $br_id;
    public $ua_username;

    const STAT_HOLD = 0;
    const STAT_PROC = 1;
    const STAT_DONE = 2;

    const STAT_PENDING = 0;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'comm_booking';
    }

    public function relations()
    {
        return array(
            'ua' => [static::BELONGS_TO, 'UserAccount', 'ua_id'],
            'sa' => [static::BELONGS_TO, 'UserAccount', 'sa_id'],
            'cc' => [static::BELONGS_TO, 'CommMigrateClient', 'cc_id'],
            'br' => [static::HAS_MANY, 'CommBookingRequest', 'cb_id'],
            'be' => [static::HAS_MANY, 'CommBookingEdition', 'cb_id']
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'ua_id' => 'Account ID',
            'sa_id' => 'Sales ID',
            'co_id' => 'Customer ID',
            'name' => 'Judul',
            'stat' => 'Status',
            'note' => 'Catatan'
        );
    }

    public function rules()
    {
        return array(
            ['ua_id,sa_id,co_id', 'required', 'on' => 'create,update'],
            ['name,stat,editions', 'required', 'on' => 'create,update'],
            ['ua_id,sa_id,co_id,name,stat', 'safe', 'on' => 'manage,browse'],
        );
    }

    protected function afterSave()
    {
        $this->syncEdition();
    }

    protected function afterFind()
    {
        $this->editions = static::getEditions($this->id);
    }

    public function syncEdition()
    {
        if(!$this->isNewRecord) {
            CommBookingEdition::model()->deleteAll('cb_id = :cb_id', [
                'cb_id' => $this->id
            ]);
        }

        foreach($this->editions as $ne) {
            $edition = new CommBookingEdition('create');
            $edition->cb_id = $this->id;
            $edition->ne_id = $ne;
            $edition->save(false);
        }
    }

    public function manage()
    {
        $criteria = new CDbCriteria();
        $criteria->together = true;
        $criteria->with = ['ua'];
        $criteria->compare('t.name', $this->name, TRUE);
        $criteria->compare('t.stat', $this->stat, TRUE);

        $criteria->compare('ua.username', $this->ua_username, TRUE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'id' => array(
                        'asc'  => 't.id',
                        'desc' => 't.id DESC',
                    ),
                    'ua_username' => array(
                        'asc'  => 'ua.username',
                        'desc' => 'ua.username DESC',
                    ),
                    'name' => array(
                        'asc'  => 't.name',
                        'desc' => 't.name DESC',
                    ),
                    'stat' => array(
                        'asc'  => 't.stat',
                        'desc' => 't.stat DESC',
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

    public static function getEditions($id)
    {
        return CHtml::listData(CommBookingEdition::model()->findAllByAttributes(['cb_id' => $id]), 'ne_id', 'ne_id');
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
}
