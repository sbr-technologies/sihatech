<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\DoctorAppointmentBookings;

/* @var $this yii\web\View */
/* @var $model common\models\DoctorAppointmentBookings */
/* @var $form yii\widgets\ActiveForm */
$statusList = [
    DoctorAppointmentBookings::STATUS_CANCEL => 'Cancelled',
    DoctorAppointmentBookings::STATUS_CANCEL_CLINIC => 'Cancelled By Clinic',
    DoctorAppointmentBookings::STATUS_CANCEL_DOCTOR => 'Cancelled By Doctor',
    DoctorAppointmentBookings::STATUS_CANCEL_PATIENT => 'Cancelled By Patient',
    DoctorAppointmentBookings::STATUS_ACTIVE => 'Confirmed',
    DoctorAppointmentBookings::STATUS_DOCTOR_CONFIRMED => 'Confirmed By Doctor',
    DoctorAppointmentBookings::STATUS_PATIENT_CONFIRMED => 'Confirmed By Patient',
    DoctorAppointmentBookings::STATUS_EMERGENCY => 'Emergency',
    DoctorAppointmentBookings::STATUS_PENDING => 'Pending',
    DoctorAppointmentBookings::STATUS_VISITED => 'Visited',
    DoctorAppointmentBookings::STATUS_WAITING => 'Waiting'];
?>

<div class="doctor-appointment-bookings-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'status')->dropDownList($statusList); ?>

    <div class="form-group">
        <div class="col-sm-8 col-md-6 col-sm-push-4 col-md-push-3">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
