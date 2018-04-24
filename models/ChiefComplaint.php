<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "{{%chief_complaint}}".
 *
 * @property integer $id
 * @property integer $specialty_id
 * @property string $description
 * @property integer $created_at
 */
class ChiefComplaint extends \yii\db\ActiveRecord {

    public function behaviors() {
        parent::behaviors();
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => null
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%chief_complaint}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['specialty_id', 'description'], 'required'],
            [['specialty_id', 'created_at'], 'integer'],
            [['description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'specialty_id' => Yii::t('app', 'Specialty '),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialty()
    {
        return $this->hasOne(SpecialtyMaster::className(), ['id' => 'specialty_id']);
    }
    
}
