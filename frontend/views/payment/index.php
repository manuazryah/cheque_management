<?php
$paypal_url = 'https://www.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id = 'info@gulfproaccountants.com'; // Business email ID
?>

<div class="product">
    <div class="btn">
        <form id="payform" action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1">
            <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="item_name" value="<?= Yii::$app->session['payment'][2] ?>">
            <input type="hidden" name="item_number" value="<?= Yii::$app->session['payment'][1] ?>">
            <input type="hidden" name="credits" value="510">
            <input type="hidden" name="userid" value="<?= Yii::$app->session['payment'][2] ?>">
            <input type="hidden" name="amount" value="<?= Yii::$app->session['payment'][3] ?>">
            <input type="hidden" name="cpp_header_image" value="https://www.edesi.com/Images/Edesi-10.png">
            <input type="hidden" name="no_shipping" value="1">
            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="handling" value="0">
            <input type="hidden" name="cancel_return" value="http://eazycheque.com/payment/failed">
            <input type="hidden" name="return" value="http://eazycheque.com/site/save-upgrade?upgrade_id=<?= Yii::$app->session['payment'][0] ?> && user_id=<?= Yii::$app->session['payment'][1] ?>">
            <!--<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">-->
            <!--<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">-->
        </form>
    </div>
</div>
<p> Redirecting... . . .</p>
<script>document.getElementById("payform").submit();</script>