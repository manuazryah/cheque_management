<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>css/invoice.css">
        <style>
            footer {
                padding-top: 20px;
                padding-bottom: 20px;
                font-size: 9px;
                color: #f00;
                text-align: center;
                border-top: 1px solid #5a5959;
                width: 100%;
            }
            table th{
                text-align: left;
            }
            th, td {
                border: 1px solid black;
            }
            .txt-clr{
                color: black;
            }
            @page {
                size: A4;
                margin: 11mm 17mm 17mm 17mm;
            }

            @media print {
                /*                footer {
                                    position: fixed;
                                    bottom: 0;
                                }*/

                .content-block, p {
                    page-break-inside: avoid;
                }

                html, body {
                    width: 210mm;
                    height: 297mm;
                }
                th, td {
                    border: 1px solid black;
                }
                .txt-clr{
                    color: black;
                }
            }
        </style>
    </head>
    <body>
        <div class="container" style="margin: 0px 80px;">
            <div class="header" style="margin-top: 185px;">
                <h2 style="text-align: center;text-transform: uppercase;padding-bottom: 5px;padding-top: 5px;border-bottom: 1px solid black;">Payment Voucher</h2>
                <?php if (isset($check_prints->user_id)) { ?>
                                                                                                                                                                                                                                                                                                                                                                        <!--<h2 style="text-align: center;text-transform: uppercase;padding-bottom: 18px;"><?php // \common\models\Users::findOne($check_prints->user_id)->company_name                                                                                     ?></h2>-->
                <?php }
                ?>
                <!--<h4 style="text-align: center;text-transform: uppercase;border-top: 1px solid black;margin-bottom: 0px;padding: 6px 0px;border-bottom: 1px solid black;">Payment Voucher</h4>-->
            </div>
            <div>
                <div class="main-left" style="width: 60%;padding-top: 15px;">
                </div>
                <div class="main-left" style="width: 40%;float: right;padding-top: 15px;">
                    <table style="border: 1px solid black;border-collapse: collapse;width: 100%;">
                        <tr>
                            <td style="width:38%;padding: 5px 5px;font-size: 13px;c"><span class="txt-clr">Voucher No:</span></td><td style="padding: 5px 5px;font-size: 13px;"></td>
                        </tr>
                        <tr>
                            <td style="width:38%;padding: 5px 5px;font-size: 13px;"><span class="txt-clr">Date:</span></td><td style="padding: 5px 5px;font-size: 13px;"><?= date('d-M-Y') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="clearfix"></div>
            <div style="width:100%;clear: both;padding-top: 20px;">
                <table style="border: 1px solid black;border-collapse: collapse;width: 100%;">
                    <tr>
                        <td style="width:25%;padding: 5px 5px;font-size: 13px;"><span class="txt-clr">Payee</span></td>
                        <td style="width:75%;padding: 5px 5px;font-size: 13px;">
                            <?php if (isset($check_prints->payee_id)) { ?>
                                <span class="txt-clr" style="text-transform: uppercase;"><?= \common\models\Payee::findOne($check_prints->payee_id)->payee_name; ?></span>
                            <?php }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div style="width:100%;clear: both;">
                <div class="main-left" style="width: 45%;padding-top: 15px;">
                    <span style="border: 1px solid black;font-size: 13px;border-bottom: none;padding: 2px 30% 2px 5px;"><span class="txt-clr">Description</span></span>
                </div>
                <div class="main-left" style="width: 25.2%;float: right;padding-top: 15px;padding-bottom: 1px;">
                    <?php
                    if (isset($check_prints->currency)) {
                        $currency = \common\models\Country::findOne($check_prints->currency)->currency_code;
                    } else {
                        $currency = '';
                    }
                    ?>
                    <span style="border: 1px solid black;font-size: 13px;border-bottom: none;padding: 2px 53px 2px 0px;"><span class="txt-clr"><span style="padding: 3px 17.5px 2px 5px;border-right: 1px solid black;color:black;">Currency</span><span style="padding: 0px 0px 0px 5px;"><?= $currency ?></span></span></span>
                </div>
                <div class="" style="width: 100%;padding-top: 15px;">
                    <table style="border: 1px solid black;border-collapse: collapse;width: 100%;">
                        <tr>
                            <td style="width:60%;padding: 5px 5px;font-size: 13px;height: 50px;"><?= $check_prints->remarks ?></td><td style="width:20%;padding: 5px 5px;font-size: 13px;"><span class="txt-clr"><?= number_format($check_prints->cheque_amount, 2) ?></span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div style="width:100%;clear: both;">
                <div class="main-left" style="width: 29.5%;padding-top: 15px;">
                    <span style="border: 1px solid black;font-size: 13px;border-bottom: none;padding: 2px 30% 2px 5px;"><span class="txt-clr">Amount in words</span></span>
                </div>
                <div class="" style="width: 100%;padding-top: 15px;">
                    <table style="border: 1px solid black;border-collapse: collapse;width: 100%;">
                        <tr>
                            <td style="width:100%;padding: 30px 5px;font-size: 13px;text-transform: capitalize;"><?= $check_prints->cheque_amount_words ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div style="width:100%;clear: both;">
                <div class="main-left" style="width: 29.5%;padding-top: 15px;">
                    <span style="border: 1px solid black;font-size: 13px;border-bottom: none;padding: 2px 35% 2px 5px;"><span class="txt-clr">Cheque Details</span></span>
                </div>
                <div class="" style="width: 100%;padding-top: 15px;">
                    <table style="border: 1px solid black;border-collapse: collapse;width: 100%;">
                        <tr>
                            <td style="width:25%;padding: 5px 5px;font-size: 13px;"><span class="txt-clr">Bank:</span></td><td style="width:75%;padding: 5px 5px;font-size: 13px;">
                                <?php
                                if (isset($check_prints->bank_account_id)) {
                                    echo \common\models\BankAccounts::findOne($check_prints->bank_account_id)->bank_name;
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:25%;padding: 5px 5px;font-size: 13px;"><span class="txt-clr">Dated:</span></td><td style="width:75%;padding: 5px 5px;font-size: 13px;"><?= date("d-M-Y", strtotime($check_prints->cheque_date)); ?></td>
                        </tr>
                        <tr>
                            <td style="width:25%;padding: 5px 5px;font-size: 13px;"><span class="txt-clr">Cheque No:</span></td><td style="width:75%;padding: 5px 5px;font-size: 13px;"><?= $check_prints->cheque_number ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div style="width:100%;clear: both;padding-top: 20px;">
                <table style="border: 1px solid black;border-collapse: collapse;width: 100%;">
                    <tr>
                        <th style="width: 30%;font-size: 13px;padding-left: 5px;font-weight: 400;color: black;">Prepared by</th>
                        <th style="width: 35%;font-size: 13px;padding-left: 5px;font-weight: 400;color: black;">Approved by</th>
                        <th style="width: 35%;font-size: 13px;padding-left: 5px;font-weight: 400;color: black;">Received by</th>
                    </tr>
                    <tr>
                        <td style="width: 30%;font-size: 13px;height: 85px;"></td>
                        <td style="width: 35%;font-size: 13px;height: 85px;"></td>
                        <td style="width: 35%;font-size: 13px;height: 85px;"></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">

    window.print();
    setTimeout(function () {
        window.close();
    }, 500);
</script>