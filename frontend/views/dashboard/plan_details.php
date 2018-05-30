<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterPlans;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = 'Plan Details';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<style>
	.detail1-view-custom {
		/*		padding: 5px 3px 5px 3px;*/
	}
	.detail1-view-custom>tbody>tr>th{
		padding: 12px 15px;
		width: 25%;
	}
	.detail1-view-custom>tbody>tr>td{
		padding: 12px 15px;
		width: 25%;

	}
	.detail1-view-custom{
		width: 72%;
		text-align: center;
		margin-bottom: 0px;

	}
	hr{
                margin-top: 10px;
                margin-bottom: 28px;
                border: 0;
                border-top: 3px solid rgba(39, 41, 42, 0.46);
        }
	.panel .panel-heading {
		padding-bottom: 0px;
		border-bottom: none;
	}
	.panel .panel-body{
		padding-top: 0px;
	}
	.panel h3{
		color:black;
		text-decoration: #000;
	}
	.list-custom{
		color: black;
		padding: 5px;
	}
	.upgrade-link{
		margin-left: 582px;
	}
</style>
<div class="container">
        <div class="row">

                <div class="panel panel-default">
                        <div class="panel-heading">
				<h1 style="font-size: 20px;float: left"><?= Html::encode($this->title) ?></h1>



                                <div style="float:right;padding-top: 5px;">
					<?php
					//echo Html::a('<i class="fa-rocket"></i><span> Upgrade Plan</span>', ['upgrade-plan', 'id' => $model->id], ['class' => 'btn btn-warning dropdown-toggle']);
					?>

                                </div>


                        </div>
			<hr>

			<?php
			$start_date = strtotime($model->date);
			$date = date('Y-m-d');
			$end_date = strtotime($date);
			$timeDiff = abs($end_date - $start_date);
			$numberDays = $timeDiff / 86400;
			$numberDays = intval($numberDays);
			$no_of_day_left = $model->valid_days - $numberDays;
			?>

                        <div class="panel-body">
                                <div class="panel-body">
					<h3>Current Plan:</h3>
					<?=
					DetailView::widget([
					    'model' => $model,
					    'options' => ['class' => 'table table-striped table-bordered  detail1-view-custom'],
					    'attributes' => [
						    [
						    'label' => 'User Name',
						    'value' => Yii::$app->session['user_session']['company_name']
						],
						'plan_name',
						    [
						    'label' => 'Valid Days',
						    'value' => $model->valid_days . ' days'
						],
						    [
						    'label' => 'Amount',
						    'value' => '$' . $model->amount
						],
						    [
						    'label' => 'Number Of Days Left',
						    'value' => $no_of_day_left . ' days'
						],
					    ],
					])
					?>
                                </div>
                        </div>
			<hr>
                        <div class="panel-body">
                                <div class="panel-body">
					<h3>Plan History:</h3>
					<?=
					ListView::widget([
					    'dataProvider' => $dataProvider,
					    'options' => [
						'tag' => 'div',
						'class' => 'pager-wrapper list-custom',
						'id' => 'pager-container',
					    ],
					    'itemView' => '_history', 'summary' => '',
					]);
					?>
                                </div>
                        </div>
			<hr>
                        <div class="panel-body">
                                <div class="panel-body">
					<h3>Upgrade Plan:</h3><?php
					foreach ($master_plans as $plans) {
						?>

						<?=
						DetailView::widget([
						    'model' => $plans,
						    'options' => ['class' => 'table table-striped table-bordered  detail1-view-custom'],
						    'attributes' => [
							'plan_name',
							    [
							    'label' => 'valid_days',
							    'value' => $plans->valid_days . ' days'
							],
							    [
							    'label' => 'amount',
							    'value' => '$' . $plans->amount
							],
						    ],
						])
						?>
						<?= Html::a('UPGRADE TO PROFESSIONAL', ['/payment/index', 'upgrade_id' => $plans->id, 'user_id' => Yii::$app->session['user_session']->id], ['class' => 'btn btn-secondary upgrade-link']) ?>
					<?php } ?>
				</div>
			</div>


                </div>
        </div>
</div>
