<?php

$params = array_merge(
	require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'bootstrap' => ['gii'],
    'modules' => [
	'gii' => [
	    'class' => 'yii\gii\Module',
	    'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'], // adjust this to your needs
	    'generators' => [//here
		'crud' => [// generator name
		    'class' => 'yii\gii\generators\crud\Generator', // generator class
		    'templates' => [//setting for out templates
			'custom' => '@common/myTemplates/crud/custom', // template name => path to template
		    ]
		]
	    ],
	],
	'admin' => [
	    'class' => 'backend\modules\admin\Admin',
	],
	'masters' => [
	    'class' => 'backend\modules\masters\Masters',
	],
	'slider' => [
	    'class' => 'backend\modules\slider\Slider',
	],
	'products' => [
	    'class' => 'backend\modules\products\Products',
	],
	'about' => [
	    'class' => 'backend\modules\about\about',
	],
	'content' => [
	    'class' => 'backend\modules\content\Content',
	],
	'static' => [
	    'class' => 'backend\modules\static\static',
	],
	'users' => [
	    'class' => 'backend\modules\users\Module',
	],
'reports' => [
	    'class' => 'backend\modules\reports\Module',
	],
    ],
    'components' => [
	'request' => [
	    'csrfParam' => '_csrf-backend',
	],
	'user' => [
	    'identityClass' => 'common\models\Employee',
	    'enableAutoLogin' => true,
	    'loginUrl' => ['site/index'],
	    'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
	],
	'session' => [
	    // this is the name of the session cookie used for login on the backend
	    'name' => 'advanced-backend',
	],
	'log' => [
	    'traceLevel' => YII_DEBUG ? 3 : 0,
	    'targets' => [
		    [
		    'class' => 'yii\log\FileTarget',
		    'levels' => ['error', 'warning'],
		],
	    ],
	],
	'errorHandler' => [
	    'errorAction' => 'site/error',
	],
	'urlManager' => [
	    'enablePrettyUrl' => true,
	    'showScriptName' => false,
	    'rules' => [
	    ],
	],
	'assetManager' => [
	    'bundles' => [
		'yii\web\JqueryAsset' => [
		    'js' => []
		],
		'yii\bootstrap\BootstrapAsset' => [
		    'css' => [],
		],
	    ],
	],
    ],
    'params' => $params,
];
