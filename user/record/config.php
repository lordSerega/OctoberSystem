<?php
	$conn = new mysqli("localhost","root","","diplom");

	if($conn->connect_error){
		die("Невозможно подключиться к БД!".$conn->connect_error);
	}

	
?>