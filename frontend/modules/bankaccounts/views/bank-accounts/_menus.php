<?php

use yii\helpers\Html;
?>

<div style="padding: 17px 0px 15px 0px;margin-left: 15px;">
        <?php if (Yii::$app->controller->action->id == 'update') { ?>
                <?= Html::a('Edit Bank', ['/bankaccounts/bank-accounts/update?id=' . $_GET['id']], ['class' => 'active-button']) ?>
        <?php } else { ?>
                <?= Html::a('Edit Bank', ['/bankaccounts/bank-accounts/update?id=' . $_GET['id']], ['class' => 'button']) ?>
        <?php } ?>
        <?php if (Yii::$app->controller->action->id == 'cheques') { ?>
                <?= Html::a('Cheque Book', ['/bankaccounts/cheque/cheques?id=' . $_GET['id']], ['class' => 'active-button']) ?>
        <?php } else { ?>
                <?= Html::a('Cheque Book', ['/bankaccounts/cheque/cheques?id=' . $_GET['id']], ['class' => 'button']) ?>
        <?php } ?>
        <?php if ((Yii::$app->controller->action->id == 'new-design') || (Yii::$app->controller->action->id == 'set-design') || ((Yii::$app->controller->action->id == 'more-details'))) { ?>
                <?= Html::a('Cheque Design', ['/dashboard/check-design?id=' . $_GET['id']], ['class' => 'active-button']) ?>
                <?php
        } else {
                ?>
                <?= Html::a('Cheque Design', ['/dashboard/check-design?id=' . $_GET['id']], ['class' => 'button']) ?>
        <?php } if (Yii::$app->controller->action->id == 'print-cheque') { ?>
                <?= Html::a('Print New Cheque', ['/printcheque/print-cheque/index?id=' . $_GET['id']], ['class' => 'active-button']) ?>
        <?php } else { ?>
                <?= Html::a('Print New Cheque', ['/printcheque/print-cheque/index?id=' . $_GET['id']], ['class' => 'button']) ?>
        <?php } if (Yii::$app->controller->action->id == 'prints') { ?>
                <?= Html::a('List Printed Cheque', ['/printcheque/print-cheque/prints?id=' . $_GET['id']], ['class' => 'active-button']) ?>
        <?php } else { ?>
                <?= Html::a('List Printed Cheque', ['/printcheque/print-cheque/prints?id=' . $_GET['id']], ['class' => 'button']) ?>
        <?php } ?>
</div>
<!--<div style="float: right;margin-bottom: 10px;margin-right: 8px;">
<?php // Html::a('List Prints', ['printcheque/print-cheque/prints?id=' . $_GET['id']], ['class' => 'list_button']) ?>
</div>-->