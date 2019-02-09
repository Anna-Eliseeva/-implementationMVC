<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07/02/2019
 * Time: 14:54
 */

namespace application\core;

class Controller
{
    public $route;
    public $view;

    /**
     * Controller constructor.
     * @param array $route Массив с маршрутом [controller => ..., action => ...]
     */
    public function __construct(array $route)
    {
        $this->route = $route;
        // передаем маршруты в View
        $this->view = new View($route);
    }
}