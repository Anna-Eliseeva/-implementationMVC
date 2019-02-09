<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-02-09
 * Time: 17:58
 */

namespace application\controller;

use application\core\Controller;
use application\model\User;

class UserController extends Controller
{
    public function indexAction(): void
    {
        $userModel = new User();
        $userList = $userModel->getAll();

        // Отправляем данные на View
        $this->view->render([
            'userList' => $userList,
        ]);
    }

    public function addAction(): void
    {
        $error = false;
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $error = false;
            $message = 'Пользователь добавлен успешно!';

            if (empty($_POST)) {
                $error =  true;
                $message = 'Не были отправлены данные для добавления!';
            }

            if (empty($_POST['id'])) {
                $error = true;
                $message = 'Id пользователя не был заполнен!';
            }

            if (empty($_POST['login'])) {
                $error = true;
                $message = 'Login пользователя не был заполнен!';
            }

            if (empty($_POST['name'])) {
                $error = true;
                $message = 'Name пользователя не был заполнен!';
            }

            if (empty($_POST['birthday'])) {
                $error = true;
                $message = 'Birthday не был заполнен!';
            }

            // Формируем данные для сохранения
            $userInfo['id'] = $_POST['id'];
            $userInfo['login'] = $_POST['login'];
            $userInfo['name'] = $_POST['name'];
            $userInfo['birthday'] = $_POST['birthday'];

            $userModel = new User();
            $userModel->add($userInfo);
        }

        $this->view->render([
            'error' => $error,
            'message' => $message,
        ]);
    }

    public function updateAction(): void
    {
        $userModel = new User();
    }

    public function deleteAction(): void
    {
        $userModel = new User();
    }
}