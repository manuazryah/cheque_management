<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PayeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payees';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    hr{
        margin-top: 10px;
        margin-bottom: 28px;
        border: 0;
        border-top: 3px solid rgba(39, 41, 42, 0.46);
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
            <div class="payee-create panel">

                <h1><?= Html::encode($this->title) ?></h1>
                <?php if (!empty($_GET['id'])) { ?>
                    <?= Html::a('<i class="fa-th-list"></i><span> Create Payee</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?php }
                ?>
                <hr>

                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>

            </div>
        </div>
        <div class="col-md-9">
            <div class="payee-index panel">
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
                    <h1><?= Html::encode($this->title) ?></h1>
                    <?php // Html::a('Export Excel', ['/payee/payee/export'], ['class' => 'export']) ?>
                </div>
                <hr>
                <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>


                <?php
                $gridColumns = [
                    ['class' => 'yii\grid\SerialColumn'],
                    'payee_name',
                    'city',
                    'email:email',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['style' => 'width:100px;'],
                        'header' => 'Actions',
                        'template' => '{update}{delete}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                            'title' => Yii::t('app', 'update'),
                                            'class' => '',
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                            'title' => Yii::t('app', 'delete'),
                                            'class' => '',
                                            'data' => [
                                                'confirm' => 'Are you absolutely sure ?',
                                            ],
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model) {
                            if ($action === 'update') {
                                $url = 'index?id=' . $model->id;
                                return $url;
                            }
                            if ($action === 'delete') {
                                $url = 'del?id=' . $model->id;
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
                    'columns' => $gridColumns
                ]);
                ?>

            </div>
        </div>
    </div>
</div>
