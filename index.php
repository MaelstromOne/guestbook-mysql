<?php

require_once("defines.php");
require_once("db.php");

session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    saveMessage();
}

$result = getMessages() ?>

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
        <a href="signup.php" class="link-primary">Регистрация</a>
        <a href="auth.php" class="link-primary">Аутентификация</a>
        <?php if (isset($_SESSION["login"])) { ?>
            <a href="exit.php" class="link-primary">Выйти</a>
        <?php } ?>
    </div>
    <?php if (isset($_SESSION["login"])) { ?>
        <div class="mt-5">
            <h5>Вы авторизовались как</h5>
            <h4><?= $_SESSION["login"] ?></h4>
        </div>
        <form class="mt-4" method="post">
            <div class="form-group mt-4">
                <label for="text">Комментарий</label>
                <input type="text" class="form-control" id="text" name="text" placeholder="Введите комментарий">
            </div>
            <button type="submit" class="btn btn-primary mt-4">Отправить</button>
        </form>
    <?php } else { ?>
        <div class="mt-5">
            <p>Для отправления комментариев нужно авторизоваться</p>
        </div>
    <?php } ?>

    <div class="mt-5">
        <?php
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['login'] ?></h5>
                    <p class="card-text"><?= $row['text'] ?></p>
                </div>
                <div class="card-body">
                    <p class="card-text"><?= $row['date'] ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</body>
</html>