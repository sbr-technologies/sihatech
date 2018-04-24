<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%contact_form}}".
 *
 * @property integer $id
 * @property string $salutation
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $subject
 * @property string $message
 * @property integer $sent_at
 */
class ContactForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contact_form}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'phone', 'subject', 'message', 'sent_at'], 'required'],
            [['message'], 'string'],
            [['sent_at'], 'integer'],
            [['salutation', 'phone'], 'string', 'max' => 20],
            [['first_name', 'last_name'], 'string', 'max' => 128],
            [['subject'], 'string', 'max' => 256],
            [['email'], 'email'],
            [['phone'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'salutation' => Yii::t('app', 'Salutation'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'subject' => Yii::t('app', 'Subject'),
            'message' => Yii::t('app', 'Message'),
            'sent_at' => Yii::t('app', 'Sent At'),
        ];
    }
}
