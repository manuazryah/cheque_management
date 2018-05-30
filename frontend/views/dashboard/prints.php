<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\BankAccounts;
use yii\helpers\ArrayHelper;
use common\models\Payee;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ChequePrintSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cheque Prints';
$this->params['breadcrumbs'][] = $this->title;
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

			<?= Html::a('Cheque Book', ['/bankaccounts/cheque/cheques?id=' . $_GET['id']], ['class' => 'button']) ?>

			<?= Html::a('Cheque Design', ['/dashboard/check-design?id=' . $_GET['id']], ['class' => 'button']) ?>
			<?php if (Yii::$app->controller->action->id == 'prints') { ?>
				<?= Html::a('Print', ['/dashboard/print-cheque?id=' . $_GET['id']], ['class' => 'active-button']) ?>
				<?php
			}
			?>
		</div>
		<!--		<div class="col-md-3">
					<div class="bank-accounts-create panel">

						<p>
		<?= Html::a('Print Check', ['/dashboard/print-cheque?id=' . $_GET['id']], ['class' => 'btn btn-success']) ?>
						</p>
						<hr>



					</div>
				</div>-->
		<div class="col-md-12">
			<div class="bank-accounts-index panel">
				<h1 style="font-size: 20px"><?= Html::encode($this->title) . ' of ' . $bank_details->bank_name ?></h1>
				<hr>


				<?=
				GridView::widget([
				    'dataProvider' => $dataProvider,
				    'filterModel' => $searchModel,
				    'columns' => [
					    ['class' => 'yii\grid\SerialColumn'],
					    [
					    'attribute' => 'bank_account_id',
					    'value' => 'bank.bank_name',
					    'filter' => ArrayHelper::map(BankAccounts::find()->asArray()->all(), 'id', 'bank_name'),
					],
					'cheque_number',
					//'cheque_date',
                                        [
                                            'attribute' => 'cheque_date',
                                            'value' => function ($model) {
                                                    return date("d-m-Y", strtotime($model->cheque_date));
                                            }
                                        ],
					    [
					    'attribute' => 'payee_id',
					    'value' => 'payee.payee_name',
					    'filter' => ArrayHelper::map(Payee::find()->asArray()->all(), 'id', 'payee_name'),
					],
					// 'currency_type',
					'cheque_amount',
					    [
					    'attribute' => 'print_status',
					    'value' => 'status.status',
					    'filter' => ArrayHelper::map(Payee::find()->asArray()->all(), 'id', 'payee_name'),
					],
					// 'cheque_amount_words',
					// 'date',
					// 'field_1',
					// 'field_2',
					// 'field_3',
					// 'field_4',
					[
					    'class' => 'yii\grid\ActionColumn',
					    'contentOptions' => [],
					    'header' => 'Actions',
					    'template' => '{update}{reprint}',
					    'buttons' => [
						//view button
						'update' => function ($url, $model) {
							return Html::a('<span class="glyphicon glyphicon-pencil" style="padding-top: 8px;"></span>', $url, [
								    'title' => Yii::t('app', 'reprint'),
								    'class' => 'actions',
							]);
						},
						'reprint' => function ($url, $model) {
							return Html::a('<i class="fa fa-print" aria-hidden="true"></i>', $url, [
								    'title' => Yii::t('app', 'reprint'),
								    'class' => 'actions',
								    'target' => 'print_popup',
								    'onClick' => "window.open('about:blank','print_popup','width=1200,height=740');"
							]);
						},
					    ],
					    'urlCreator' => function ($action, $model) {
						    if ($action === 'reprint') {
							    $url = '../printcheque/print-cheque/re-print?id=' . $model->id;
							    return $url;
						    }
						    if ($action === 'update') {
							    $url = '../printcheque/print-cheque/update-print?id=' . $model->id;
							    return $url;
						    }
					    }
					],
				    ],
				]);
				?>
			</div>
		</div>
	</div>
</div>