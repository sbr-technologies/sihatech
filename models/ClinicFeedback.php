<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%clinic_feedback}}".
 *
 * @property integer $id
 * @property integer $feedback_from
 * @property integer $clinic_id
 * @property string $message
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $rating
 * @property integer $status
 *
 * @property Clinic $feedbackTo
 * @property Users $feedbackFrom
 */
class ClinicFeedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%clinic_feedback}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feedback_from', 'clinic_id', 'rating', 'message'], 'required'],
            [['feedback_from', 'clinic_id', 'created_at', 'updated_at', 'rating', 'status'], 'integer'],
            [['message'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'feedback_from' => Yii::t('app', 'Feedback From'),
            'clinic_id' => Yii::t('app', 'Clinic'),
            'message' => Yii::t('app', 'Message'),
            'created_at' => Yii::t('app', 'Feedback At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'rating' => Yii::t('app', 'Rating'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
    
    public function behaviors() {
        parent::behaviors();

        return [TimestampBehavior::className()];
    }
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        $this->changeClinicStat();
    }

    public function afterDelete() {
        parent::afterDelete();
        $this->changeClinicStat();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinic()
    {
        return $this->hasOne(Clinic::className(), ['id' => 'clinic_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbackFrom()
    {
        return $this->hasOne(User::className(), ['id' => 'feedback_from']);
    }
    
    public function getFeedbackTime()
    {
        return \frontend\models\Common::date('jS M, Y', $this->created_at);
    }
    
    protected function changeClinicStat() {
        $ratingModel = static::find()->where(["clinic_id" => $this->clinic_id, "status" => 1]);
        $avg = $ratingModel->average('rating');
        $count = $ratingModel->count();
        $clinicModel = Clinic::findOne($this->clinic_id);
        if(empty($clinicModel)){
            return false;
        }
        $clinicModel->avg_rating = $avg;
        $clinicModel->total_reviews = $count;
        $clinicModel->save();
    }
}
