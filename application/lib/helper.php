<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-02-10
 * Time: 00:20
 */

/**
 * Очистка от PHP и HTML тегов из строки
 * @param string $value
 * @return string
 */
function clean($value = '') {
    $value = trim($value);         // удаляем пробелы от начала и до конца строки
    $value = stripslashes($value); // удаляем экранированные символоы ("Ваc зовут O\'reilly?" => "Вас зовут O'reilly?")
    $value = strip_tags($value);   // удаляем php html символы

    return $value;
}

/**
 * Функция для проверки корректности даты
 * @param string $birthday Дата
 * @param string $format Формат даты
 * @return bool Результат
 */
function validateDate($birthday, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $birthday); // Создаем объект даты из строки по формату Y-m-d (2019-02-05)

    return $d && $d->format($format) === $birthday;
}