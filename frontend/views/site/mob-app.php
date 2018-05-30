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
<div class="container" style="margin-top: 40px;min-height: 244px;">
    <div class="row">
        <div class="col-md-12">
            <div class="" style="text-align: center;">
                <h4>Please download the mobile application from following link</h4>
                <a href="https://play.google.com/store/apps/details?id=com.ionicframework.cheque819757" style="" class="" target="_blank">
                    <img alt="" src="/img/android.png"></a>
                <a href="https://itunes.apple.com/in/app/facebook/id1233137764?mt=8" style="text-decoration:none;" class="" target="_blank">
                    <img alt="" src="/img/apple.png">
                </a>
            </div>
        </div>
    </div>
</div>
<!--<div class="row" style="padding:10px 0 50px 0;"></div>-->


