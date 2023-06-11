<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'My Console Application',

	// preloading 'log' component
	'preload' => array('log'),

	'import' => array(
		'application.models.*',
		'application.models_console.*',
		'application.extensions.*',
		'application.components.*',
		'ext.YiiMongoDbSuite.*',
		'application.vendor.*',
		'application.vendor.swiftmailer.swiftmailer.lib.*',
		'application.vendor.razorpay-php.Razorpay',
		
	),

	// application components
	'components' => array(

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
		

		/**
		 * Authenticates the password.
		 * This is the 'authenticate' validator as declared in rules().
		 * @param string $attribute the name of the attribute to be validated.
		 * @param array $params additional parameters passed with rule when being executed.
		 */
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			),
		),

	),


);
