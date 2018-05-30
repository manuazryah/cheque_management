<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model common\models\UserImg */

$this->title = 'Create User Img';
$this->params['breadcrumbs'][] = ['label' => 'User Imgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$data = Json::decode($model->field_7);
//var_dump($data);
//exit;
?>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
<style type="text/css">
        hr{
                margin-top: 10px;
                margin-bottom: 28px;
                border: 0;
                border-top: 3px solid rgba(39, 41, 42, 0.46);
        }
        .bgimg {
                background-repeat: no-repeat;
                background-size: contain;
                position: relative;

        }
        .cheque_image{
                width: <?= $data['image_size']['width'] . 'cm' ?>;
                height: <?= $data['image_size']['height'] . 'cm' ?>;
        }
        .datas {
                padding: 0.5em;
                font-weight: bolder;
                color: black;
                position: absolute;
                background-color: rgba(151, 152, 152, 0.4);

        }
        .data_style{
                font-weight: bolder;
                color: black;
                position: absolute;
                font-size: <?= $data['font']['size'] . 'px' ?>;
                line-height: 12px;
                background-color: rgba(151, 152, 152, 0.4);
                cursor: all-scroll;
        }


        #date{
                top:<?= $data['cheque_date']['top'] ?>;
                left:<?= $data['cheque_date']['left'] ?>;
                letter-spacing: <?= $data['cheque_date']['letter-spacing'] ?>;
                width: auto !important;
                font-family: sans-serif !important;
        }
        #name{
                top:<?= $data['cheque_name']['top'] ?>;
                left:<?= $data['cheque_name']['left'] ?>;
                width: auto !important;
                font-family: sans-serif !important;
        }
        #rupee_word{
                top:<?= $data['rupee_word']['top'] ?>;
                left:<?= $data['rupee_word']['left'] ?>;
                text-indent: <?= $data['rupee_word']['text-indent'] ?>;
                line-height: <?= $data['rupee_word']['line-height'] . 'px' ?>;
                width:<?= $data['rupee_word']['width'] . 'px' ?>;
                font-family: sans-serif !important;

        }
        #ac_center{
                top:<?= $data['ac_center']['top'] ?>;
                left:<?= $data['ac_center']['left'] ?>;
                width:<?= $data['ac_center']['width'] . 'px' ?>;
                font-family: sans-serif !important;

        }
        #rupee_num{
                top:<?= $data['rupee_num']['top'] ?>;
                left:<?= $data['rupee_num']['left'] ?>;
                width: auto !important;
                font-family: sans-serif !important;
        }
        #accnt_num{
                top:<?= $data['acc_num']['top'] ?>;
                left:<?= $data['acc_num']['left'] ?>;
                width: auto !important;
                font-family: sans-serif !important;
        }
        #bearer{
                top:<?= $data['bearer']['top'] ?>;
                left:<?= $data['bearer']['left'] ?>;
        }
        .panel .panel-body {
                margin-bottom: 23px;
        }
