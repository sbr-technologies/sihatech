<?php

  namespace common\models;

  use yii\behaviors\TimestampBehavior;
  use yii\behaviors\BlameableBehavior;
  use Yii;

  /**
   * This is the model class for table "{{%banner}}".
   *
   * @property integer $id
   * @property string $title
   * @property string $description
   * @property string $image
   * @property integer $sort_order
   * @property integer $created_by
   * @property integer $updated_by
   * @property integer $created_at
   * @property integer $updated_at
   * @property integer $status
   */
  class Banner extends \yii\db\ActiveRecord
  {

      /**
       * @inheritdoc
       */
      const STATUS_BLOCKED = 0;
      const STATUS_ACTIVE = 1;

      public static function tableName()
      {
          return '{{%banner}}';
      }

      public function behaviors()
      {
          parent::behaviors();

          return [TimestampBehavior::className(), BlameableBehavior::className()];
      }

      /**
       * @inheritdoc
       */
      public function rules()
      {
          return [
              [['banner_image', 'title', 'description', 'sort_order'], 'required' ,'on'=>'create'],
              [[ 'title', 'description', 'sort_order'], 'required','on'=>'update'],
              [['sort_order', 'created_by', 'updated_by', 'created_at', 'updated_at', 'status'], 'integer'],
              [['description', 'banner_image' , 'text_color' , 'title' , 'title_ar' , 'description_ar'], 'string'],
              [['title'], 'string', 'max' => 100],
              ['banner_image', 'image', 'extensions' => 'png, jpg, jpeg',
                  'minWidth' => 1600, 'maxWidth' => 1800, 'minHeight' => 560, 'maxHeight' => 800,
              ],
          ];
      }

      /**
       * @inheritdoc
       */
      public function attributeLabels()
      {
          return [
              'id' => Yii::t('app', 'ID'),
              'title' => Yii::t('app', 'Title (EN)'),
              'title_ar' => Yii::t('app', 'Title (AR)'),
              'description' => Yii::t('app', 'Description (EN)'),
              'description_ar' => Yii::t('app', 'Description (AR)'),
              'banner_image' => Yii::t('app', 'Image'),
              'sort_order' => Yii::t('app', 'Sort Order'),
              'created_by' => Yii::t('app', 'Created By'),
              'updated_by' => Yii::t('app', 'Updated By'),
              'created_at' => Yii::t('app', 'Created At'),
              'updated_at' => Yii::t('app', 'Updated At'),
              'status' => Yii::t('app', 'Status'),
          ];
      }

  }
  