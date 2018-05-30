<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\BankAccounts;
use common\models\Users;
use common\models\Payee;
use kartik\daterange\DateRangePicker;
use common\models\PrintStatus;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ChequePrintSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cheque Prints';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cheque-print-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                        <div class="panel-options">
                                                <a href="#" data-toggle="panel">
                                                        <span class="collapse-icon">&ndash;</span>
                                                        <span class="expand-icon">+</span>
                                                </a>
                                                <a href="#" data-toggle="remove">
                                                        &times;
                                                </a>
                                        </div>
                                </div>
                                <div class="panel-body">
					<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

					<?php Html::a('<i class="fa-th-list"></i><span> Create Cheque Print</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
					<?=
					GridView::widget([
					    'dataProvider' => $dataProvider,
					    'filterModel' => $searchModel,
					    'columns' => [
						    ['class' => 'yii\grid\SerialColumn'],
						//'id',
						[
						    'attribute' => 'bank_account_id',
						    'value' => 'bank.bank_name',
						    'label' => 'Bank',
						    'filter' => ArrayHelper::map(BankAccounts::findAll(['status' => 1]), 'id', 'bank_name'),
						],
						//'cheque_design_id',
						[
						    'attribute' => 'user_id',
						    'label' => 'User',
						    'value' => 'username.company_name',
						    'filter' => ArrayHelper::map(Users::find()->asArray()->all(), 'id', 'company_name'),
						],
						'cheque_number',
						// 'cheque_book_id',
						[
						    'attribute' => 'cheque_date',
						    'value' => function ($model) {
							    return date("d-m-Y", strtotime($model->cheque_date));
						    },
						    'filter' => DateRangePicker::widget(['model' => $searchModel, 'attribute' => 'created_at_range', 'pluginOptions' => ['format' => 'd-m-Y', 'autoUpdateInput' => false]]),
						],
						// 'cheque_date_hyphen',
						[
						    'attribute' => 'payee_id',
						    'value' => 'payee.payee_name',
						    // 'filter' => ArrayHelper::map(Payee::find()->asArray()->all(), 'id', 'payee_name'),
						     'filter' => ArrayHelper::map(Payee::findAll(['status' => 1]), 'id', 'payee_name'),
						],
						// 'currency_type',
						[
						    'attribute' => 'cheque_amount',
						    //'label' => 'C.Amount',
						    'value' => function ($model) {
							    return Yii::$app->SetValues->NumberFormat($model->cheque_amount);
						    },
						],
						// 'cheque_amount_words',
						// 'date',
						// 'cheque_type',
						// 'not_over_status',
						[
						    'attribute' => 'print_status',
						    'label' => 'Status',
						    'value' => function($data) {
							    return PrintStatus::findOne($data->print_status)->status_name;
						    },
						    'filter' => ArrayHelper::map(PrintStatus::find()->where(['status' => 1])->asArray()->all(), 'id', 'status_name'),
						],
						'remarks:ntext',
					    // 'no_of_emi_cheques',
					    // 'decrement_check_status',
					    // 'current_print_status',
					    // 'cheque_position',
					    // 'print_type',
					    ],
					]);
					?>
				</div>
                        </div>
                </div>
        </div>
</div>


