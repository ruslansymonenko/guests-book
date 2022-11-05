<?php
error_reporting(-1);
session_start();

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/funcs.php';

if (isset($_POST['registr'])) {
    registration();
    header("Location: index.php");
    die;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guests book</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container">

        <?php if (!empty($_SESSION['success'])): ?>
        <div class="success__notice">
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
                ?>
                <div></div>
                <button type="button" class="btn__close btn btn-outline-secondary">X</button>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['errors'])): ?>
        <div class="error__notice">
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <?php
            echo $_SESSION['errors'];
            unset($_SESSION['errors']);
                ?>
                <div></div>
                <button type="button" class="btn__close btn btn-outline-secondary">X</button>
            </div>
        </div>
        <?php endif; ?>

        <?php if (empty($_SESSION['user']['name'])): ?>
        <div class="registration web__form">
            <h2 class="registr__title">Регістрація</h2>
            <form method="POST">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Логін</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" name="login">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Пароль</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword3" name="pass">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="registr">
                    Підтвердити
                </button>
            </form>
        </div>


        <div class="authorization web__form">
            <h2 class="registr__title">Авторизація</h2>
            <form method="POST">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Логін</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Пароль</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword3">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="authorization">
                    Підтвердити
                </button>
            </form>
        </div>

        <?php else: ?>
        <div class="row">
            <div class="col-md-8">
                <p class="welcome__text">
                    Ласкаво просимо User
                </p>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-secondary" name="exit">
                    Вийти
                </button>
            </div>
        </div>

        <form class="user__message web__form">
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                    style="height: 100px"></textarea>
                <label for="floatingTextarea2">Comments</label>
            </div>
            <button type="submit" class="btn btn-primary" name="send">
                Відправити
            </button>
        </form>
        <?php endif; ?>

        <div class="messages web__form">
            <div class="card" style="width: 35rem;">
                <div class="card-body">
                    <h5 class="card-title">User</h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        02.11.22
                    </h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                </div>
            </div>
        </div>
    </div>



    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>