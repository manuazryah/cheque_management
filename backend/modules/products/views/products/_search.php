<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'product_category') ?>

    <?= $form->field($model, 'product_titile') ?>

    <?= $form->field($model, 'sub_title') ?>

    <?= $form->field($model, 'big_image') ?>

    <?php // echo $form->field($model, 'small_image') ?>

    <?php // echo $form->field($model, 'big_content') ?>

    <?php // echo $form->field($model, 'small_content') ?>

    <?php // echo $form->field($model, 'view_more_link') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'data_1') ?>

    <?php // echo $form->field($model, 'data_2') ?>

    <?php // echo $form->field($model, 'data_3') ?>

    <?php // echo $form->field($model, 'CB') ?>

    <?php // echo $form->field($model, 'UB') ?>

    <?php // echo $form->field($model, 'DOC') ?>

    <?php // echo $form->field($model, 'DOU') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
