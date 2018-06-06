<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href=css/style.css rel="stylesheet">
    </head>
    <body>
        <header>
        <h1>Генератор фильмов</h1>
        </header>
        <content>
            <form method="POST" action"<?php echo $_SERVER['PHP_SELF']; ?>"></form>
            <label for="username">Введите ваш логин</label>
            <input type="text" name="username">
            <label for="username">Введите ваш пароль</label>
            <input type="password" name="password1">
            <label for="username">Введите ваш пароль еще раз</label>
            <input type="password" name="password2">
            <button name="submit">Зарегестрироваться</button>
        </content>
    </body>
</html>