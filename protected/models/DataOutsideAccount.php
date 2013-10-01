<?php

/*
 */

/**
 * Class DataOutsideAccount
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class DataOutsideAccount extends ActiveRecord {
    public $KOD_AE;
    public $NAMA_AE;
    public $SECTION;
    public $JABATAN;
    public $KODE_GRUP;
    public $KODE;
    public $TANGGAL_AWAL;
    public $TANGGAL_AKHIR;
    public $KODE_BIRO;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'TB_AE';
    }

    public function getDbConnection()
    {
        return Yii::app()->sisko;
    }

    public function syncronize()
    {
        set_time_limit(0);
    }
}
