<?php

use yii\helpers\Html;
use common\models\ProductCategory;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

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

                    <?= Html::a('<i class="fa-th-list"></i><span> Create Products</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                          //  'id',
                            [
                                'attribute' => 'product_category',
                                'value' => 'categories.category_name',
                                'filter' => ArrayHelper::map(ProductCategory::find()->asArray()->all(), 'id', 'category_name'),
                            ],
                            'product_titile',
                            'sub_title',
                            [
                                'attribute' => 'big_image',
                                'format' => 'raw',
                                'value' => function ($data) {
                                        $img = '<img width="120px" src="' . Yii::$app->homeUrl . '/uploads/products/' . $data->id . '_big'.'.' . $data->big_image . '"/>';
                                        return $img;
                                },
                            ],
                            // 'small_image',
                            // 'big_content:ntext',
                            // 'small_content:ntext',
                            // 'view_more_link',
                            // 'status',
                            // 'data_1',
                            // 'data_2',
                            // 'data_3',
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


