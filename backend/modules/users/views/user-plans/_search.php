<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserPlansSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-plans-search">

        <?php
        $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
        ]);
        ?>

        <?= $form->field($model, 'id') ?>

        <?= $form->field($model, 'user_id') ?>

        <?= $form->field($model, 'plan_name') ?>

        <?= $form->field($model, 'status') ?>

        <?= $form->field($model, 'amount') ?>

        <?= $form->field($model, 'valid_days') ?>

        <?php // echo $form->field($model, 'amount') ?>

        <?php // echo $form->field($model, 'date')  ?>

        <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
