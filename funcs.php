<?php

function debug($data)
{
    echo '<pre>' . print_r($data) . '</pre>';
}

function registration(): bool
{
    global $pdo;

    $login = !empty($_POST['login']) ? trim($_POST['login']) : '';
    $pass = !empty($_POST['pass']) ? trim($_POST['pass']) : '';


    if (empty($login) || empty($pass)) {
        $_SESSION['errors'] = 'Вкажіть логін/пароль';
        return false;
    }

    $res = $pdo->prepare("SELECT COUNT(*) FROM users WHERE login = ?");
    $res->execute([$login]);

    if ($res->fetchColumn()) {
        $_SESSION['errors'] = 'Такий логін вже зареєстрований';
        return false;
    }

    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $res = $pdo->prepare("INSERT INTO users (login, pass) VALUES(?, ?)");

    if ($res->execute([$login, $pass])) {
        $_SESSION['success'] = 'Регістрація пройшла успішно';
        return true;
    } else {
        $_SESSION['errors'] = 'Помилка реєстрації';
        return false;
    }
}

function login(): bool
{
    global $pdo;

    $login = !empty($_POST['login']) ? trim($_POST['login']) : '';
    $pass = !empty($_POST['pass']) ? trim($_POST['pass']) : '';

    if (empty($login) || empty($pass)) {
        $_SESSION['errors'] = 'Вкажіть логін/пароль';
        return false;
    }

    $res = $pdo->prepare("SELECT * FROM users WHERE login = ?");
    $res->execute([$login]);

    if (!$user = $res->fetch()) {
        $_SESSION['errors'] = 'Логін чи пароль вказані невірно';
        return false;
    }

    if (!password_verify($pass, $user['pass'])) {
        $_SESSION['errors'] = 'Логін чи пароль вказані невірно';
        return false;
    } else {
        $_SESSION['success'] = 'Авторизація пройшла успішно';
        $_SESSION['user']['name'] = $user['login'];
        $_SESSION['user']['id'] = $user['id'];
        return true;
    }
}