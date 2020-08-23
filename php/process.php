<?php


	require_once 'db.php';
	$db = new Database();


		if(isset($_GET['details'])){
			$id=$_GET['details'];
		}








		if(isset($_POST['del_idBron'])){
		$id = $_POST['del_idBron'];
		
		$db->deleteZap($id);
	


	}

	if(isset($_POST['action']) && $_POST['action'] == "showOldDoctor"){
		$output = '';
		$docID = $_POST['getUsernameDoctor'];

		$data = $db->readOldDoc($docID);
		if($db->totalRowCountDoctor()>0){
			$output .= '<table class="table table-striped table-sm table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Дата</th>
                                <th>Время</th>
                                <th>Пациент</th>
                             	 <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($data as $row) {
        	$output .= '<tr class="text-center text-secondary">
        		<td>'.$row['кодБрони'].'</td>
        		<td>'.$row['дата'].'</td>
        		<td>'.$row['таймслот'].'</td>
        		<td>'.$row['фамилия'].' '.$row['имя'].' '.$row['отчество'].'</td>
       
        		 <td>

	                <a href="" title="Редактировать" class="text-primary editBtn" data-toggle="modal" data-target="#editModal" id="'.$row['кодБрони'].'"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;

	              
                </td> </tr>';
        }

        $output .= '</tbody></table>';
        echo $output;

		}
		else {
			echo '<h3 class="text-center text-secondary mt-5"> :( В базе данных нет записей!</h3>';
		}
	}






	if(isset($_POST['action']) && $_POST['action'] == "showZapDoctor"){
		$output = '';
		$docID = $_POST['getUsernameDoctor'];

		$data = $db->readZapDoc($docID);
		if($db->totalRowCountDoctor()>0){
			$output .= '<table class="table table-striped table-sm table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Дата</th>
                                <th>Время</th>
                                <th>Пациент</th>
                             	 <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($data as $row) {
        	$output .= '<tr class="text-center text-secondary">
        		<td>'.$row['кодБрони'].'</td>
        		<td>'.$row['дата'].'</td>
        		<td>'.$row['таймслот'].'</td>
        		<td>'.$row['фамилия'].' '.$row['имя'].' '.$row['отчество'].'</td>
       
        		 <td>

	                <a href="" title="Редактировать" class="text-primary editBtn" data-toggle="modal" data-target="#editModal" id="'.$row['кодБрони'].'"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;

	              
                </td> </tr>';
        }

        $output .= '</tbody></table>';
        echo $output;

		}
		else {
			echo '<h3 class="text-center text-secondary mt-5"> :( В базе данных нет записей!</h3>';
		}
	}


		if(isset($_POST['action']) && $_POST['action'] == "showOld"){
		$output = '';
		$pacID = $_POST['getUsername'];


		$data = $db->readOld($pacID);
		if($db->totalRowCountDoctor()>0){
			$output .= '<table class="table table table-striped table-sm table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Дата</th>
                                <th>Время</th>
                                <th>Врач</th>
                             	<th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($data as $row) {
        	$output .= '<tr class="text-center text-secondary">
        		<td>'.$row['кодБрони'].'</td>
        		<td>'.$row['дата'].'</td>
        		<td>'.$row['таймслот'].'</td>
        		<td><b>'.$row['название'].'</b> '.$row['фамилия'].' '.$row['имя'].' '.$row['отчество'].'</td>
       
        		 <td>
	               
	               <a href="" title="Посмотреть" class="text-primary editBtn" data-toggle="modal" data-target="#editModal" id="'.$row['кодБрони'].'"><i class="fas fa-info-circle fa-lg" id="'.$row['кодБрони'].'"></i></a>&nbsp;&nbsp;

	          
                </td> </tr>';
        }

        $output .= '</tbody></table>';
        echo $output;

		}
		else {
			echo '<h3 class="text-center text-secondary mt-5"> :( В базе данных нет записей!</h3>';
		}
	}









	if(isset($_POST['action']) && $_POST['action'] == "showZap"){
		$output = '';
		$pacID = $_POST['getUsername'];


		$data = $db->readZap($pacID);
		if($db->totalRowCountDoctor()>0){
			$output .= '<table class="table table-striped table-sm table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Дата</th>
                                <th>Время</th>
                                <th>Врач</th>
                             	 <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($data as $row) {
        	$output .= '<tr class="text-center text-secondary">
        		<td>'.$row['кодБрони'].'</td>
        		<td>'.$row['дата'].'</td>
        		<td>'.$row['таймслот'].'</td>
        		<td><b>'.$row['название'].'</b> '.$row['фамилия'].' '.$row['имя'].' '.$row['отчество'].'</td>
       
        		 <td>
	               

	                <a href="" title="Удалить" class="text-danger delBtn" id="'.$row['кодБрони'].'" ><i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;&nbsp;
                </td> </tr>';
        }

        $output .= '</tbody></table>';
        echo $output;

		}
		else {
			echo '<h3 class="text-center text-secondary mt-5"> :( В базе данных нет записей!</h3>';
		}
	}




		if(isset($_GET['action']) && $_GET['action'] == "viewPacientID"){
		$output = '';
		$pacID = $_GET['details'];

		$data = $db->readPacID($pacID);
		if($db->totalRowCountDoctor()>0){
			$output .= '<table class="table table-striped table-sm table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Дата</th>
                                <th>Время</th>
                                <th>Пациент</th>
                             	 <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($data as $row) {
        	$output .= '<tr class="text-center text-secondary">
        		<td>'.$row['кодБрони'].'</td>
        		<td>'.$row['дата'].'</td>
        		<td>'.$row['таймслот'].'</td>
        		<td>'.$row['фамилия'].' '.$row['имя'].' '.$row['отчество'].'</td>
       
        		 <td>
	               

	                <a href="" title="Удалить" class="text-danger delBtn" id="'.$row['кодБрони'].'" ><i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;&nbsp;
                </td> </tr>';
        }

        $output .= '</tbody></table>';
        echo $output;

		}
		else {
			echo '<h3 class="text-center text-secondary mt-5"> :( В базе данных нет записей!</h3>';
		}
	}






		if(isset($_GET['action']) && $_GET['action'] == "viewDoctorID"){
		$output = '';
		$doctorID = $_GET['details'];

		$data = $db->readDocotorID($doctorID);
		if($db->totalRowCountDoctor()>0){
			$output .= '<table class="table table-striped table-sm table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Дата</th>
                                <th>Время</th>
                                <th>Пациент</th>
                             	 <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($data as $row) {
        	$output .= '<tr class="text-center text-secondary">
        		<td>'.$row['кодБрони'].'</td>
        		<td>'.$row['дата'].'</td>
        		<td>'.$row['таймслот'].'</td>
        		<td>'.$row['фамилия'].' '.$row['имя'].' '.$row['отчество'].'</td>
       
        		 <td>
	               

	                <a href="" title="Удалить" class="text-danger delBtn" id="'.$row['кодБрони'].'" ><i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;&nbsp;
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
		$data = $db->readDocotor();
		if($db->totalRowCountDoctor()>0){
			$output .= '<table class="table table-striped table-sm table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Специальность</th>
                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Отчество</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($data as $row) {
        	$output .= '<tr class="text-center text-secondary">
        		<td>'.$row['кодВрача'].'</td>
        		<td>'.$row['название'].'</td>
        		<td>'.$row['фамилия'].'</td>
        		<td>'.$row['имя'].'</td>
        		<td>'.$row['отчество'].'</td>
        		 <td>
	                <a href="doctor-detail.php?details='.$row['кодВрача'].'" title="Подробнее" class="text-success infoBtn"><i class="fas fa-info-circle fa-lg" id="'.$row['кодВрача'].'"></i></a>&nbsp;&nbsp;

	                <a href="" title="Редактировать" class="text-primary editBtn" data-toggle="modal" data-target="#editModal" id="'.$row['кодВрача'].'"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;

	                <a href="" title="Удалить" class="text-danger delBtn" id="'.$row['кодВрача'].'" ><i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;&nbsp;
                </td> </tr>';
        }

        $output .= '</tbody></table>';
        echo $output;

		}
		else {
			echo '<h3 class="text-center text-secondary mt-5"> :( В базе данных нет записей!</h3>';
		}
	}

	if(isset($_POST['action']) && $_POST['action'] == "insert"){
		$sname = $_POST['sname'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$spec = $_POST['spec'];
		$login = $_POST['login'];
		$pass = $_POST['pass'];


		$db->insertDoctor($sname,$fname,$lname,$spec);
		$db->insertDoctorAuth($sname,$fname,$lname,$login,$pass);

	}

	if(isset($_POST['edit_Zav'])){
		$id = $_POST['edit_Zav'];
		
		$row = $db->getComplete($id);
		echo json_encode($row);


	}

		if(isset($_POST['edit_ZavOld'])){
		$id = $_POST['edit_ZavOld'];
		
		$row = $db->getCompleteOld($id);
		echo json_encode($row);


	}

		if(isset($_POST['showOldPac'])){
		$id = $_POST['showOldPac'];
		
		$row = $db->getCompleteOld($id);
		echo json_encode($row);


	}
	

		if(isset($_POST['edit_id'])){
		$id = $_POST['edit_id'];
		
		$row = $db->getDoctorById($id);
		echo json_encode($row);


	}



	if(isset($_POST['action']) && $_POST['action'] == "update"){
		$id = $_POST['id'];
		$sname = $_POST['sname'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$spec = $_POST['spec'];
		$login = $_POST['login'];
		$password = $_POST['pass'];
		$db->updateDoctor($id,$sname,$fname,$lname,$spec);
		$db->updateDoctorAuth($id,$login,$password);

	}

		if(isset($_POST['del_id'])){
		$id = $_POST['del_id'];
		
		$db->deleteDoctor($id);
	


	}


	if(isset($_GET['export']) && $_GET['export'] =="excel"){
		header("Content-Type: application/xls;charset=UTF-8");

		header("Content-Disposition: attachment; filename=ВрачиОктябрь.xls");
		header("Pragma: no-cache");
		header("Expires: 0");

		$data = $db->readDocotor();
		echo '<table border="1">';
		echo '<tr><th>#</th><th>Специальость</th><th>Фамилия</th><th>Имя</th><th>Отчетсво</th></tr>';

		foreach ($data as $row) {
			echo '<tr>
				<td>'.$row['кодВрача'].'</td>
				<td>'.$row['название'].'</td>
				<td>'.$row['фамилия'].'</td>
				<td>'.$row['имя'].'</td>
				<td>'.$row['отчество'].'</td>
			</tr>';
		}
		echo '</table>';

	}



?>