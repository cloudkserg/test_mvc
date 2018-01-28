<?php
$rootPath = dirname(__DIR__);
\RedBeanPHP\R::setup(getenv('DB_STRING'), getenv('DB_USER'), getenv('DB_PASS'));

return [
    'name' => getenv('APP_NAME'),
    'middlewares' => [
        \Middlewares\PhpSession::class,
       \Middlewares\FastRoute::class,
        \Src\Core\Auth\OnlyAdminMiddleware::class,
        \Middlewares\RequestHandler::class
    ],
    'twig' => [
        'templatePath' => $rootPath . '/resources/views',
        'cachePath' => $rootPath . '/runtime/cache'
    ],

    'image' => [
        'width' => 320,
        'height' => 240,
        'path' => $rootPath . '/public/images',
        'pathForWeb' => '/images'
    ],

    'tasks' => [
        'file' => $rootPath . '/runtime/storage/tasks.json'
    ],

    'log' => [
        'level' => 'warning',
        'path' => $rootPath . '/runtime/logs/application.log'
    ],

    'routes' => [
        ['GET', '/', \Src\Action\IndexAction::class],
        ['GET', '/api/tasks', \Src\Action\Task\IndexAction::class],

        ['GET', '/create', \Src\Action\Task\CreateAction::class],
        ['POST', '/save', \Src\Action\Task\SaveAction::class],

        ['GET', '/edit', \Src\Action\Task\EditAction::class],
        ['POST', '/update', \Src\Action\Task\UpdateAction::class],

        ['POST', '/login', \Src\Action\LoginAction::class],
        ['POST', '/logout', \Src\Action\LogoutAction::class]
    ],

    'admin' => [
        'login' => 'admin',
        'pass' => '202cb962ac59075b964b07152d234b70'
    ]
];
