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


        <div class="col-md-12" style="border-right: 1px solid #e6e6e6">
            <div class="site-register" id="Registration">
                <h1><b>Your Payment for plan upgrade has failed</b></h1><hr>

                <div class="row">
                    <div class="col-sm-2">
                    </div>

                </div>
            </div>
        </div>






    </div>
</div>


