<?php
return [
    'settings' => [
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        //MySql Database
        'db' => [
            'driver'=> 'mysql',
            'host' => DBHOST,
            'username' => DBUSER,
            'password' => DBPASS,
            'database' => DBNAME,

        ],
        'SECRET_KEY_CMS'=>"CMS^%WS*&",
        'SECRET_KEY_WEB'=>"WEB^%WS*&",
        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
