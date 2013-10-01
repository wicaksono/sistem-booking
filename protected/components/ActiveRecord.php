<?php
class ActiveRecord extends CActiveRecord
{
    public $created_at;
    public $updated_at;

    public function behaviors()
    {
            return array(
                    'CTimestampBehavior' => array(
                            'class' => 'zii.behaviors.CTimestampBehavior',
                            'createAttribute' => 'created_at',
                            'updateAttribute' => 'updated_at',
                            'setUpdateOnCreate' => true,
                            'timestampExpression' => 'time()',
                    ),
            );
    }
}
