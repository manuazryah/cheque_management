<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-category-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_name')->textInput(['maxlength' => true]) ?>

    <?php// $form->field($model, 'big_image')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'small_image')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'big_content')->textarea(['rows' => 6]) ?>

    <?php //$form->field($model, 'small_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

    <?php //$form->field($model, 'data_1')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'data_2')->textInput(['maxlength' => true]) ?>

    <?php// $form->field($model, 'data_3')->textInput() ?>

    <?php //$form->field($model, 'CB')->textInput() ?>

    <?php// $form->field($model, 'UB')->textInput() ?>

    <?php //$form->field($model, 'DOC')->textInput() ?>

    <?php// $form->field($model, 'DOU')->textInput() ?>

    <div classphp"form-group" style="float: right;">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
