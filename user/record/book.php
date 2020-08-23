<?php
    include 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

 session_start();




if(isset($_GET['date'])){
    $date = $_GET['date'];


  
  
    $stmt = $conn->prepare("select * from бронь where дата = ? and врач = ?");
    $stmt->bind_param('ss', $date,$_SESSION['doctor']);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['таймслот'];
            }
            
            $stmt->close();
            
     
    }
    
}

}


if(isset($_POST['submit'])){


    $user = $_POST['user'];
    $timeslot = $_POST['timeslot'];

    $stmt = $conn->prepare("SELECT * from бронь where дата  = ? AND таймслот  = ? and врач = ?");
    echo $conn->error;

    $stmt->bind_param('sss', $date, $timeslot,$_SESSION['doctor']);

    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
        $msg = "<div class='alert alert-danger'>К сожалению, на это время уже записался другой пациент.</div>";
            
    } else {
    
        $searchClient = $conn->query("SELECT пациент FROM пациент_авторизация WHERE логин= '$user'") or die($conn->error);
        $rowS = $searchClient->fetch_array();
        $id = $rowS['пациент'];

        

        $stmt = $conn->prepare("INSERT INTO бронь (дата,пациент,таймслот,врач) VALUES (?,?,?,?)");
        $stmt->bind_param('ssss',  $date,$id, $timeslot, $_SESSION['doctor']);
        $stmt->execute();
        $msg = "<div class='alert alert-success'>Вы успешно записались на прием. Вскоре, с вами свяжется администратор для подтверждения записи.</div>";
        $bookings[]=$timeslot;
        $stmt->close();
        $conn->close();
        
    }
}

   
}



$duration = 30;
$cleanup = 0;
$start = "09:00";
$end = "20:00";


function timeslots($duration,$cleanup,$start,$end){
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT".$duration."M");
    $cleanupInterval = new DateInterval("PT".$cleanup."M");
    $slots = array();

    for($intStart =$start;$intStart<$end; $intStart->add($interval)->add($cleanupInterval)){
       $endPeriod = clone $intStart;
       $endPeriod->add($interval);
       if($endPeriod>$end){
       break;
       } 

       $slots[] = $intStart->format("H:i")."-".$endPeriod->format("H:i");
    }

    return $slots;
}

?>
<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Запись к врачу|Стоматологическая клиника Октябрь</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="../../css/sb-admin-2.css" rel="stylesheet">
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
        <a class="nav-link" href="../index.php">Главная</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../card.php">Информация о приемах</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="chooseDoctor.php">Запись к врачу</a>
      </li>

    </ul>
    <form class="form-inline my-2 my-lg-0">
         <a class="nav-link disabled" href="#">Вы вошли как: <?=$_SESSION['usernameUser'];?></a>
            <a class="btn btn-primary" href="../../logout.php">Завершить сеанс</a>
    </form>
  </div>
</nav>
    <div class="container  bg-light mt-5 mb-5 card p-5">
        <h1 class="text-center">Записаться на: <?php echo date('d/m/Y', strtotime($date)); ?></h1><hr>
        <div class="row">
        <div class="col-md-12">
        <?php
            echo isset($msg)?$msg:"";
            ?>
  
        </div>
        <?php
            $timeslots = timeslots($duration,$cleanup,$start,$end);
                foreach($timeslots as $ts){
        ?>
        <div class="col-md-2">
            <div class="form-group">
            <?php if(in_array($ts,$bookings)){ ?>

            <button class="btn btn-danger"><?php echo $ts; ?></button>
            <?php }else { ?>
            <button class="btn btn-success1 book" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>
            <?php } ?>

            
            </div>
        </div>
             <?php }?>
        </div>
    </div>

    <div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Запись на: <span id="slot"></span></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
        <div class="col-md-12">
        <form action="" method="post">
        <div class="form-group">
        <label for="">Время</label>
        <input type="text" readonly name="timeslot" id="timeslot" class="form-control">
        <div class="form-group">
                        <label for="">Пользователь</label>
                        <input type="text" readonly class="form-control" name="user" value="<?php echo  $_SESSION['usernameUser']; ?>">
                    </div>
                    
                    <button class="btn btn-primary" type="submit" name="submit">Записаться</button>
                    
        </div>
        </form>
        </div>
        </div>
      </div>



    </div>
  </div>
</div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../js/jquery.maskedinput.js"></script>
<script>
    $(".book").click(function(){
        var timeslot = $(this).attr('data-timeslot');
        $("#slot").html(timeslot);
        $("#timeslot").val(timeslot);
        
        $("#myModal").modal("show");


    })

</script>
  </body>

</html>
