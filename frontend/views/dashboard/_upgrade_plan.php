<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterPlans;
use yii\helpers\ArrayHelper;
use common\models\Country;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = 'Upgrade Plan';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<style>
        .plans table th,td{
                padding: 15px 0px;
        }
</style>
<div class="container">
        <div class="row">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
				<div style="float:right;padding-top: 5px;">
					<?php
					echo Html::a('<i class="fa fa-pencil-square-o"></i><span> Plan History</span>', ['plan-history', 'id' => $model->id], ['class' => 'btn btn-warning dropdown-toggle']);
					?>

				</div>

                        </div>
                        <div class="panel-body">
                                <div class="panel-body">
					<?php //Html::beginForm(['dashboard/save-upgrade'], 'post', ['target' => '_blank']) ?>
					<?php if (!empty($master_plans)) { ?>
						<div class="row">
							<div class="col-md-12 plans">
								<div class="col-md-4">

									<table class="table table-striped table-bordered detail-view">
										<tbody>
											<tr>
												<th style="color: #0e62ca;">PLAN NAME</th>
											</tr>
											<tr>
												<th style="color: #0e62ca;">VALIDITY</th>
											</tr>
											<tr>
												<th style="color: #0e62ca;">AMOUNT</th>
											</tr>
											<tr>
												<th></th>
											</tr>
										</tbody>
									</table>
								</div>
								<?php
								foreach ($master_plans as $plans) {
									?>
									<div class="col-md-4">
										<table class="table table-striped table-bordered detail-view">
											<tbody>
												<tr>
													<th><?= $plans->plan_name ?></th>
												</tr>
												<tr>
													<td><?= $plans->valid_days ?> Days</td>
												</tr>
												<tr>
													<td><?= '$' . $plans->amount ?></td>
												</tr>
												<tr>
													<td>
														<?= Html::a('SELECT', ['/payment/index', 'upgrade_id' => $plans->id, 'user_id' => Yii::$app->session['user_session']->id], ['class' => 'btn btn-secondary']) ?>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								<?php }
								?>
							</div>
						</div>
					<?php }
					?>
                                        <div style="margin: 15px 0px 0px 13px;">
						<?php // Html::submitButton('<span>Upgrade Now</span>', ['class' => 'btn btn-secondary']) ?>
                                        </div>
					<?php // Html::endForm() ?>
                                </div>
                        </div>

                </div>
        </div>
</div>