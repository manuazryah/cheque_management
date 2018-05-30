<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\MasterBank;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BankAccountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<style>
	hr{
		margin-top: 10px;
		margin-bottom: 28px;
		border: 0;
		border-top: 3px solid rgba(39, 41, 42, 0.46);
	}
	.button {
		background-color: #27292a;
		border: none;
		color: white;
		padding: 7px 25px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		cursor: pointer;
		margin-right: 10px;
		margin-bottom: 29px;

	}
	.active-button{
		background-color: #8dc63f;
		border: none;
		color: white;
		padding: 7px 25px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		cursor: pointer;

		margin-right: 10px;
		margin-top: -35px;
	}
	a:hover{
		color: #fff;
	}
</style>
<div class="container">
	<div class="row">
		<div style="width: 100%">
			<?= Html::a('Banks', ['/bankaccounts/bank-accounts/index'], ['class' => 'button']) ?>
			<?php if (Yii::$app->controller->action->id == 'cheques') { ?>
				<?= Html::a('Cheque', ['/bankaccounts/cheque/cheques?id=' . $_GET['id']], ['class' => 'active-button']) ?>
				<?php
			}
			?>
			<?= Html::a('Cheque Design', ['/dashboard/check-design?id=' . $_GET['id']], ['class' => 'button']) ?>
			<?= Html::a('Print', ['/dashboard/print-cheque?id=' . $_GET['id']], ['class' => 'button']) ?>
		</div>
		<div class="col-md-3 top-padding">
			<div class="bank-accounts-create panel">

				<h1 style="font-size: 20px">Cheque Details</h1>
				<hr>

				<?=
				$this->render('_form', [
				    'model' => $model,
				])
				?>

			</div>
		</div>
		<div class="col-md-9">
			<div class="bank-accounts-index panel">

				<h1 style="font-size: 20px">Cheques of </h1>
				<hr>
				<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

				<?=
				GridView::widget([
				    'dataProvider' => $dataProvider,
				    'filterModel' => $searchModel,
				    'columns' => [
					'cheque_series_starting_number',
					'number_of_cheques',
					'cheques_left',
					    [
					    'attribute' => 'status',
					    'format' => 'raw',
					    'filter' => [1 => 'Enabled', 0 => 'disabled'],
					    'value' => function ($model) {
						    return $model->status == 1 ? 'Enabled' : 'disabled';
					    },
					],
//					    [
//					    'class' => 'yii\grid\ActionColumn',
//					    'contentOptions' => ['style' => 'width:100px;'],
//					    'header' => 'Actions',
//					    'template' => '{update}',
//					    'buttons' => [
//						'update' => function ($url, $model) {
//							return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
//								    'title' => Yii::t('app', 'update'),
//								    'class' => '',
//							]);
//						},
//					    ],
//					    'urlCreator' => function ($action, $model) {
//						    if ($action === 'update') {
//							    $url = 'index?id=' . $model->id;
//							    return $url;
//						    }
//					    }
//					],
				    ],
				]);
				?>
			</div>
		</div>
	</div>
</div>

