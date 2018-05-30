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
	<body style="">
		<div id="print" style="width:210mm;min-height: 297mm;;">
			<style type="text/css">

				@media print {
					#printcontent {

						width: <?= $data['image_size']['width'] . 'cm' ?>;
						height: <?= $data['image_size']['height'] . 'cm' ?>;
						/*padding: 0 5px;*/
						text-align: center;
						background-size: cover;
						/*						transform: translate(0%,0%) rotate(90deg);*/
						position: absolute;
						bottom: 100%;
						/*                                        -webkit-transform: rotateZ(90deg);*/
						transform-origin: 0 100%;
						/*background: #AACAD7;*/
						/*white-space: nowrap;*/
						background-repeat: no-repeat;
						/*                               background-image: url("<?= Yii::$app->homeUrl ?>img/cheque-images/<?= $design->id ?>.<?= $design->cheque_image ?>");*/

					}
#printcontent img{width: <?= $data['image_size']['width'] . 'cm' ?>;
							  height: <?= $data['image_size']['height'] . 'cm' ?>;

					}


					* {-webkit-print-color-adjust:exact;}


				}
				* {
					-webkit-box-sizing: border-box;
					-moz-box-sizing: border-box;
					box-sizing: border-box;
				}

				body {
					margin: 0;
					padding: 0;
					width: 210mm;
					min-height: 297mm;
					font-family: sans-serif;
				}

				#printcontent {
					width: <?= $data['image_size']['width'] . 'cm' ?>;
					height: <?= $data['image_size']['height'] . 'cm' ?>;
					padding: 0 5px;
					text-align: center;
					background-size: cover;

					//position: absolute;
					bottom: 100%;
					/*-webkit-transform: rotateZ(90deg);*/
					transform-origin: 0 100%;
					/*background: #AACAD7;*/
					/*white-space: nowrap;*/
					background-repeat: no-repeat;
					                             /* background-image: url("<?= Yii::$app->homeUrl ?>img/cheque-images/<?= $design->id ?>.<?= $design->cheque_image ?>");*/


				}
				.cheque_position_left{
					transform: translate(0%,0%) rotate(90deg);
				}
				.cheque_position_center{
					transform: translate(35%,0%) rotate(90deg);
				}
.cheque_position_left_landscape{
                    transform: translate(0%,0%) rotate(0deg);
                    bottom:71.5%!important;
                }
                .cheque_position_center_landscape{
                    transform: translate(10%,0%) rotate(0deg);
                    bottom:71.5%!important;
                }
                .cheque_position_left_portrait{
                    transform: translate(0%,0%) rotate(90deg);
position: absolute;
                }
                .cheque_position_center_portrait{
                    transform: translate(35%,0%) rotate(90deg);
position: absolute;
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
					/*width: 556px;*/
					width:<?= $data['rupee_word']['width'] . 'px' ?>;
					text-align: left;

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
				#ac_center{
					top:<?= $data['ac_center']['top'] . 'px' ?>;
					left:<?= $data['ac_center']['left'] . 'px' ?>;
					width:<?= $data['ac_center']['width'] . 'px' ?>;
					position: absolute;
				}
				.data_style{
					font-weight: bolder;
					color: black;
					position: absolute;
					font-size: <?= $data['font']['size'] . 'px' ?>;
					line-height: 12px;
					/*background-color: rgba(151, 152, 152, 0.4);*/
					cursor: all-scroll;
				}

			</style>
<?php
            if ($print_dats->cheque_position == 2 && $print_dats->print_type == 2) {
                $class_n = 'cheque_position_center_landscape';
            }
            elseif ($print_dats->cheque_position == 2 && $print_dats->print_type == 1) {
                $class_n = 'cheque_position_center_portrait';
            }
            elseif ($print_dats->cheque_position == 1 && $print_dats->print_type == 2) {
                $class_n = 'cheque_position_left_landscape';
            }
            elseif ($print_dats->cheque_position == 1 && $print_dats->print_type == 1) {
                $class_n = 'cheque_position_left_portrait';
            }
else {
				$class_n = 'cheque_position_center_landscape';
			}
            ?>
			<!--                <div style="width:100%;height: 270%;">-->
			<div id="printcontent" class="<?= $class_n ?>"  >


                                                  <!--<img src='<?= Yii::$app->homeUrl ?>img/cheque-images/<?= $design->id ?>.<?= $design->cheque_image ?>' class="cheque_image">-->
				<div id="date" class="data_style" style="width: auto !important;"><?= $newDate; ?></div>
				<div id="name" class="data_style" style="padding: 0em;"><?= $print_dats->payee->payee_name; ?></div>
				<div id="rupee_word" class="data_style">
					
<?= strtoupper($print_dats->cheque_amount_words); ?>
				</div>
				<div id="rupee_num" class="data_style"><?= $amount_number; ?></div>
				<?php if ($print_dats->cheque_type == 2) { ?>
					<img src="http://www.cheque360.com/cheque/cheque_marks/ac_payee_e.png" id="ac_cross">
				<?php } elseif ($print_dats->cheque_type == 3) {
					?>
					<div id="ac_center" class="data_style">A/C PAYEE ONLY</div>
				<?php } elseif ($print_dats->cheque_type == 4) { ?>
					<div id="ac_not" class="acc_center_class">NOT NEGOTIABLE<br>A/C PAYEE ONLY</div>
				<?php } ?>
				<?php // if ($print_dats->not_over_status == 1)  ?>
<!--<div id="not_more_than" class="not_more_class" style="">NOT OVER THAN &nbsp;<?php // $print_dats->cheque_amount . '/-';                                                                                                                ?></div>-->
<!--                        <p>Y Button 2</p>-->
			</div>
			<!--                <div class="line"></div>-->
			<!--</div>-->
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
		<div style="margin-bottom: 100px;text-align: center;" class="print">
			<button onclick="printContent('print')" style="font-weight: bold !important;">Print</button>

			<button onclick="window.close();" style="font-weight: bold !important;">Close</button>
		</div>
	</body>
</html>

