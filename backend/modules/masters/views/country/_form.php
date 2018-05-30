<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-form form-inline">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'country_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'currency_code')->textInput(['maxlength' => true]) ?>



        <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'decimal_value')->textInput(['maxlength' => true]) ?>


        <?= $form->field($model, 'format')->dropDownList(['1' => 'indian', '2' => 'international']) ?>

        <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

        <div class="form-group" style="float: right;">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
