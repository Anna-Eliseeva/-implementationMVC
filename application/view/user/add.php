<h1>Создание пользователя</h1>

<!-- Если страница загружена методом POST (т.е. произошла отправка формы) -->
<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <div class="flash <?= $error ? 'error' : 'success'; ?>-msg">
        <p><?= $message; ?></p>
    </div>
<?php endif; ?>

<form name="user-add-form" method="POST">
    <table>
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th>Name</th>
            <th>Birthday</th>
        </tr>
        <tr>
            <td><input type="number" min="1" name="id" value=""></td>
            <td><input type="text" name="login" value=""</td>
            <td><input type="text" name="name" value=""></td>
            <td><input type="date" name="birthday" value=""></td>
            <td><input type="submit" name="submit" value="СОХРАНИТЬ"></td>
        </tr>
    </table>
</form>
