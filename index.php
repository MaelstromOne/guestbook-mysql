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
    <form method="post">
        <div class="form-group mt-4">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Введите имя">
        </div>

        <div class="form-group mt-4">
            <label for="message">Комментарий</label>
            <input type="text" class="form-control" id="message" name="message" placeholder="Введите комментарий">
        </div>
        <button type="submit" class="btn btn-primary mt-4">Отправить</button>
    </form>

    <?php

    require_once($_SERVER['DOCUMENT_ROOT'] . "/defines.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/db.php");

    $mysqli = mysqli_connect(DB['host'], DB['login'], DB['password'], DB['name']) or die("Не удалось подключиться к базе данных");

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $query = sprintf(INSERT,
            mysqli_real_escape_string($mysqli, $_POST['name']),
            mysqli_real_escape_string($mysqli, $_POST['message']));

        $result = mysqli_query($mysqli, $query) or die("Не удалось записать в базу данных");
        header("Location: /");
    }

    $result = mysqli_query($mysqli, SELECT) or die("Не удалось получить данные от базы данных"); ?>
    <div class="mt-5">
        <?php
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['name'] ?></h5>
                    <p class="card-text"><?= $row['message'] ?></p>
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