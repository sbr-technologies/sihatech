<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%custom_schedules}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $schedule_id
 * @property string $schedule_date
 * @property integer $clinic_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @property Users $user
 * @property Schedules $schedule
 * @property Users $clinic
 * @property Users $updatedBy
 * @property Users $createdBy
 */
class CustomSchedules extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%custom_schedules}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'schedule_id', 'schedule_date', 'clinic_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'schedule_id', 'clinic_id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'status'], 'integer'],
            [['schedule_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'schedule_id' => Yii::t('app', 'Schedule ID'),
            'schedule_date' => Yii::t('app', 'Schedule Date'),
            'clinic_id' => Yii::t('app', 'Clinic ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedule()
    {
        return $this->hasOne(Schedules::className(), ['id' => 'schedule_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinic()
    {
        return $this->hasOne(Users::className(), ['id' => 'clinic_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(Users::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Users::className(), ['id' => 'created_by']);
    }
}
