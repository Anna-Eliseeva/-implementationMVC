<?php

namespace application\core;

use application\core\View;

class Router
{
    protected $routes = [];
    protected $params = [];

    public function __construct()
    {
        // Подключаем config
        $arr = require APPLICATION_DIR . '/config/routes.php';

        // Создаем цикл который будет перебирать массив и добавлять его в функцию
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
    }

    /**
     * Добавление маршрута
     * @param $route
     * @param $params
     */
    public function add($route, $params): void
    {
        $route = '#^' . $route . '$#';
        $this->routes[$route] = $params;
    }

    /**
     * Проверка существования маршрута
     * @return bool
     */
    public function match(): bool
    {
        // Получаем текущий URL и обрезаем слэш
        $url = trim($_SERVER['REQUEST_URI'], '/');

        // В цикле перебираем массив маршрутов и из него получаем $route и $params
        foreach ($this->routes as $route => $params) {

            // Если не переданно название экшена (т.е. передано только название контроллера),
            if ($url && !preg_match('#\/#', $url)) {
                // то назначаем название экшена как index
                $url .= '/index';
            }

            // При помощи регулярных выражений проверяем соответсвие этих данных
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * Запуск контроллера
     */
    public function run(): void
    {
        // Проверяем существует ли метод
        if ($this->match()) {
            $classPath = sprintf('application\\controller\\%sController', ucfirst($this->params['controller']));

            // Проверяем существует ли класс
            if (class_exists($classPath)) {
                if (empty($this->params['action'])) {
                    $this->params['action'] = 'index';
                }
                $action = $this->params['action'] . 'Action';

                // Проверка на существование метода
                if (method_exists($classPath, $action)) {
                    // Если метод в контроллере существует то создаем экземпляр класса
                    $controller = new $classPath($this->params);
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }
}