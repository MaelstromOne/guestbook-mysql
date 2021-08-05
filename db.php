<?php

const LOGIN_INSERT = "INSERT INTO users (login, password) VALUES ('%s', '%s')";
const LOGIN_SELECT = "SELECT id, login, password FROM users WHERE login = '%s' AND password = '%s'";

const MESSAGE_INSERT = "INSERT INTO messages (user_id, text) VALUES ((SELECT id FROM users WHERE login = '%s'), '%s')";
const MESSAGE_SELECT = "SELECT login, text, date FROM users JOIN messages ON users.id = messages.user_id;";