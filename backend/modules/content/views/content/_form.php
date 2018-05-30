<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Content */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-form form-inline">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'content_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'heading')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_heading')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'small_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'large_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'banner_image')->fileInput() ?>

    <?= $form->field($model, 'small_image')->fileInput() ?>

    <?= $form->field($model, 'large_image')->fileInput() ?>

    <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

    <div class="form-group" style="float: right;">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
