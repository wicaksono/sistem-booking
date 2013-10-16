<?php return array(
    'name'     => APPLICATION_NAME,
    'basePath' => APPLICATION_PATH,

    'defaultController' => 'booking',

    'preload' => array('log'),

    'import' => array(
        'application.models.*',
        'application.components.*',
    ),

    'params' => array(
        'secret' => 'UOtw3GsOFDcbCVtnXXsJDA==',
        'shared' => APPLICATION_PATH . '/../shared',
    ),

    'components' => array(
        'clientScript' => array(
            'scriptMap' => array(
                'jquery-ui.css' => FALSE,
                'jquery.js' => FALSE,
                'jquery.min.js' => FALSE,
                'jquery-ui.js' => FALSE,
                'jquery.yiiactiveform.js' => FALSE,
                'jquery.yiigridview.js' => FALSE
            ),
        ),
        'user' => array(
            'class'          => 'application.components.WebUser',
            'loginUrl'       => array('/account/login'),
            'allowAutoLogin' => TRUE,
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=booking',
            'username'         => 'booking',
            'password'         => 'booking',
            'charset'          => 'utf8',
            'emulatePrepare'   => TRUE,
            'autoCommit'       => TRUE,
            'enableProfiling'  => FALSE
        ),
        'sisko' => array(
            'class' => 'ext.oci8pdo.OciDbConnection', ////192.168.152.171:1521/siorcl
            'connectionString' => 'oci:dbname=192.168.152.171:1521/siorcl;charset=UTF8',
            'username' => 'iklan',
            'password' => 'adminiklansi',
            'enableProfiling'  => TRUE
        ),
        'errorHandler' => array(
            'errorAction' => 'account/error',
        ),
        'log' => array(
            'class'  => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                    'logPath' => APPLICATION_PATH . '/runtime/log',
                ),
            ),
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => TRUE,
        ),
    ),
);
