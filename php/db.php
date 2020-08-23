<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


	class Database{
		private $dsn = "mysql:host=localhost;dbname=diplom";
		private $user = "root";
		private $pass = "";
		public $conn;
		public function __construct(){
			try{
				$this->conn = new PDO($this->dsn, $this->user, $this->pass);
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}


    public function readOldDoc($docID){
      $data = array();
      $sql = "SELECT
  бронь.кодБрони,
  бронь.дата,
  бронь.таймслот,
  пациент.фамилия,
  пациент.имя,
  пациент.отчество,
  бронь.заврешен,
  бронь.комментарий,
  врач_авторизация.логин
FROM врач_авторизация
  INNER JOIN врач
    ON врач_авторизация.врач = врач.кодВрача
  INNER JOIN бронь
    ON бронь.врач = врач.кодВрача
  INNER JOIN пациент
    ON бронь.пациент = пациент.кодПациента
WHERE бронь.заврешен = 1
AND врач_авторизация.логин = '$docID'";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
        $data[] = $row;
      }

      return $data;

    }




        public function completeDoctorZap($id,$comment){
      $sql = "UPDATE бронь SET  комментарий=:comment, заврешен =1 WHERE кодБрони =:id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'comment'=>$comment,
        'id'=>$id
      ]);
      return true;
    }

      public function getCompleteOld($id){

      $sql = "SELECT * FROM бронь WHERE кодБрони ='$id'";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id'=>$id]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result;
    }

    
    


      public function getComplete($id){

      $sql = "SELECT * FROM бронь WHERE кодБрони ='$id'";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id'=>$id]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result;
    }




    public function readZapDoc($docID){
      $data = array();
      $sql = "SELECT
  бронь.кодБрони,
  бронь.дата,
  бронь.таймслот,
  пациент.фамилия,
  пациент.имя,
  пациент.отчество,
  бронь.заврешен,
  бронь.комментарий,
  врач_авторизация.логин
FROM врач_авторизация
  INNER JOIN врач
    ON врач_авторизация.врач = врач.кодВрача
  INNER JOIN бронь
    ON бронь.врач = врач.кодВрача
  INNER JOIN пациент
    ON бронь.пациент = пациент.кодПациента
WHERE бронь.заврешен = 0
AND врач_авторизация.логин = '$docID'";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
        $data[] = $row;
      }

      return $data;

    }

