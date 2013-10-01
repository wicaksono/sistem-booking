<?php

/**
 * Class DataOutsideCustomer
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class DataOutsideCompany extends ActiveRecord {
    public $CUSTCODE;
    public $CUSNAME;
    public $CUSADD;
    public $CUSTELNO;
    public $CUSNPWP;
    public $KETERANGAN;
    public $FLAG;
    public $KD_AGEN;
    public $CUSADD2;
    public $CONTACK;
    public $NAMA_NPWP;
    public $ALAMAT_NPWP;
    public $GRUP;
    public $KODE_BIRO;
    public $JENIS_CUST;
    public $BADAN_USAHA;
    public $GL_ID_REC;
    public $GL_ID_REV;
    public $CUSTOMER_CLASS_CODE;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getDbConnection()
    {
        return Yii::app()->sisko;
    }

    public function tableName()
    {
        return 'TB_CUSTOMER';
    }
}
