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

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
        .site-register h1{
                color: red;
                margin-left: 10px;
                margin-bottom: 0px !important;
        }
        .site-login h1{
                color: red;
                margin-left: 10px;
                margin-bottom: 0px !important;
        }
        .site-register hr{
                margin-top: 8px !important;
        }
        .site-login hr{
                margin-top: 8px !important;
        }

</style>



<div class="container" style="margin-top: 40px;">
        <div class="row">


                <div class="col-md-6" style="border-right: 1px solid #e6e6e6">
                        <div class="site-register" id="Registration">
                                <h1><b>Registration</b></h1><hr>
                                <div class="col-lg-12">
                                        <?php if (Yii::$app->session->hasFlash('error')): ?>
                                                <div class="alert alert-danger" role="alert">
                                                        <?= Yii::$app->session->getFlash('error') ?>
                                                </div>
                                        <?php endif; ?>
                                </div>
                                <p style="margin-left: 15px;">If you are a new user? please register here</p>
                                <?php $form = ActiveForm::begin(['action' => Yii::$app->homeUrl . 'site/register']); ?>

                                <?= $form->field($model, 'company_name', ['options' => ['class' => 'form-group required'], 'template' => '<div class="col-sm-12"><label style="margin-left:15px;font-weight:bold;">Name:</label>{input}{error}</div>'])->textInput(['placeholder' => 'Name']) ?>
                                <?php // $form->field($model, 'owners_name', ['options' => ['class' => 'form-group required'], 'template' => '<div class="col-sm-12">{input}{error}</div>'])->textInput(['placeholder' => 'Owners Name']) ?>
                                <?= $form->field($model, 'email_id', ['options' => ['class' => 'form-group required'], 'template' => '<label style="margin-left:15px;font-weight:bold;">Email Id(this will be used for login):</label><div class="col-sm-12">{input}{error}</div>'])->textInput(['placeholder' => 'Email Id']) ?>
                                <?= $form->field($model, 'password', ['options' => ['class' => 'form-group required'], 'template' => '<label style="margin-left:15px;font-weight:bold;">Password:</label><div class="col-sm-12">{input}{error}</div>'])->passwordInput(['placeholder' => 'Password']) ?>
                                <?php // $form->field($model, 'country', ['options' => ['class' => 'form-group'], 'template' => '<div class="col-sm-12">{input}{error}</div>'])->textInput(['placeholder' => 'Country'])  ?>


                                <?php // $form->field($model, 'state', ['options' => ['class' => 'form-group'], 'template' => '<div class="col-sm-12">{input}{error}</div>'])->textInput(['placeholder' => 'State'])     ?>
                                <?php // $form->field($model, 'city', ['options' => ['class' => 'form-group'], 'template' => '<div class="col-sm-12">{input}{error}</div>'])->textInput(['placeholder' => 'city'])   ?>
                                <?= $form->field($model, 'mobile', ['options' => ['class' => 'form-group required'], 'template' => '<label style="margin-left:15px;font-weight:bold;">Mobile Number:</label><div class="col-sm-12">{input}{error}</div>'])->textInput(['placeholder' => 'Mobile']) ?>
                                <?php // $form->field($model, 'address', ['options' => ['class' => 'form-group'], 'template' => '<div class="col-sm-12">{input}{error}</div>'])->textInput(['placeholder' => 'address']) ?>
                                <?php
                                $countries = ArrayHelper::map(Country::findAll(['status' => 1]), 'id', 'country_name');
                                ?>
                                <?= $form->field($model, 'country', ['options' => ['class' => 'form-group required'], 'template' => '<label style="margin-left:15px;font-weight:bold;">Choose your country:</label><div class="col-sm-12">{input}{error}</div>'])->dropDownList($countries, ['prompt' => '-Choose a country-',]) ?>

                                <?php //$posts = ArrayHelper::map(MasterPlans::findAll(['status' => 1]), 'id', 'plan_name'); ?>
                                <?php // $form->field($model, 'plan', ['options' => ['class' => 'form-group required'], 'template' => '<label style="margin-left:15px;font-weight:bold;">Company Name:</label><div class="col-sm-12">{input}{error}</div>'])->dropDownList($posts, ['prompt' => '-Choose a Plan-']) ?>
                                <div class="row">
                                        <div class="col-sm-2">
                                        </div>
                                        <div class="col-sm-12" style="margin-left: 15px">
                                                <?= Html::submitButton('Save & Continue', ['class' => 'btn btn-primary btn-sm']) ?>
                                                <button type="button" class="btn btn-default btn-sm">
                                                        Cancel</button>
                                        </div>
                                </div>
                                <?php ActiveForm::end(); ?>
                        </div>
                </div>



                <div class="col-md-6" >
                        <div class="site-login">

                                <h1><b><?= Html::encode($this->title) ?></b></h1><hr>
                                <div class="col-lg-12">
                                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                                                <div class="alert alert-danger" role="alert">
                                                        <?= Yii::$app->session->getFlash('success') ?>
                                                </div>
                                        <?php endif; ?>
                                </div>

                                <div class="col-lg-12">
                                        <?php if (Yii::$app->session->hasFlash('log-error')): ?>
                                                <div class="alert alert-danger" role="alert">
                                                        <?= Yii::$app->session->getFlash('log-error') ?>
                                                </div>
                                        <?php endif; ?>
                                </div>

                                <p style="margin-left: 15px;">Please fill out the following fields to login:</p>

                                <?php $form1 = ActiveForm::begin(['action' => Yii::$app->homeUrl . 'site/login-user']); ?>

                                <?= $form1->field($modellog, 'email_id', ['options' => ['class' => 'form-group required'], 'template' => '<label style="margin-left:15px;font-weight:bold;">Email Id(this will be used for login):</label><div class="col-sm-12">{input}{error}</div>'])->textInput(['placeholder' => 'Email Id']) ?>

                                <?= $form1->field($modellog, 'password', ['options' => ['class' => 'form-group required'], 'template' => '<label style="margin-left:15px;font-weight:bold;">Password:</label><div class="col-sm-12">{input}{error}</div>'])->passwordInput(['placeholder' => 'Password']) ?>

                                <div class="row">

                                        <div class="col-sm-12" style="margin-left: 15px">
                                                <button type="submit" id="submit" class="btn btn-primary btn-sm" style="padding:10px 25px; font-size:14px;">
                                                        Submit</button>
                                                <a style="float:right;margin-right: 25px;" href="<?= Yii::$app->homeUrl; ?>site/forgot">Forgot password?</a>
                                                <a href="../../../../../../../C:/Users/user/AppData/Local/Temp/SiteController.php"></a>
                                        </div>
                                </div>
                                <?php ActiveForm::end(); ?>
                        </div>
                </div>


        </div>
</div>
<div class="row" style="padding:10px 0 50px 0;"></div>


