<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\products */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
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
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Products</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <div class="panel-body"><div class="products-view">
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
                                [
                                    'attribute' => 'product_category',
                                    'value' => call_user_func(function($model) {
                                                    return $model->categories->category_name;
                                            }, $model),
                                ],
                                'product_titile',
                                'sub_title',
                                [
                                    'attribute' => 'big_image',
                                    'format' => 'raw',
                                    'value' => call_user_func(function($model) {
                                                    return '<img width="120px" height="100px" src="' . Yii::$app->homeUrl . '/uploads/products/' . $model->id . '_big' . '.' . $model->big_image . '"/>';
                                            }, $model),
                                ],
                                'small_image',
                                'big_content:ntext',
                                'small_content:ntext',
                                'view_more_link',
                                [
                                    'attribute' => 'status',
                                    'value' => $model->status == 1 ? 'Enabled' : 'Disabled',
                                ],
//                                'data_1',
//                                'data_2',
//                                'data_3',
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


