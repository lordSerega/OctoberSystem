<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
	session_start();

	require_once 'db.php';

	$db = new Database();
	$step1 = true;

	function selected($var, $value){
	if (!is_array($var)) {
		$var = explode(',', $var);
	}
	return (in_array($value, $var)) ? ' selected' : '';

	}

	if(isset($_POST['edit_id'])){
		$id = $_POST['edit_id'];
		
		$row = $db->getPacientById($id);
		echo json_encode($row);

	}

		if(isset($_POST['act_id'])){

		$id = $_POST['act_id'];

		$db->activePacient($id); 
	
		 }

		if(isset($_POST['del_id'])){
		$id = $_POST['del_id'];
		$db->deletePacient($id); 
		 }


		if(isset($_POST['action']) && $_POST['action'] == "completeZapis"){

		$id = $_POST['id'];
		$comment = $_POST['comment'];

	

		$db->completeDoctorZap($id,$comment);

		}



		if(isset($_POST['action']) && $_POST['action'] == "updatePasport"){

		$id = $_POST['id3'];
		$pasportSeriya = $_POST['pasportSeriya'];
		$pasportNomer = $_POST['pasportNomer'];
		$pasportKem = $_POST['pasportKem'];
		$pasportDate = $_POST['pasportDate'];
		$pasportCode = $_POST['pasportCode'];
	

		$db->updatePasport($id,$pasportSeriya,$pasportNomer,$pasportKem,$pasportDate,$pasportCode);

		}




		if(isset($_POST['action']) && $_POST['action'] == "updatePolis"){
		$id = $_POST['id4'];
		$polisOrg = $_POST['polisOrg'];
		$polisNomer = $_POST['polisNomer'];


		$db->updatePolis($id,$polisOrg,$polisNomer);

	}




		if(isset($_POST['action']) && $_POST['action'] == "updateOsnova"){
		$id = $_POST['id'];
		$pacientSurname = $_POST['pacientSurname'];
		$pacientName = $_POST['pacientName'];
		$pacientLast = $_POST['pacientLast'];
		$pacientGender = $_POST['pacientGender'];
		$pacientBirth = $_POST['pacientBirth'];
		$pacientSnils = $_POST['pacientSnils'];
		$pacientTel = $_POST['pacientTel'];
		$pacientGrah = $_POST['pacientGrah'];
		$pacientEmail = $_POST['pacientEmail'];

		$db->updateOsnova($id,$pacientSurname,$pacientGrah,$pacientName,$pacientLast,$pacientGender,$pacientBirth,$pacientSnils,$pacientTel,$pacientEmail);

	}


	if(isset($_POST['action']) && $_POST['action'] == "updateMesto"){
		$id = $_POST['id2'];
		$pacientCountry = $_POST['pacientCountry'];
		$pacientCity = $_POST['pacientCity'];
		$pacientStreet = $_POST['pacientStreet'];
		$pacientHouse = $_POST['pacientHouse'];
		$pacientFlat = $_POST['pacientFlat'];


		$db->updateMesto($id,$pacientCountry,$pacientCity,$pacientStreet,$pacientHouse,$pacientFlat);

	}


		if(isset($_POST['action']) && $_POST['action'] == "showPacientNotActive"){
		$output = '';
		$data = $db->showPacientNotActive();
		if($db->totalRowCount()>0){
			$output .= '<table class="table table-striped table-sm table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>фамилия</th>
                                <th>имя</th>
                                <th>отчество</th>
                                <th>дата р</th>
                                <th>снилс</th>
                                <th>теле</th>
                                <th>email</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($data as $row) {
        	$output .= '<tr class="text-center text-secondary">
        		<td>'.$row['кодПациента'].'</td>
        		<td>'.$row['фамилия'].'</td>
        		<td>'.$row['имя'].'</td>
        		<td>'.$row['отчество'].'</td>
        		<td>'.$row['датаРождения'].'</td>
        		<td>'.$row['снилс'].'</td>
        		<td>'.$row['мобТелефон'].'</td>
        		<td>'.$row['email'].'</td>
        		 <td>
	                <a href="" title="Активировать" id="'.$row['кодПациента'].'" class="text-success activeBtn">
	                <i class=" fa fa-check fa-lg" >
	               </i></a>&nbsp;&nbsp;
	                <a href="" title="Удалить" class="text-danger delBtn" id="'.$row['кодПациента'].'" ><i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;&nbsp;
                </td> </tr>';
        }

        $output .= '</tbody></table>';
        echo $output;

		}
		else {
			echo '<h3 class="text-center text-secondary mt-5"> :( В базе данных нет записей!</h3>';
		}
	}



	






	if(isset($_POST['action']) && $_POST['action'] == "view"){
		$output = '';
		$data = $db->read();
		if($db->totalRowCount()>0){
			$output .= '<table class="table table-striped table-sm table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>фамилия</th>
                                <th>имя</th>
                                <th>отчество</th>
                     
                                <th>дата р</th>
                                <th>снилс</th>
                                <th>теле</th>
                 
                                <th>email</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($data as $row) {
        	$output .= '<tr class="text-center text-secondary">
        		<td>'.$row['кодПациента'].'</td>
        		<td>'.$row['фамилия'].'</td>
        		<td>'.$row['имя'].'</td>
        		<td>'.$row['отчество'].'</td>

        		<td>'.$row['датаРождения'].'</td>
        		<td>'.$row['снилс'].'</td>
        		<td>'.$row['мобТелефон'].'</td>
  
        		<td>'.$row['email'].'</td>
        		 <td>
	                <a href="pacient-detail.php?details='.$row['кодПациента'].'" title="Подробнее" class="text-success infoBtn"><i class="fas fa-info-circle fa-lg" id="'.$row['кодПациента'].'"></i></a>&nbsp;&nbsp;

	                <a href="" title="Редактировать" class="text-primary editBtn" data-toggle="modal" data-target="#editModal" id="'.$row['кодПациента'].'"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;

	                <a href="" title="Удалить" class="text-danger delBtn" id="'.$row['кодПациента'].'" ><i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;&nbsp;
                </td> </tr>';
        }

        $output .= '</tbody></table>';
        echo $output;

		}
		else {
			echo '<h3 class="text-center text-secondary mt-5"> :( В базе данных нет записей!</h3>';
		}
	}






