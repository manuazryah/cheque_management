<?php

use yii\jui\DatePicker;
use common\models\Payee;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\PrintStatus;
use common\models\Users;
use common\models\Cheques;

/* @var $this yii\web\View */
/* @var $model common\models\BankAccounts */
/* @var $form yii\widgets\ActiveForm */

$bankcoountsid = $bank_accounts_id;
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
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
    .new-class{
        color: blue;
        margin-left: 105px;
        text-decoration: underline;
    }
    .hidediv1{
        display:none;
    }
    .hover-color a:hover{
        color: blue !important;
        text-decoration: underline !important;
    }

</style>

<div class="bank-accounts-form">



    <div class="form-group ">
        <?php
        $cheques = Cheques::find()->where(['bank_id' => $model->bank_accounts_id, 'status' => 1])->all();
        $arr = array();
        $check_no = array();
        foreach ($prints as $value) {
            $check_no[] = $value->cheque_number;
        }
        foreach ($cheques as $cheque) {
            $id = $cheque->id;
            $i = $cheque->cheque_series_starting_number;

            $j = 1;
            while ($j <= $cheque->number_of_cheques) {
                if (!in_array($i, $check_no)) {
                    $arr[] = $id . '_' . $i;


                } $i++;
                $j++;
            }
        }

        ?>
        <label class="control-label">Cheque Number: </label>
        <select id="cheque-number" class="form-control" name="cheque-number" required=""oninvalid="this.setCustomValidity('Please update cheque book')">

            <?php
            foreach ($arr as $value) {
                $str = $value;
                $arr = preg_split("/[_]/", $str);
                ?>
                <option value="<?= $value ?>"><?= $arr[1] ?></option>
                <?php
            }
            ?>
        </select>
        <!--                <label class="control-label">CHEQUE NUMBER : </label>
                        <input type="text" id="cheque-number" class="form-control" name="cheque-number"   value="<?php // $cheques->cheque_series_starting_number                                                                                                                                                                                                                                                     ?>">-->
    </div>
    <div class="form-group ">
        <label class="control-label">Date::</label>
        <?php
        echo DatePicker::widget([
            'name' => 'c_date',
            'id' => 'print-date',
            'value' => date('d-m-Y'),
            'dateFormat' => 'dd-MM-yyyy',
            'options' => ['class' => 'form-control']
        ]);
        ?>
    </div>
    <?php
    $payee = ArrayHelper::map(Payee::findAll(['status' => 1, 'user_id' => Yii::$app->session['user_session']['id']]), 'id', 'payee_name');
    echo $form->field($model_new, 'payee_id')->dropDownList($payee, ['prompt' => '-Choose a Payee-']);
    ?>
    <div class="hover-color">
        <?= Html::a('Add New Payee', ['payee/payee/index'], ['class' => 'new-class', 'target' => '_blank']) ?>
    </div>
    <?= $form->field($model_new, 'cheque_amount')->textInput(['maxlength' => true, 'id' => 'amount', 'autocomplete' => 'off']) ?>
    <div class="form-group ">
        <label class="control-label">Cheque Position On Print Page: </label>
        <select id="cheque-position" class="form-control" name="cheque-position">
            <option value="1">Left</option>
            <option value="2">Center</option>
        </select>
    </div>
    <div class="form-group ">
        <label class="control-label">Cheque Print Type: </label>
        <select id="print-type" class="form-control" name="print-type">
            <option value="1">Portrait</option>
            <option value="2">Landscape</option>
        </select>
    </div>
    <?= $form->field($model_new, 'cheque_amount_words')->hiddenInput(['value' => "", 'id' => 'amount_words'])->label(false); ?>
    <!--        <div class="form-group ">
                    <label class="control-label">
                            <input name="not_more" id="not_more"type="checkbox" checked="" value=""> ADD NOT OVER THAN</label>
                    <input name="notoveramount" type="hidden" value="" id="notoveramount">
            </div>-->
    <?php
//        $status = ArrayHelper::map(PrintStatus::findAll(['status' => 1]), 'id', 'status_name');
//        echo $form->field($model_new, 'print_status')->dropDownList($status, ['prompt' => '-Choose a Status-']);
    ?>
    <div class="form-group ">
        <?php
        // Html::dropDownList('status', null, ArrayHelper::map(PrintStatus::find()->all(), 'id', 'status_name'), ['prompt' => '--- change status ---', 'class' => 'form-control', 'id' => 'status'])
        ?>
    </div>
    <div class="form-group ">
        <label class="control-label">Remarks: </label>
        <textarea id="remarks" class="form-control" name="remarks"   value=""></textarea>
    </div>
    <input name="payment_mode" type="hidden" value="" id="payment_mode">
    <div><label class="advanced_options_print_label" id="advanced">Advanced Options:</label></div>
    <div class="hidediv1">
        <?= $form->field($model_new, 'no_of_emi_cheques')->textInput(['maxlength' => true]) ?>


        <div class="form-group">
            <!--<label class="advanced_options_print_label" id="advanced">Advanced Options:</label>-->
            <!--                <div class="advanced_toggle" >-->
            <div class="radio">
                <label> <input name="cheque_type" type="radio" value="1" id="cheque_type" checked="checked"> BEARER</label>
            </div>
            <!--                        <div class="radio">
                                            <label> <input name="cheque_type" type="radio" value="2" id="cheque_type"> AC PAYEE ONLY(CROSS)</label>
                                    </div>-->
            <div class="radio">
                <label> <input name="cheque_type" type="radio" value="3" id="cheque_type"> AC PAYEE (CENTER)</label>
            </div>
            <!--                        <div class="radio">
                                            <label> <input name="cheque_type" type="radio" value="4" id="cheque_type">  AC PAYEE & NOT NEGOTIABLE (CENTRE)</label>
                                    </div>-->
            <input name="payment_mode" type="hidden" value="" id="payment_mode">
            <!--</div>-->

        </div>

        <input name="hyphen" type="hidden" value="<?= $model->cheque_date_hyphen ?>" id="print_date_hyphen">
        <?php
