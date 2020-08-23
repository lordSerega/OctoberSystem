<?php
    include 'config.php';
    ini_set('display_errors', 'Off'); 

    if (isset($_POST['selectedAll'])){
    $doctor = $_POST['codeDoctor'];
    session_start();

    $_SESSION['doctor'] = $doctor;


}
   function build_calendar($month,$year){
        $conn = new mysqli("localhost","root","","diplom");
   
    $stmt = $conn->prepare("select * from бронь where MONTH(дата) = ? AND YEAR(дата) = ? AND врач= ?");
    $stmt->bind_param('sss', $month, $year, $doctor);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['date'];
            }
            
            $stmt->close();
        }

    }



    // Create array containing abbreviations of days of week.
    $daysOfWeek = array('Понедельник','Вторник','Среда','Четверг','Пятница','Суббота','Воскресенеье');

    // What is the first day of the month in question?
    $firstDayOfMonth = mktime(0,0,0,$month,7,$year);

    // How many days does this month contain?
    $numberDays = date('t',$firstDayOfMonth);

    // Retrieve some information about the first day of the
    // month in question.
    
    $dateComponents = getdate($firstDayOfMonth);

    // What is the name of the month in question?


    $monthName = $dateComponents['month'];
     if ($monthName == "January") {
        $monthName = "Январь";
     }
        if ($monthName == "February") {
        $monthName = "Февраль";
     }
        if ($monthName == "March") {
        $monthName = "Март";
     }
        if ($monthName == "April") {
        $monthName = "Апрель";
     }
             if ($monthName == "May") {
        $monthName = "Май";
     }
        if ($monthName == "June") {
        $monthName = "Июнь";
     }
        if ($monthName == "July") {
        $monthName = "Июль";
     }
        if ($monthName == "August") {
        $monthName = "Август";
     }
        if ($monthName == "September") {
        $monthName = "Сентябрь";
     }
        if ($monthName == "October") {
        $monthName = "Октябрь";
     }
             if ($monthName == "November") {
        $monthName = "Ноябрь";
     }

             if ($monthName == "December") {
        $monthName = "Декабрь";
     }

    // What is the index value (0-6) of the first day of the
    // month in question.
    $dayOfWeek = $dateComponents['wday'];

    // Create the table tag opener and day headers
    
   $datetoday = date('Y-m-d');
   
   
   
   $calendar = "<table class='table table-bordered'>";
   $calendar .= "<center><h2>$monthName $year</h2>";
   $calendar .= "<h2>   $doctor</h2>";

   $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month-1, 7, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 7, $year))."'>Прошлый месяц</a> ";
    
   $calendar.= " <a class='btn btn-xs btn-primary' href='?month=".date('m')."&year=".date('Y')."'>Текущий месяц</a> ";
   
   $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month+1, 7, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 7, $year))."'>Следующий месяц</a></center><br>";
     $calendar .= "<tr>";

    // Create the calendar headers

    foreach($daysOfWeek as $day) {
         $calendar .= "<th  class='header'>$day</th>";
    } 

    // Create the rest of the calendar

    // Initiate the day counter, starting with the 1st.

    $currentDay = 1;

    $calendar .= "</tr><tr>";

    // The variable $dayOfWeek is used to
    // ensure that the calendar
    // display consists of exactly 7 columns.

    if ($dayOfWeek > 0) { 
        for($k=0;$k<$dayOfWeek;$k++){
               $calendar .= "<td  class='empty'></td>"; 

        }
    }
   
    
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
 
    while ($currentDay <= $numberDays) {

         // Seventh column (Saturday) reached. Start a new row.

         if ($dayOfWeek == 7) {

              $dayOfWeek = 0;
              $calendar .= "</tr><tr>";

         }
         
         $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
         $date = "$year-$month-$currentDayRel";
         
          
         $dayname = strtolower(date('l', strtotime($date)));
         $eventNum = 0;
         $today = $date==date('Y-m-d')? "today" : "";
      if($date<date('Y-m-d')){
          $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>А нужно было раньше :)</button>";
       } else{
          $calendar.="<td class='$today'><h4>$currentDay </h4> <a href='book.php?date=".$date."' class='btn btn-success1 btn-xs'>Записаться</a>";
      }
         $calendar .="</td>";


         $currentDay++;
         $dayOfWeek++;

    }
    
    

    // Complete the row of the last week in month, if necessary

    if ($dayOfWeek != 7) { 
    
         $remainingDays = 7 - $dayOfWeek;
           for($l=0;$l<$remainingDays;$l++){
               $calendar .= "<td class='empty'></td>"; 

        }

    }
    
    $calendar .= "</tr>";

    $calendar .= "</table>";

    echo $calendar;


}
?>


<!DOCTYPE html>
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
        <div class="row">
            <div class="col-md-12">
            <?php
                     $dateComponents = getdate();
                     if(isset($_GET['month']) && isset($_GET['year'])){
                         $month = $_GET['month']; 			     
                         $year = $_GET['year'];
                     }else{
                         $month = $dateComponents['mon']; 			     
                         $year = $dateComponents['year'];
                     }
                    echo build_calendar($month,$year);
                ?>
            </div>
        </div>
    </div>
    
</body>
</html>