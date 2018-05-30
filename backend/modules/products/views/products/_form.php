<?php

use yii\helpers\Html;
use common\models\ProductCategory;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form form-inline">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php $categories = ArrayHelper::map(ProductCategory::findAll(['status' => 1]), 'id', 'category_name'); ?>
    <?= $form->field($model, 'product_category')->dropDownList($categories, ['prompt' => '-Choose a Product Category-']) ?>

    <?= $form->field($model, 'product_titile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'big_image')->fileInput() ?>

    <?php// $form->field($model, 'small_image')->fileInput() ?>

    <?= $form->field($model, 'big_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'small_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'view_more_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

  

    <div class="form-group" style="float: right;">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
