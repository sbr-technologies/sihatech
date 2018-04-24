<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%default_map_cities}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $location
 */
class DefaultMapCities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%default_map_cities}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'location', 'lat', 'lng'], 'required'],
            
            [['name' , 'location'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'location' => Yii::t('app', 'Location'),
        ];
    }
}
