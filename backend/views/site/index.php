<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\MasterPlans;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

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
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?php // Html::a('<i class="fa-th-list"></i><span> Create Users</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                //   'id',
                                                'company_name',
                                                'email_id',
                                                //'email_id:email',
                                               [
						    'attribute' => 'last_login',
						    'format' => 'raw',
						    'value' => function ($model) {
							    if (!empty($model->last_login))
								    return date('d-m-Y', strtotime($model->last_login));
						    },
						],

                                                    [
                                                    'attribute' => 'plan',
                                                    'format' => 'raw',
                                                    'filter' => ArrayHelper::map(MasterPlans::find()->asArray()->all(), 'id', 'plan_name'),
                                                    'value' => 'plans.plan_name',
                                                ],
                                                [
						    'attribute' => 'plan_end_date',
						    'format' => 'raw',
						    'value' => function ($model) {
							    if (!empty($model->plan_end_date))
								    return date('d-m-Y', strtotime($model->plan_end_date));
						    },
						],
                                                    [
                                                    'attribute' => 'status',
                                                    'format' => 'raw',
                                                    'filter' => [1 => 'Enabled', 0 => 'disabled'],
                                                    'value' => function ($model) {
                                                            return $model->status == 1 ? 'Enabled' : 'disabled';
                                                    },
                                                ],
                                            // 'address:ntext',
                                            // 'country',
                                            // 'state',
                                            // 'city',
                                            // 'mobile',
                                            // 'plan',
                                            // 'status',
                                            // 'field1',
                                            // 'field2',
                                            // 'CB',
                                            // 'UB',
                                            // 'DOC',
                                            // 'DOU',
                                            //['class' => 'yii\grid\ActionColumn'],
//                            ['class' => 'yii\grid\ActionColumn',
//                                'template' => '{update}{view}{delete}',
//                                'buttons' => [
//                                    'update' => function ($url, $model) {
//                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
//                                                    'title' => Yii::t('app', 'update'),
//                                        ]);
//                                    },
//                                            'view' => function ($url, $model) {
//                                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
//                                                    'title' => Yii::t('app', 'view'),
//                                        ]);
//                                    },
//                                            'delete' => function ($url, $model) {
//                                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['data-confirm' => 'Are you sure you want to delete this item?', 'data-method' => 'POST']);
//                                    },
//                                        ],
//                                        'urlCreator' => function ($action, $model) {
//                                    if ($action === 'view') {
//                                        $url = '@web/users/users/view?id=' . $model->id;
//                                        return $url;
//                                    }
//                                    if ($action === 'update') {
//                                        $url = '@web/users/users/view?id=' . $model->id;
//                                        return $url;
//                                    }
//                                    if ($action === 'delete') {
//                                        $url = '@web/users/users/delete?id=' . $model->id;
//                                        return $url;
//                                    }
//                                }
//                                    ],
                                            ],
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


