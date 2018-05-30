<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MasterBankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Banks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-bank-index">

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

					<?= Html::a('<i class="fa-th-list"></i><span> Create Master Bank</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
					<?=
					GridView::widget([
					    'dataProvider' => $dataProvider,
					    'filterModel' => $searchModel,
					    'columns' => [
						    ['class' => 'yii\grid\SerialColumn'],
						//'id',
						'bank_name',
						//'design',
						[
						    'attribute' => 'country_id',
						    'value' => function ($model) {
							    return $model->country->country_name;
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
						// 'CB',
						// 'UB',
						// 'DOC',
						// 'DOU',
						  ['class' => 'yii\grid\ActionColumn',
						    'visibleButtons' => [
							
							'view' => function ($model, $key, $index) {
								false;
							}
						    ]],
//						['class' => 'yii\grid\ActionColumn',
//						    'template' => '{update}{view}{delete}{design}',
//						    'buttons' => [
//							'update' => function ($url, $model) {
//								return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
//									    'title' => Yii::t('app', 'update'),
//								]);
//							},
//							'view' => function ($url, $model) {
//								return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
//									    'title' => Yii::t('app', 'view'),
//								]);
//							},
//							'delete' => function ($url, $model) {
//								return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['data-confirm' => 'Are you sure you want to delete this item?', 'data-method' => 'POST']);
//							},
//							'design' => function ($url, $model) {
//								return Html::a('<span class="fa fa-tasks" aria-hidden="true"></span>', $url, [
//									    'title' => Yii::t('app', 'cheque-design'),
//								]);
//							},
//						    ],
//						    'urlCreator' => function ($action, $model) {
//							    if ($action === 'view') {
//								    $url = '@web/masters/master-bank/view?id=' . $model->id;
//								    return $url;
//							    }
//							    if ($action === 'update') {
//								    $url = '@web/masters/master-bank/update?id=' . $model->id;
//								    return $url;
//							    }
//							    if ($action === 'delete') {
//								    $url = '@web/masters/master-bank/delete?id=' . $model->id;
//								    return $url;
//							    }
//							    if ($action === 'design') {
//								    $url = '@web/masters/master-cheque-design/check-design?id=' . $model->id;
//								    return $url;
//							    }
//						    }
//						],
					    ],
					]);
					?>
				</div>
                        </div>
                </div>
        </div>
</div>