public function readOld($pacID){
      $data = array();
      $sql = "SELECT
  бронь.кодБрони,
  бронь.дата,
  бронь.таймслот,
  врач.фамилия,
  врач.имя,
  врач.отчество,
  пациент_авторизация.логин,
  врач_специальность.название
FROM бронь
  INNER JOIN пациент
    ON бронь.пациент = пациент.кодПациента
  INNER JOIN пациент_авторизация
    ON пациент_авторизация.пациент = пациент.кодПациента
  INNER JOIN врач
    ON бронь.врач = врач.кодВрача
  INNER JOIN врач_специальность
    ON врач.специальность = врач_специальность.кодВрачСпец
WHERE пациент_авторизация.логин = '$pacID'
AND бронь.заврешен =1";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
        $data[] = $row;
      }

      return $data;

    }




    public function readZap($pacID){
      $data = array();
      $sql = "SELECT
  бронь.кодБрони,
  бронь.дата,
  бронь.таймслот,
  врач.фамилия,
  врач.имя,
  врач.отчество,
  пациент_авторизация.логин,
  врач_специальность.название
FROM бронь
  INNER JOIN пациент
    ON бронь.пациент = пациент.кодПациента
  INNER JOIN пациент_авторизация
    ON пациент_авторизация.пациент = пациент.кодПациента
  INNER JOIN врач
    ON бронь.врач = врач.кодВрача
  INNER JOIN врач_специальность
    ON врач.специальность = врач_специальность.кодВрачСпец
WHERE пациент_авторизация.логин = '$pacID'
AND бронь.заврешен =0";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
        $data[] = $row;
      }

      return $data;

    }



    public function readPacID($pacID){
      $data = array();
      $sql = "SELECT
  бронь.кодБрони,
  бронь.дата,
  бронь.таймслот,
  врач.фамилия,
  врач.имя,
  врач.отчество,
  врач_специальность.название,
  бронь.пациент
FROM врач
  INNER JOIN бронь
    ON бронь.врач = врач.кодВрача
  INNER JOIN врач_специальность
    ON врач.специальность = врач_специальность.кодВрачСпец
WHERE бронь.пациент = $pacID ";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
        $data[] = $row;
      }
      return $data;
    }






    public function readDocotorID($doctorID){
      $data = array();
      $sql = "SELECT
  бронь.кодБрони,
  бронь.дата,
  бронь.таймслот,
  бронь.врач,
  пациент.фамилия,
  пациент.имя,
  пациент.отчество
FROM бронь
  INNER JOIN пациент
    ON бронь.пациент = пациент.кодПациента
WHERE бронь.врач = $doctorID";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
        $data[] = $row;
      }
      return $data;
    }


    public function deleteZap($id){
      $sql = "DELETE FROM бронь WHERE кодБрони = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id'=>$id]);
      return true;
    }






    public function deleteDoctor($id){
      $sql = "DELETE FROM врач WHERE кодВрача = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id'=>$id]);
      return true;
    }





    public function updateDoctor($id,$sname,$fname,$lname,$spec){
      $sql = "UPDATE врач SET специальность =:spec, фамилия =:sname, имя=:fname, отчество=:lname WHERE кодВрача = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'spec'=>$spec,
        'sname'=>$sname,
        'fname'=>$fname,
        'lname'=>$lname,
        'id'=>$id
      ]);
      return true;
    }


    public function updateDoctorAuth($id,$login,$password){
      $sql = "UPDATE врач_авторизация SET логин =:login, пароль =:pass WHERE врач = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'login'=>$login,
        'pass'=>$password,
        'id'=>$id
      ]);
      return true;
    }





        public function insertDoctor($sname,$fname,$lname,$spec){

      $sql = "INSERT INTO `врач` (`специальность`, `фамилия`, `имя`, `отчество`) VALUES (:spec,:sname,:fname,:lname)";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'spec'=>$spec,
        'sname'=>$sname,
        'fname'=>$fname,
        'lname'=>$lname
      ]);

       return true;

    
    }

        public function getDoctorById($id){

      $sql = "SELECT
  врач.кодВрача,
  врач.фамилия,
  врач.имя,
  врач.отчество,
  врач_специальность.кодВрачСпец,
  врач_авторизация.логин,
  врач_авторизация.пароль,
  врач_специальность.название
FROM врач_авторизация
  INNER JOIN врач
    ON врач_авторизация.врач = врач.кодВрача
  INNER JOIN врач_специальность
    ON врач.специальность = врач_специальность.кодВрачСпец WHERE кодВрача = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id'=>$id]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result;
    }



      public function insertDoctorAuth($sname,$fname,$lname,$login,$pass){
           $search = "SELECT
  врач.кодВрача,
  врач.фамилия,
  врач.имя,
  врач.отчество
FROM врач
WHERE врач.фамилия = :sname
AND врач.имя = :fname
AND врач.отчество = :lname";
      $stmt1 = $this->conn->prepare($search);
      $stmt1->execute([
        'sname'=>$sname,
        'fname'=>$fname,
        'lname'=>$lname
      ]);
      while($row = $stmt1->fetch()) {  

              $idDoctor = $row['кодВрача'];
                    $sql1 = "INSERT INTO `врач_авторизация` (`логин`, `пароль`,`врач`) VALUES (:login,:pass,:doctor)";
      $stmt2 = $this->conn->prepare($sql1);
      $stmt2->execute([
        'login'=>$login,
        'pass'=>$pass,
        'doctor'=>$idDoctor
      ]);
      return true;

}




        }







        public function totalRowCountDoctor(){
            $sql = "SELECT * FROM врач";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $t_rows = $stmt->rowCount();

            return $t_rows;
        }


    public function readDocotor(){
      $data = array();
      $sql = "SELECT
  врач.кодВрача,
  врач.фамилия,
  врач.имя,
  врач.отчество,
  врач_специальность.название,
  врач_авторизация.логин,
  врач_авторизация.пароль
FROM врач
  INNER JOIN врач_специальность
    ON врач.специальность = врач_специальность.кодВрачСпец
  INNER JOIN врач_авторизация
    ON врач_авторизация.врач = врач.кодВрача";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
        $data[] = $row;
      }
      return $data;
    }


























            public function getPacientById($id){
            $sql = "SELECT
                      пациент.кодПациента,
                      пациент.фамилия,
                      пациент.имя,
                      пациент.отчество,
                      пациент.пол,
                      пациент.датаРождения,
                      пациент.снилс,
                      пациент.мобТелефон,
                      пациент.гражданство,
                      пациент.email,
                      пациент_адрес.страна,
                      пациент_адрес.населПункт,
                      пациент_адрес.улица,
                      пациент_адрес.дом,
                      пациент_адрес.квартира,
                      полис_организация.кодПолисОрг,
                      пациент_полис.номер,
                      пациент_паспорт.паспортСерия,
                      пациент_паспорт.паспортНомер,
                      пациент_паспорт.кемВыдан,
                      пациент_паспорт.датаВыдачи,
                      пациент_паспорт.кодПодразделения,
                      пациент_авторизация.логин,
                      пациент_авторизация.датаРегистрации,
                      пациент_авторизация.проверка
                    FROM пациент_авторизация
                      INNER JOIN пациент
                        ON пациент_авторизация.пациент = пациент.кодПациента
                      INNER JOIN пациент_адрес
                        ON пациент_адрес.пациент = пациент.кодПациента
                      INNER JOIN пациент_паспорт
                        ON пациент_паспорт.пациент = пациент.кодПациента
                      INNER JOIN пациент_полис
                        ON пациент_полис.пациент = пациент.кодПациента
                      INNER JOIN полис_организация
                        ON пациент_полис.организация = полис_организация.кодПолисОрг
                    WHERE пациент_авторизация.проверка = 1
                    AND пациент.кодПациента = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
              while($row = $stmt->fetch())  {
                $_SESSION['pacientGender'] =  $row['пол'] ;

              }
                    

            return $result;
        }


   public function showPacientNotActive(){
            $data = array();
            $sql = "SELECT
                      пациент.кодПациента,
                      пациент.фамилия,
                      пациент.имя,
                      пациент.отчество,
                      пациент.пол,
                      пациент.датаРождения,
                      пациент.снилс,
                      пациент.мобТелефон,
                      пациент.гражданство,
                      пациент.email,
                      пациент_адрес.страна,
                      пациент_адрес.населПункт,
                      пациент_адрес.улица,
                      пациент_адрес.дом,
                      пациент_адрес.квартира,
                      полис_организация.кодПолисОрг,
                      пациент_полис.номер,
                      пациент_паспорт.паспортСерия,
                      пациент_паспорт.паспортНомер,
                      пациент_паспорт.кемВыдан,
                      пациент_паспорт.датаВыдачи,
                      пациент_паспорт.кодПодразделения,
                      пациент_авторизация.логин,
                      пациент_авторизация.датаРегистрации,
                      пациент_авторизация.проверка
                    FROM пациент_авторизация
                      INNER JOIN пациент
                        ON пациент_авторизация.пациент = пациент.кодПациента
                      INNER JOIN пациент_адрес
                        ON пациент_адрес.пациент = пациент.кодПациента
                      INNER JOIN пациент_паспорт
                        ON пациент_паспорт.пациент = пациент.кодПациента
                      INNER JOIN пациент_полис
                        ON пациент_полис.пациент = пациент.кодПациента
                      INNER JOIN полис_организация
                        ON пациент_полис.организация = полис_организация.кодПолисОрг
                    WHERE пациент_авторизация.проверка = 0
                    ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $data[] = $row;
            }
            return $data;
        }




        public function read(){
            $data = array();
            $sql = "SELECT
                      пациент.кодПациента,
                      пациент.фамилия,
                      пациент.имя,
                      пациент.отчество,
                      пациент.пол,
                      пациент.датаРождения,
                      пациент.снилс,
                      пациент.мобТелефон,
                      пациент.гражданство,
                      пациент.email,
                      пациент_адрес.страна,
                      пациент_адрес.населПункт,
                      пациент_адрес.улица,
                      пациент_адрес.дом,
                      пациент_адрес.квартира,
                      полис_организация.кодПолисОрг,
                      пациент_полис.номер,
                      пациент_паспорт.паспортСерия,
                      пациент_паспорт.паспортНомер,
                      пациент_паспорт.кемВыдан,
                      пациент_паспорт.датаВыдачи,
                      пациент_паспорт.кодПодразделения,
                      пациент_авторизация.логин,
                      пациент_авторизация.датаРегистрации,
                      пациент_авторизация.проверка
                    FROM пациент_авторизация
                      INNER JOIN пациент
                        ON пациент_авторизация.пациент = пациент.кодПациента
                      INNER JOIN пациент_адрес
                        ON пациент_адрес.пациент = пациент.кодПациента
                      INNER JOIN пациент_паспорт
                        ON пациент_паспорт.пациент = пациент.кодПациента
                      INNER JOIN пациент_полис
                        ON пациент_полис.пациент = пациент.кодПациента
                      INNER JOIN полис_организация
                        ON пациент_полис.организация = полис_организация.кодПолисОрг
                    WHERE пациент_авторизация.проверка = 1
                    ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $data[] = $row;
            }
            return $data;
        }

                public function totalRowCount(){
            $sql = "SELECT * FROM пациент";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $t_rows = $stmt->rowCount();

            return $t_rows;
        }


            public function doctorLogin($username,$password)
    {

      $sql = "SELECT * from врач_авторизация WHERE логин= :login AND пароль= :password";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'login'=>$username,
        'password'=>$password
      ]);
      $l_records = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($l_records) {
        echo json_encode(array('success' => 1));



      } else {
          echo json_encode(array('success' => 0));

      }

}





		public function adminLogin($username,$password)
		{

			$sql = "SELECT * from администратор WHERE логин= :login AND пароль= :password";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([
				'login'=>$username,
				'password'=>$password
			]);
			$l_records = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($l_records) {
				echo json_encode(array('success' => 1));



			} else {
					echo json_encode(array('success' => 0));

			}

}

