<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07/02/2019
 * Time: 14:49
 */

namespace application\controller;


use application\core\Controller;

class AccountController extends Controller
{
    public function loginAction(): void
    {
        $this->view->render('Вход');
    }

    public function registerAction(): void
    {
        $this->view->render('Регистрация');
    }
}