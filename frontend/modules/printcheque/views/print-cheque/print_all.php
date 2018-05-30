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

$this->title = 'Printed Cheques';
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


        <div class="col-md-12">

            <div class="bank-accounts-index panel">
                <div>
                    <h1><?= Html::encode($this->title) ?></h1>
                    <?php // Html::a('Export Excel', ['/printcheque/print-cheque/export-print-result?print_status=' . $_GET['current_print_status']], ['class' => 'export']) ?>
                </div>
                <hr>


                <?php
                $gridColumns = [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'bank_account_id',
                        'value' => 'bank.bank_name',
                        'filter' => ArrayHelper::map(BankAccounts::findAll(['status' => 1, 'user_id' => Yii::$app->session['user_session']['id']]), 'id', 'bank_name'),
                    ],
                    'cheque_number',
                    [
                        'attribute' => 'cheque_date',
                        'value' => function ($model) {
                            return date("d-m-Y", strtotime($model->cheque_date));
                        },
                        'filter' => DateRangePicker::widget(['model' => $searchModel, 'attribute' => 'created_at_range', 'pluginOptions' => ['format' => 'd-m-Y', 'autoUpdateInput' => false]]),
                    ],
                    [
                        'attribute' => 'payee_id',
                        'value' => 'payee.payee_name',
                        'filter' => ArrayHelper::map(Payee::findAll(['status' => 1, 'user_id' => Yii::$app->session['user_session']['id']]), 'id', 'payee_name'),
                    ],
                    [
                        'attribute' => 'cheque_amount',
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
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['style' => 'width:100px;'],
                        'header' => 'Actions',
                        'template' => '{update}{reprint}{report}',
                        'buttons' => [
                            //view button
                            'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil" style="padding-top: 8px;"></span>', $url, [
                                            'title' => Yii::t('app', 'update'),
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
                        }],
                ];
                echo ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                ]);
                echo \kartik\grid\GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'pager' => [
                        'firstPageLabel' => 'First',
                        'lastPageLabel' => 'Last',
                        'prevPageLabel' => '<',
                        'nextPageLabel' => '>',
                        'maxButtonCount' => 10,
                    ],
                    'columns' => $gridColumns
                ]);
                ?>

            </div>
        </div>
    </div>
</div>