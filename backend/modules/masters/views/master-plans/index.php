<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MasterPlansSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Plans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-plans-index">

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
<?php if (Yii::$app->session->hasFlash('error')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 5px;">
							<?= Yii::$app->session->getFlash('error') ?>
						</div>
					<?php endif; ?>
					<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

					<?= Html::a('<i class="fa-th-list"></i><span> Create Master Plans</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
					<?=
					GridView::widget([
					    'dataProvider' => $dataProvider,
					    'filterModel' => $searchModel,
					    'columns' => [
						    ['class' => 'yii\grid\SerialColumn'],
						'plan_name',
						'valid_days',
						[
						    'attribute' => 'amount',
						    'value' => function ($model) {
							    return '$' . $model->amount;
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
						['class' => 'yii\grid\ActionColumn'],
					    ],
					]);
					?>
				</div>
                        </div>
                </div>
        </div>
</div>


