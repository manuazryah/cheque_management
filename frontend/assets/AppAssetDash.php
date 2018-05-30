<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAssetDash extends AssetBundle {

	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
	    'http://fonts.googleapis.com/css?family=Arimo:400,700,400italic',
	    'dash/css/fonts/linecons/css/linecons.css',
	    'dash/css/fonts/fontawesome/css/font-awesome.min.css',
	    'dash/css/bootstrap.css',
	    
	    'dash/css/xenon-core.css',
	    'dash/css/xenon-forms.css',
	    'dash/css/xenon-components.css',
	    'dash/css/xenon-skins.css',
	    'dash/css/custom.css',
	];
	public $js = [
	    //'dash/js/bootstrap.min.js',
	    'dash/js/TweenMax.min.js',
	    'dash/js/resizeable.js',
	    'dash/js/joinable.js',
	    'dash/js/xenon-api.js',
	    'dash/js/xenon-toggles.js',
	    /*
	     * for chart
	     */
	    'dash/js/xenon-widgets.js',
	    'dash/js/devexpress-web-14.1/js/globalize.min.js',
	    'dash/js/devexpress-web-14.1/js/dx.chartjs.js',
	    'dash/js/toastr/toastr.min.js',
	];
	public $depends = [
	    'yii\web\YiiAsset',
	    'yii\bootstrap\BootstrapAsset',
	];

}
