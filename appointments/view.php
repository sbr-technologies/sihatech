<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\DoctorAppointmentBookings */

$this->title = Yii::t("app", "View booking - {bookingID}", ['bookingID' => $model->bookingID]);
$this->params['breadcrumbs'][] = ['label' => 'Doctor Appointment Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-appointment-bookings-view">


<?php if (Yii::$app->user->identity->profile_id == User::PROFILE_ADMIN) : ?>
        <p>

            <?=
            Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t("app", 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </p>
    <?php endif; ?>
<?php if (Yii::$app->user->identity->profile_id == User::PROFILE_CC) : ?>
        <p>

            <?=
            Html::a('Update Status', ['change-status', 'id' => $model->id], [
                'class' => 'btn btn-success',
            ])
            ?>
        </p>
    <?php endif; ?>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [

            'bookingID',
            ['attribute' => 'Doctor Name', 'value' => $model->doctor->fullName . ' ( ' . (!empty($model->doctor->calling_code) && !empty($model->doctor->phone_number) ? $model->doctor->calling_code . ' ' . $model->doctor->phone_number : Yii::t('app', 'No Phone number') ) . ' )',],
            'patientName',
            ['attribute' => 'Clinic Name', 'value' => $model->clinic->name . ' ( ' . (!empty($model->clinic->calling_code) && !empty($model->clinic->phone_number) ? $model->clinic->calling_code . ' ' . $model->clinic->phone_number : Yii::t('app', 'No Phone number') ) . ' )',],
            ['attribute' => 'Visit Time', 'value' => $model->visitTimeGmt,],
            ['attribute' => 'Booking Time', 'value' => date('m/d/Y h:i a', $model->booking_time) . ' (UTC)'],
            'problem:ntext',
            'patientPhoneNumber',
            'bookingStatus'
        ],
    ])
    ?>

</div>
