<?php


include '../php/action.php';

ini_set('display_errors', 'Off');

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Регистрация пациента|Стоматологическая клиника Октябрь</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link href="../css/sb-admin-2.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary ">

    <div class="container bg-light mt-5 mb-5 card p-5">

        <div class="row ">
            <div class="col-12">
                <h1 class="text-center">Подача заявления на регистарцию</h1>
                <div class="row justify-content-center ">
                    <div class="col-lg-12 ">

                        <?php if(isset($_SESSION['response1'])) { ?>

                        <div class="alert alert-<?=$_SESSION['res_type1']; ?> alert-dismissible text-center">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?= $_SESSION['response1']; ?>
                        </div>
                        <b>
                            <?php } unset($_SESSION['response1']); ?></b>
                    </div>
                </div>
                <hr>
            </div>


            <div class="col-9 border-right ">

                <h1>1. Данные пациента</h1>

                <div class="alert alert-secondary" role="alert"> Заполните все поля, помеченные *, чтобы регистрация прошла успешна. При вводе паспортных данных будьте предельно внимательны, т.к. ошибка, допущенная в данных, может стать причиной отказа в регистрации вашего заявления. Если у вас имеется ИНН физического лица укажите его обязательно. </div>
                <h3>Дата подачи заявления на регистрацию</h3>
                <form class="pl-3" method="POST" action="../php/action.php">
                    <div class="form-group row pt-3 ">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">Дата подачи заявления<strong class="text-danger">*</strong></p>
                        </label>
                        <div class="col-xl-">
                            <input type="date" class="form-control" id="date" value="<?= $_SESSION['dateOfReg'];?>" name="dateOfReg" placeholder="Дата" required>
                        </div>
                        <p> Внимание! Указываемая дата должна быть раньше предполагаемой даты посещения клиники.</p>
                        <h3>Личные данные</h3>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">Гражданство<strong class="text-danger">*</strong></p>
                        </label>
                        <div class="col-xl- pl-0">
                            <select class="form-control"  name="grah" required>
                                <option value="РФ" <?php echo selected($_SESSION['grah'], 1); ?>>Гражданин РФ</option>
                                <option value="Иное"<?php echo selected($_SESSION['grah'], 2); ?>>Иностранный гражданин</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">Фамилия<strong class="text-danger">*</strong></p>
                        </label>
                        <div class="col-xl-8 pl-0">
                            <input type="text" value="<?=$_SESSION['pacientFam'];?>" name="pacientFam" class="form-control" required> </div>
                    </div>
                    <div class="form-group row ">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">Имя<strong class="text-danger">*</strong></p>
                        </label>
                        <div class="col-xl-8 pl-0">
                            <input type="text" value="<?=$_SESSION['pacientName'];?>" name="pacientName" class="form-control" required> </div>
                    </div>
                    <div class="form-group row ">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">Отчество</p>
                        </label>
                        <div class="col-xl-8 pl-0">
                            <input type="text" name="pacientLast" value="<?=$_SESSION['pacientLast'];?>" class="form-control">
                            <xlall id="emailHelp" class="form-text text-muted">Не заполняется только, если у вас его нет.</xlall>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">Номер телефона<strong class="text-danger">*</strong></p>
                        </label>
                        <div class="col-xl-8 pl-0">
                            <input type="text" name="mobileNumber" id="mobileNumber" value="<?=$_SESSION['mobileNumber'];?>" class="form-control required">

                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">Дата рождения<strong class="text-danger">*</strong></p>
                        </label>
                        <div class="col-xl-3 pl-0">
                            <input type="date" class="form-control" name="dateOfBirth" placeholder="Дата" value="<?=$_SESSION['dateOfBirth'];?> required">
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">Пол<strong class="text-danger">*</strong></p>
                        </label>
                        <div class="col-xl-3 pl-0">
                            <select class="form-control"  name="gender" required>
                                <option value="М" <?php echo selected($_SESSION['gender'], 1); ?>>Мужской</option>
                                <option value="Ж"<?php echo selected($_SESSION['gender'], 2); ?>>Женский</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <h3>Паспортные данные</h3>
                    </div>
                    <div class="form-group row ">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">Паспорт<strong class="text-danger">*</strong></p>
                        </label>
                        <div class="col-xl-8 pl-0">
                            <div class="form-inline pl-0">
                                <div class="input-group  col-xl-4 pl-0">
                                    <div class="input-group-prepend pl-0">
                                        <div class="input-group-text">серия</div>
                                    </div>
                                    <input type="text" class="form-control" id="paspotSeriya" name="paspotSeriya" value="<?=$_SESSION['paspotSeriya'];?>" placeholder="" required>
                                </div>
                                <div class="input-group col-xl-5 pl-0">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">№</div>
                                    </div>
                                    <input type="text" class="form-control" id="paspotNomer" name="paspotNomer" value="<?=$_SESSION['paspotNomer'];?>" placeholder=""required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="inputEmail3" class="col-xl-4 pl-0 col-form-label ">
                            <p class="h5">Кем выдан<strong class="text-danger">*</strong></p>
                        </label>
                        <div class="col-xl-8 pl-0">
                            <input type="text" value="<?=$_SESSION['pasportKem'];?>" name="pasportKem" class="form-control" required> </div>
                    </div>
                    <div class="form-group row ">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">Дата выдачи<strong class="text-danger">*</strong></p>
                        </label>
                        <div class="col-xl-8 pl-0">
                            <div class="form-inline pl-0">
                                <div class="input-group  col-xl-4 pl-0">
                                    <input type="date" class="form-control" value="<?=$_SESSION['pasportDate'];?>" name="pasportDate" placeholder="Дата" required>
                                </div>
                                <div class="input-group col-xl-8 pl-0">
                                    <p class="h5 pt-2 pl-2 pr-3">Код подразделения<strong class="text-danger">*</strong></p>
                                    <input type="text" class="form-control " value="<?=$_SESSION['pasportCode'];?>" id="pasportCode" name="pasportCode" placeholder="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">СНИЛС<strong class="text-danger">*</strong></p>
                        </label>
                        <div class="col-xl-3 pl-0">
                            <input id="snils" value="<?=$_SESSION['snils'];?>" type="text" name="snils" class="form-control" required> </div>
                    </div>
                    <div class="form-group row ">
                        <h3>Медицинский полис</h3>
                    </div>
                    <div class="form-group row ">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">Номер<strong class="text-danger">*</strong></p>
                        </label>
                        <div class="col-xl-8 pl-0">
                            <input type="text" value="<?=$_SESSION['polisNomer'];?>" name="polisNomer" id="polisNomer" class="form-control" required> </div>
                    </div>
                    <div class="form-group row ">
                        <label for="inputEmail3" class="col-xl-4 col-form-label pl-0">
                            <p class="h5">Страховая компания<strong class="text-danger">*</strong></p>
                        </label>
                        <div class="col-xl-8 pl-0">
                            <select class="form-control"  name="polisOrg" required>
                                <option value="1" <?php echo selected($_SESSION['polisOrg'], 1); ?> >ООО МСО «Панацея»</option>
                                <option value="2" <?php echo selected($_SESSION['polisOrg'], 2); ?>>Ростовский филиал АО «МАКС-М»</option>
                                <option value="3"<?php echo selected($_SESSION['polisOrg'], 3); ?>>Ростовский филиал АО Страховая компания СОГАЗ-Мед</option>
                                <option value="4"<?php echo selected($_SESSION['polisOrg'], 4); ?>>Филиал ООО «Капитал МС» в Ростовской области</option>
                                <option value="5"<?php echo selected($_SESSION['polisOrg'], 5); ?>>ООО «АльфаСтрахование-ОМС» филиал «АсСтра»</option>
                                <option value="6"<?php echo selected($_SESSION['polisOrg'], 6); ?>>Иная</option>
                            </select>
                            <xlall id="emailHelp" class="form-text text-muted">Бесплатное лечение предоставляется только при наличии полиса страховой компании из выпадающего списка. Если Вашей страховой компании нет в списке, выберите пункт «Иная».</xlall>
                        </div>
                    </div>
                    <div class="form-group form-check pl-0">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label" for="exampleCheck1">Нажимая кнопку «Сохранить и продолжить», я принимаю условия Пользовательского соглашения ООО «Октябрь» и даю своё согласие на обработку моих персональных данных на условиях и для целей, определенных Политикой конфиденциальности.</label>
                    </div>
                    <div class="form-group row ">
                        <input type="submit" name="step1" class="btn btn-primary" value="Сохранить и продолжить">
                    </div>
                </form>
            </div>
            <div class="col-3">
                <h5 class="pt-4 text-dark">Шаг 1. Данные пациента</h5>
                <p class="pt-2 text-dark">Шаг 2. Домашний адрес</p>
                <p class="text-dark">Шаг 3. Данные для выхода</p>
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
