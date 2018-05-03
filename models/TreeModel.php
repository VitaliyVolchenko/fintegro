<?php
namespace app\models;

use yii\db\ActiveRecord;

class TreeModel extends ActiveRecord
{
    public function getMenu(){
        return self::find()->asArray()->all();
    }

    public static function tableName()
    {
        return 'items';
    }

}