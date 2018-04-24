<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\DatePicker;
use common\models\User;
use common\models\DoctorAppointmentBookings;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Doctor Appointment Bookings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-appointment-bookings-index">
   <?php if(Yii::$app->user->identity->profile_id == User::PROFILE_ADMIN) : ?>
    <a href="<?= Yii::$app->urlManager->createUrl(['/appointments/export']) ?>" target="_blank" class="btn btn-success pull-right"><?= Yii::t('app', 'export to CSV') ?></a>
    <a href="<?= Yii::$app->urlManager->createUrl(['/appointments/export-pdf']) ?>" target="_blank" class="btn btn-success pull-right mr10"><?= Yii::t('app', 'export to PDF') ?></a>
    <div class="clear"></div>
    <?php endif;?>
    <?php \yii\widgets\Pjax::begin(); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//                        ['class' => 'yii\grid\SerialColumn'],
            'bookingID',
            ['attribute' => 'doctorName', 'value' => 'doctor.name'],
            ['attribute' => 'clinicName', 'value' => 'clinic.name'],
            ['attribute' => 'visitTimeGmt',
                'label' => 'Visit date',
//                            'contentOptions' => function ($model, $key, $index, $column) {
//                                return ['width' => '25%'];
//                            },
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'visitTime',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'removeButton' => false,
                    'options' => ['placeholder' => Yii::t('app', 'Visit date'), 'class' => 'form-control'],
                    'pluginOptions' => [
                        'autoclose' => true,
                    ],
                ]),
                'format' => 'html',
            ],
            ['attribute' => 'patientName', 'value' => 'patient.name'],
            ['attribute' => 'bookingStatus',
              'headerOptions' => ['style' => 'width:15%'],
              'label' => Yii::t('app', 'Status'),
              'filter' => Html::activeDropDownList($searchModel, 'bookingStatus', [DoctorAppointmentBookings::STATUS_PENDING => 'Pending', DoctorAppointmentBookings::STATUS_ACTIVE => 'Confirmed', DoctorAppointmentBookings::STATUS_CANCEL => 'Canceled', 
                  DoctorAppointmentBookings::STATUS_CANCEL_PATIENT => 'Canceled by patient', DoctorAppointmentBookings::STATUS_CANCEL_DOCTOR => 'Canceled by doctor', DoctorAppointmentBookings::STATUS_CANCEL_CLINIC => 'Canceled by clinic'], ['class' => 'form-control search_select', 'prompt' => 'Status'])
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'buttons' => [
                    'delete' => function($url, $model) {
                        return Yii::$app->user->identity->profile_id == User::PROFILE_ADMIN ? Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => Yii::t('app', 'Delete'),
                                    'data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?')
                                ]) : '';
                    }
                        ]
                    ],
                ],
                'layout' => "{pager}\n{summary}\n{items}\n{pager}"
            ]);
            ?>
            <!--</div>-->
            <!--</div>-->
            <?php \yii\widgets\Pjax::end(); ?>
</div>
