<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use common\models\Users;
use common\models\MasterPlans;
use yii\helpers\ArrayHelper;
use common\models\Country;

$this->title = 'Choose Plan';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .choose-plan h3{
        color: #0084ec !important;
        text-align: center !important;
        text-decoration: underline !important;
    }
    .fa {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

</style>


<div role="main" class="main">

    <section class="section section-no-background m-none">


        <div class="container">
            <?php // Html::beginForm(['site/save-upgrade'], 'post') ?>
            <?php if (!empty($master_plans)) { ?>
                <div class="row">
                    <div class="pricing-table">
                        <?php
                        foreach ($master_plans as $plans) {
                            ?>
                            <?php if (!empty($_GET['us_id'])) { ?>
                                <div class="col-md-6 col-sm-6" <?php if ($plans->id == 1) { ?>style="display: none"<?php
                                } else {
                                    ?> style="display: block"<?php } ?>>


                                    <div <?php if ($plans->id == 2) { ?>class="plan most-popular" <?php
                                    } else {
                                        ?> class="plan"<?php } ?> >
                                                                        <?php
                                                                        if ($plans->id == 2) {
                                                                            ?>
                                            <div class="plan-ribbon-wrapper"><div class="plan-ribbon">Popular</div></div>
                                            <?php
                                        }
                                        ?>
                                        <h3><?= $plans->plan_name ?><span><i class="fa fa-usd" style="margin-top: 23px;"><b style="font-size: 20px;"><?= $plans->amount ?></b></i></span></h3>
                                        <?php if (empty($_GET['us_id'])) {
                                            ?>
                                            <?= Html::a('SELECT', ['/site/login'], ['class' => 'btn btn-lg btn-primary']) ?>
                                            <?php
                                        } else {
                                            ?>
                                            <?= Html::a('SELECT', ['/payment/index', 'upgrade_id' => $plans->id, 'user_id' => $_GET['us_id']], ['class' => 'btn btn-lg btn-primary']) ?>
                                        <?php } ?>
                                        <ul>
                                            <li>Unlimited Number of Cheques</li>
                                            <!--<li><strong>User - </strong> 1</li>-->
                                            <li>Connected to Mobile Application (Android/ios)</li>
                                            <li><strong>Validity:</strong> <?= $plans->valid_days ?> Days</li>
                                        </ul>
                                    </div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="col-md-6 col-sm-6" >


                                    <div <?php if ($plans->id == 2) { ?>class="plan most-popular" <?php
                                    } else {
                                        ?> class="plan"<?php } ?> >
                                                                        <?php
                                                                        if ($plans->id == 2) {
                                                                            ?>
                                            <div class="plan-ribbon-wrapper"><div class="plan-ribbon">Popular</div></div>
                                            <?php
                                        }
                                        ?>
                                        <h3><?= $plans->plan_name ?><span><i class="fa fa-usd" style="margin-top: 23px;"><b style="font-size: 20px;"><?= $plans->amount ?></b></i></span></h3>
                                                    <?php if (empty($_GET['us_id'])) {
                                                        ?>
                                                        <?= Html::a('SELECT', ['/site/login'], ['class' => 'btn btn-lg btn-primary']) ?>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <?= Html::a('SELECT', ['/payment/index', 'upgrade_id' => $plans->id, 'user_id' => $_GET['us_id']], ['class' => 'btn btn-lg btn-primary']) ?>
                                                    <?php } ?>
                                        <ul>
                                            <li>Unlimited Number of Cheques</li>
                                            <!--<li><strong>User - </strong> 1</li>-->
                                            <li>Connected to Mobile Application (Android/ios)</li>
                                            <li><strong>Validity:</strong> <?= $plans->valid_days ?> Days</li>
                                        </ul>
                                    </div>
                                </div>
                            <?php }
                            ?>


                        <?php }
                        ?>
                                                                                                                                    <!--                        <input type="hidden" name="user_id" value="<?php // $id                ?>"/>-->


                    </div>

                </div>
            <?php }
            ?>
            <!--<div style="margin: 15px 0px 0px 13px;">-->
            <?php // Html::submitButton('<span>Submit</span>', ['class' => 'btn btn-secondary'])      ?>
            <!--</div>-->
            <?php // Html::endForm()        ?>
        </div>
    </section>

</div>
<script>
    $("#select_plan").click(function () {
        $('.plan h3').css('text-align', 'center');
    });
</script>


