<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Payee */

$this->title = 'Create Payee';
$this->params['breadcrumbs'][] = ['label' => 'Payees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
