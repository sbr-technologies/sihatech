<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DoctorAppointmentBookings */

$this->title =  Yii::t('app', 'Create Doctor Appointment Bookings');
$this->params['breadcrumbs'][] = ['label' =>  Yii::t('app', 'Doctor Appointment Bookings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-appointment-bookings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
