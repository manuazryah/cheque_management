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
?>
<!DOCTYPE html>

<div id="print">
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>/css/pdf.css">

        <style type="text/css">

                @media print {
                        thead {display: table-header-group;}
                        tfoot {display: table-footer-group}
                        /*tfoot {position: absolute;bottom: 0px;}*/
                        .main-tabl{width: 100%}
                        .footer {position: fixed ; left: 0px; bottom: 0px; right: 0px; font-size:10px; }
                }
                /*.footer {position: fixed ; left: 0px; bottom: 0px; right: 0px; font-size:10px; }*/
                @media screen{
                        .main-tabl{
                                width: 60%;
                        }
                }
                .table td {
                        border: 1px solid black;
                        font-size: 9px !important;
                        text-align: center;
                        padding: 3px;
                }
                .print{
                        margin-top: 18px;
                        /*                        margin-left: 375px;*/
                }
                .save{
                        margin-top: 18px;
                        margin-left: 6px !important;
                }
                .cheque_image{
                        width: <?= $data['image_size']['width'] . 'cm' ?>;
                        height: <?= $data['image_size']['height'] . 'cm' ?>;
                }

                #date{
                        top:<?= $data['cheque_date']['top'] . 'px' ?>;
                        left:<?= $data['cheque_date']['left'] . 'px' ?>;
                        letter-spacing: <?= $data['cheque_date']['letter-spacing'] . 'px' ?>;
                        width: auto !important;
                        position: absolute;

                }
                #name{
                        top:<?= $data['cheque_name']['top'] . 'px' ?>;
                        left:<?= $data['cheque_name']['left'] . 'px' ?>;
                        width: auto !important;
                        position: absolute;

                }
                #rupee_word{
                        top:<?= $data['rupee_word']['top'] . 'px' ?>;
                        left:<?= $data['rupee_word']['left'] . 'px' ?>;
                        text-indent: <?= $data['rupee_word']['text-indent'] . 'px' ?>;
                        line-height: <?= $data['rupee_word']['line-height'] . 'px' ?>;
                        position: absolute;
                        width:556px;

                        /*			//width:556px;*/

                }
                #rupee_num{
                        top: <?= $data['rupee_num']['top'] . 'px' ?>;
                        padding-left:<?= $data['rupee_num']['left'] . 'px' ?>;
                        width: auto !important;
                        position: absolute;

                }
                #test{
                        color: red;
                }
                .data_style{
                        font-size: <?= $data['font']['size'] . 'px' ?>;
                }
                .bgimg {
                        background-repeat: no-repeat;
                        background-size: contain;
                        position: relative;



                }
                #rotate_div {
                        -webkit-transform: rotate(90deg);

                        /*-webkit-transform-origin: 0 100%;*/
                        position : relative;
                        /*			top      : 50%;*/
                }
                .not_more_class{
                        width:auto !important;
                        top:<?= $data['rupee_word']['top'] + 120 . 'px' ?>;
                        left:284px;
                        position: absolute;
                        visibility: visible;
                        font-size: 12px;
                        line-height: 12px;
                }
                #ac_cross {
                        position: absolute;
                        top: 0px;
                        left: 0px;
                }
                #ac_center{
                        position: absolute;
                        top:<?= $data['rupee_word']['top'] + 70 . 'px' ?>;
                        left: 347px;
                }
                .acc_center_class {
                        border-top: solid 1px #000;
                        border-bottom: solid 1px #000;
                        font-size: 13px;
                        line-height: 13px;
                        text-align: center;
                        font-weight: bold;
                }
                #ac_not{
                        position: absolute;
                        top:<?= $data['rupee_word']['top'] + 70 . 'px' ?>;
                        left: 347px;
                }
                @media screen{
                        #rotate_div {
                                top      : 181px;
                                width: <?= $data['image_size']['width'] . 'cm' ?>;
                                height: <?= $data['image_size']['height'] . 'cm' ?>;

                        }
                }
                @media print{
                        #rotate_div {
                                top: 208px;
                                margin-left: 0px!important;
                        }
                        body {
                                margin-left: 0mm !important; margin-right: 0mm}

                }
                @page {
                        margin: 0;

                }


        </style>
        <?php foreach ($emi_cheques as $emis) { ?>
                <div class="bgimg" style="height: auto !important;" id="rotate_div">
                        <img src='<?= Yii::$app->homeUrl ?>img/cheque-images/<?= $design->id ?>.<?= $design->cheque_image ?>' class="cheque_image"  style="display:none;">

                        <div id="date" class="data_style" style="width: auto !important;"><?= $newDate; ?></div>
                        <div id="name" class="data_style" style="padding: 0em;"><?= $print_dats->payee->payee_name; ?></div>
                        <div id="rupee_word" class="data_style">
                                <?= $print_dats->cheque_amount_words; ?>
                        </div>
                        <div id="rupee_num" class="data_style"><?= $print_dats->cheque_amount . '/-'; ?></div>
                        <?php if ($print_dats->cheque_type == 2) { ?>
                                <img src="http://www.cheque360.com/cheque/cheque_marks/ac_payee_e.png" id="ac_cross">
                                <?php
                        } elseif ($print_dats->cheque_type == 3) {
                                ?>
                                <div id="ac_center" class="acc_center_class">A/C PAYEE ONLY</div>
                                <?php
                        } elseif ($print_dats->cheque_type == 4) {
                                ?>
                                <div id="ac_not" class="acc_center_class">NOT NEGOTIABLE<br>A/C PAYEE ONLY</div>
                        <?php } ?>
                        <?php if ($print_dats->not_over_status == 1) { ?>
                                <div id="not_more_than" class="not_more_class" style="">NOT OVER THAN &nbsp;<?= $print_dats->cheque_amount . '/-'; ?></div>
                        <?php } ?>
                </div>
        <?php } ?>


        <script>
                function printContent(el) {
                        var restorepage = document.body.innerHTML;
                        var printcontent = document.getElementById(el).innerHTML;
                        document.body.innerHTML = printcontent;
                        window.print();
                        document.body.innerHTML = restorepage;
                }
        </script>


</div>
<div style="/*margin-top: 450px;*/" class="print">
        <button onclick="printContent('print')" style="font-weight: bold !important;">Print</button>

        <button onclick="window.close();" style="font-weight: bold !important;">Close</button>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<!--<script type="text/javascript" src="http://beneposto.pl/jqueryrotate/js/jQueryRotateCompressed.js"></script>-->
<script>
                $(document).ready(function () {




                });
</script>
