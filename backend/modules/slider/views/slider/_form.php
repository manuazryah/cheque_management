<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form form-inline">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'Slider_category')->textInput() ?>

    <?= $form->field($model, 'caption')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sub_caption')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'readmore_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

    <div class="form-group" style="float: right;">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
