<?php
define('YII_DEBUG', TRUE);

defined('APPLICATION_NAME') ||
    define('APPLICATION_NAME', 'SINDO Booking Development');

defined('APPLICATION_PATH') ||
    define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/protected'));

require_once(APPLICATION_PATH . '/framework/yii.php');
Yii::createWebApplication(APPLICATION_PATH . '/configs/development.php')->run();
