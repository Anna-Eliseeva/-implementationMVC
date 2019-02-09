<?php

namespace application\core;

class View
{
    public $path;
    public $route;
    public $layout = 'default';

    /**
     * View constructor.
     * @param array $route Массив с маршрутом (контроллер и действие)
     */
    public function __construct(array $route)
    {
        // Получаем наши данные маршрутов
        $this->route = $route;

        // Формируем наш путь
        $this->path = sprintf('%s/%s', $route['controller'], $route['action']);
    }

    /**
     * Загрузка шаблона и вида
     * @param array $vars
     * @param string $title
     */
    public function render(array $vars = [], string $title = ''): void
    {
        // Распакуем массив в переменную
        extract($vars, EXTR_OVERWRITE);

        // Помещаем в переменную путь к видам
        $path = 'application/view/' . $this->path . '.php';

        // Проверяем существует ли такой путь
        if (file_exists($path)) {
            // Включаем буферизацию вывода
            ob_start();

            // Присоединяем путь
            require $path;

            // Заканчиваем буферизацию вывода и возвращаем результат в  $content
            $content = ob_get_clean();

            // Присоединяем шаблон с видами
            require 'application/view/layouts/' . $this->layout . '.php';
        }
    }

    /**
     * Перенаправление страниц
     * @param string $url Url на который произойдет перенаправление
     */
    public function redirect(string $url): void
    {
        header('location: ' . $url);
        exit;
    }

    /** Вывод статус кодов ошибок
     * @param string $code
     */
    public static function errorCode(string $code): void
    {
        // Получаем код ответа  HTTP
        http_response_code($code);

        // Подключаем наш путь
        $path = 'application/view/errors/' . $code . '.php';

        // Проверяем существует ли такой файл
        if (file_exists($path)) {
            // Если существует то подключаем его
            require $path;
        }
        exit;
    }

    /** Вывод сообщения с результатом на экран
     * @param string $status
     * @param string $message
     */
    public function message(string $status, string $message): void
    {
        // Завершение скрипта принудительно
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    /** Редирект для JavaScript
     * @param string $url
     */
    public function location(string $url): void
    {
        exit(json_encode(['url' => $url]));
    }
}