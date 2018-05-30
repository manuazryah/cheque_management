<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Payee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payee-form">

        <?php $form = ActiveForm::begin(); ?>

        <?php // $form->field($model, 'user_id')->textInput() ?>

        <?= $form->field($model, 'payee_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone')->textInput() ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?php // $form->field($model, 'pan_number')->textInput(['maxlength' => true]) ?>

        <?php // $form->field($model, 'upload_pan_copy')->fileInput(['maxlength' => true]) ?>

        <?php // $form->field($model, 'status')->textInput() ?>

        <?php // $form->field($model, 'date')->textInput() ?>

        <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
