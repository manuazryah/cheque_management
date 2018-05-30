<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\SubServices;
use common\models\Appointment;
use common\models\EstimatedProforma;
use common\models\Debtor;
use common\models\ServiceCategorys;
use common\models\Services;
use common\models\Vessel;
use common\models\EstimateReport;
use common\models\Currency;
use yii\helpers\Json;

$data = Json::decode($design->field_7);
//var_dump($data);
//exit;
?>
<!DOCTYPE html>
<html>
        <head>
                <style>
                        * {
                                -webkit-box-sizing: border-box;
                                -moz-box-sizing: border-box;
                                box-sizing: border-box;
                        }
                        body {
                                margin: 0;
                                padding: 0;
                                height: 300px;
                                width: 300px;
                        }

                        #yaxisbuttons {
                                width: <?= $data['image_size']['width'] . 'cm' ?>;
                                height: <?= $data['image_size']['height'] . 'cm' ?>;
                                /*position: absolute;*/
                                background-repeat: no-repeat;
                                padding: 0 5px;
                                text-align: center;
                                background-size: contain;
                                transform: translate(-28%,61%) rotate(90deg);
                                background-image: url("<?= Yii::$app->homeUrl ?>img/cheque-images/<?= $design->id ?>.<?= $design->cheque_image ?>");

                        }
                        .line {
                                position: absolute;
                                top: 50%;
                                width: 100%;
                                height: 1px;
                                border-bottom: 1px solid red;
                        }
                        #date{
                                top:<?= $data['cheque_date']['top'] . 'px' ?>;
                                left:<?= $data['cheque_date']['left'] . 'px' ?>;
                                letter-spacing: <?= $data['cheque_date']['letter-spacing'] . 'px' ?>;
                                width: auto !important;
                                position: absolute;

                        }
                        #name{
                                top:<?= $data['cheque_name']['top'] ?>;
                                left:<?= $data['cheque_name']['left'] ?>;
                                width: auto !important;
                                position: absolute;

                        }
                        #rupee_word{
                                top:<?= $data['rupee_word']['top'] . 'px' ?>;
                                left:<?= $data['rupee_word']['left'] . 'px' ?>;
                                text-indent: <?= $data['rupee_word']['text-indent'] . 'px' ?>;
                                line-height: <?= $data['rupee_word']['line-height'] . 'px' ?>;
                                position: absolute;
                                width: 556px;

                        }
                        #rupee_num{
                                top: <?= $data['rupee_num']['top'] . 'px' ?>;
                                padding-left:<?= $data['rupee_num']['left'] . 'px' ?>;
                                width: auto !important;
                                position: absolute;

                        }
                        .not_more_class{
                                width:auto !important;
                                top:200px;
                                left:284px;
                                position: absolute;
                                visibility: visible;
                                font-size: 12px;
                                line-height: 12px;
                        }
                </style>
        </head>
        <body>
                <div id="yaxisbuttons">
                        <!--<img src='<?php // Yii::$app->homeUrl                                                                                                  ?>img/cheque-images/<?php // $design->id                                                                                                  ?>.<?php // $design->cheque_image                                                                                                  ?>' class="cheque_image">-->
                        <div id="date" class="data_style" style="width: auto !important;"><?= $newDate; ?></div>
                        <div id="name" class="data_style" style="padding: 0em;"><?= $print_dats->payee->payee_name; ?></div>
                        <div id="rupee_word" class="data_style">
                                <?= $print_dats->cheque_amount_words; ?>
                        </div>
                        <div id="rupee_num" class="data_style"><?= $print_dats->cheque_amount . '/-'; ?></div>
                        <?php if ($print_dats->cheque_type == 2) { ?>
                                <img src="http://www.cheque360.com/cheque/cheque_marks/ac_payee_e.png" id="ac_cross">
                        <?php } elseif ($print_dats->cheque_type == 3) {
                                ?>
                                <div id="ac_center" class="acc_center_class">A/C PAYEE ONLY</div>
                        <?php } elseif ($print_dats->cheque_type == 4) { ?>
                                <div id="ac_not" class="acc_center_class">NOT NEGOTIABLE<br>A/C PAYEE ONLY</div>
                        <?php } ?>
                        <?php if ($print_dats->not_over_status == 1)  ?>
                        <div id="not_more_than" class="not_more_class" style="">NOT OVER THAN &nbsp;<?= $print_dats->cheque_amount . '/-'; ?></div>
         <!--                        <p>Y Button 2</p>-->
                </div>
                <!--                <div class="line"></div>-->

        </body>
</html>