//        $this->render('_emi_datas', [
//            'model' => $model,
//            'cheques' => $cheques,
//            'model_new' => $model_new,
//            'form' => $form,
//        ])
        ?>

        <div class="form-group" style="" id="curncy_type">
            <label>Currency</label>
            <?php
            $user_details = Users::find()->where(['id' => Yii::$app->session['user_session']['id']])->one();
            $bank_details = \common\models\BankAccounts::find()->where(['user_id' => Yii::$app->session['user_session']['id'], 'id' => $bankcoountsid])->one();
            $coutry_id = $bank_details->country_id;
            ?>
            <?=
            Html::dropDownList('currency', $coutry_id, ArrayHelper::map(\common\models\Country::find()->all(), 'id', 'currency_code'), ['class' => 'form-control', 'id' => 'currency'], ['options' => [$coutry_id => ['Selected' => 'selected']]])
            ?>

        </div>
    </div>
    <div class="form-group" style="visibility: hidden">
        <label>CURRENCY TYPE:</label>
        <div class="radio">
            <label> <input name="currency_type" type="radio" value="1" id="indian" checked="true"> Indian</label>
        </div>
        <div class="radio">
            <label> <input name="currency_type" type="radio" value="2"> International</label>
        </div>

    </div>







</div>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<script>

    $(document).ready(function () {

        var Cheque_type = 1; /*cheque type 1 means bearer*/
        //$('#not_more_than').css("visibility", 'hidden');

        //		$('#indian').prop('checked', true);

        var d = new Date();
        var hyphen_status = $('#print_date_hyphen').val();
        if (hyphen_status == '1') {
            var current = $.datepicker.formatDate('dd-mm-yy', new Date(d));
        } else {
            var current = $.datepicker.formatDate('dd-mm-yy', new Date(d));
        }

        $('#date').text(current);

        $('#print-date').datepicker({dateFormat: 'yy-mm-dd'})

                .on("change", function (e) {
                    var dateFormat = e.target.value;

                    if (hyphen_status == '1') {
                        var dateFormat = $.datepicker.formatDate('dd-mm-yy', new Date(dateFormat));
                    } else {
                        var dateFormat = $.datepicker.formatDate('dd-mm-yy', new Date(dateFormat));
                    }
                    $('#date').text(dateFormat);
                    $('#print-date').val(dateFormat);
                });
        $("#chequeprint-payee_id").change(function () {
            var end = this.value;
            var payee = $("#chequeprint-payee_id option:selected").text();
            $('#name').text(payee);
        });
        //var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
        //var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];


        $("#amount").keyup(function () {
            if ($('input[name=currency_type]:checked').val() === '1') {
                var currency_option = $("#currency option:selected").val();
                //                                inWords($('#amount').val());
                //                                number2text($('#amount').val());
                var amout_num = $('#amount').val();
                var rounded_amount = (amout_num * 1).toFixed(2);

                var bank_id = <?= $model->bank_accounts_id; ?>;
 //showLoader();
                $.ajax({
                    type: "post",
                    url: '<?php echo Yii::$app->request->baseUrl . '/dashboard/test' ?>',
                    data: {value: rounded_amount, bank_id: bank_id, currrency: currency_option},
                    cache: false,
                    success: function (data) {
                        var word = data.toUpperCase();
                       $('#rupee_word').text(word + ' ONLY');
						$('#amount_words').val(word + ' ONLY');
                        numberWithCommas(rounded_amount);
hideLoader();
                    }
                });

            } else {
                alert('sorry');
            }
        });



        function convert_number(number)
        {
            //alert(number);
            if ((number < 0) || (number > 999999999))
            {
                return "NUMBER OUT OF RANGE!";
            }
            var Gn = Math.floor(number / 10000000); /* Crore */
            number -= Gn * 10000000;
            var kn = Math.floor(number / 100000); /* lakhs */
            number -= kn * 100000;
            var Hn = Math.floor(number / 1000); /* thousand */
            number -= Hn * 1000;
            var Dn = Math.floor(number / 100); /* Tens (deca) */
            number = number % 100; /* Ones */
            var tn = Math.floor(number / 10);
            var one = Math.floor(number % 10);
            var res = "";
            if (Gn > 0)
            {
                res += (convert_number(Gn) + " CRORE");
            }
            if (kn > 0)
            {
                res += (((res == "") ? "" : " ") +
                        convert_number(kn) + " LAKH");
            }
            if (Hn > 0)
            {
                res += (((res == "") ? "" : " ") +
                        convert_number(Hn) + " THOUSAND");
            }

            if (Dn)
            {
                res += (((res == "") ? "" : " ") +
                        convert_number(Dn) + " HUNDRED");
            }


            var ones = Array("", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN", "FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN", "NINETEEN");
            var tens = Array("", "", "TWENTY", "THIRTY", "FOURTY", "FIFTY", "SIXTY", "SEVENTY", "EIGHTY", "NINETY");
            if (tn > 0 || one > 0)
            {
                if (!(res == ""))
                {
                    res += " AND ";
                }
                if (tn < 2)
                {
                    res += ones[tn * 10 + one];
                } else
                {

                    res += tens[tn];
                    if (one > 0)
                    {
                        res += ("-" + ones[one]);
                    }
                }
            }

            if (res == "")
            {
                res = "zero";
            }
            return res;
        }




        function numberWithCommas(x) {
            var rupee_num = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#rupee_num').text('****' + rupee_num);
//                        if (x % 1 != 0) {
//                                $('#rupee_num').text('****' + rupee_num);
//                        } else {
//                                $('#rupee_num').text('****' + rupee_num + '.00');
//                        }
            notMoreThan(rupee_num);
        }


function showLoader() {
                        $('.page-loading-overlay').removeClass('loaded');
                }
                function hideLoader() {
                        $('.page-loading-overlay').addClass('loaded');
                }

//                $('#advanced').click(function () {
//                        $('.advanced_toggle').css("display", 'block');
//                        $('#emi_cheq').css("visibility", 'visible');
//                        $('#curncy_type').css("visibility", 'visible');
//                        $('#date_hyphen').css("visibility", 'visible');
//                });

        $('#advanced').click(function () {
            $('.hidediv1').slideToggle();
        });

        $('input[name=cheque_type]').change(function () {
            var type = $(this).val();
            if (type == 2) {
                $('#ac_cross').css("visibility", 'visible');
                $('#ac_center').css("visibility", 'hidden');
                Cheque_type = 2;
            } else if (type == 3) {
                $('#ac_center').css("visibility", 'visible');
                $('#ac_cross').css("visibility", 'hidden');
                $('#ac_not').css("visibility", 'hidden');
                Cheque_type = 3;
            } else if (type == 4) {

                $('#ac_not').css("visibility", 'visible');
                $('#ac_center').css("visibility", 'hidden');
                $('#ac_cross').css("visibility", 'hidden');
                Cheque_type = 4;
            } else {
                $('#ac_cross').css("visibility", 'hidden');
                $('#ac_not').css("visibility", 'hidden');
                $('#ac_center').css("visibility", 'hidden');
            }
            $('#payment_mode').val(Cheque_type);
        });
        $('#currency').change(function () {
            var cheque_amount = $('#amount').val();
            var currency_type = $("#currency option:selected").val();
            $.ajax({
                type: "post",
                url: '<?php echo Yii::$app->request->baseUrl . '/dashboard/test' ?>',
                data: {value: cheque_amount, currrency: currency_type},
                cache: false,
                success: function (data) {
                    var word = data.toUpperCase();
                    $('#rupee_word').text(word);
                    $('#amount_words').val(word);
                    numberWithCommas(cheque_amount);
                }
            });
        });
        $('#payment_mode').val(Cheque_type);
        function notMoreThan(rupee_num) {

            if ($('#not_more').is(':checked')) {

                $('#not_more_than').text('NOT OVER THAN ' + rupee_num + ' /-');
                $('#notoveramount').val('1');
            } else {
                $('#not_more_than').css("visibility", 'hidden');
                $('#notoveramount').val('0');
            }

        }
        $('#not_more').click(function () {
            if (!$(this).is(':checked')) {
                $('#not_more_than').css("visibility", 'hidden');
                $('#notoveramount').val('0');
            } else {

                $('#not_more_than').css("visibility", 'visible');
                $('#notoveramount').val('1');
            }
        });
        $('#input_date_hyphen').change(function () {
            if ($("#input_date_hyphen").prop('checked') == true) {
                var date = $('#print-date').val();
                var formattedDate = new Date(date);
                var d = formattedDate.getDate();
                var m = formattedDate.getMonth();
                m += 1; // JavaScript months are 0-11
                var y = formattedDate.getFullYear();
                var formatted_date = d + "-" + m + "-" + y;
                $('#date').text(formatted_date);
                $('#hyphen').val('1');
            }
            $('#textbox1').val($(this).is(':checked'));
        });
    });
</script>


