<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model common\models\UserImg */

$this->title = 'Print Design';
$this->params['breadcrumbs'][] = ['label' => 'User Imgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$data = Json::decode($model->field_7);
?>
<!--<script>var strWindowFeatures = "location=yes,height=570,width=520,scrollbars=yes,status=yes";
        var URL = "https://www.linkedin.com/cws/share?mini=true&amp;url=" + location.href;
        var win = window.open(URL, "_blank", strWindowFeatures);</script>-->

<style>
        .cheque_image{
                width: <?= $data['image_size']['width'] . 'cm' ?>;
                height: <?= $data['image_size']['height'] . 'cm' ?>;
        }
        .bgimg {
                background-repeat: no-repeat;
                background-size: contain;
                position: relative;

        }
        .data_style{
                font-weight: bolder;
                color: black;
                position: absolute;
                font-size: <?= $data['font']['size'] . 'px' ?>;
                line-height: 12px;
                background-color: rgba(151, 152, 152, 0.4);
        }
        #date{
                top:<?= $data['cheque_date']['top'] ?>;
                left:<?= $data['cheque_date']['left'] ?>;
                letter-spacing: <?= $data['cheque_date']['letter-spacing'] ?>;
                width: auto !important;
        }
        #name{
                top:<?= $data['cheque_name']['top'] ?>;
                left:<?= $data['cheque_name']['left'] ?>;
                width: auto !important;
        }
        #rupee_word{
                top:<?= $data['rupee_word']['top'] ?>;
                left:<?= $data['rupee_word']['left'] ?>;
                text-indent: <?= $data['rupee_word']['text-indent'] ?>;
                line-height: <?= $data['rupee_word']['line-height'] . 'px' ?>;
                width:<?= $data['rupee_word']['width'] . 'px' ?>;

        }
        #ac_center{
                top:<?= $data['ac_center']['top'] ?>;
                left:<?= $data['ac_center']['left'] ?>;
                width:<?= $data['ac_center']['width'] . 'px' ?>;
                visibility: hidden;
        }
        #rupee_num{
                top:<?= $data['rupee_num']['top'] ?>;
                left:<?= $data['rupee_num']['left'] ?>;
                width: auto !important;
        }
        .float_a{
                float: left;
        }
        /*        #ac_center{
                        position: absolute;
                        top:<?php // $data['rupee_word']['top'] + 70  ?>;
                        left: 347px;
                        visibility: hidden;
                }*/
        #ac_not{
                position: absolute;
                top:<?= $data['rupee_word']['top'] + 70 ?>;
                left: 347px;
                visibility: hidden;
        }
        .not_more_class{
                width:184px;
                top:<?= $data['rupee_word']['top'] + 120 ?>;
                left:284px;
                position: absolute;
                visibility: visible;
                font-size: 12px;
                line-height: 12px;
                font-weight: bold;
        }
        hr{
                margin-top: 10px;
                margin-bottom: 28px;
                border: 0;
                border-top: 3px solid rgba(39, 41, 42, 0.46);
        }

</style>
<div class="container">
        <div class = "row" style="    margin-bottom: 8px;">
                <?=
                $this->render('_menus', [
                    'model' => $model,
                ])
                ?>

        </div>

        <div class = "row">
                <?php
                //$form = ActiveForm::begin(['dashboard/save-print?id=' . $_GET['id'], 'id' => 'print_form', 'method' => 'post',]);
                $form = ActiveForm::begin([
                            'id' => 'print_form',
                            'options' => ['method' => 'post',],
                            'action' => 'save-print?id=' . $bank_accounts_id,
                ]);
                ?>
                <div class="col-md-3">
                        <div style="width: 100%;">
                                <?php if (Yii::$app->session->hasFlash('error')): ?>
                                        <div class="alert alert-danger" role="alert">
                                                <?= Yii::$app->session->getFlash('error') ?>
                                        </div>
                                <?php endif; ?>
                                <?php if (Yii::$app->session->hasFlash('success')): ?>
                                        <div class="alert alert-success" role="alert">
                                                <?= Yii::$app->session->getFlash('success') ?>
                                        </div>
                                <?php endif; ?>
                        </div>
                        <div class="bank-accounts-create panel">
                                <h1 style="font-size: 20px;margin-top: 2px;">Cheque Details</h1>
				<hr>
                                <?php // Html::beginForm(['dashboard/save-print?id=' . $_GET['id']], 'post', [/* 'target' => 'print_popup', 'onSubmit' => "window.open('about:blank','print_popup','width=1200,height=740');" */ 'id' => 'print_form']) ?>

                                <?=
                                $this->render('_print_form', [
                                    'model' => $model,
                                    'cheques' => $cheques,
                                    'model_new' => $model_new,
                                    'form' => $form,
                                    'prints' => $prints,
                                    'bank_accounts_id' => $bank_accounts_id,
                                ])
                                ?>

                        </div>

                </div>
                <div class="col-md-9">

                        <div class = "panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><span style="font-weight:bold;"><?= $model->bank->bank_name ?> - <?= $model->bank->account_name?></span></h3><br/>
                                        <hr>
                                </div>
                                <div class="bgimg">
                                        <img class="cheque_image"src='<?= Yii::$app->homeUrl ?>img/cheque-images/<?= $model->id ?>.<?= $model->cheque_image ?>' style="" id="prnt_image">
                                        <div id="date" class="data_style" style="width: auto !important;" ></div>
                                        <div id="name" class="data_style" style="padding: 0em;">XYZ NAME</div>
                                        <div id="rupee_word" class="data_style" style="/*width: 556px !important;*/height: 61px;">
                                                 NINETY NINE CRORE NINETY NINE LAKH NINETY NINE THOUSAND NINE HUNDRED AND NINETY NINE USD AND NINETY NINE CENTS ONLY
                                        </div>
                                        <img src="<?= Yii::$app->homeUrl; ?>img/ac_payee_e.png" id="ac_cross">
                                        <div id="ac_center" class="data_style">A/C PAYEE ONLY</div>
                                        <div id="ac_not" class="acc_center_class">NOT NEGOTIABLE<br>A/C PAYEE ONLY</div>
                                         <div id="rupee_num" class="data_style">****99,99,99,999.99</div>
                                        <!--<div id="not_more_than" class="not_more_class" style="">NOT OVER THAN </div>-->
                                </div>
                                <div class="form-group">
                                        <?php // Html::submitButton('SAVE PRINT', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;', 'id' => 'save-print', 'value' => 'save_print', 'name' => 'submit']) ?>
                                        <?= Html::submitButton('SAVE & PRINT', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;', 'id' => 'save_only', 'value' => 'save', 'name' => 'print-submit']) ?>
                                </div>


                                <div id="myModal" class="modal">

                                        <!-- Modal content -->

                                        <div class="modal-content">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                        ×</button>
                                                <div id="datas_new"></div>


                                        </div>

                                </div>

                        </div>
                </div>
                <?php ActiveForm::end(); ?>
        </div>
</div>

<script>
        $(document).ready(function () {
                $('#save-print').click(function () {
                        $("#print_form").attr('target', 'print_popup');
                });
                $('#save_only').click(function () {
                        $("#print_form").attr('target', '_self');
                });
        });
</script>

<script>
// Get the modal
        var modal = document.getElementById('myModal');

// Get the button that opens the modal
        var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
        //btn.onclick = function () {
        //modal.style.display = "block";
//	}

// When the user clicks on <span> (x), close the modal
        span.onclick = function () {

                modal.style.display = "none";
        }

// When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
                if (event.target == modal) {
                        modal.style.display = "none";
                }
        }
</script>