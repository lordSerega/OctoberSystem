<?php


include '../php/action.php';

ini_set('display_errors', 'Off');

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Личная карта|Стоматологическая клиника Октябрь</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link href="../css/sb-admin-2.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary ">
  <nav class="navbar navbar-expand-lg navbar-dark  bg-dark">
  <a class="navbar-brand" href="#">АИС Октябрь</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Главная <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="card.php">Информация о приемах</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="record/chooseDoctor.php">Запись к врачу</a>
      </li>

    </ul>
    <form class="form-inline my-2 my-lg-0">
         <a class="nav-link disabled" href="#">Вы вошли как: <?=$_SESSION['usernameUser'];?></a>
            <a class="btn btn-primary" href="../logout.php">Завершить сеанс</a>
    </form>
  </div>
</nav>


    <div class="container bg-light mt-5 mb-5 card p-5">

        <div class="row ">
            <div class="col-xl-12">
                <h1 class="text-center">Личная карточка пациента</h1>
              <p class="lead text-center"> Для изменения данных необходимо обратиться в регистратуру клиники.</p>

                <hr>



                                <h1>1. Данные пациента</h1>

                                <form class="pl-3">

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Гражданство</p>
                                        </label>
                                        <div class="col-xl- pl-0">
                                            <select class="form-control" readonly  name="grah" required>
                                                <option  value="РФ" <?php echo selected($_SESSION['pacientGrah'], РФ); ?>>Гражданин РФ</option>
                                                <option  value="Иное"<?php echo selected($_SESSION['pacientGrah'], Иное); ?>>Иностранный гражданин</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Фамилия</p>
                                        </label>
                                        <div class="col-xl-8 pl-0">
                                            <input type="text" readonly value="<?= $_SESSION['pacientSurname'];?>" name="pacientFam" class="form-control" required> </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Имя</p>
                                        </label>
                                        <div class="col-xl-8 pl-0">
                                            <input type="text" value="<?= $_SESSION['pacientName'];?>"readonly name="pacientName" class="form-control" required> </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="inputEmail3"  class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Отчество</p>
                                        </label>
                                        <div class="col-xl-8 pl-0">
                                            <input type="text" name="pacientLast" value="<?= $_SESSION['pacientLastname'];?>" readonly class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Номер телефона</p>
                                        </label>
                                        <div class="col-xl-8 pl-0">
                                            <input type="text" name="mobileNumber" id="mobileNumber" value="<?= $_SESSION['pacientTel'];?>" readonly class="form-control required">

                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Дата рождения</p>
                                        </label>
                                        <div class="col-xl-3 pl-0">
                                            <input type="date" class="form-control" name="dateOfBirth" placeholder="Дата" value="<?= $_SESSION['pacientDateOfBirth'];?>" readonly required">
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Пол</p>
                                        </label>
                                        <div class="col-xl-3 pl-0">
                                            <select class="form-control" readonly  name="gender" required>
                                                <option value="М" <?php echo selected($_SESSION['pacientGender'], М); ?>>Мужской</option>
                                                <option value="Ж"<?php echo selected($_SESSION['pacientGender'], Ж); ?>>Женский</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <h3>Паспортные данные</h3>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Паспорт</p>
                                        </label>
                                        <div class="col-xl-8 pl-0">
                                            <div class="form-inline pl-0">
                                                <div class="input-group  col-xl-4 pl-0">
                                                    <div class="input-group-prepend pl-0">
                                                        <div class="input-group-text">серия</div>
                                                    </div>
                                                    <input type="text" class="form-control" id="paspotSeriya" name="paspotSeriya" value="<?= $_SESSION['pacientPasportSeriya'];?>" readonly placeholder="" required>
                                                </div>
                                                <div class="input-group col-xl-5 pl-0">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">№</div>
                                                    </div>
                                                    <input type="text" class="form-control" id="paspotNomer" name="paspotNomer" value="<?= $_SESSION['pacientPasportNomer'];?>" readonly placeholder=""required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="inputEmail3" class="col-xl-4 pl-0 col-form-label ">
                                            <p class="h5">Кем выдан</p>
                                        </label>
                                        <div class="col-xl-8 pl-0">
                                            <input type="text" value="<?= $_SESSION['pacientPasportKem'];?>" readonly name="pasportKem" class="form-control" required> </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Дата выдачи</p>
                                        </label>
                                        <div class="col-xl-8 pl-0">
                                            <div class="form-inline pl-0">
                                                <div class="input-group  col-xl-4 pl-0">
                                                    <input type="date" class="form-control" value="<?= $_SESSION['pacientPasportDate'];?>" readonly name="pasportDate" placeholder="Дата" required>
                                                </div>
                                                <div class="input-group col-xl-8 pl-0">
                                                    <p class="h5 pt-2 pl-2 pr-3">Код подразделения</p>
                                                    <input type="text" class="form-control " value="<?= $_SESSION['pacientPasportCode'];?>" readonly id="pasportCode" name="pasportCode" placeholder="" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">СНИЛС</p>
                                        </label>
                                        <div class="col-xl-3 pl-0">
                                            <input id="snils" value="<?= $_SESSION['pacientSNILS'];?>" readonly type="text" name="snils" class="form-control" required> </div>
                                    </div>
                                    <div class="form-group row ">
                                        <h3>Медицинский полис</h3>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Номер</p>
                                        </label>
                                        <div class="col-xl-8 pl-0">
                                            <input type="text"  value="<?= $_SESSION['pacientPolisNumber'];?>"  readonly name="polisNomer" id="polisNomer" class="form-control" required> </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Страховая компания</p>
                                        </label>
                                        <div class="col-xl-8 pl-0">
                                            <select class="form-control"  readonly name="polisOrg" required>
                                                <option value="1" <?php echo selected($_SESSION['pacientPolisCode'], 1); ?> >ООО МСО «Панацея»</option>
                                                <option value="2" <?php echo selected($_SESSION['pacientPolisCode'], 2); ?>>Ростовский филиал АО «МАКС-М»</option>
                                                <option value="3"<?php echo selected($_SESSION['pacientPolisCode'], 3); ?>>Ростовский филиал АО Страховая компания СОГАЗ-Мед</option>
                                                <option value="4"<?php echo selected($_SESSION['pacientPolisCode'], 4); ?>>Филиал ООО «Капитал МС» в Ростовской области</option>
                                                <option value="5"<?php echo selected($_SESSION['pacientPolisCode'], 5); ?>>ООО «АльфаСтрахование-ОМС» филиал «АсСтра»</option>
                                                <option value="6"<?php echo selected($_SESSION['pacientPolisCode'], 6); ?>>Иная</option>
                                            </select>
                                            <xlall id="emailHelp" class="form-text text-muted">Бесплатное лечение предоставляется только при наличии полиса страховой компании из выпадающего списка. Если Вашей страховой компании нет в списке, выберите пункт «Иная».</xlall>
                                        </div>
                                    </div>


                                </form>

                                <h1>2. Домашний адрес</h1>

                                <h3>Фактический адрес проживания</h3>

                                <form class="pl-3" method="POST" action="../php/action.php">
                                    <div class="form-group row pt-3 ">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Страна</p>
                                        </label>
                                        <div class="col-xl-8">
                                             <input type="text" value="<?= $_SESSION['pacientCountry'];?>" readonly name="country" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row  ">
                                        <label for="inputEmail3" readonly class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Населённый пукнт</p>
                                        </label>
                                        <div class="col-xl-8">
                                             <input type="text" readonly value="<?= $_SESSION['pacientCity'];?>" name="city" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row  ">
                                        <label for="inputEmail3" readonly class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Улица</p>
                                        </label>
                                        <div class="col-xl-8">
                                             <input type="text"readonly name="street" value="<?= $_SESSION['pacientStreet'];?>"  class="form-control" required>
                                        </div>
                                    </div>

                                        <div class="form-group row  ">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Дом</p>
                                        </label>
                                        <div class="col-xl-8">
                                             <input type="text" readonly name="house" value="<?= $_SESSION['pacientHouse'];?>" class="form-control" required>
                                        </div>
                                    </div>
                                        <div class="form-group row  ">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Квартира</p>
                                        </label>
                                        <div class="col-xl-8">
                                             <input type="text" readonly value="<?= $_SESSION['pacientFlat'];?>" name="flat" class="form-control">
                                        </div>
                                    </div>



                                </form>

                                <h1>3. Данные для входа</h1>

                                <h3>Смена пароля</h3>
                                <form class="pl-3" method="POST" action="../php/action.php" id="form-data">
                                    <div class="form-group row pt-3 ">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Логин</p>
                                        </label>
                                        <div class="col-xl-8">
                                            <input type="text" value="<?= $_SESSION['usernameUser'];?>" readonly name="login" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row pt-3 ">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Email</p>
                                        </label>
                                        <div class="col-xl-8">
                                            <input type="Email" readonly value="<?= $_SESSION['pacientEmail'];?>" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pt-3 ">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Пароль</p>
                                        </label>
                                        <div class="col-xl-8">
                                            <input type="password" name="pass" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pt-3 ">
                                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                                            <p class="h5">Подтвердите пароль</p>
                                        </label>
                                        <div class="col-xl-8">
                                            <input type="password" name="pass2" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <input type="submit" name="step3" id="step3" class="btn btn-primary" value="Сменить пароль">
                                    </div>
                                </form>

            </div>




        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../js/jquery.maskedinput.js"></script>
    <script>
    jQuery(function($) {
        //создания своего специального символа для маски
        $("#paspotSeriya").mask("99 99");
        $("#paspotNomer").mask("999999");
        $("#pasportCode").mask("999-999");
        $("#snils").mask("999-999-999 99");
        $("#polisNomer").mask("9999999999999999");
        $("#mobileNumber").mask("+7 (999) 999-99-99");
    });
    </script>
</body>

</html>
