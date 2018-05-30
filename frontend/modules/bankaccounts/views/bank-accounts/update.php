<style>
        hr{
                margin-top: 10px;
                margin-bottom: 28px;
                border: 0;
                border-top: 3px solid rgba(39, 41, 42, 0.46);
        }

        /*        a:hover{
                        color: #fff;
                }*/
</style>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BankAccounts */

$this->params['breadcrumbs'][] = ['label' => 'Bank Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>


<div class="container">
        <div class="row">
                <div class="bank-accounts-update">
                        <?=
                        $this->render('_menus', [
                            'model' => $model,
                        ])
                        ?>
                        <div class="col-md-12">

                                <div class="bank-accounts-create panel">
                                        <div style="float:right;">
                                                <?= Html::a('Delete Bank', ['bank-accounts/delete?id=' . $model->id], ['data-confirm' => 'Are you sure you want to delete this item?', 'data-method' => 'POST', 'class' => 'btn btn-red']) ?>
                                        </div>
<!--					<a><img src="<?php // \Yii::$app->request->BaseUrl       ?>/img/delete-icon.png" width="50" height="50"></a>-->
                                        <h1 style="font-size: 20px">Update: <span style="font-weight: bold;"><?= $model->bank_name ?> - <?= $model->account_name ?></span></h1>
					<hr>

                                        <?=
                                        $this->render('_form', [
                                            'model' => $model,
                                        ])
                                        ?>

                                </div>
                        </div>
                </div>
        </div>


</div>
