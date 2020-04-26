<?php

include '../php/action.php';


?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Регистрация пациента | Стоматологическая клиника Октябрь</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link href="../css/sb-admin-2.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <br>
    <br>
    <div class="container  bg-light mt-5 mb-5 card p-5">
        <div class="row">
            <div class="col-9  border-right">
                <h1>2. Домашний адрес</h1>
               
                <h3>Фактический адрес проживания</h3>

                <form class="pl-3" method="POST" action="../php/action.php">
                    <div class="form-group row pt-3 ">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">Страна<strong class="text-danger">*</strong></p>
                        </label>
                        <div class="col-xl-8">
                             <input type="text"  name="country" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row  ">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">Населённый пукнт<strong class="text-danger">*</strong></p>
                        </label>
                        <div class="col-xl-8">
                             <input type="text"  name="city" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row  ">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">Улица<strong class="text-danger">*</strong></p>
                        </label>
                        <div class="col-xl-8">
                             <input type="text" name="street"  class="form-control" required>
                        </div>
                    </div>

                        <div class="form-group row  ">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">Дом<strong class="text-danger">*</strong></p>
                        </label>
                        <div class="col-xl-8">
                             <input type="text"  name="house" class="form-control" required>
                        </div>
                    </div>
                        <div class="form-group row  ">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">Квартира</p>
                        </label>
                        <div class="col-xl-8">
                             <input type="text"  name="flat" class="form-control">
                        </div>
                    </div>


                    <div class="form-group row ">
                        <input type="submit" name="step2" class="btn btn-primary" value="Сохранить и продолжить">
                    </div>
                </form>
            </div>
            <div class="col-3 ">
                <p class=" pt-4 text-dark">1 Данные пациента</p>
                <h5 class="text-dark">2 Домашний адрес</h5>
                <p class="pt-2 text-dark">3 Данные для выхода</p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>