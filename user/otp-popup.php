<?php

use yii\helpers\Html;
?>
<div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h2 class="modal-title text-center"> <?= Yii::t('app', 'Account OTP Verification') ?></h2>
    <input type="hidden" id="otp_hash" value="<?= Yii::$app->request->get('hash') ?>"/>
</div>
<div class="inner_popup_form_tab details_view_popup">
    <table class="table table-responsive table-bordered table-striped booking_table">
        <tbody>
            <?php if (!empty($phoneNumber)) : ?>
                <tr>
                    <td colspan="2"> <p>
                            <?= Yii::t('app', 'To verify your account, we will be sending a confirmation code to the phone number you have on your account. If you need to change your phone number, please click on "update phone number" link.'); ?>
                        </p>
                        <p>
                            <?= Yii::t('app', 'If you do not get any confirmation code, it could mean several things. Sometimes, your mobile carrier would have slight delays receiving SMSes, or you might also have blocked receiving SMSes from commercial numbers. In such cases, please contact your mobile carrier.'); ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
            <center>
                <div class="row">
                    <button class="btn btn_primary_blue"  id='send_new_acc_otp'> <?= Yii::t('app', 'Send OTP to {phoneNumber}', ['phoneNumber' => $phoneNumber]) ?></button>
                    <button class="btn btn_primary_grey" id='already_got_acc_otp'> <?= Yii::t('app', 'I have already Received an OTP') ?></button>
                </div>
            </center>

            <center><a href="javascript:void(0)" class="upnlink"><?= Yii::t('app', 'update phone number') ?></a> </center>
            <br/>
            <div class="row dnone upnod">
                <div class="form-group col-md-8 col-md-offset-2">

                    <div class="col-md-3 npd"><?= Html::dropDownList('calling_code', Yii::$app->user->identity->calling_code, \yii\helpers\ArrayHelper::map(\common\models\CallingCodes::find()->orderBy(['name' => SORT_STRING])->all(), 'code', 'name'), ['class' => 'form-control selectpicker calling_code_up'])
                            ?></div>
                    <div class="col-md-4 npd">  <?= Html::textInput('phone_number', Yii::$app->user->identity->phone_number, ['class' => 'form-control phone_number_up', 'placeholder' => Yii::t('app', 'Phone Number') ]) ?></div>
                    <div class="col-md-5  text-left">
                        <inpput type="button" class="btn btn_primary_green savebt"><?= Yii::t('app', 'Update') ?></inpput>
                        <inpput type="button" class="btn btn-danger upcbt"><?= Yii::t('app', 'Cancel') ?></inpput>
                    </div>
                    <div class="clear"></div>

                </div>
            </div>

            </td>
            </tr>
            <tr class="acc_otp_row dnone">
                <td> <label for="otp_number"><?= Yii::t('app', 'Enter OTP Code') ?></label></td>
                <td>
                    <div class="row">
                        <div class="form-book col-lg-4">
                            <input type="text" 
                                   data-error-text="<?= Yii::t('app', 'OTP can\'t be blank.') ?>" 
                                   placeholder="ex. 340003" value="" class="form-control" 
                                   name="" 
                                   id="acc_otp_number">

                        </div>

                        <div class="form-book col-lg-2">
                            <button class="btn btn_primary_green" id='confirm_acc_otp'> <?= Yii::t('app', 'Confirm') ?></button>

                        </div>
                        <div class="form-book col-lg-3"><a href="javascript:void(0)" class="acc_otp_resend_link btn"><?= Yii::t('app', 'Resend OTP') ?></a></div>

                        <div class="clear"></div>
                    </div>
                    <div class="row dnone acc_otp_sent-status">
                        <div class="col-lg-12 help-block help-block-success"></div>
                    </div>
                    <div class="clear"></div>
                </td>
            </tr>
        <?php else : ?>
            <tr>
                <td colspan="2"> <p>
                        <?= Yii::t('app', 'Looks like you do not have any phone number on file. Please edit your profile, and enter a phone number first.'); ?>
                    </p>

                </td>
            </tr>
        <?php endif; ?>
        </tbody>

    </table>


</div>
