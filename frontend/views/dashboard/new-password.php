<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterPlans;
use yii\helpers\ArrayHelper;
use common\models\Country;
use yii\helpers\BaseHtml;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = 'Update';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
        <div class="col-md-12">
                <script type="text/javascript">
                        jQuery(document).ready(function ($)
                        {
                                setTimeout(function () {
                                        $(".fade-in-effect").addClass('in');
                                }, 1);

                        });
                </script>
                <div class="errors-container">
                </div>
                <div class="panel panel-default">
                        <div class="panel-heading">
                                <div style="float:right;padding-top: 5px;">
                                        <?php
                                        echo Html::a('<i class="fa-rocket"></i><span> Change password</span>', ['change-password', 'id' => $model->id], ['class' => 'btn btn-warning dropdown-toggle']);
                                        ?>

                                </div>

                        </div>
                        <div class="panel-body">
                                <div class="panel-body"><div class="users-create">
                                                <div class="col-md-3"> </div> <div class="col-md-6">
                                                        <?php
                                                        $form = ActiveForm::begin(
                                                                        [
                                                                            'id' => 'forgot-email',
                                                                            'method' => 'post',
                                                                            'options' => [
                                                                                'class' => 'login-form fade-in-effect'
                                                                            ]
                                                                        ]
                                                        );
                                                        ?>

                                                        <?php if (Yii::$app->session->hasFlash('success')):
                                                                ?>
                                                                <div class="alert alert-success" role="alert">
                                                                        <?= Yii::$app->session->getFlash('success') ?>
                                                                </div>
                                                        <?php endif; ?>

                                                        <?php if (Yii::$app->session->hasFlash('error')): ?>
                                                                <div class="alert alert-danger" role="alert">
                                                                        <?= Yii::$app->session->getFlash('error') ?>
                                                                </div>
                                                        <?php endif; ?>
                                                        <!--                                                        <div class="alert alert-danger" role="alert">
                                                        <?php
                                                        // Yii::$app->session->getFlash('success');
                                                        // Yii::$app->session->getFlash('error');
                                                        ?>
                                                                                                                </div>-->

                                                        <h1 style = "margin-top: 20px;margin-bottom: 15px;color: blue">Reset password?</h1>
                                                        <div class = "form-group">
                                                                <div class = "form-group field-employee-password">
                                                                        <label style = "font-weight:bold;">Enter old Password:</label>
                                                                        <input type = "password" id = "new-password" class = "form-control" name = "old-password" autofocus = "false" required>
                                                                        <p class = "help-block help-block-error"></p>
                                                                </div>

                                                        </div>

                                                        <div class = "form-group">
                                                                <div class = "form-group field-employee-password">
                                                                        <label style = "font-weight:bold;">Enter new Password:</label>
                                                                        <input type = "password" id = "new-password" class = "form-control" name = "new-password" autofocus = "false" required>
                                                                        <p class = "help-block help-block-error"></p>
                                                                </div>

                                                        </div>
                                                        <div class = "form-group">
                                                                <div class = "form-group field-employee-password">
                                                                        <label style = "font-weight:bold;">Confirm Password:</label>
                                                                        <input type = "password" id = "confirm-password" class = "form-control" name = "confirm-password" autofocus = "false" required>
                                                                        <p class = "help-block help-block-error"></p>
                                                                </div>

                                                        </div>


                                                        <div class = "form-group" >
                                                                <button type = "submit" class = "btn btn-primary">Submit</button> </div>
                                                        <?php ActiveForm::end(); ?>

                                                </div>
                                                <div class = "col-md-3">
                                                </div>
                                        </div>
                                </div>
                        </div>
