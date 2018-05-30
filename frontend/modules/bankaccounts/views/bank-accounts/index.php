<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\MasterBank;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BankAccountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bank Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    hr{
        margin-top: 10px;
        margin-bottom: 28px;
        border: 0;
        border-top: 3px solid rgba(39, 41, 42, 0.46);
    }
    .button1 {
        /*background:url('<?php // echo Yii::app()->request->baseUrl . "/img/delete-icon.png";                                                                              ?>');*/
        width:244px;
        height:56px;
        cursor:pointer;
        border-radius: 12px;
    }
    .delete-button{
        width: 20px;
        height: 20px;
        padding-top: 2px;
    }
    .bank-accounts-index table tr {
        cursor: pointer;
    }
    .table>thead:first-child>tr:first-child>th {
        width: 85px;
    }
    .table>thead>tr>th {
        position: relative;
        border-bottom: 1px solid #eee;
        color: rgba(216, 7, 14, 0.88);
    }
</style>
<div class="container">
    <div class="row">

        <div class="col-md-3">
            <div class="bank-accounts-create panel">

                <h1 style="font-size: 20px">New Account</h1>
                <hr>

                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>
                <br/>
                <br/>

            </div>
        </div>
        <div class="col-md-9">
            <div class="bank-accounts-index panel">
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
                <div>
                    <h1 style="font-size: 20px;"><?= Html::encode($this->title) ?></h1>
                    <?php // Html::a('Export Excel', ['/bankaccounts/bank-accounts/export'], ['class' => 'export']) ?>
                </div>
                <hr>
                <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

                <?php
                $gridColumns = [
                    ['class' => 'yii\grid\SerialColumn'],
                    'bank_name',
                    'branch',
                    'account_name',
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'filter' => [1 => 'Enabled', 0 => 'disabled'],
                        'value' => function ($model) {
                            return $model->status == 1 ? 'Enabled' : 'disabled';
                        },
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => [],
                        'header' => 'Actions',
                        'template' => '{print}',
                        'buttons' => [
                            'print' => function ($url, $model) {
                                return Html::a('<i class="fa fa-print" style="color: #0e62c7;font-size: 20px !important;margin-top: 0px;"></i>', $url, [
                                            'title' => Yii::t('app', 'print'),
                                            'class' => 'actions',
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model) {

                            if ($action === 'print') {
                                $url = '@web/printcheque/print-cheque/index?id=' . $model->id;
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
                    'pager' => [
                        'firstPageLabel' => 'First',
                        'lastPageLabel' => 'Last',
                        'prevPageLabel' => '<',
                        'nextPageLabel' => '>',
                        'maxButtonCount' => 10,
                    ],
                    'rowOptions' => function ($model, $key, $index, $grid) {
                        $url = 'https://' . Yii::$app->getRequest()->serverName . Yii::$app->homeUrl . 'printcheque/print-cheque/index?id=' . $model->id;
                        return ['data-id' => $model->id, 'onclick' => "window.location.href='{$url}'", 'onmouseover' => "this.style.backgroundColor='rgba(167, 167, 167, 0.52)'", 'onmouseout' => "this.style.backgroundColor=''"];
                    },
                    'columns' => $gridColumns
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
<script>

//	$(document).ready(function () {
//		$('#w0 select[name="BankAccounts[bank_id]"]').change(function () {
//			if ($('#contact select[name="select-question"]').val() !== "") {
//				$('.field-bankaccounts-bank_name').hide();
//			} else {
//				$('.field-bankaccounts-bank_name').show();
//			}
//		});
//
//	});
</script>
