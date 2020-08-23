<?php

  	require_once '../php/action.php';

    if (!isset($_SESSION['username'])){
        header("location:index.php");
    }


?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Регистрация пациента|Стоматологическая клиника Октябрь</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/af-2.3.4/b-1.6.1/b-print-1.6.1/datatables.min.css"/>

    <link rel="stylesheet" href="../css/style.css">
    <link href="../css/sb-admin-2.css" rel="stylesheet">
</head>

<body class="bg-gradient-warning ">
  <nav class="navbar navbar-expand-lg navbar-dark  bg-dark">
  <a class="navbar-brand" href="#">АИС Октябрь </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="#">Главная</a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Пациенты<span class="sr-only">(current)</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item " href="pacient-all.php">Список всех пациентов</a>
          <a class="dropdown-item" href="pacient-activation.php">Активация пациентов</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Врачи
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="doctor-all.php">Список всех врачей</a>
          
          <div class="dropdown-divider"></div>

        </div>
      </li>
 

    </ul>
    <form class="form-inline my-2 my-lg-0">
         <a class="nav-link disabled" href="#">Вы вошли как: <?=$_SESSION['username'];?></a>
            <a class="btn btn-primary" href="logout.php">Завершить сеанс</a>
    </form>
  </div>
</nav>


    <div class="container bg-light mt-5 mb-5 card p-5">
      <h1>Список всех пациентов в клинике</h1>
             <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive" id="showPacient">
                    <h3 class="text-center text-success" style="margin-top:150px;"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                        <span class="sr-only">Загрузка...</span></h3>
                </div>
            </div>
        </div>  

    </div>

     <!-- Изменение записи в модальном окне -->
    <div class="modal fade " id="editModal">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Изменение информации пациента</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body px-4 ">
                  
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          Основная информация
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
          <form action="" method="post" id="edit-form-data">

                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="">Фамилия</label>
                            <input type="text" name="pacientSurname" class="form-control" id="pacientSurname" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Имя</label>
                            <input type="text" name="pacientName" class="form-control" id="pacientName" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Отчество</label>
                            <input type="text" name="pacientLast" class="form-control" id="pacientLast" required="">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Пол</label>
                            </div>
                            <select class="custom-select" name="pacientGender" id="pacientGender">
                                <option value="М">Мужской</option>
                                <option value="Ж">Женский</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Дата рождения</label>
                             <input type="date" class="form-control" id="pacientBirth" name="pacientBirth" placeholder="Дата" required>
                        </div>
                          <div class="form-group">
                            <label for="">СНИЛС</label>
                            <input type="text" name="pacientSnils" class="form-control" id="pacientSnils" required="">
                        </div>
                          <div class="form-group">
                            <label for="">Телефон</label>
                            <input type="text" name="pacientTel" class="form-control" id="pacientTel" required="">
                        </div>
                          <div class="form-group">
                            <label for="">Гражданство</label>
                            <select class="form-control"  name="pacientGrah" id="pacientGrah" required>
                                <option value="РФ">Гражданин РФ</option>
                                <option value="Иное">Иностранный гражданин</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="pacientEmail" class="form-control" id="pacientEmail" required="">
                        </div>
                               <div class="form-group">
                            <input type="submit" name="update" id="updateOsnova" value="Изменить" class="btn btn-primary btn-block">
                        </div>
                    </form>
      </div>
    </div>
  </div>




  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Место жительства
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <form action="" method="post" id="edit-form-data2">
                        <input type="hidden" name="id2" id="id2">
                        <div class="form-group">
                            <label for="">Страна</label>
                            <input type="text" name="pacientCountry" class="form-control" id="pacientCountry" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Населенный пункт</label>
                            <input type="text" name="pacientCity" class="form-control" id="pacientCity" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Улица</label>
                            <input type="text" name="pacientStreet" class="form-control" id="pacientStreet" required="">
                        </div>
                             <div class="form-group">
                            <label for="">Дом</label>
                            <input type="text" name="pacientHouse" class="form-control" id="pacientHouse" required="">
                        </div>
                             <div class="form-group">
                            <label for="">Квартира</label>
                            <input type="text" name="pacientFlat" class="form-control" id="pacientFlat" required="">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="updateMesto" id="updateMesto" value="Изменить" class="btn btn-primary btn-block">
                        </div>
                    </form>
      </div>
    </div>
  </div>




  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Паспорт
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        <form action="" method="post" id="edit-form-data-3">
                        <input type="hidden" name="id3" id="id3">
                        <div class="form-group">
                            <label for="">Серия</label>
                            <input type="text" name="pasportSeriya" class="form-control" id="pasportSeriya" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Номер</label>
                            <input type="text" name="pasportNomer" class="form-control" id="pasportNomer" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Кем выдан</label>
                            <input type="text" name="pasportKem" class="form-control" id="pasportKem" required="">
                        </div>
                             <div class="form-group">
                            <label for="">Дата выдачи</label>
                            <input type="date" class="form-control" id="pasportDate"  name="pasportDate" placeholder="Дата" required>
                        </div>
                             <div class="form-group">
                            <label for="">Код подразделения</label>
                            <input type="text" name="pasportCode" class="form-control" id="pasportCode" required="">
                        </div>
                          <div class="form-group">
                            <input type="submit" name="updatePasport" id="updatePasport" value="Изменить" class="btn btn-primary btn-block">
                        </div>
                    </form>

      </div>
    </div>
  </div>
    <div class="card">
    <div class="card-header" id="headingFour">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Полис
        </button>
      </h5>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
      <div class="card-body">
        <form action="" method="post" id="edit-form-data4">
                        <input type="hidden" name="id4" id="id4">
                        <div class="form-group">
                            <label for="">Страховая компания</label>
                            <select class="form-control"  name="polisOrg" id="polisOrg" required>
                                <option value="1">ООО МСО «Панацея»</option>
                                <option value="2" >Ростовский филиал АО «МАКС-М»</option>
                                <option value="3">Ростовский филиал АО Страховая компания СОГАЗ-Мед</option>
                                <option value="4">Филиал ООО «Капитал МС» в Ростовской области</option>
                                <option value="5">ООО «АльфаСтрахование-ОМС» филиал «АсСтра»</option>
                                <option value="6">Иная</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Номер</label>
                            <input type="text" name="polisNomer" class="form-control" id="polisNomer" required="">
                        </div>
                    
                       <div class="form-group">
                            <input type="submit" name="updatePolis" id="updatePolis" value="Изменить" class="btn btn-primary btn-block">
                        </div>
                    </form>
        

      </div>
    </div>
  </div>
