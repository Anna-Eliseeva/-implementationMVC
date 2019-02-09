<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-02-09
 * Time: 22:40
 */

$title = 'Страница с пользователями';
?>

<?php if (!count($userList)): ?>
    <h2>Пользователи не найдены!</h2>
    <p>Вы можете их <a href="/user/add">добавить</a></p>
<?php endif; ?>

<ol>
<?php foreach ($userList as $user): ?>
    <li><?= $user['id']; ?>: <?= $user['name']; ?></li>
<?php endforeach; ?>
</ol>

<table>
    <tr>
        <th>ID</th>
        <th>Login</th>
        <th>Name</th>
        <th>Birthday</th>
    </tr>
    <?php foreach ($userList as $user): ?>
        <tr>
            <td><?= $user['id']; ?></td>
            <td><?= $user['login']; ?></td>
            <td><?= $user['name']; ?></td>
            <td><?= $user['birthday']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>