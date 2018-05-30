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
                                                        <div class="col-md-6 col-sm-6">
                                                                <div <?php if ($plans->id == 2) { ?>class="plan most-popular" <?php } else { ?> class="plan"<?php } ?>>
                                                                        <?php
                                                                        if ($plans->id == 2) {
                                                                                ?>
                                                                                <div class="plan-ribbon-wrapper"><div class="plan-ribbon">Popular</div></div>
                                                                                <?php
                                                                        }
                                                                        ?>
                                                                        <h3><?= $plans->plan_name ?><span><i class="fa fa-usd" style="margin-top: 23px;"><?= $plans->amount ?></i></span></h3>
                                                                        <?= Html::a('SELECT', ['/site/save-upgrade', 'upgrade_id' => $plans->id, 'user_id' => $id], ['class' => 'btn btn-lg btn-primary']) ?>
                                                                        <ul>
                                                                                <li><strong>Validity:</strong> <?= $plans->valid_days ?> Days</li>
                                                                                <li><strong>User:</strong> 1</li>
                                                                        </ul>
                                                                </div>
                                                        </div>

                                                <?php }
                                                ?>
                                                <input type="hidden" name="user_id" value="<?= $id ?>"/>

                                                <!--                                                        <div class="col-md-3 col-sm-6 center">
                                                                                                                <div class="plan most-popular">
                                                                                                                        <div class="plan-ribbon-wrapper"><div class="plan-ribbon">Popular</div></div>
                                                                                                                        <h3>Professional<span><i class="fa fa-inr">4000</i></span></h3>
                                                                                                                        <a class="btn btn-lg btn-primary" href="#">SELECT</a>
                                                                                                                        <ul>
                                                                                                                                <li><strong>Validity:</strong> 120 Days</li>
                                                                                                                                <li><strong>User:</strong> 1</li>
                                                                                                                        </ul>
                                                                                                                </div>
                                                                                                        </div>-->
                                                <!--                                                        <div class="col-md-3 col-sm-6">
                                                                                                                <div class="plan">
                                                                                                                        <h3>Standard<span><i class="fa fa-inr">3000</i></span></h3>
                                                                                                                        <a class="btn btn-lg btn-primary" href="#">SELECT</a>
                                                                                                                        <ul>
                                                                                                                                <li><strong>Validity:</strong> 90 Days</li>
                                                                                                                                <li><strong>User:</strong> 1</li>
                                                                                                                        </ul>
                                                                                                                </div>
                                                                                                        </div>-->
                                                <!--                                                        <div class="col-md-3 col-sm-6">
                                                                                                                <div class="plan">
                                                                                                                        <h3>Basic<span><i class="fa fa-inr">1000</i></span></h3>
                                                                                                                        <a class="btn btn-lg btn-primary" href="#">SELECT</a>
                                                                                                                        <ul>
                                                                                                                                <li><strong>Validity:</strong> 60 Days</li>
                                                                                                                                <li><strong>User:</strong> 1</li>
                                                                                                                        </ul>
                                                                                                                </div>
                                                                                                        </div>-->
                                        </div>

                                </div>
                        <?php }
                        ?>
                        <!--<div style="margin: 15px 0px 0px 13px;">-->
                        <?php // Html::submitButton('<span>Submit</span>', ['class' => 'btn btn-secondary']) ?>
                        <!--</div>-->
                        <?php // Html::endForm() ?>
                </div>
        </section>

        <section class="section mt-none section-footer">
                <div class="container">
                        <div class="row">
                                <div class="col-md-12 center">
                                        <div class="owl-carousel owl-theme mt-xl" data-plugin-options='{"items": 6, "autoplay": true, "autoplayTimeout": 3000}'>
                                                <div><img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>img/logos/logo-1.png" alt=""></div>
                                                <div><img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>img/logos/logo-2.png" alt=""></div>
                                                <div><img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>img/logos/logo-3.png" alt=""></div>
                                                <div><img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>img/logos/logo-4.png" alt=""></div>
                                                <div><img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>img/logos/logo-5.png" alt=""></div>
                                                <div><img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>img/logos/logo-6.png" alt=""></div>
                                                <div><img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>img/logos/logo-4.png" alt=""></div>
                                                <div><img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>img/logos/logo-2.png" alt=""></div>
                                        </div>
                                </div>
                        </div>

                </div>
        </section>
</div>
<script>
        $("#select_plan").click(function () {
                $('.plan h3').css('text-align', 'center');
        });
</script>


