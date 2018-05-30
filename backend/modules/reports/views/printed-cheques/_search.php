<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ChequePrintSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cheque-print-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'bank_account_id') ?>

    <?= $form->field($model, 'cheque_design_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'cheque_number') ?>

    <?php // echo $form->field($model, 'cheque_book_id') ?>

    <?php // echo $form->field($model, 'cheque_date') ?>

    <?php // echo $form->field($model, 'cheque_date_hyphen') ?>

    <?php // echo $form->field($model, 'payee_id') ?>

    <?php // echo $form->field($model, 'currency_type') ?>

    <?php // echo $form->field($model, 'cheque_amount') ?>

    <?php // echo $form->field($model, 'cheque_amount_words') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'cheque_type') ?>

    <?php // echo $form->field($model, 'not_over_status') ?>

    <?php // echo $form->field($model, 'print_status') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'no_of_emi_cheques') ?>

    <?php // echo $form->field($model, 'decrement_check_status') ?>

    <?php // echo $form->field($model, 'current_print_status') ?>

    <?php // echo $form->field($model, 'cheque_position') ?>

    <?php // echo $form->field($model, 'print_type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
