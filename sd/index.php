<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="keywords" content="Кино, Фильмы на вечер, Генератор фильмов, Фильмы" />
    <meta name="description" content="Генератор фильмов" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="icon/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <title>Генератор фильмов</title>
</head>
<body>

    <header>
        <h1>Генератор фильмов</h1>
        <a href="/signup.php">Регистрация</a>
    </header>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <label for="username">Логин:</label>
	<input type="text" name="username">
	<label for="password">Пароль:</label>
	<input type="password" name="password1">
	<button type="submit" name="submit">Вход</button>

    </form>
</body>
</html>