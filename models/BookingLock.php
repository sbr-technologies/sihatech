<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%booking_lock}}".
 *
 * @property integer $id
 * @property integer $doctor_id
 * @property integer $clinic_id
 * @property integer $patient_id
 * @property string $visiting_date
 * @property string $lock_time
 *
 * @property Users $patient
 * @property Users $doctor
 * @property Clinic $clinic
 */
class BookingLock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const MAXLOCKTIME = 600;// in seconds
    public static function tableName()
    {
        return '{{%booking_lock}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doctor_id', 'clinic_id', 'patient_id', 'visiting_date'], 'required'],
            [['doctor_id', 'clinic_id', 'patient_id'], 'integer'],
            [['visiting_date', 'lock_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'doctor_id' => Yii::t('app', 'Doctor ID'),
            'clinic_id' => Yii::t('app', 'Clinic ID'),
            'patient_id' => Yii::t('app', 'Patient ID'),
            'visiting_date' => Yii::t('app', 'Visiting Date'),
            'lock_time' => Yii::t('app', 'Lock Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Users::className(), ['id' => 'patient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctor()
    {
        return $this->hasOne(Users::className(), ['id' => 'doctor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinic()
    {
        return $this->hasOne(Clinic::className(), ['id' => 'clinic_id']);
    }
}
