<?php
include 'php/action.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Стоматологическая клиника ОКТЯБРЬ - Вход</title>

  <!-- Custom fonts for this template-->
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.css" rel="stylesheet">


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


</head>

<body class="bg-black">

   <audio autoplay>
    <source src="audio/music.ogg" type='audio/ogg; codecs=vorbis'>
    <source src="audio/music.mp3" type="audio/mpeg">
    Тег audio не поддерживается вашим браузером. <a href="audio/music.mp3">Скачайте музыку</a>.
   </audio>

  <div class="container pt-5">



  <h1 class="text-center text-light">Автоматизированная информационная система</h1>
      <h2 class="text-center text-light">ООО "ОКТЯБРЬ"</h2>
      <hr>

      <h4 class="text-center text-light">Выберите подходящий уровень доступа, чтобы воспользоваться системой.</h4>
      <div class="row justify-content-center">
        <div class="col-xl-12 text-center">
          <video width="500" height="400" autoplay loop>
    <source src="video/snowman.ogv" type='video/ogg; codecs="theora, vorbis"'>
    <source src="video/snowman.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
    <source src="video/snowman.webm" type='video/webm; codecs="vp8, vorbis"'>
    
  </video>
        </div>
      </div>


    <div class="row justify-content-center mt-5">



      <div class="  col-xl-4  bg-light">
        <p class="lead  text-center">Пациент</p>
      <button type="button" class="btn btn-light btn-lg btn-block"><a href="login.php">Перейти</a></button>

      </div>
      <div class=" col-xl-4  bg-light"><p class="lead text-center">Врач</p>
      <button type="button" class="btn btn-light btn-lg btn-block"><a href="doctor/login.php">Перейти</a></button></div>

      <div class=" col-xl-4  bg-light"><p class="lead text-center">Администратор</p>
      <button type="button" class="btn btn-light btn-lg btn-block"><a href="admin/login.php">Перейти</a></button></div>
    </div>

  </div>



    <script type="text/javascript">
    $(document).ready(function() {
        $('#loginform').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: '../php/action.php',
                data: $(this).serialize(),
                success: function(response)
                {
                    var jsonData = JSON.parse(response);

                    // user is logged in successfully in the back-end
                    // let's redirect
                    if (jsonData.success == "1")
                    { const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 9000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: 'success',
    title: 'Сегодня вы выглядите прекрасно :)'
  })

  setTimeout(
  () => {
    location.href = 'user/index.php';
  },
  2 * 1000
);

  
                    }
                    else
                    {
                      Swal.fire({
                        icon: 'error',
                        title: 'Ой-ей...',
                        text: 'Кажется, вы ввели неверный логин или пароль! Либо ваш аккаунт еще не активирован.',
                        confirmButtonText: 'Давайте я попробую еще раз :)',
                        footer: '<a href>Не помните пароль?</a>'
                      })
                    }
               }
           });
         });
    });
    </script>



</body>

</html>
