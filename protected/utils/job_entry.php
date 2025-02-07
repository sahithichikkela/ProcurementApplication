<?php

// change the following paths if necessary
$yii = dirname(__FILE__) . '/../../framework/yii.php';
$config = dirname(__FILE__) . '/../config/console.php';
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be
//shown in each log message
defined('YII_TRACE_LEVEL') or
        define('YII_TRACE_LEVEL', 0);
require_once($yii);
if(file_exists(dirname(__FILE__) ."/../../vendor/autoload.php"))
	require_once(dirname(__FILE__) ."/../../vendor/autoload.php");

$app = Yii::createConsoleApplication($config)->run();
?>
