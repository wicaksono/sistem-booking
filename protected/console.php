<?php
define('YII_DEBUG', FALSE);

defined('APPLICATION_NAME') ||
    define('APPLICATION_NAME', 'SINDO Booking');

defined('APPLICATION_PATH') ||
    define('APPLICATION_PATH', realpath(dirname(__FILE__)));

require_once(APPLICATION_PATH . '/framework/yiilite.php');
Yii::createConsoleApplication(APPLICATION_PATH . '/configs/console.php')->run();
