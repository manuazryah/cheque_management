<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\BankAccounts;
use common\models\MasterBank;

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
	.new-design{
		margin-top: 108px;
	}
	.preview{
		padding: 8px 15px;
		background-color: #979898;
	}

</style>
<?php // Html::a('<i class="fa-th-list"></i><span>New Design</span>', ['new-design'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone new-design']) ?>
<div class="container">
	<div class="row">

		<div class="col-md-12">

			<div class="bank-accounts-index panel">

				<h1 style="font-size: 20px"><?= Html::encode('Cheque Designs') ?></h1>
				<hr>
				<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

				<?=
				GridView::widget([
				    'dataProvider' => $dataProvider,
				    'filterModel' => $searchModel,
				    'columns' => [
					//'bank_accounts_id',
					    [
					    'attribute' => 'bank_accounts_id',
					    'value' => 'bank.bank_name',
					],
//					'cheque_image',
//					'field_1',
					[
					    'class' => 'yii\grid\ActionColumn',
					    'contentOptions' => ['style' => 'width:100px;'],
					    'header' => '',
					    'template' => '{preview}',
					    'buttons' => [
						//view button
						'preview' => function ($url, $model) {
							return Html::a('<div class="preview"><i class="fa fa-file-image-o" aria-hidden="true"></i></div>', $url, [
								    'title' => Yii::t('app', 'preview'),
								    'class' => '',
							]);
						},
					    ],
					    'urlCreator' => function ($action, $model) {
						    if ($action === 'preview') {
							    $url = 'check-design?id=' . $model->bank_accounts_id;
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

