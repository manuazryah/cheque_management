<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\BankAccounts;
use yii\helpers\ArrayHelper;
use common\models\Payee;
use common\models\PrintStatus;
use kartik\export\ExportMenu;
use kartik\daterange\DateRangePicker;
use yii\helpers\Url;

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
    .table>thead:first-child>tr:first-child>th {
        width: 85px;
    }
    .table>thead>tr>th {
        position: relative;
        border-bottom: 1px solid #eee;
        color: rgba(216, 7, 14, 0.88);
    }
    .btn1{
                float: right;
        }
</style>
<div class="container">
    <div class="row">

      
        <div class="col-md-12">
           
            <div class="bank-accounts-index panel">
                <div>
                    <h1 style="font-size: 20px"><?= Html::encode($this->title) ?></h1>
                <?php // Html::a('Export Excel', ['/printcheque/print-cheque/export-print-result'], ['class' => 'export']) ?>
                </div>
                <hr>
                <?= Html::a('<i class="fa-trash"></i><span>Remove Printed Cheque</span>', ['/dashboard/remove-cheque'], ['class' => 'btn btn-red btn-icon btn-icon-standalone btn1']) ?>
               <?php
				$gridColumns = [
					['class' => 'yii\grid\SerialColumn'],
					[
					'attribute' => 'bank_account_id',
					'value' => 'bank.bank_name',
					'label' => 'Bank',
				    'filter' => ArrayHelper::map(BankAccounts::findAll(['status' => 1, 'user_id' => Yii::$app->session['user_session']['id']]), 'id', 'bank_name'),
				    ],
					[
					'attribute' => 'cheque_date',
					
					'value' => function ($model) {
						return date("d-m-Y", strtotime($model->cheque_date));
					},
'filter' => DateRangePicker::widget(['model' => $searchModel, 'attribute' => 'created_at_range', 'pluginOptions' => ['format' => 'd-m-Y', 'autoUpdateInput' => false]]),
				    ],
					[
					'attribute' => 'cheque_number',
				    ],
//                                        'cheque_date',
//                                            [
//                                            'attribute' => 'no_of_emi_cheques',
//                                            'label' => 'Emi',
//                                            'value' => $model->no_of_emi_cheques,
//                                            'filter' => ArrayHelper::map(Payee::find()->asArray()->all(), 'id', 'payee_name'),
//                                        ],
				    [
					'attribute' => 'payee_id',
					'value' => 'payee.payee_name',
					// 'filter' => ArrayHelper::map(Payee::find()->asArray()->all(), 'id', 'payee_name'),
					'filter' => ArrayHelper::map(Payee::findAll(['status' => 1, 'user_id' => Yii::$app->session['user_session']['id']]), 'id', 'payee_name'),
				    ],
				    // 'currency_type',
				    [
					'attribute' => 'cheque_amount',
					//'label' => 'C.Amount',
					'value' => function ($model) {
						return Yii::$app->SetValues->NumberFormat($model->cheque_amount);
					},
				    ],
				    'remarks',
					[
					'attribute' => 'print_status',
					'label' => 'Status',
					'value' => function($data) {
						return PrintStatus::findOne($data->print_status)->status_name;
					},
					'filter' => ArrayHelper::map(PrintStatus::find()->asArray()->all(), 'id', 'status_name'),
				    ],
//                                        'current_print_status',
				    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => [],
                        'header' => 'Actions',
                        'template' => '{update}{reprint}{report}',
                        'buttons' => [
                            //view button
                            'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil" style="padding-top: 8px;"></span>', $url, [
                                            'title' => Yii::t('app', 'Edit'),
                                            'class' => 'actions',
                                ]);
                            },
                            'reprint' => function ($url, $model) {
                                return Html::a('<i class="fa fa-print" aria-hidden="true"></i>', $url, [
                                            'title' => Yii::t('app', 'Reprint'),
                                            'class' => 'actions',
                                            'target' => 'print_popup',
                                            'onClick' => "window.open('about:blank','print_popup','width=1200,height=740');"
                                ]);
                            },
                            'report' => function ($url, $model) {
                                return Html::a('<span><i class="fa fa-files-o" aria-hidden="true"></i></span>', $url, [
                                            'title' => Yii::t('app', 'Report'),
                                            'class' => 'actions',
                                            'target' => '_blank',
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model) {
                            if ($action === 'reprint') {
                                $url = 're-print?id=' . $model->id;
                                return $url;
                            }
                            if ($action === 'update') {
                                $url = 'update-print?id=' . $model->id;
                                return $url;
                            }
                            if ($action === 'report') {
                                $url = Url::to(['report', 'id' => $model->id]);
                                return $url;
                            }
                        }
                    ],
				];
				echo ExportMenu::widget([
				    'dataProvider' => $dataProvider,
				    'columns' => $gridColumns,
				    
				]);
				echo \kartik\grid\GridView::widget([
				    'dataProvider' => $dataProvider,
				    'filterModel' => $searchModel,
				    'columns' => $gridColumns
				]);
				?>

            </div>
        </div>
    </div>
</div>