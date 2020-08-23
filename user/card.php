<?php

  	require_once '../php/action.php';
    require_once '../php/process.php';



?>



<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Список приемов|Стоматологическая клиника Октябрь</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/af-2.3.4/b-1.6.1/b-print-1.6.1/datatables.min.css"/>

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
      <li class="nav-item">
        <a class="nav-link" href="index.php">Главная</a>
      </li>
      <li class="nav-itema active">
        <a class="nav-link" href="card.php">Текущие приемы</a>
      </li>
    <li class="nav-itema ">
        <a class="nav-link" href="cardold.php">История</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="record/chooseDoctor.php">Запись к врачу</a>
      </li>

    </ul>
    <form class="form-inline my-2 my-lg-0">
        <input type="hidden" value="<?=$_SESSION['usernameUser'];?>" id="getUsername">
         <a class="nav-link disabled" href="#">Вы вошли как: <?=$_SESSION['usernameUser'];?></a>
            <a class="btn btn-primary" href="../../logout.php">Завершить сеанс</a>
    </form>
  </div>
</nav>



    <div class="container bg-light mt-5 mb-5 card p-5">
      <div class="row pb-3">
        <div class="col-lg-6">
             <h1>Список запланированных приемов</h1>
        </div>
             <div class="col-lg-6">
                <a href="../php/process.php?export=excel" class="btn btn-success m-1 float-right"><i class="fas fa-table fa-lg"></i>&nbsp;&nbsp;Экспортировать в Excel</a>
            </div>
      </div>
      <hr class="my-1">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive" id="showZap">
                    <h3 class="text-center text-success" style="margin-top:150px;"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                        <span class="sr-only">Загрузка...</span></h3>
                </div>
            </div>
        </div>

    </div>

    <!-- Изменение записи в модальном окне -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Изменение записи</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="post" id="edit-form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <input type="text" name="sname" class="form-control" id="sname" required="">
                        </div>
                        <div class="form-group">
                            <input type="text" name="fname" class="form-control" id="fname" required="">
                        </div>
                        <div class="form-group">
                            <input type="text" name="lname" class="form-control" id="lname" required="">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Специальность</label>
                            </div>
                            <select class="custom-select"  name="spec" id="spec">
                                <option value="2">Терапевт</option>
                                <option value="3">Ортодонт</option>
                                <option value="4">Ортопед</option>
                                <option value="5">Пародонтолог</option>
                                <option value="1">Хирург</option>
                                <option value="6">Зубной техник</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" name="login" class="form-control" id="login" required="">
                        </div>

                        <div class="form-group">
                            <input type="passwod" name="pass" class="form-control" id="pass" required="">
                        </div>

                        <div class="form-group">
                            <input type="submit" name="update" id="update" value="Изменить запись" class="btn btn-primary btn-block">
                        </div>
                    </form>
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
    var getUsername = document.getElementById("getUsername").value;
            $.ajax({
                url: "../php/process.php",
                type: "POST",
                data: { action: "showZap",
                getUsername: getUsername},
                success: function(response) {
                    //console.log(response);
                    $("#showZap").html(response);
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
                url: "../php/process.php",
                type: "POST",
                data: { edit_id: edit_id },
                success: function(response) {
                    data = JSON.parse(response);
                    $("#id").val(data.кодВрача);
                    $("#sname").val(data.имя);
                    $("#fname").val(data.фамилия);
                    $("#lname").val(data.отчество);
                    $("#spec").val(data.кодВрачСпец);
                    $("#login").val(data.логин);
                    $("#pass").val(data.пароль);
                }
            });

        });



        //запрос на удаление ajax

        $("body").on("click", ".delBtn", function(e) {
            e.preventDefault();
            var tr = $(this).closest('tr');
            del_idBron = $(this).attr('id');
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
                        url: "../php/process.php",
                        type: "POST",
                        data: { del_idBron: del_idBron },
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

        $('#myTable').DataTable( {
    buttons: [
        'print'
    ]
} );
        
    });
    </script>
</body>

</html>