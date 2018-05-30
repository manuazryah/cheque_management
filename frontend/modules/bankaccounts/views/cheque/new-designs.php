<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\BankAccounts;
use common\models\ChequeDesigns;

/* @var $this yii\web\View */
/* @var $model common\models\UserImg */

$this->title = 'Create User Img';
$this->params['breadcrumbs'][] = ['label' => 'User Imgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
        <div class="col-md-12">
		<div style="padding: 17px 0px 15px 0px;">

			<?= Html::a('Banks', ['/bankaccounts/bank-accounts/index'], ['class' => 'button']) ?>

			<?= Html::a('Cheque', ['/bankaccounts/cheque/cheques?id=' . $_GET['id']], ['class' => 'button']) ?>
			<?php if (Yii::$app->controller->action->id == 'new-design') { ?>
				<?= Html::a('Cheque Design', ['/dashboard/check-design?id=' . $_GET['id']], ['class' => 'active-button']) ?>
				<?php
			}
			?>
			<?= Html::a('Print', ['/dashboard/prints?id=' . $_GET['id']], ['class' => 'button']) ?>
		</div>
                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode('New Cheque Design') ?></h3>


                        </div>
                        <div class="panel-body">
                                <div class="panel-body"><div class="user-img-create">
						<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'method' => 'post']]) ?>

						<?= $form->field($model, 'cheque_image')->fileInput() ?>

						<div class="form-group" >
							<?= Html::submitButton('Upload', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;', 'id' => 'upload']) ?>
						</div>

						<?php ActiveForm::end() ?>                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>

<script>
	$(document).ready(function () {
		// click on button submit
		$("#upload").on('click', function () {
			// send ajax
			$.ajax({
				url: 'new-design', // url where to submit the request
				type: "POST", // type of action POST || GET
				dataType: 'json', // data type
				data: $("#form").serialize(), // post data || get data
				success: function (result) {
					// you can see the result from the console
					// tab of the developer tools
					console.log(result);
				},
				error: function (xhr, resp, text) {
					console.log(xhr, resp, text);
				}
			})
		});
	});

</script>

