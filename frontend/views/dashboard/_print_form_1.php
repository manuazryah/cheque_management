<?php

use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\BankAccounts */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
	.another_bank{
		color: #ea1714;
		font-size: 17px;
	}
	label{
		font-weight: 600 !important;
		margin-bottom: 7px;
	}


</style>

<div class="bank-accounts-form">

	<div class="form-group ">
		<label class="control-label">CHEQUE NUMBER : </label>
		<input type="text" id="cheque-number" class="form-control" name="cheque-number"   value="<?= $cheques->cheque_series_starting_number ?>">
	</div>
	<div class="form-group ">
		<label class="control-label">DATE:</label>
		<?php
		echo DatePicker::widget([
		    'name' => 'date',
		    'id' => 'print-date',
		    'value' => '23-Feb-1982',
		    'dateFormat' => 'MM-dd-yyyy',
		    'options' => ['class' => 'form-control']
		]);
		?>
	</div>

	<div class="form-group ">
		<label class="control-label">AMOUNT LINE HEIGHT</label>
		<input type="number" id="amount-line-height" class="form-control" name="amount-line-height"  step="1" value="<?= $data['rupee_word']['line-height'] ?>">
	</div>


</div>



<script>

	$(document).ready(function () {

		$('#print-date').datepicker({dateFormat: 'mmddyy'})
			.on("change", function (e) {
				var date = new Date(userDate),
					yr = date.getFullYear(),
					month = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
					day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
					newDate = yr + '-' + month + '-' + day;
				console.log(newDate);
				$('#date').text(e.target.value);
			});
	});
</script>