<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterBank;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\BankAccounts */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
        .another_bank{
                color: #ea1714;
                font-size: 17px;
        }
        label{
                font-weight: 600 !important;
                margin-bottom: 7px;
        }
        .scale{
                float: left;
                width: 10%;
                padding-top: 15px;
                padding-bottom: 4px;
                margin-left: 3px;
                font-size: 15px;
        }


</style>

<div class="bank-accounts-form">


        <div class="form-group">
                <label class="control-label">WIDTH</label>
                <div class="row" style="display:inline-block">
                        <div style="float:left;width:60%;margin-left: 15px">
                                <input type="number" id="design_width" class="form-control" name="design_width"  step="any" value="<?= $data['image_size']['width'] ?>" style="width:50%;">
                        </div>
                        <div class="scale">
                                <span>.cm</span>
                        </div>

                </div>
        </div>
        <div class="form-group ">
                <label class="control-label">HEIGHT</label>
                <div class="row" style="display:inline-block">
                        <div style="float:left;width:60%;margin-left: 15px">
                                <input type="number" id="design_height" class="form-control" name="design_height"  step="any" value="<?= $data['image_size']['height'] ?>">
                        </div>
                        <div class="scale">
                                <span>.cm</span>
                        </div>

                </div>
        </div>
        <div class="form-group ">
                <label class="control-label">FONT SIZE</label>
                <input type="number" id="font_size" class="form-control" name="font_size"  step="1" value="<?= $data['font']['size'] ?>">
        </div>
        <div class="form-group ">
                <label class="control-label">DATE LETTER SPACE</label>
                <input type="number" id="date-space" class="form-control" name="date-space"  step="1" value="<?= $data['cheque_date']['letter-spacing'] ?>">
        </div>
        <div class="form-group ">
                <label class="control-label">AMOUNT TEXT INDENT</label>
                <input type="number" id="amount-text-indent" class="form-control" name="amount-text-indent"  step="1" value="<?= $data['rupee_word']['text-indent'] ?>">
        </div>
        <div class="form-group ">
                <label class="control-label">AMOUNT LINE HEIGHT</label>
                <input type="number" id="amount-line-height" class="form-control" name="amount-line-height"  step="1" value="<?= $data['rupee_word']['line-height'] ?>">
        </div>

        <div class="form-group" style="visibility: visible" id="date_hyphen">
                <label class="control-label">
                        <input name="date_hyphen" id="input_date_hyphen"type="checkbox"  value=""> Separate Date with Hyphen</label>
                <input name="hyphen" type="hidden" value="<?= $model->cheque_date_hyphen; ?>" id="hyphen">
        </div>
        <script>
                $(document).ready(function () {
                        if ($('#hyphen').val() == '1') {
                                $('#input_date_hyphen').prop('checked', true);
                                var date = $('#date').text();

                                var d = $('#date').text().substr(0, 2);
                                var m = $('#date').text().substr(2, 2);
                                var y = $('#date').text().substr(4, 4);
                                var formatted_date = d + "-" + m + "-" + y;

                                $('#date').text(formatted_date);
                                $('#hyphen').val('1');
                        }

                        $('#input_date_hyphen').change(function () {

                                if ($("#input_date_hyphen").prop('checked') == true) {
//                                        alert('yes');
                                        var date = $('#date').text();

                                        var d = $('#date').text().substr(0, 2);
                                        var m = $('#date').text().substr(2, 2);
                                        var y = $('#date').text().substr(4, 4);
                                        var formatted_date = d + "-" + m + "-" + y;

                                        $('#date').text(formatted_date);
                                        $('#hyphen').val('1');
                                } else {
                                        var value = $('#date').text();
                                        var dteSplit = value.split("-");
                                        var nor_d = dteSplit[0];
                                        var nor_m = dteSplit[1];
                                        var nor_yr = dteSplit[2];
                                        var nor_date = nor_d + nor_m + nor_yr;
                                        $('#date').text(nor_date);
                                        $('#hyphen').val('0');
                                }
                                $('#textbox1').val($(this).is(':checked'));
                        });
                });
        </script>









</div>

<script>

        $(document).ready(function () {

                $("#date-space").bind('keyup mouseup', function () {
                        var spacing = $("#date-space").val();
                        $('#letter-spacing').val(spacing);
                        $('#date').css('letter-spacing', spacing);
                });
                $("#amount-text-indent").bind('keyup mouseup', function () {
                        var textindent = $("#amount-text-indent").val();
                        $('#rupee_word_text_indent').val(textindent);
                        $('#rupee_word').css('text-indent', textindent);
                });
                $("#amount-line-height").bind('keyup mouseup', function () {
                        var lineheight = $("#amount-line-height").val();
                        $('#rupee_word_line_height').val(lineheight);
                        $('#rupee_word').css('line-height', lineheight + 'px');
                });
                $("#design_width").bind('keyup mouseup', function () {
                        var width = $("#design_width").val();
                        $('#image_width').val(width);
                        $('#chq_image').css("width", width + 'cm');
                });
                $("#design_height").bind('keyup mouseup', function () {
                        var height = $("#design_height").val();
                        $('#image_height').val(height);
                        $('#chq_image').css("height", height + 'cm');
                });
                $("#font_size").bind('keyup mouseup', function () {
                        var fontsize = $("#font_size").val();
                        $('#font_size').val(fontsize);
                        $('.data_style').css("font-size", fontsize + 'px');
                });
        });
</script>
