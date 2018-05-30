<?php

use yii\jui\DatePicker;
use common\models\Payee;
use yii\helpers\Html;
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
		    'value' => date('Y-m-d'),
		    'dateFormat' => 'dd-MM-yyyy',
		    'options' => ['class' => 'form-control']
		]);
		?>
	</div>

	<div class="form-group ">
		<label class="control-label">SELECT PAYEE:</label>
		<?=
		Html::dropDownList('payee', null, ArrayHelper::map(Payee::find()->all(), 'id', 'payee_name'), ['prompt' => '--- select payee ---', 'class' => 'form-control', 'id' => 'payee'])
		?>
	</div>

	<div class="form-group ">
		<label class="control-label">ENTER AMOUNT : </label>
		<input type="text" id="amount" class="form-control" name="amount"   value="">
		<input type="hidden" id="amount_words" class="form-control" name="amount_words"   value="">
	</div>
	<div class="form-group" style="visibility: hidden">
		<label>CURRENCY TYPE:</label>
		<div class="radio">
			<label> <input name="currency_type" type="radio" value="1" id="indian" checked="true"> Indian</label>
		</div>
		<div class="radio">
			<label> <input name="currency_type" type="radio" value="2"> International</label>
		</div>

	</div>
	<div class="form-group">
		<?= Html::submitButton('SAVE PRINT', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;', 'id' => 'save-print']) ?>
		<?php // Html::submitButton('SAVE', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;', 'id' => 'save-print']) ?>
	</div>


</div>



<script>

	$(document).ready(function () {
//		$('#indian').prop('checked', true);

		var d = new Date();
		var current = $.datepicker.formatDate('mmddyy', new Date(d));
		$('#date').text(current);
		$('#print-date').datepicker({dateFormat: 'mm-dd-yy'})
			.on("change", function (e) {
				var dateFormat = e.target.value;
				var dateFormat = $.datepicker.formatDate('ddmmyy', new Date(dateFormat));
				$('#date').text(dateFormat);
			});
		$("#payee").change(function () {
			var end = this.value;
			var payee = $("#payee option:selected").text();
			$('#name').text(payee);
		});
		var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
		var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];


		$("#amount").keyup(function () {
			if ($('input[name=currency_type]:checked').val() === '1') {


				inWords($('#amount').val());
			} else {
				alert('sorry');
			}
		});


		function inWords(num) {
			if ((num = num.toString()).length > 9)
				return 'overflow';
			n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
			if (!n)
				return;
			var str = '';
			str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
			str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
			str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
			str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
			str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
			var word = str.toUpperCase();
			$('#rupee_word').text(word);
			$('#amount_words').val(word);

			numberWithCommas(num);
		}
		function numberWithCommas(x) {
			var rupee_num = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			$('#rupee_num').text(rupee_num + '/-');
		}
	});
</script>