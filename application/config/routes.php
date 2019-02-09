<?php

/*здесь будут маршруты. Будет возвращаться массив,первым параметром которого будет являться название возвращаемой
страницы, она будет являться массивом, в котором будут лежать контроллер с названием и экшен с названием */

return [
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'account/login' => [
        'controller' => 'account',
        'action' => 'login',
    ],

    'account/register' => [
        'controller' => 'account',
        'action' => 'register',
    ],

    'user/index' => [
        'controller' => 'user',
        'action' => 'index',
    ],

    'user/add' => [
        'controller' => 'user',
        'action' => 'add',
    ],

    'user/update' => [
        'controller' => 'user',
        'action' => 'update',
    ],

    'user/delete' => [
        'controller' => 'user',
        'action' => 'delete',
    ],
];