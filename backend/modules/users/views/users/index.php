<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\MasterPlans;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
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
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= Html::a('<i class="fa-th-list"></i><span> Create Users</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            //   'id',
                            'company_name',
                            //'owners_name',
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
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


