<?php

namespace application\controller;


use application\core\Controller;

class MainController extends Controller
{
    public function indexAction(): void
    {
        // Указываем какой метод из модели будет вызываться
        $result = $this->model->getNews();

        // Указываем значения в массиве
        $vars = [
            'news' => $result,
        ];

        // Выводим результат на страницу
        $this->view->render('Главная страница', $vars);
    }
}