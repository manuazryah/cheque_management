<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ContentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'content_name') ?>

    <?= $form->field($model, 'heading') ?>

    <?= $form->field($model, 'sub_heading') ?>

    <?= $form->field($model, 'small_content') ?>

    <?php // echo $form->field($model, 'large_content') ?>

    <?php // echo $form->field($model, 'banner_image') ?>

    <?php // echo $form->field($model, 'small_image') ?>

    <?php // echo $form->field($model, 'large_image') ?>

    <?php // echo $form->field($model, 'sort_order') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'CB') ?>

    <?php // echo $form->field($model, 'UB') ?>

    <?php // echo $form->field($model, 'DOC') ?>

    <?php // echo $form->field($model, 'DOU') ?>

    <?php // echo $form->field($model, 'field1') ?>

    <?php // echo $form->field($model, 'field2') ?>

    <?php // echo $form->field($model, 'field3') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
