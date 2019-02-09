<?php

use application\core\Router;

/**
 * Функция автозагрузки классов,
 * перед вызовом класса будет вызываться эта функция
 * и если класс не подключен, будет показываться ошибка
 * @var string $class
 */
function autoload(string $class) {
    $path = str_replace('\\', '/', sprintf('%s.php', $class));
    if (file_exists($path)) {
        require $path;
    } else {
        throw new \RuntimeException(sprintf('Класс %s не найден!', $path));
    }
}
spl_autoload_register('autoload');

// стартуем сессии
session_start();

define('APPLICATION_DIR', __DIR__ . '/application');
define('PUBLIC_DIR', __DIR__ . '/public');


$router = new Router;
$router->run();
