<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterPlans;
use yii\helpers\ArrayHelper;
use common\models\Country;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = 'Update';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<style>
	hr{
                margin-top: 10px;
                margin-bottom: 17px;
                border: 0;
                border-top: 3px solid rgba(39, 41, 42, 0.46);
        }
	.panel .panel-heading{
		border-bottom: none;
	}
.alert-success{
		background-color: rgba(44, 46, 47, 0.67);
		padding: 1px;
		width: 61%;
	}
</style>
<!--<div class="row">-->
        <!--<div class="col-md-12">-->
<div class="container">
        <div class="row">
                <div class="panel panel-default">
                        <div class="panel-heading">
               <h1 style="font-size: 20px"><?= Html::encode($this->title) ?></h1>
				<hr>
                <div style="float:right;padding-top: 5px;">
                    <?php
                    echo Html::a('<i class="fa fa-pencil-square-o"></i><span> Change password</span>', ['change-password', 'id' => $model->id], ['class' => 'btn btn-warning dropdown-toggle']);
                    ?>

                </div>
<?php if (Yii::$app->session->hasFlash('error')): ?>
					<div class="alert alert-danger" role="alert">
						<?= Yii::$app->session->getFlash('error') ?>
					</div>
				<?php endif; ?>
				<?php if (Yii::$app->session->hasFlash('success')): ?>
					<div class="alert alert-success" role="alert" style="/*color: #cc3f44;border: 1px solid transparent;
					     border-radius: 0;margin: -4px;*/">
					     <?= Yii::$app->session->getFlash('success') ?>
					</div>
				<?php endif; ?>
               
            </div>
                        
                        <div class="panel-body">
 
                                <div class="panel-body"><div class="users-create">
                                                <div class="users-form form-inline">

                                                        <?php $form = ActiveForm::begin(); ?>

                                                        <?= $form->errorSummary($model); ?>

                                                        <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

                                                        <?php // $form->field($model, 'owners_name')->textInput(['maxlength' => true]) ?>

                                                        <?= $form->field($model, 'email_id')->textInput(['maxlength' => true, 'disabled' => true]) ?>

                                                        <?php if ($model->isNewRecord) { ?>
                                                                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                                                                <?php
                                                        } else {
                                                                ?>
                                                                <?= ''; ?> <?php } ?>
                                                        <?php
                                                        $countries = ArrayHelper::map(Country::findAll(['status' => 1]), 'id', 'country_name');
                                                        ?>
                                                        <?= $form->field($model, 'country')->dropDownList($countries, ['prompt' => '-Choose a country-', 'options' => ['class' => 'form-group'], 'template' => '<div class="col-sm-12">{input}{error}</div>']) ?>

                                                        <?php // $form->field($model, 'state')->textInput(['maxlength' => true])  ?>

                                                        <?php // $form->field($model, 'city')->textInput(['maxlength' => true])  ?>

                                                        <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

                                                        <?php // $form->field($model, 'address')->textarea(['rows' => 6])  ?>

                                                        <?php // '<br>' ?>

                                                        <?php $posts = ArrayHelper::map(MasterPlans::findAll(['status' => 1]), 'id', 'plan_name'); ?>
                                                        <?php // $form->field($model, 'plan')->dropDownList($posts, ['prompt' => '-Choose a Plan-', "disabled" => "disabled"]) ?>
                                                        <div class="form-group"></div>
                                                        <?php // $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>
                                                        <div class="form-group"></div>

                                                        <div class="form-group" style="float: right;">
                                                                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;']) ?>
                                                        </div>

                                                        <?php ActiveForm::end(); ?>

                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>