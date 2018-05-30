<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MasterPlans */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-plans-form form-inline">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'plan_name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'valid_days')->textInput() ?>

	<?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>



	<div class="form-group" style="float: right;">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
