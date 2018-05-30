<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserPlans */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-plans-form form-inline">

        <?php $form = ActiveForm::begin(); ?>



        <?php // $form->field($model, 'valid_days')->textInput() ?>

        <?php // $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

        <?=
        $form->field($model, 'plan_end_date')->widget(\yii\jui\DatePicker::classname(), [
            //'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control'],
        ])
        ?>

        <?php // $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>
        <div class="form-group"></div>
        <div class="form-group"></div>
        <div class="form-group" style="float: right;">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
