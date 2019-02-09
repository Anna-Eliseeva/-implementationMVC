<?php

namespace application\lib;

use PDO;
use PDOStatement;

class Db
{
    protected $db;

    public function __construct()
    {
        // Подключаем конфиг*/
        $config = require APPLICATION_DIR . '/config/db.php';
        $dsn = sprintf('mysql:host=%s;dbname=%s', $config['host'], $config['name']);
        $this->db = new PDO($dsn, $config['user'], $config['password']);
    }

    /**
     * Функция которая делает запрос к базе данных
     * @param string $sql
     * @param array $params
     * @return bool|PDOStatement
     */
    public function query(string $sql, array $params = []): ?PDOStatement
    {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $stmt->execute();

        return $stmt;
    }

    /**
     * Вывод данных из БД в массиве
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function row(string $sql, array $params = []): array
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Вывод данных из БД в виде колонок
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function column(string $sql, array $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }
}