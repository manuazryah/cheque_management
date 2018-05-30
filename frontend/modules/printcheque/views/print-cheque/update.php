<style>

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
                        <div class="col-md-12">
                                <div style="width: 100%;padding-bottom: 32px;">
					<?php if (Yii::$app->controller->action->id == 'update') { ?>
						<?= Html::a('Edit Bank', ['/bankaccounts/bank-accounts/update?id=' . $model->bank_account_id], ['class' => 'active-button']) ?>
					<?php } else { ?>
						<?= Html::a('Edit Bank', ['/bankaccounts/bank-accounts/update?id=' . $model->bank_account_id], ['class' => 'button']) ?>
					<?php } ?>
					<?php if (Yii::$app->controller->action->id == 'cheques') { ?>
						<?= Html::a('Cheque Book', ['/bankaccounts/cheque/cheques?id=' . $model->bank_account_id], ['class' => 'active-button']) ?>
					<?php } else { ?>
						<?= Html::a('Cheque Book', ['/bankaccounts/cheque/cheques?id=' . $model->bank_account_id], ['class' => 'button']) ?>
					<?php } ?>
					<?php if ((Yii::$app->controller->action->id == 'new-design') || (Yii::$app->controller->action->id == 'set-design') || ((Yii::$app->controller->action->id == 'more-details'))) { ?>
						<?= Html::a('Cheque Design', ['/dashboard/check-design?id=' . $model->bank_account_id], ['class' => 'active-button']) ?>
						<?php
					} else {
						?>
						<?= Html::a('Cheque Design', ['/dashboard/check-design?id=' . $model->bank_account_id], ['class' => 'button']) ?>
					<?php } if (Yii::$app->controller->action->id == 'print-cheque') { ?>
						<?= Html::a('Print New Cheque', ['/printcheque/print-cheque/index?id=' . $model->bank_account_id], ['class' => 'active-button']) ?>
					<?php } else { ?>
						<?= Html::a('Print New Cheque', ['/printcheque/print-cheque/index?id=' . $model->bank_account_id], ['class' => 'button']) ?>
					<?php } if (Yii::$app->controller->action->id == 'update-print') { ?>
						<?= Html::a('List Printed Cheque', ['/printcheque/print-cheque/prints?id=' . $model->bank_account_id], ['class' => 'active-button']) ?>
					<?php } else { ?>
						<?= Html::a('List Printed Cheque', ['/printcheque/print-cheque/prints?id=' . $model->bank_account_id], ['class' => 'button']) ?>
					<?php } ?>
				</div>
                                <div class="bank-accounts-create panel">
<div style="float:right;">
						<?= Html::a('Delete Cheque', ['print-cheque/delete?id=' . $model->id], ['data-confirm' => 'Are you sure you want to delete this item?', 'data-method' => 'POST', 'class' => 'btn btn-red']) ?>
                                        </div>
                                        <h1 style="font-size: 20px">Update</h1>


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
