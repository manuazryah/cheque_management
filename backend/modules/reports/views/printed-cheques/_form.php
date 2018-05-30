<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ChequePrint */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cheque-print-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bank_account_id')->textInput() ?>

    <?= $form->field($model, 'cheque_design_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'cheque_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cheque_date')->textInput() ?>

    <?= $form->field($model, 'payee_id')->textInput() ?>

    <?= $form->field($model, 'currency_type')->textInput() ?>

    <?= $form->field($model, 'cheque_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'print_status')->textInput() ?>

    <?= $form->field($model, 'decrement_check_status')->textInput() ?>

    <?= $form->field($model, 'current_print_status')->textInput() ?>

    <div class="form-group" style="float: right;">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
