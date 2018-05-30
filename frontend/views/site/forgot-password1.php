<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="container">
        <div class="login-container">

                <div class="row">

                        <div class="col-sm-6 ">

                                <script type="text/javascript">
                                        jQuery(document).ready(function ($)
                                        {
                                                setTimeout(function () {
                                                        $(".fade-in-effect").addClass('in');
                                                }, 1);

                                        });
                                </script>
                                <!-- Errors container -->
                                <div class="errors-container">
                                </div>

                                <!-- Add class "fade-in-effect" for login form effect -->
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
                                <?php if (Yii::$app->session->hasFlash('error')): ?>
                                        <div class="alert alert-danger" role="alert">
                                                <?= Yii::$app->session->getFlash('error') ?>
                                        </div>
                                <?php endif; ?>
                                <?php if (Yii::$app->session->hasFlash('success')): ?>
                                        <div class="alert alert-success" role="alert">
                                                <?= Yii::$app->session->getFlash('success') ?>
                                        </div>
                                <?php endif; ?>
                                <h1 style="margin-top: 20px">Forgot password?</h1>
                                <!--                                <div class="form-group" style="margin-top: 50px;margin-left: 15px;">
                                                                        <label class="control-label" for="employee-user_name" style="    color: black;
                                                                               font-size: 14px;
                                                                               font-weight: bold;">Enter your Email/Username</label>

                                                                        <input type="text" id="employee-user_name" class="form-control" name="Employee[user_name]" autofocus="true">
                                                                        <p class="help-block help-block-error"></p>
                                                                </div>-->
                                <div class="form-group required field-users-email_id">
                                        <label style="margin-left:15px;font-weight:bold;">Enter Your Email:</label><div class="col-sm-12"><input type="text" id="users-email_id" class="form-control" name="Users[email_id]" placeholder="Email Id"><div class="help-block"></div></div>
                                </div>




                                <div class="form-group" style="margin-left: 15px;">
                                        <button type="submit" class="btn btn-primary">Submit</button>    </div>
                                        <?php ActiveForm::end(); ?>

                        </div>
                </div>

        </div>

</div>
