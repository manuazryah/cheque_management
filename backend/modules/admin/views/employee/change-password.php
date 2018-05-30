<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = 'Change Password: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
				<?= Html::a('<i class="fa-th-list"></i><span> Manage Employee</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>


				<div class="panel-body">
					<div class="panel-body"><div class="users-create">
							<div class="col-md-3"> </div> <div class="col-md-6">
								<?php
								$form = ActiveForm::begin(
										[
										    'id' => 'forgot-email',
										    'method' => 'post',
										    'options' => [
											'class' => 'login-form fade-in-effect'
										    ]
										]
								);
								?>

								<?php if (Yii::$app->session->hasFlash('success')):
									?>
									<div class="alert alert-success" role="alert">
										<?= Yii::$app->session->getFlash('success') ?>
									</div>
								<?php endif; ?>

								<?php if (Yii::$app->session->hasFlash('error')): ?>
									<div class="alert alert-danger" role="alert">
										<?= Yii::$app->session->getFlash('error') ?>
									</div>
								<?php endif; ?>
								<!--                                                        <div class="alert alert-danger" role="alert">
								<?php
								// Yii::$app->session->getFlash('success');
								// Yii::$app->session->getFlash('error');
								?>
															</div>-->

								<h1 style = "margin-top: 20px;margin-bottom: 15px;color: blue">Reset password?</h1>
								<div class = "form-group">
									<div class = "form-group field-employee-password">
										<label style = "font-weight:bold;">Enter old Password:</label>
										<input type = "password" id = "new-password" class = "form-control" name = "old-password" autofocus = "false" required>
										<p class = "help-block help-block-error"></p>
									</div>

								</div>

								<div class = "form-group">
									<div class = "form-group field-employee-password">
										<label style = "font-weight:bold;">Enter new Password:</label>
										<input type = "password" id = "new-password" class = "form-control" name = "new-password" autofocus = "false" required>
										<p class = "help-block help-block-error"></p>
									</div>

								</div>
								<div class = "form-group">
									<div class = "form-group field-employee-password">
										<label style = "font-weight:bold;">Confirm Password:</label>
										<input type = "password" id = "confirm-password" class = "form-control" name = "confirm-password" autofocus = "false" required>
										<p class = "help-block help-block-error"></p>
									</div>

								</div>


								<div class = "form-group" >
									<button type = "submit" class = "btn btn-primary">Submit</button> </div>
								<?php ActiveForm::end(); ?>

							</div>
							<div class = "col-md-3">
							</div>
						</div>
					</div>
				</div>
                        </div>
                </div>
        </div>
</div>