</style>
<div class="container">

        <div class = "row">
                <?=
                $this->render('_menus', [
                    'model' => $model,
                ])
                ?>
                <?php $form = ActiveForm::begin(['id' => 'cheque_form', 'options' => ['enctype' => 'multipart/form-data', 'method' => 'post'], 'action' => Yii::$app->homeUrl . 'dashboard/save-layout']) ?>
                <div class="col-md-3" style="padding-left: 0px">

                        <div class="bank-accounts-create panel">

                                <h1 style="font-size: 20px">Set Parameters</h1>
				<hr>
                                <?=
                                $this->render('_form', [
                                    'model' => $model,
                                    'data' => $data,
                                ])
                                ?>

                        </div>
                </div>
                <div class = "col-md-9">

                        <div class = "panel">

                                <h1 style="font-size: 20px"><?= Html::encode('Set Layout for: ') ?><span style="font-weight: bold"><?= $model->bank->bank_name ?>  -  <?= $model->bank->account_name ?></span></h1>
                                <hr>

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
                                <div class="panel-body">
                                        <div class="panel-body">
                                                <div class="user-img-create">



                                                        <div class="bgimg">
                                                                <img class="cheque_image"src='<?= Yii::$app->homeUrl ?>img/cheque-images/<?= $model->id ?>.<?= $model->cheque_image ?>' style="" id="chq_image">
                                                                <div id="date" class="data_style" style="width: auto !important;" >20102016</div>
                                                                <div id="name" class="data_style" style="padding: 0em;">XYZ NAME</div>
                                                                <div id="rupee_word" class="data_style" style="/*width: 556px !important;*/height: 61px;">
                                                                         NINETY NINE CRORE NINETY NINE LAKH NINETY NINE THOUSAND NINE HUNDRED AND NINETY NINE USD AND NINETY NINE CENTS ONLY
                                                                </div>
                                                                <div id="ac_center" class="data_style">A/C PAYEE ONLY</div>
                                                                <div id="rupee_num" class="data_style">****99,99,99,999.99</div>
                                                                <!--								<div id="accnt_num" class="data_style">SDFT0056468</div>-->
                                                                <!--							<div id="bearer" class="data_style">*********</div>-->

                                                        </div>


                                                        <input type="hidden" name="image_width" value="<?= $data['image_size']['width'] ?>" id="image_width">
                                                        <input type="hidden" name="image_height" value="<?= $data['image_size']['height'] ?>" id="image_height">
                                                        <input type="hidden" name="date_x" value="" id="date_x">
                                                        <input type="hidden" name="date_y" value="" id="date_y">
                                                        <input type="hidden" name="letter-spacing" value="<?= $data['cheque_date']['letter-spacing'] ?>" id="letter-spacing">
                                                        <input type="hidden" name="name_x" value="" id="name_x">
                                                        <input type="hidden" name="name_y" value="" id="name_y">
                                                        <input type="hidden" name="rupee_word_x" value="" id="rupee_word_x">
                                                        <input type="hidden" name="rupee_word_y" value="" id="rupee_word_y">
                                                        <input type="hidden" name="rupee_word_width" value="" id="rupee_word_width">
                                                        <input type="hidden" name="rupee_word_text_indent" value="<?= $data['rupee_word']['text-indent'] ?>" id="rupee_word_text_indent">
                                                        <input type="hidden" name="rupee_word_line_height" value="<?= $data['rupee_word']['line-height'] ?>" id="rupee_word_line_height">
                                                        <input type="hidden" name="rupee_num_x" value="" id="rupee_num_x">
                                                        <input type="hidden" name="rupee_num_y" value="" id="rupee_num_y">
                                                        <input type="hidden" name="accnt_num_x" value="" id="accnt_num_x">
                                                        <input type="hidden" name="accnt_num_y" value="" id="accnt_num_y">
                                                        <input type="hidden" name="bearer_x" value="" id="bearer_x">
                                                        <input type="hidden" name="bearer_y" value="" id="bearer_y">
                                                        <input type="hidden" name="model_id" value="<?= $model->id ?>" id="model_id">
                                                        <input type="hidden" name="ac_center_x" value="" id="ac_center_x">
                                                        <input type="hidden" name="ac_center_y" value="" id="ac_center_y">
                                                        <input type="hidden" name="ac_center_width" value="" id="ac_center_width">

                                                </div>
                                                <div class="form-group" >
                        <!--						<input value="Save" type="submit" onclick="function()" class="btn btn-primary" style="margin-top: 18px;" id="save">-->
                                                        <?= Html::submitButton('SAVE', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;', 'id' => 'upload']) ?>
                                                </div>

                                        </div>
                                </div>
                                <?php ActiveForm::end() ?>

                        </div>
                </div>

        </div>
        <div class="row">
                <div class="col-md-3" style="padding-left: 0px">

                </div>
                <div class="col-md-9">
                        <div class="panel">
                                <h4 style="font-weight:bold;">Change Cheque Image</h4>
                                <hr>
                                <?php $form1 = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action' => Yii::$app->request->baseUrl . '/dashboard/new-cheque-design?id=' . $_GET['id'], 'method' => 'post']) ?>
                                <?php
//                                $form1 = ActiveForm::begin([
//                                            'options' => ['enctype' => 'multipart/form-data', 'method' => 'post'],
//                                            'action' => 'new-cheque-design?id=' . $_GET['id'],
//                                        ])
                                ?>
<?php if (Yii::$app->session->hasFlash('error2')): ?>
					<div class="alert alert-danger" role="alert">
						<?= Yii::$app->session->getFlash('error2') ?>
					</div>
				<?php endif; ?>
<?= $form1->errorSummary($model); ?>

                                <?= $form1->field($new_design, 'cheque_image')->fileInput() ?>

                                <div class="form-group" >
                                        <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
                                </div>

                                <?php ActiveForm::end() ?>
                        </div>
                </div>

        </div>
</div>


<script>
        $(document).ready(function () {
                setTimeout(function () {
                }, 30);
                $('#date').draggable(
                        {
                                drag: function () {
                                        var offset = $(this).position();
                                        var xPos = offset.left;
                                        var yPos = offset.top;
                                        $('#date_x').val(xPos);
                                        $('#date_y').val(yPos);
                                }
                        });
                $('#name').draggable(
                        {
                                drag: function () {
                                        var offset = $(this).position();
                                        var xPos = offset.left;
                                        var yPos = offset.top;
                                        $('#name_x').val(xPos);
                                        $('#name_y').val(yPos);
                                }
                        });
                $('#rupee_word').draggable(
                        {
                                drag: function () {
                                        var offset = $(this).position();
                                        var xPos = offset.left;
                                        var yPos = offset.top;
                                        $('#rupee_word_x').val(xPos);
                                        $('#rupee_word_y').val(yPos);
                                }
                        }).resizable({
                        handles: 'e, w',
                        stop: function (event, ui) {
                                $('#rupee_word_width').val($('#rupee_word').width());
                        }
                });

                $('#ac_center').draggable(
                        {
                                drag: function () {
                                        var offset = $(this).position();
                                        var xPos = offset.left;
                                        var yPos = offset.top;
                                        $('#ac_center_x').val(xPos);
                                        $('#ac_center_y').val(yPos);
                                }
                        }).resizable({
                        handles: 'e, w',
                        stop: function (event, ui) {
                                $('#ac_center_width').val($('#ac_center').width());
                        }
                });

                $('#rupee_num').draggable(
                        {
                                drag: function () {
                                        var offset = $(this).position();
                                        var xPos = offset.left;
                                        var yPos = offset.top;
                                        $('#rupee_num_x').val(xPos);
                                        $('#rupee_num_y').val(yPos);
                                }
                        });
                $('#accnt_num').draggable(
                        {
                                drag: function () {
                                        var offset = $(this).position();
                                        var xPos = offset.left;
                                        var yPos = offset.top;
                                        $('#accnt_num_x').val(xPos);
                                        $('#accnt_num_y').val(yPos);
                                }
                        });
                $('#bearer').draggable(
                        {
                                drag: function () {
                                        var offset = $(this).position();
                                        var xPos = offset.left;
                                        var yPos = offset.top;
                                        $('#bearer_x').val(xPos);
                                        $('#bearer_y').val(yPos);
                                }
                        });



        });


</script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

