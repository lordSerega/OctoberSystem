<?php
error_reporting(-1);

ini_set('display_errors', 1);
include '../php/action.php';


?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Регистрация пациента | Стоматологическая клиника Октябрь</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <link rel="stylesheet" href="../css/style.css">
    <link href="../css/sb-admin-2.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
<br>
<br>
<div class="row justify-content-center">
    <div class="col-lg-10">

        <?php if(isset($_SESSION['response'])) { ?>
        <div class="alert alert-<?=$_SESSION['res_type']; ?> alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= $_SESSION['response']; ?>
        </div>
        <b>
            <?php } unset($_SESSION['response']); ?></b>
    </div>
</div>

<div class="container bg-light mt-5 mb-5 card p-5">
    <div class="row">
        <div class="col-9 border-right">
            <h1>3. Данные для входа</h1>

            <h3>Регистрация на портале онлайн записи</h3>
            <form class="pl-3" method="POST" action="../php/action.php" id="form-data">
                <div class="form-group row pt-3 ">
                    <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                        <p class="h5">Логин<strong class="text-danger">*</strong></p>
                    </label>
                    <div class="col-xl-8">
                        <input type="text" name="login" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row pt-3 ">
                    <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                        <p class="h5">Email<strong class="text-danger">*</strong></p>
                    </label>
                    <div class="col-xl-8">
                        <input type="Email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row pt-3 ">
                    <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                        <p class="h5">Пароль<strong class="text-danger">*</strong></p>
                    </label>
                    <div class="col-xl-8">
                        <input type="password" name="pass" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row pt-3 ">
                    <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                        <p class="h5">Подтвердите пароль<strong class="text-danger">*</strong></p>
                    </label>
                    <div class="col-xl-8">
                        <input type="password" name="pass2" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row ">
                    <input type="submit" name="step3" id="step3" class="btn btn-primary" value="Отправить заявку на регистрацию">
                </div>
            </form>
        </div>
        <div class="col-3  ">
            <p class=" pt-4 text-dark">1 Данные пациента</p>
            <p class=" text-dark">2 Домашний адрес</p>
            <h5 class="text-dark">3 Данные для выхода</h5>
        </div>
    </div>
</div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>







    </body>

    </html>