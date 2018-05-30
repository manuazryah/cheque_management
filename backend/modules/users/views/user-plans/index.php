<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Users;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MasterPlansSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Plans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-plans-index">

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
                                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                                                <div class="alert alert-success" role="alert">
                                                        <?= Yii::$app->session->getFlash('success') ?>
                                                </div>
                                        <?php endif; ?>


                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                    [
                                                    'attribute' => 'user_id',
                                                    'value' => 'username.company_name',
                                                    'filter' => ArrayHelper::map(Users::find()->asArray()->all(), 'id', 'company_name'),
                                                ],
//                                                'user_id',
                                                'plan_name',
                                                'valid_days',
                                                'amount',
                                                    [
                                                    'attribute' => 'status',
                                                    'format' => 'raw',
                                                    'filter' => [1 => 'Enabled', 0 => 'disabled'],
                                                    'value' => function ($model) {
                                                            return $model->status == 1 ? 'Enabled' : 'disabled';
                                                    },
                                                ],
                                                [
						    'attribute' => 'plan_end_date',
						    'format' => 'raw',
						    'value' => function ($model) {
							    if (!empty($model->plan_end_date))
								    return date('d-m-Y', strtotime($model->plan_end_date));
						    },
						],
                                                // 'CB',
                                                // 'UB',
                                                // 'DOC',
                                                // 'DOU',
//                                                ['class' => 'yii\grid\ActionColumn'],
                                                [
                                                    'class' => 'yii\grid\ActionColumn',
                                                    'contentOptions' => ['style' => 'width:100px;'],
                                                    'header' => 'Actions',
                                                    'template' => '{update}{upgrade}',
                                                    'buttons' => [
                                                        //view button

                                                        'update' => function ($url, $model) {
                                                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                                                            'title' => Yii::t('app', 'update'),
                                                                            'class' => '',
                                                                ]);
                                                        },
                                                        'upgrade' => function ($url, $model) {
                                                                return Html::a('<span class="fa-rocket"></span>', $url, [
                                                                            'title' => Yii::t('app', 'upgrade plan'),
                                                                            'class' => '',
                                                                ]);
                                                        },
                                                    ],
                                                    'urlCreator' => function ($action, $model) {

                                                            if ($action === 'update') {
                                                                    $url = 'update?id=' . $model->id;
                                                                    return $url;
                                                            }
                                                            if ($action === 'upgrade') {
                                                                    $url = 'upgrade?id=' . $model->id;
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
</div>


