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

        /*        a:hover{
                        color: #fff;
                }*/
</style>
<div class="container">
        <div class="row">
                <?=
                $this->render('_menus', [
                    'model' => $model,
                ])
                ?>
        </div>

        <div class="row">

                <div class="col-md-3 top-padding">
                        
                        <div class="bank-accounts-create panel">

                                <h1 style="font-size: 20px">Create Cheque Book</h1>
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

                                <h1 style="font-size: 20px">Cheques of: <span style="font-weight: bold;"><?= $bank_details->bank_name ?> - <?= $bank_details->account_name ;?></span></h1>
                                <hr>
                                <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

                                <?=
                                GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'filterModel' => $searchModel,
                                    'columns' => [
                                        [
					    'attribute' => 'cheque_series_starting_number',
					    'label' => 'Cheque Starting No:',
					],
                                        'number_of_cheques',
                                        'cheques_left',
//                                            [
//                                            'attribute' => 'status',
//                                            'format' => 'raw',
//                                            'filter' => [1 => 'Enabled', 0 => 'disabled'],
//                                            'value' => function ($model) {
//                                                    return $model->status == 1 ? 'Enabled' : 'disabled';
//                                            },
//                                        ],
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'contentOptions' => ['style' => 'width:100px;'],
                                            'header' => 'Actions',
                                            'template' => '{delete}',
                                        ],
                                    ],
                                ]);
                                ?>
                        </div>
                </div>
        </div>
</div>

