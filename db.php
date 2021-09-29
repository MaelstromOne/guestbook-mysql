<?php

const LOGIN_INSERT = "INSERT INTO users (login, password) VALUES ('%s', '%s')";
const LOGIN_SELECT = "SELECT id, login, password FROM users WHERE login = '%s' AND password = '%s'";

const MESSAGE_INSERT = "INSERT INTO messages (user_id, text) VALUES ((SELECT id FROM users WHERE login = '%s'), '%s')";
const MESSAGE_SELECT = "SELECT login, text, date FROM users JOIN messages ON users.id = messages.user_id";

function getDbConnection()
{
    $mysqli = mysqli_connect(DB['host'], DB['login'], DB['password'], DB['name']);
    $mysqli or die("Не удалось подключиться к базе данных");
    return $mysqli;
}

function saveMessage()
{
    $mysqli = getDbConnection();
    $query = sprintf(MESSAGE_INSERT,
        mysqli_real_escape_string($mysqli, $_SESSION["login"]),
        mysqli_real_escape_string($mysqli, $_POST['text']));

    mysqli_query($mysqli, $query) or die("Не удалось записать в базу данных");
    header("Location: /");
}

function getMessages()
{
    $mysqli = getDbConnection();
    $result = mysqli_query($mysqli, MESSAGE_SELECT);
    $result or die("Не удалось получить данные от базы данных");
    return mysqli_query($mysqli, MESSAGE_SELECT);
}

function auth()
{
    $mysqli = getDbConnection();
    $query = sprintf(LOGIN_SELECT,
        mysqli_real_escape_string($mysqli, $_POST['login']),
        mysqli_real_escape_string($mysqli, $_POST['password']));

    mysqli_num_rows(mysqli_query($mysqli, $query)) or die("Логин или пароль не совпадают");

    session_start();
    $_SESSION["login"] = $_POST['login'];
    header("Location: /");
}

function signup()
{
    $mysqli = getDbConnection();
    $query = sprintf(LOGIN_INSERT,
        mysqli_real_escape_string($mysqli, $_POST['login']),
        mysqli_real_escape_string($mysqli, $_POST['password']));

    mysqli_query($mysqli, $query) or die("Не удалось записать в базу данных");
    header("Location: /auth.php");
}