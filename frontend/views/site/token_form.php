<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="container" style="margin-top: 40px;">
	<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
	<input type="text" name="token"id="token">


	<?= Html::submitButton('submit', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

	<?php ActiveForm::end(); ?>
</div>

