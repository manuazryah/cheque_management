<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterPlans;
use yii\helpers\ArrayHelper;
use common\models\Country;

/* @var $this yii\web\View */
/* @var $model common\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form form-inline">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->errorSummary($model); ?>

        <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

        <?php // $form->field($model, 'owners_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email_id')->textInput(['maxlength' => true]) ?>

        <?php if ($model->isNewRecord) { ?>
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                <?php
        } else {
                ?>
                <?= ''; ?> <?php } ?>
        <?php
        $countries = ArrayHelper::map(Country::findAll(['status' => 1]), 'id', 'country_name');
        ?>
        <?= $form->field($model, 'country')->dropDownList($countries, ['prompt' => '-Choose a country-', 'options' => ['class' => 'form-group'], 'template' => '<div class="col-sm-12">{input}{error}</div>']) ?>

        <?php // $form->field($model, 'state')->textInput(['maxlength' => true])  ?>

        <?php // $form->field($model, 'city')->textInput(['maxlength' => true])  ?>

        <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

        <?php // $form->field($model, 'address')->textarea(['rows' => 6])  ?>

        <?php $posts = ArrayHelper::map(MasterPlans::findAll(['status' => 1]), 'id', 'plan_name'); ?>
        <?= $form->field($model, 'plan')->dropDownList($posts, ['prompt' => '-Choose a Plan-']) ?>

        <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>
        <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>
        <div class="form-group"></div>
        <div class="form-group"></div>


        <div class="form-group" style="float: right;">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
