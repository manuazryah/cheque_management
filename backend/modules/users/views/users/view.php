<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = $model->company_name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
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
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Users</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <div class="panel-body"><div class="users-view">
                        <p>
                            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                            <?=
                            Html::a('Delete', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ])
                            ?>
                        </p>

                        <?=
                        DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                //'id',
                                'company_name',
                               // 'owners_name',
                                'email_id:email',
                                //'address:ntext',
                                 [
							    'attribute' => 'country',
							    'value' => $model->countries->country_name,
							],
                               // 'state',
                               // 'city',
                                'mobile',
                                [
                                    'attribute' => 'plan',
                                    'value' => $model->plans->plan_name,
                                ],
//'last_login',
[
							    'attribute' => 'last_login',
							    'format' => 'raw',
							    'value' => date('d-m-Y', strtotime($model->last_login))
							],
							    [
							    'attribute' => 'plan_end_date',
							    'format' => 'raw',
							    'value' => date('d-m-Y', strtotime($model->plan_end_date))
							],
                                [
                                    'attribute' => 'status',
                                    'value' => $model->status == 1 ? 'Enabled' : 'Disabled',
                                ],
//                                'CB',
//                                'UB',
//                                'DOC',
//                                'DOU',
                            ],
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


