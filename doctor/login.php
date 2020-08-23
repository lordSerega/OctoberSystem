
<!DOCTYPE html>
<html lang="ru">

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

<body class="bg-gradient-light">



  <div class="container">

    <div class="row justify-content-center mt-5">

      <div class="col-xl-10 col-lg-12 col-md-9 mt-5">


        <div class="card o-hidden border-0 shadow-lg my-5 ">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image2"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Добро пожаловать!</h1>
                    <hr>
                    <h4 class="h5 text-gray-900 mb-4">Вход для врача клиники</h4>
                  </div>
                  <form class="user" method="post" id="loginform">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user"  id="usernameDoctor" name="usernameDoctor" aria-describedby="emailHelp" placeholder="Логин">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="passwordDoctor" name="passwordDoctor" placeholder="Пароль">
                    </div>
                        <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Запомнить меня</label>
                      </div>
                    </div>
                      <input type="submit" name="admin" id="loginBtn"  class="btn btn-primary btn-user btn-block" value="Войти">
                  </form>
                            <hr>
                  <div class="text-center">
                    <a class="small" href="">Забыли пароль? Обратитесь к администратору ^_^</a>
                  </div>
                  <div class="text-center">
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

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
    location.href = 'index.php';
  },
  2 * 1000
);

                  }
                  else
                  {
                    Swal.fire({
                      icon: 'error',
                      title: 'Ой-ей...',
                      text: 'Кажется, вы ввели неверный логин или пароль!',
                      confirmButtonText: 'Давайте я попробую еще раз :)',
                      footer: '<a href>Не помните пароль? Обратитесь к администратору!</a>'
                    })
                  }
             }
         });
       });
  });
  </script>





</body>

</html>
