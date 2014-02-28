<?php return array(
    'name'     => APPLICATION_NAME,
    'basePath' => APPLICATION_PATH,

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
            'connectionString' => 'oci:dbname=192.168.152.246:1521/siorcl;charset=UTF8',
            'username' => 'iklan',
            'password' => 'adminiklansi',
            'enableProfiling'  => TRUE
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
    ),
);
