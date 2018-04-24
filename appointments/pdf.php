<table width="100%" class="table table-striped table-condensed table-bordered">
    <thead>
        <tr>
            <th><?= Yii::t('app', 'Booking ID') ?></th>
            <th><?= Yii::t('app', 'Booked By') ?></th>
            <th><?= Yii::t('app', 'Doctor Name') ?></th>
            <th><?= Yii::t('app', 'Patient Name') ?></th>
            <th><?= Yii::t('app', 'Clinic Name') ?></th>
            <th><?= Yii::t('app', 'Booking Time') ?></th>
            <th><?= Yii::t('app', 'Visiting Time') ?></th>
            <th><?= Yii::t('app', 'Problem') ?></th>
            <th><?= Yii::t('app', 'Patient Mobile Phone') ?></th>
            <th><?= Yii::t('app', 'Patient Email') ?></th>
            <th><?= Yii::t('app', 'Note') ?></th>
            <th><?= Yii::t('app', 'Booking Status') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($dataProvider->getModels() as $row):
            ?>
            <tr>
                <td><?= $row->bookingID ?></td>
                <td><?= $row->patient->fullName ?></td>
                <td><?= $row->doctor->name ?></td>
                <td><?= $row->patient_name ?></td>
                <td><?= $row->clinic->name ?></td>
                <td><?= date('m/d/Y g:ia', $row->booking_time) . " UTC" ?></td>
                <td><?= $row->visitTime . '" UTC' ?></td>
                <td><?= $row->problem ?></td>
                <td><?= $row->patient_phone_number ?></td>
                <td><?= $row->patient->email ?></td>
                <td><?= $row->note ?></td>
                <td><?= $row->bookingStatus ?></td>
            </tr>
            <?php
        endforeach;
        ?>
    </tbody>
</table>