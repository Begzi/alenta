<?php


namespace app\models;


use yii\db\ActiveRecord;

class Auto extends ActiveRecord
{
    public static function tableName()
    {
        return 'auto';
    }
}