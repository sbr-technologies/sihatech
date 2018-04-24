<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use Yii;

/**
 * This is the model class for table "{{%clinic}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $location
 * @property string $lat
 * @property string $lng
 * @property string $email
 * @property string $phone
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class Clinic extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;

    public static function tableName() {
        return '{{%clinic}}';
    }

    public function behaviors() {
        parent::behaviors();

        return [TimestampBehavior::className(), BlameableBehavior::className()];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [

            [['name', 'email', 'location', 'phone'], 'required'],
            [['name', 'email', 'location', 'phone', 'max_no_of_doc'], 'required', 'on' => 'backend_data'],
            [['short_name'], 'required', 'on' => 'updateClinic'],
            [['name', 'email', 'location', 'phone', 'lat', 'lng', 'provider_id'], 'safe'],
            [['name', 'email', 'location', 'phone', 'lat', 'lng', 'max_no_of_doc'], 'safe', 'on' => 'backend_data'],
            ['short_name', 'string', 'length' => 3],
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'status', 'max_no_of_doc'], 'integer'],
            [['email', 'short_name'], 'unique'],
            [['location'], 'string', 'max' => 150],
            [['email'], 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
//            'name' => Yii::t('app', 'Name'),
            'location' => Yii::t('app', 'Location'),
            'lat' => Yii::t('app', 'Lattitude'),
            'lng' => Yii::t('app', 'Longitude'),
            'phone' => Yii::t('app', 'Phone'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
            'max_no_of_doc' => Yii::t('app', 'Maximum No. Of Doctors'),
        ];
    }

    public function beforeSave($insert) {
        if (!empty($this->short_name)) {
            $this->short_name = strtoupper($this->short_name);
        }
        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingLocks() {
        return $this->hasMany(BookingLock::className(), ['clinic_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinicDocumentUploads() {
        return $this->hasMany(ClinicDocumentUploads::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomSchedules() {
        return $this->hasMany(CustomSchedules::className(), ['clinic_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctorAppointmentBookings() {
        return $this->hasMany(DoctorAppointmentBookings::className(), ['clinic_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctorSchedulePreferances() {
        return $this->hasMany(DoctorSchedulePreferances::className(), ['clinic_id' => 'id']);
    }

    public function getDoctors() {
        $preferences = DoctorSchedulePreferances::find()->where(['clinic_id' => $this->id])->groupBy(['user_id'])->all();
        $ids = [];
        foreach ($preferences as $pref) {
            $ids[] = $pref->user_id;
        }
        return Doctor::find()->where(['id' => $ids])->all();
    }

    public function getDoctorsCount() {
        UserClinic::find()->where(['clinic_id' => $this->id])->groupBy(['user_id'])->count();
    }

    public function getImageSrc() {
        $image = $this->image;
        return empty($image) ? Yii::getAlias('@web/images/no_image.jpg') : Yii::getAlias('@uploadBaseUrl/clinic/' . $image);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers() {
        return $this->hasMany(User::className(), ['clinic_id' => 'id']);
    }

    public static function getUserId($id) {
        $clinic = new self();
        $users = $clinic->users;

        return !empty($users[0]) ? $users[0]->id : false;
    }

    public static function getClinicStatus($id) {
        $doc = Clinic::find()->where(['id' => $id])->one();
        $avgRate = ($doc->avg_rating <> "")?$doc->avg_rating:0;
        $totalRevw = ($doc->total_reviews <> "")?$doc->total_reviews:0;
        $return = [];
        $return['avg_rating'] = (float) $avgRate;
        $return['total_reviews'] = (String) $totalRevw;
        return $return;
    }
    
    public function getPendingSchedules() {
        return $this->hasMany(DoctorSchedulePreferances::className(), ['clinic_id' => 'id'])->where(['user_id' => UserClinic::find()->where('clinic_id=:clinicId and status=:status', [':clinicId' => $this->id, ':status' => UserClinic::STATUS_PENDING])->select('user_id')])->orderBy(['user_id' => SORT_ASC]);
    }

    public function getHasPendingSchedule() {
        return $this->hasOne(UserClinic::className(), ['clinic_id' => 'id'])->where(['status' => UserClinic::STATUS_PENDING])->andWhere(['<>', 'requested_by', $this->id])->exists();
    }

    public function getProfileImage() {
        $avatar = $this->image;
        return empty($avatar) ? Yii::getAlias('@uploadBaseUrl/images/no_thumbnail.jpg') : Yii::getAlias('@uploadBaseUrl/clinic/' . $avatar);
    }

    public static function generateUsername($name, $maxLength = 15, $minLength = 7) {
         return substr(md5(uniqid(rand(), true)), 0 , 8);
    }
    
    public function getDoctorCount(){
        $preferences = DoctorSchedulePreferances::find()->where(['clinic_id' => $this->id])->groupBy(['user_id'])->all();
        $ids = [];
        foreach ($preferences as $pref) {
            $ids[] = $pref->user_id;
        }
        return Doctor::find()->where(['id' => $ids])->count();
    }
    public function getClinicOperatorCount(){
        return User::find()->where(['clinic_id' => $this->id])->count();
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHospital() {
        return $this->hasOne(Hospital::className(), ['id' => 'hospital_id']);
    }
    
}
