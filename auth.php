<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guest book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div>
        <a href="./" class="link-primary">Комментарии</a>
        <a href="registration.php" class="link-primary">Регистрация</a>
    </div>
    <form class="mt-5" method="post">
        <div class="form-group mt-4">
            <label for="login">Логин</label>
            <input type="text" class="form-control" id="login" name="login" placeholder="Введите логин">
        </div>

        <div class="form-group mt-4">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль">
        </div>
        <button type="submit" class="btn btn-primary mt-4">Отправить</button>
    </form>

    <?php

    require_once("defines.php");
    require_once("db.php");

    $mysqli = mysqli_connect(DB['host'], DB['login'], DB['password'], DB['name']) or die("Не удалось подключиться к базе данных");

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $query = sprintf(LOGIN_SELECT,
            mysqli_real_escape_string($mysqli, $_POST['login']),
            mysqli_real_escape_string($mysqli, $_POST['password']));

        mysqli_num_rows(mysqli_query($mysqli, $query)) or die("Логин или пароль не совпадают");

        session_start();
        $_SESSION["login"] = $_POST['login'];
        header("Location: /");
    }  ?>
</div>
</body>
</html>