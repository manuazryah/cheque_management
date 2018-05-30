<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//use karpoff\icrop\CropImageUpload;

/* @var $this yii\web\View */
/* @var $model common\models\UserImg */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-img-form form-inline">
	<?php
	$new_path = Yii::$app->basePath . '/../img/cheque-images/' . $model->id . '.' . $model->cheque_image;
	?>
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<?php //echo $form->field($model, 'image')->widget(CropImageUpload::className()) ?>
	<?php
	echo \newerton\jcrop\jCrop::widget([
	    // Image URL
	    'url' => $path . '?' . rand(10, 100000000),
	    // options for the IMG element
	    'imageOptions' => [
		'id' => 'imageId',
		'width' => '',
		'alt' => 'Crop this image'
	    ],
	    // Jcrop options (see Jcrop documentation [http://deepliquid.com/content/Jcrop_Manual.html])
	    'jsOptions' => array(
		'minSize' => [50, 50],
		'aspectRatio' => '',
		'onRelease' => new yii\web\JsExpression("function() {ejcrop_cancelCrop(this); window.location.href = '" . Yii::$app->homeUrl . 'dashboard/more-details?id=' . $model->id . "'} "),
		//customization
		'bgColor' => 'rgba(65, 78, 82, 0.92);',
		'bgOpacity' => 0.4,
		'selection' => true,
		'theme' => 'light',
	    ),
	    // if this array is empty, buttons will not be added
	    'buttons' => array(
		'start' => array(
		    'label' => 'Adjust thumbnail cropping',
		    'htmlOptions' => array(
			'class' => ' btn btn-success',
			'style' => 'color: #eee;
				    display: inline;
				    margin-top: 26px;'
		    )
		),
		'crop' => array(
		    'label' => 'Apply cropping',
		    'htmlOptions' => array(
			'class' => 'btn btn-success',
			'style' => 'color: #eee;
				    display: inline;
				    margin-top: 26px;'
		    )
		),
		'cancel' => array(
		    'label' => 'Cancel cropping',
		    'htmlOptions' => array(
			'class' => 'myClass btn btn-success',
			'style' => 'color: #eee;
				    display: inline;
				    margin-top: 26px;
				    margin-left: 12px;'
		    )
		)
	    ),
	    // URL to send request to (unused if no buttons)
	    'ajaxUrl' => 'ajaxcrop',
	    // Additional parameters to send to the AJAX call (unused if no buttons)
	    'ajaxParams' => ['path' => $new_path, 'model' => $model],
	]);
	?>



	<?php ActiveForm::end(); ?>

</div>
<script>
	$("document").ready(function () {
		setTimeout(function () {
			$("#start_imageId").trigger('click');
		}, 10);
//		$('#crop_imageId').click(function () {
//			var url = 'more-details';
//			var id = <?= $model->id; ?>
//			//you dont need the .each, because you are selecting by id
//			//var inputURL = $('#wpsl-search-input1').val();
//			//Redirects
//			window.location.href = url + '?id=' + id;
//			return false;
//		});
	});

</script>