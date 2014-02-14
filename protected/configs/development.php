<?php return CMap::mergeArray(require_once(APPLICATION_PATH . '/configs/production.php'), array(
    'components' => array(
        'fixture' => array(
            'class' => 'system.test.CDbFixtureManager',
        ),
        /*'cache' => array(
            'class' => 'CApcCache'
        ),*/
        'clientScript' => array(
            'scriptMap' => array(
                //'jquery-ui.css' => 'assets/static/css/jui/jquery-ui.css'
            ),
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=booking',
            'username'         => 'booking',
            'password'         => 'booking',
            'schemaCachingDuration' => 3600,
            'autoCommit'       => TRUE,
            'enableProfiling'  => TRUE
        ),
        'log' => array(
            'class'  => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CWebLogRoute',
                ),
                array(
                    'class' => 'CProfileLogRoute'
                ),
            ),
        ),
        'urlManager' => array(
            'urlFormat' => 'get',
            'showScriptName' => TRUE,
        ),
    ),
));
