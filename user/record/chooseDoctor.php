<?php
	include 'config.php';
	require 'clandarAction.php';?>
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

<body class="bg-gradient-primary">
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

    <?php 
				if ($update == true):
			?>

			<div class="container  bg-light mt-5 mb-5 card p-5">

            <?php
            $searchSpec = $conn->query("SELECT название from врач_специальность WHERE кодВрачСпец= $id") or die($conn->error);
            $result = $searchSpec->fetch_array();
            $nameSpec = $result['название'];
	        ?>

				<h3>Выбор врача по специальности <strong><?php echo  $nameSpec;?></strong> </h3>

	<?php
		$result = $conn->query("SELECT * from врач WHERE специальность= $id") or die($conn->error);
	?>

	<div class="row justify-content-center">
		<table class="table">
			<thead>
				<tr>
					<th>фамилия</th>
					<th>имя</th>
					<th>отчество</th>
					<th colspan="1">Действие</th>
				</tr>
			</thead>
				<?php while($row =$result->fetch_assoc()): ?>
					<tr>
						<td><?php echo $row['фамилия']; ?></td>
						<td><?php echo $row['имя']; ?></td>
                        <td><?php echo $row['отчество']; ?></td>
                        <td><form action="calendar.php" method="POST">	
						<input type="hidden" name="codeDoctor" class="form-control" value="<?php echo $row['кодВрача']; ?>">
						<button type="submit" class="btn btn-success1" name="selectedAll">Выбрать</button>
						</form>							
						</td>
					</tr>
				<?php endwhile; ?>
		</table>
	</div>



			<?php 
				else:
			?>

	
	<div class="container  bg-light mt-5 mb-5 card p-5">

	<?php
		
		$result = $conn->query("SELECT * FROM врач_специальность") or die($conn->error);
	?>
 <h3>Выбор специализации</h3>
	<div class="row justify-content-center">
   
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Название</th>
					<th colspan="1">Действие</th>
				</tr>
			</thead>
				<?php while($row =$result->fetch_assoc()): ?>
					<tr>
						<td><?php echo $row['название']; ?></td>
				
						<td>
							<a href="chooseDoctor.php?specialisation=<?php echo $row['кодВрачСпец']; ?>" class="btn btn-success1">Выбрать</a>

						</td>
					</tr>
				<?php endwhile; ?>
		</table>
	</div>
	<?php 
				endif;
			?>
    

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../js/jquery.maskedinput.js"></script>
</body>
</html>