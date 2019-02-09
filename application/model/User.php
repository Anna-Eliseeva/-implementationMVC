<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06/02/2019
 * Time: 11:37
 */

namespace application\model;

class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $birthday;

    /**
     * Путь до файла с пользователями
     * @var string
     */
    private $storage;

    /**
     * Путь до временного файла
     * @var string
     */
    private $storageTmp;

    /**
     * Ресурс файла с пользователями
     * @var resource
     */
    private $storageRes;

    /**
     * Ресурс временного файла с пользователями
     * @var resource
     */
    private $storageTmpRes;

    public function __construct() // FIXME: openFile(['file1', 'file2'])
    {
        $this->storage = APPLICATION_DIR . '/file/user.txt';
        $this->storageTmp = APPLICATION_DIR . '/file/tmp.txt';
        $this->storageRes = fopen($this->storage, 'a+b');
        $this->storageTmpRes = fopen($this->storageTmp, 'a+b');

        if (!is_resource($this->storageRes)) {
            throw new \RuntimeException(sprintf('Не существует файл %s', $this->storage));
        }

        if (!is_resource($this->storageTmpRes)) {
            throw new \RuntimeException(sprintf('Не существует файл %s', $this->storageTmp));
        }
    }

    public function __destruct() // FIXME: closeFile(['file1', 'file2'])
    {
        if (is_resource($this->storageRes)) {
            fclose($this->storageRes);
        }

        if (is_resource($this->storageTmpRes)) {
            fclose($this->storageTmpRes);
        }
    }

    /**
     * Метод получения данных конкретного пользователя
     * @param int $id
     * @return array|null
     */
    public function getOne(int $id): ?array
    {
        while ($line = fgets($this->storageRes)) {
            $user = json_decode($line, true);
            if ((int)$user['id'] === $id) {
                return $user;
            }
        }

        return null;
    }

    /**
     * Метод получения данных всех пользователей
     * @return array
     */
    public function getAll(): array
    {
        $userList = [];

        while ($line = fgets($this->storageRes)) {
            $user = json_decode($line, true);
            $userList[] = $user;
        }

        return $userList;
    }

    /**
     * Метод добавления пользователей
     * @param array $userData Массив пользователя
     */
    public function add(array $userData): void
    {
        // Если не произошло написание внутри файла то отправляем клиенту ошибку
        if (!fwrite($this->storageRes, json_encode($userData) . PHP_EOL)) {
            $msg = 'Не удалось произвести сохранения в файл! (Возможно не хватает permission или файл не существует!)';
            throw new \RuntimeException($msg);
        }
    }

    /**
     * Метод обновления данных пользователей
     * @param int $id
     * @param array $userData
     * @return bool
     */
    public function update(int $id, array $userData): bool
    {
        while ($line = fgets($this->storageRes)) {
            $user = json_decode($line, true);
            if ((int)$user['id'] === $id) {
                fwrite($this->storageTmpRes, json_encode($userData) . PHP_EOL);
            } else {
                fwrite($this->storageTmpRes, $line);
            }
        }

        $this->__destruct();

        unlink($this->storage);
        rename($this->storageTmp, $this->storage);

        return true;
    }

    /**
     * Метод удаления пользователей
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        while ($line = fgets($this->storageRes)) {
            $user = json_decode($line, true);
            if ((int)$user['id'] !== $id) {
                fwrite($this->storageTmpRes, $line);
            }
        }

        $this->__destruct();

        unlink($this->storage);
        rename($this->storageTmp, $this->storage);

        return true;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {

        return $this->login;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getBirthday(): string
    {
        return $this->birthday;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }
}