if (isset($_POST['username']) && $_POST['username'] && isset($_POST['password']) && $_POST['password']) {

    $username= $_POST['username'];
    $password= $_POST['password'];

		$_SESSION['username']= $username;

	$db->adminLogin($username,$password);



}

if (isset($_POST['usernameDoctor']) && $_POST['usernameDoctor'] && isset($_POST['passwordDoctor']) && $_POST['passwordDoctor']) {

    $username= $_POST['usernameDoctor'];
    $password= $_POST['passwordDoctor'];

		$_SESSION['usernameDoctor']= $username;

	$db->doctorLogin($username,$password);



}


if (isset($_POST['usernameUser']) && $_POST['usernameUser'] && isset($_POST['passwordUser']) && $_POST['passwordUser']) {

    $usernameUser= $_POST['usernameUser'];
    $passwordUser= $_POST['passwordUser'];

		$_SESSION['usernameUser']= $usernameUser;

	$db->userLogin($usernameUser,$passwordUser);



}




if(isset($_POST['step1'])){


    $_SESSION['dateOfReg']=$_POST['dateOfReg'];
    $_SESSION['grah']=$_POST['grah'];
    $_SESSION['pacientFam']=$_POST['pacientFam'];
    $_SESSION['pacientName']=$_POST['pacientName'];
    $_SESSION['pacientLast']=$_POST['pacientLast'];
    $_SESSION['mobileNumber']=$_POST['mobileNumber'];
    $_SESSION['dateOfBirth']=$_POST['dateOfBirth'];
    $_SESSION['gender']=$_POST['gender'];
    $_SESSION['paspotSeriya']=$_POST['paspotSeriya'];
    $_SESSION['paspotNomer']=$_POST['paspotNomer'];
    $_SESSION['pasportKem']=$_POST['pasportKem'];
    $_SESSION['pasportDate']=$_POST['pasportDate'];
    $_SESSION['pasportCode']=$_POST['pasportCode'];
    $_SESSION['snils']=$_POST['snils'];
    $_SESSION['polisNomer']=$_POST['polisNomer'];
    $_SESSION['polisOrg']=$_POST['polisOrg'];

    $db->checkStep1($_SESSION['mobileNumber'],$_SESSION['snils']);

	}


if(isset($_POST['step2'])){

	 $_SESSION['country']=$_POST['country'];
	 $_SESSION['city']=$_POST['city'];
	 $_SESSION['street']=$_POST['street'];
	 $_SESSION['house']=$_POST['house'];
	 $_SESSION['flat']=$_POST['flat'];

	 header('location:../registration/step3.php');

	}

if(isset($_POST['step3'])) {
	 $_SESSION['login']=$_POST['login'];
	 $_SESSION['email']=$_POST['email'];
	 $_SESSION['pass']=$_POST['pass'];
	 $_SESSION['pass2']=$_POST['pass2'];


    if ($_SESSION['pass']==$_SESSION['pass2']){
        $db->checkLogin($_SESSION['login'],$_SESSION['pacientFam'], $_SESSION['pacientName'],$_SESSION['pacientLast'], $_SESSION['gender'],$_SESSION['dateOfBirth'], $_SESSION['snils'],$_SESSION['mobileNumber'], $_SESSION['grah'],$_SESSION['email'], $_SESSION['paspotSeriya'],$_SESSION['paspotNomer'], $_SESSION['pasportKem'],$_SESSION['pasportDate'], $_SESSION['pasportCode'],$_SESSION['polisNomer'],$_SESSION['polisOrg'],$_SESSION['country'], $_SESSION['city'],$_SESSION['street'], $_SESSION['house'], $_SESSION['flat'],$_SESSION['pass'],$_SESSION['dateOfReg']);

    } else {
        $_SESSION['response'] = "Пароли не совпадают";
        $_SESSION['res_type'] = "danger";
        header('location:../registration/step3.php');
    }

	}


?>