public function userLogin($usernameUser,$passwordUser)
{

	$sql = "SELECT * from пациент_авторизация WHERE логин= :login AND пароль= :password AND проверка = 1";
	$stmt = $this->conn->prepare($sql);
	$stmt->execute([
		'login'=>$usernameUser,
		'password'=>$passwordUser
	]);
	$l_records = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($l_records) {


			$sqlUser = "SELECT
								  пациент_авторизация.пациент,
								  пациент.фамилия,
								  пациент.имя,
								  пациент.отчество,
								  пациент.пол,
								  пациент.датаРождения,
								  пациент.снилс,
								  пациент.мобТелефон,
								  пациент.гражданство,
								  пациент.email,
								  пациент_адрес.страна,
								  пациент_адрес.населПункт,
								  пациент_адрес.улица,
								  пациент_адрес.дом,
								  пациент_адрес.квартира,
								  пациент_авторизация.логин,
								  пациент_авторизация.пароль,
								  пациент_полис.номер,
								  полис_организация.кодПолисОрг,
								  пациент_паспорт.паспортСерия,
								  пациент_паспорт.паспортНомер,
								  пациент_паспорт.кемВыдан,
								  пациент_паспорт.датаВыдачи,
								  пациент_паспорт.кодПодразделения
								FROM пациент_авторизация
								  INNER JOIN пациент
								    ON пациент_авторизация.пациент = пациент.кодПациента
								  INNER JOIN пациент_адрес
								    ON пациент_адрес.пациент = пациент.кодПациента
								  INNER JOIN пациент_паспорт
								    ON пациент_паспорт.пациент = пациент.кодПациента
								  INNER JOIN пациент_полис
								    ON пациент_полис.пациент = пациент.кодПациента
								  INNER JOIN полис_организация
								    ON пациент_полис.организация = полис_организация.кодПолисОрг
								WHERE пациент_авторизация.логин = :login";
			$stmt1 = $this->conn->prepare($sqlUser);
			$stmt1->execute([
				'login'=>$usernameUser
			]);
		while($row = $stmt1->fetch())  {
     	$_SESSION['pacientID'] =$row['пациент'];
     $_SESSION['pacientSurname'] =	$row['фамилия'];
     	$_SESSION['pacientName'] =$row['имя'];
     $_SESSION['pacientLastname'] =	$row['отчество'];
     $_SESSION['pacientGender'] =	$row['пол'];
     $_SESSION['pacientDateOfBirth'] =	$row['датаРождения'];
     $_SESSION['pacientSNILS'] =	$row['снилс'];
     $_SESSION['pacientTel'] =	$row['мобТелефон'] ;
     $_SESSION['pacientGrah'] =	$row['гражданство'];
     $_SESSION['pacientEmail'] =	$row['email'];
     $_SESSION['pacientCountry'] =	$row['страна'] ;
     $_SESSION['pacientCity'] =	$row['населПункт'];
     $_SESSION['pacientStreet'] =	$row['улица'];
     $_SESSION['pacientHouse'] =	$row['дом'] ;
     $_SESSION['pacientFlat'] =	$row['квартира'];
     $_SESSION['pacientPassword'] =	$row['пароль'] ;
     $_SESSION['pacientPolisNumber'] =	$row['номер'] ;
     $_SESSION['pacientPolisCode'] =	$row['кодПолисОрг'] ;
     $_SESSION['pacientPasportSeriya'] =	$row['паспортСерия'] ;
     $_SESSION['pacientPasportNomer'] =	$row['паспортНомер'];
     $_SESSION['pacientPasportKem'] =	$row['кемВыдан'];
     	$_SESSION['pacientPasportDate'] =$row['датаВыдачи'];
     $_SESSION['pacientPasportCode'] =	$row['кодПодразделения'];
}
echo json_encode(array('success' => 1));



	} else {
			echo json_encode(array('success' => 0));

	}

}




    public function deletePacient($id){
      $sql = "DELETE FROM пациент WHERE кодПациента = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id'=>$id]);
      return true;
    }

    public function activePacient($id){
      $sql = "UPDATE пациент_авторизация SET проверка='1' WHERE пациент = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id'=>$id]);
      return true;
    }




    public function updateOsnova($id,$pacientSurname,$pacientGrah,$pacientName,$pacientLast,$pacientGender,$pacientBirth,$pacientSnils,$pacientTel,$pacientEmail){
          echo "Hello Word!\r\n";
      $sql = "UPDATE пациент SET фамилия =:pacientSurname, имя =:pacientName,отчество =:pacientLast,пол =:pacientGender,датаРождения =:pacientBirth,снилс =:pacientSnils,мобТелефон =:pacientTel,гражданство =:pacientGrah, email =:pacientEmail WHERE кодПациента =:id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'pacientSurname'=>$pacientSurname,
        'pacientName'=>$pacientName,
        'pacientLast'=>$pacientLast,
        'pacientGender'=>$pacientGender,
        'pacientBirth'=>$pacientBirth,
        'pacientSnils'=>$pacientSnils,
        'pacientTel'=>$pacientTel,
        'pacientGrah'=>$pacientGrah,
        'pacientEmail'=>$pacientEmail,
        'id'=>$id
      ]);
      return true;
    }



      public function updatePolis($id,$polisOrg,$polisNomer){
      $sql = "UPDATE пациент_полис SET номер =:polisNomer, организация =:polisOrg WHERE пациент =:id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'polisNomer'=>$polisNomer,
        'polisOrg'=>$polisOrg,
        'id'=>$id
      ]);
      return true;
    }


        public function updatePasport($id,$pasportSeriya,$pasportNomer,$pasportKem,$pasportDate,$pasportCode){
      $sql = "UPDATE пациент_паспорт SET  паспортСерия =:pasportSeriya, паспортНомер =:pasportNomer,кемВыдан =:pasportKem,датаВыдачи =:pasportDate,кодПодразделения =:pasportCode WHERE пациент =:id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'pasportSeriya'=>$pasportSeriya,
        'pasportNomer'=>$pasportNomer,
        'pasportKem'=>$pasportKem,
        'pasportDate'=>$pasportDate,
        'pasportCode'=>$pasportCode,

        'id'=>$id
      ]);
      return true;
    }


    public function updateMesto($id,$pacientCountry,$pacientCity,$pacientStreet,$pacientHouse,$pacientFlat){
      $sql = "UPDATE пациент_адрес SET страна =:pacientCountry,населПункт =:pacientCity,улица =:pacientStreet,дом =:pacientHouse,квартира =:pacientFlat WHERE пациент =:id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'pacientCountry'=>$pacientCountry,
        'pacientCity'=>$pacientCity,
        'pacientStreet'=>$pacientStreet,
        'pacientHouse'=>$pacientHouse,
        'pacientFlat'=>$pacientFlat,
        'id'=>$id
      ]);
      return true;
    }




        public function checkStep1($mobile,$snils)
        {
            $sql = "SELECT кодПациента FROM пациент WHERE мобТелефон= :mobile";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['mobile'=>$mobile]);
            $l_records = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($l_records) {

                $_SESSION['response1'] = "Данный телефон существует";
                $_SESSION['res_type1'] = "danger";
                header('location:../registration/index.php');
                }
            else {
                $sql = "SELECT кодПациента FROM пациент WHERE снилс= :snils";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(['snils'=>$snils]);
                $l_records1 = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($l_records1) {
                    $_SESSION['response1'] = "Данный снилс существует";
                    $_SESSION['res_type1'] = "danger";
                    header('location:../registration/index.php');
                }
                else {
                    header('location:../registration/step2.php');
                }
            }

        }
			public function checkLogin($login,$fam,$name,$last,$gender,$dateB,$snils,$mobile,$grah,$email,$pasportSeriya,$pasportNomer,$pasportKem,$pasportDate,$pasportCode,$polisNomer,$polisOrg,$country,$city,$street,$house,$flat,$pass,$dateOfReg){

                $sql = "SELECT кодПациентАвто FROM пациент_авторизация WHERE логин= :login";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(['login'=>$login]);
                $l_records = $stmt->fetch(PDO::FETCH_ASSOC);



                if ($l_records) {

                    $_SESSION['response'] = "Данный логин существует";
                    $_SESSION['res_type'] = "danger";
                    header('location:../registration/step3.php');
                } else {

                    $sql2 = "SELECT кодПациента FROM пациент WHERE email= :email";
                    $stmt2 = $this->conn->prepare($sql2);
                    $stmt2->execute(['email'=>$email]);
                    $l_records2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                    if ($l_records2){

                        $_SESSION['response'] = "Данный email существует";
                        $_SESSION['res_type'] = "danger";
                        header('location:../registration/step3.php');

                    }else {

                    $sql1 = "INSERT INTO `пациент` (`фамилия`, `имя`, `отчество`, `пол`,`датаРождения`,`снилс`,`мобТелефон`,`гражданство`,`email`) VALUES (:fam,:name,:last,:gender,:dateB,:snils,:mobile,:grah,:email)";
                    $stmt1 = $this->conn->prepare($sql1);
                    $stmt1->execute([
                        'fam' => $fam,
                        'name' => $name,
                        'last' => $last,
                        'gender' => $gender,
                        'dateB' => $dateB,
                        'snils' => $snils,
                        'mobile' => $mobile,
                        'grah' => $grah,
                        'email' => $email
                    ]);

                        $sql3 = "SELECT кодПациента FROM пациент WHERE снилс =:snils";
                        $stmt3 = $this->conn->prepare($sql3);
                        $stmt3->execute(['snils' => $snils]);
                        $name = $stmt3->fetchColumn();

                        $sqlPasport = "INSERT INTO `пациент_паспорт` (`пациент`, `паспортСерия`, `паспортНомер`, `кемВыдан`,`датаВыдачи`,`кодПодразделения`) VALUES (:pacient,:pasportSer,:pasortNom,:pasportKem,:pasportDate,:pasportCode)";
                        $stmtPasport = $this->conn->prepare($sqlPasport);
                        $stmtPasport->execute([
                            'pacient' => $name,
                            'pasportSer' => $pasportSeriya,
                            'pasortNom' => $pasportNomer,
                            'pasportKem' => $pasportKem,
                            'pasportDate' => $pasportDate,
                            'pasportCode' => $pasportCode

                        ]);

                        $sqlAddress = "INSERT INTO `пациент_адрес` (`пациент`, `страна`, `населПункт`, `улица`,`дом`,`квартира`) VALUES (:pacient,:country,:city,:street,:house,:flat)";
                        $stmtAddress = $this->conn->prepare($sqlAddress);
                        $stmtAddress->execute([
                            'pacient' => $name,
                            'country' => $country,
                            'city' => $city,
                            'street' => $street,
                            'house' => $house,
                            'flat' => $flat

                        ]);

                        $sqlPolis = "INSERT INTO `пациент_полис` (`пациент`, `номер`, `организация`) VALUES (:pacient,:polisNum,:polisOrg)";
                        $stmtPolis = $this->conn->prepare($sqlPolis);
                        $stmtPolis->execute([
                            'pacient' => $name,
                            'polisNum' => $polisNomer,
                            'polisOrg' => $polisOrg
                        ]);

                        $sqlPolis = "INSERT INTO `пациент_авторизация` (`пациент`, `логин`, `пароль`, `датаРегистрации`) VALUES (:pacient,:login,:pass,:dateOfReg)";
                        $stmtPolis = $this->conn->prepare($sqlPolis);
                        $stmtPolis->execute([
                            'pacient' => $name,
                            'login' => $login,
                            'pass' => $pass,
                            'dateOfReg' => $dateOfReg
                        ]);

                        session_destroy();

                        session_start();
                        $_SESSION['response'] = "Заявление успешно отправлено. Ожидайте звонка от администратора.";
                        $_SESSION['res_type'] = "success";
                        header('location:../login.php');

                        return true;






                }
                }

		}


	}


?>
