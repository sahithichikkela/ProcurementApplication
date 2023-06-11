<?php


require_once '/data/live/vendor/razorpay/razorpay/Razorpay.php';
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => ' Procurement Website',
	'defaultController' => 'vendor',
	// preloading 'log' component
	'preload' => array('log'),

	
	'import' => array(
		'application.models.*',
		'application.components.*',
		'application.components.helpers.*',
		'application.modules.aws.components.helpers.*',
		'application.modules.aws.components.events.*',
		'ext.YiiMongoDbSuite.*',
		'application.vendor.*',
		'application.models.*',
		'application.vendor.swiftmailer.swiftmailer.lib.*',
		'application.vendor.razorpay-php.Razorpay',
	),
	
	'modules' => array(
		'sample',
		// uncomment the following to enable the Gii tool
		'aws',
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => '123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array('*'),
		),
	),
	

	// application components
	'components' => array(

		'user' => array(
			// enable cookie-based authentication
			'loginUrl' => array('/index.php/adduser/userlogin'), 
			'allowAutoLogin' => true,
		),

	
		'aliases' => array(
			'Razorpay' => 'vendor.razorpay-test.razorpay',
		),
		'razorpay' => array(
			'class' => 'application.vendor.razorpay-php.Razorpay',
			'keyId' => 'a',
			'keySecret' => 'a',
		),

		// uncomment the following to enable URLs in path-format

		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => array(
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',	
				'admin/subcategories' => 'admin/subcategories',
				'admin/productdisplay/<id:\d+>' => 'admin/productdisplay',
				'admin/orderdisplay/<id:\d+>' => 'admin/orderdisplay',
				'admin/allotitems/<id:\d+>' => 'admin/allotitems',
				'admin/downloadinvoice/<id:\d+>' => 'admin/downloadinvoice',
				'vendor/editpost/<id:\d+>' => 'vendor/editpost',
				'ticket/ticketdetails/<id:\d+>' => 'ticket/ticketdetails',
			),
		),
		// 'request' => array(
		// 	'enableCookieValidation' => true,
		// ),


		// database settings are configured in database.php
		'db' => require(dirname(__FILE__) . '/database.php'),
		'mongodb' => array(
			'class' => 'EMongoDB',
			// 'connectionString' => 'mongodb://localhost:27017',
			'connectionString' => 'mongodb://sahiti:1234@ac-kqj4zir-shard-00-00.tgtwbgx.mongodb.net:27017,ac-kqj4zir-shard-00-01.tgtwbgx.mongodb.net:27017,ac-kqj4zir-shard-00-02.tgtwbgx.mongodb.net:27017/?ssl=true&replicaSet=atlas-e09zyt-shard-0&authSource=admin&retryWrites=true&w=majority',
			'dbName' => 'helpdesk',
			'fsyncFlag' => true,
			'safeFlag' => true,
		),
		'cache' => array(
			'class' => 'CRedisCache',
			'hostname' => 'redis',
			'port' => 6379,
			'database' => 0,
			'hashKey' => false,
			'keyPrefix' => '',
		),
		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => YII_DEBUG ? null : 'site/error',
		),
		'JWT' => array(
			'class' => 'ext.jwt.JWT',
			'key' => 'dsjknldkiha',
		),
		'security' => array(
			'class' => 'CSecurityManager',
			),

		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning,info,trace',
					'logfile' => 'file.log',
				),
				// uncomment the following to show log messages on web pages

				// array(
				// 	'class'=>'CWebLogRoute',
				// ),

			),
		),
		's3' => [
			'class' => 'bpsys\yii2\aws\s3\Service',
			'credentials' => [ 
				'key' => 'aa',
				'secret' => 'zzz',
			],
			'region' => 'ap-south-1',
			'defaultBucket' => 'chikkelasahithi',
			'defaultAcl' => 'public-read',
			'defaultPresignedExpiration' => '+1 hour',
			'endpoint' => 'http://localhost:9000',
		],
		'swiftMailer'=>array(
			'class'=>'application.components.SwiftMailer',
			'host' => 'smtp.gmail.com',
            'port' => 465,
            'encryption' => 'ssl',
            'username' => 'iamsahithirao@gmail.com',
            'password' => 'meeglhaimqgfrbpn',
            'from' => [
				'email' => 'iamsahithirao@gmail.com',
                'name' => 'Sahithi',
			],
		),
		
		'sqs' => array(
			'class' => 'application.components.SqsWrapper',
			// 'class' => 'Aws\Sqs\SqsClient',
        	'version' => 'latest',
			'key' => 'zz',
			'secret' => 'zz',
			'region' => 'ap-south-1', 
		),

		'ses' => array(
			'class' => 'Aws\Ses\SesClient',
			'credentials' => array(
				'key' => 'aa',
				'secret' => 'zz',
			),
			'region' => 'ap-south-1', 
		),

	),

	'params' => array(

		'adminEmail' => 'webmaster@example.com',
		'count' => 0,
		'jwtSecret' => 'msfefvsszzay',
		'aws' => array(
			'key' => 'zz',
			'secret' => 'zz',
			'region' => 'ap-south-1', 
		),
		'id' => 6, 
	),
);
