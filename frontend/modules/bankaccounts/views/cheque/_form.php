<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterBank;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\BankAccounts */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
	.another_bank{
		color: #ea1714;
		font-size: 17px;
	}
</style>

<div class="bank-accounts-form">

	<?php $form = ActiveForm::begin(); ?>
	<?= $form->errorSummary($model); ?>

	<?php // $form->field($model, 'user_id')->textInput() ?>

	<?= $form->field($model, 'cheque_series_starting_number')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'number_of_cheques')->textInput() ?>

	<?php // $form->field($model, 'status')->textInput() ?>

	<?php // $form->field($model, 'date')->textInput()  ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
<script>
//	$(document).ready(function () {
//		//$('.field-bankaccounts-bank_name').hide();
//		$("#another").click(function () {
//			$('.field-bankaccounts-bank_name').show();
//			//$('.field-bankaccounts-bank_id').hide();
//			$('#another').hide();
//		});
//	});
</script>
