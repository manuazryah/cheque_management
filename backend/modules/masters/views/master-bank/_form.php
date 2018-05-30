<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Country;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\MasterBank */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-bank-form form-inline">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>

	<?php $countries = ArrayHelper::map(Country::findAll(['status' => 1]), 'id', 'country_name'); ?>
	<?= $form->field($model, 'country_id')->dropDownList($countries, ['prompt' => '-Choose a Country-']) ?>


	<?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

	<div class="form-group" style="float: right;">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
