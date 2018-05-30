<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\MasterPlans;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserPlanHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Plan Histories';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
        <div class="row">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?= "Plan History" ?></h3>
				<div style="float:right;padding-top: 5px;">
					<?php
					echo Html::a('<i class="fa fa-pencil-square-o"></i><span>Upgrade Plan</span>', ['upgrade-plan'], ['class' => 'btn btn-warning dropdown-toggle']);
					?>

				</div>

			</div>
			<div class="panel-body">
				<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

				<?=
				GridView::widget([
				    'dataProvider' => $dataProvider,
				    'filterModel' => $searchModel,
				    'columns' => [
					    ['class' => 'yii\grid\SerialColumn'],
					    [
					    'attribute' => 'plan_id',
					    'format' => 'raw',
					    'filter' => ArrayHelper::map(MasterPlans::find()->asArray()->all(), 'id', 'plan_name'),
					    'value' => 'plans.plan_name',
					],
					'plan_date',
					'plan_end_date',
				    // 'CB',
				    // 'UB',
				    // 'DOC',
				    // 'DOU',
				    //['class' => 'yii\grid\ActionColumn'],
				    ],
				]);
				?>
			</div>
		</div>
        </div>
</div>
