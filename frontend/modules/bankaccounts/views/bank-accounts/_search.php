<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BankAccountsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bank-accounts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'bank_id') ?>

    <?= $form->field($model, 'bank_name') ?>

    <?= $form->field($model, 'branch') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'account_name') ?>

    <?php // echo $form->field($model, 'account_number') ?>

    <?php // echo $form->field($model, 'cheque_series_starting_number') ?>

    <?php // echo $form->field($model, 'number_of_cheques') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
