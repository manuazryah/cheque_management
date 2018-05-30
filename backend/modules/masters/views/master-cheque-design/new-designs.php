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
<style>
	.alert-success{
		padding: 4px;
	}
</style>

<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
			<div style="width: 25%;">
				<?php if (Yii::$app->session->hasFlash('error')): ?>
					<div class="alert alert-danger" role="alert">
						<?= Yii::$app->session->getFlash('error') ?>
					</div>
				<?php endif; ?>
				<?php if (Yii::$app->session->hasFlash('success')): ?>
					<div class="alert alert-success" role="alert">
						<?= Yii::$app->session->getFlash('success') ?>
					</div>
				<?php endif; ?>
			</div>
                        <div class="panel-heading">

				<?= Html::a('<i class="fa-th-list"></i><span> Manage Master Bank</span>', ['/masters/master-bank/index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>


                        </div>
                        <div class="panel-heading">

                                <h3 class="panel-title"><?= Html::encode('Upload New  Cheque Design for: ') ?><span style="font-weight: bold;color: black"><?= $bank_details->bank_name ?></span></h3>


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

