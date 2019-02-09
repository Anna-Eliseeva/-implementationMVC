<?php

namespace application\core;


use application\lib\Db;

abstract class Model
{
    /**
     * @var Db
     */
    public $db;

    public function __construct()
    {
        // Создаем экземпляр класса для работы с БД
        $this->db = new Db;
    }
}