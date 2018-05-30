<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\PrintStatus;
use yii\helpers\ArrayHelper;
use common\models\Payee;

/* @var $this yii\web\View */
/* @var $model common\models\ChequePrint */
/* @var $form ActiveForm */
?>
<div class="form <?php if (!empty($_GET['id'])) { ?>form-inline<?php } ?>">

        <?php $form = ActiveForm::begin(); ?>
        <input type="hidden" name="bank_id" value="<?= $model->bank_account_id; ?>">
        <input type="hidden" name="payee_id" value="<?= $model->payee_id; ?>">
        <?php
        $model->bank_account_id = $model->bank->bank_name;
        // $model->payee_id = $model->payee->payee_name;
        ?>
        <?= $form->field($model, 'bank_account_id')->textInput(['readonly' => true]) ?>

        <?php // $form->field($model, 'cheque_design_id')  ?>
        <?php // $form->field($model, 'user_id') ?>
        <?= $form->field($model, 'cheque_number')->textInput(['readonly' => true]) ?>
        <?=
        $form->field($model, 'cheque_date')->widget(\yii\jui\DatePicker::classname(), [
            //'language' => 'ru',
            'dateFormat' => 'dd-MM-yyyy',
            'options' => ['class' => 'form-control']])
        ?>
        <?php
        $payee = ArrayHelper::map(Payee::findAll(['status' => 1, 'user_id' => Yii::$app->session['user_session']['id']]), 'id', 'payee_name');
        ?>
        <?= $form->field($model, 'payee_id')->dropDownList($payee, ['prompt' => '-Choose a payee-', 'options' => array($model->payee_id => array('selected' => true))]) ?>
        <?php // $form->field($model, 'currency_type') ?>
        <?= $form->field($model, 'cheque_amount') ?>
        <?= $form->field($model, 'remarks') ?>

        <?php if (Yii::$app->session->hasFlash('error_remark')): ?>
                <div class="alert alert-error" role="alert">
                        <?= Yii::$app->session->getFlash('error_remark') ?>
                </div>
        <?php endif; ?>



        <?php
        $arr = [4, 5];
        $status = ArrayHelper::map(PrintStatus::findAll(['status' => 1, 'id' => $arr]), 'id', 'status_name');
        ?>
        <?= $form->field($model, 'print_status')->dropDownList($status, ['prompt' => '-Choose a status-', 'options' => array($model->print_status => array('selected' => true))]) ?>


        <?php
        if (($model->print_status != 4) && ($model->print_status != 5) && ($model->print_status != 6)) {
                if ($model->print_status == 1) {
                        $text = 'POSTDATED';
                } elseif ($model->print_status == 2) {
                        $text = 'UPCOMING';
                } elseif ($model->print_status == 3) {
                        $text = 'OVERDUE';
                }
                echo '<span style="padding-left: 30px;
    font-size: 15px;
    font-weight: bold;">present status is </span><span style="font-weight: bold;
    color: green;">' . $text . '</span>';
        }
        ?>


        <div class="form-group" style="float: right;">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>

</div>

<style>
        .alert {
                padding: 4px;
                margin-bottom: 18px;
                border: 1px solid transparent;
                border-radius: 0;
                color: red;
                float: right;
                width: 160px;
        }
</style>