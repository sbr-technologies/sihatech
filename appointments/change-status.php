<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DoctorAppointmentBookings */

$this->title = Yii::t("app", "Update Doctor Appointment Bookings").': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t("app", "Doctor Appointment Bookings"), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t("app", 'Update');
?>
<div class="doctor-appointment-bookings-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