</div>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/af-2.3.4/b-1.6.1/b-print-1.6.1/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
     <script type="text/javascript">
    $(document).ready(function() {

        showAllUsers();

        function showAllUsers() {
            $.ajax({
                url: "../php/action.php",
                type: "POST",
                data: { action: "view" },
                success: function(response) {
                    //console.log(response);
                    $("#showPacient").html(response);
                    $("table").DataTable({

                        "language": {
                            "processing": "Подождите...",
                            "search": "Поиск:",
                            "lengthMenu": "Показать _MENU_ записей",
                            "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                            "infoEmpty": "Записи с 0 до 0 из 0 записей",
                            "infoFiltered": "(отфильтровано из _MAX_ записей)",
                            "infoPostFix": "",
                            "loadingRecords": "Загрузка записей...",
                            "zeroRecords": "Записи отсутствуют.",
                            "emptyTable": "В таблице отсутствуют данные",
                            "paginate": {
                                "first": "Первая",
                                "previous": "Предыдущая",
                                "next": "Следующая",
                                "last": "Последняя"
                            },
                            "aria": {
                                "sortAscending": ": активировать для сортировки столбца по возрастанию",
                                "sortDescending": ": активировать для сортировки столбца по убыванию"
                            },
                            "select": {
                                "rows": {
                                    "_": "Выбрано записей: %d",
                                    "0": "Кликните по записи для выбора",
                                    "1": "Выбрана одна запись"
                                }
                            }
                        }
                    });
                }

            });
        }

         // Изменение данных

        $("body").on("click", ".editBtn", function(e) {
            e.preventDefault();
            edit_id = $(this).attr('id');
            $.ajax({
                url: "../php/action.php",
                type: "POST",
                data: { edit_id: edit_id },
                success: function(response) {
                    data = JSON.parse(response);
                    $("#id").val(data.кодПациента);
                    $("#id2").val(data.кодПациента);
                    $("#id3").val(data.кодПациента);
                    $("#id4").val(data.кодПациента);
                    $("#pacientSurname").val(data.фамилия);
                    $("#pacientGrah").val(data.гражданство);
                    $("#pacientName").val(data.имя);
                    $("#pacientLast").val(data.отчество);
                    $("#pacientGender").val(data.пол);
                    $("#pacientBirth").val(data.датаРождения);
                    $("#pacientSnils").val(data.снилс);
                    $("#pacientTel").val(data.мобТелефон);
                    $("#pacientEmail").val(data.email);
                    $("#pacientCountry").val(data.страна);
                    $("#pacientCity").val(data.населПункт);
                    $("#pacientStreet").val(data.улица);
                    $("#pacientHouse").val(data.дом);
                    $("#pacientFlat").val(data.квартира);
                    $("#polisOrg").val(data.кодПолисОрг);
                    $("#polisNomer").val(data.номер);
                    $("#pasportSeriya").val(data.паспортСерия);
                    $("#pasportNomer").val(data.паспортНомер);
                    $("#pasportKem").val(data.кемВыдан);
                    $("#pasportDate").val(data.датаВыдачи);
                    $("#pasportCode").val(data.кодПодразделения);
                  
                }
            });

        });



        // запрос на обновление записи ajax

        $("#updatePolis").click(function(e) {
            if ($("#edit-form-data4")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "../php/action.php",
                    type: "POST",
                    data: $("#edit-form-data4").serialize() + "&action=updatePolis",
                    success: function(response) {
                        Swal.fire({
                            title: 'Запись успешно изменена!',
                            icon: 'success',
                            type: 'success'
                        })
                        $("#editModal").modal('hide');
                        $("#edit-form-data4")[0].reset();
                        showAllUsers();

                    }
                });
            }
        });


        // запрос на обновление записи ajax

        $("#updateOsnova").click(function(e) {
            if ($("#edit-form-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "../php/action.php",
                    type: "POST",
                    data: $("#edit-form-data").serialize() + "&action=updateOsnova",
                    success: function(response) {
                        Swal.fire({
                            title: 'Запись успешно изменена!',
                            icon: 'success',
                            type: 'success'
                        })
                        $("#editModal").modal('hide');
                        $("#edit-form-data")[0].reset();
                        showAllUsers();

                    }
                });
            }
        });



          $("#updatePasport").click(function(e) {
            if ($("#edit-form-data-3")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "../php/action.php",
                    type: "POST",
                    data: $("#edit-form-data-3").serialize() + "&action=updatePasport",
                    success: function(response) {
                        Swal.fire({
                            title: 'Запись успешно изменена!',
                            icon: 'success',
                            type: 'success'
                        })
                        $("#editModal").modal('hide');
                        $("#edit-form-data-3")[0].reset();
                        showAllUsers();

                    }
                });
            }
        });

      $("#updateMesto").click(function(e) {
            if ($("#edit-form-data2")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "../php/action.php",
                    type: "POST",
                    data: $("#edit-form-data2").serialize() + "&action=updateMesto",
                    success: function(response) {
                        Swal.fire({
                            title: 'Запись успешно изменена!',
                            icon: 'success',
                            type: 'success'
                        })
                        $("#editModal").modal('hide');
                        $("#edit-form-data2")[0].reset();
                        showAllUsers();

                    }
                });
            }
        });







            //запрос на удаление ajax

        $("body").on("click", ".delBtn", function(e) {
            e.preventDefault();
            var tr = $(this).closest('tr');
            del_id = $(this).attr('id');
            Swal.fire({
                title: 'Вы уверены, что хотите удалить запись?',
                text: "Данное действие нельзя отменить!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Да, удалить!',
                cancelButtonText: 'Не удалять!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "../php/action.php",
                        type: "POST",
                        data: { del_id: del_id },
                        success: function(response) {
                            tr.css('background-color', '#ff6666');
                            Swal.fire(
                                'Удалено!',
                                'Запись успешно удалена!',
                                'success'
                            )
                            showAllUsers();
                        }

                    });

                }



            });



        });




        });


      </script>

</body>

</html>

