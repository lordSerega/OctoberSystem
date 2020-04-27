<?php
	error_reporting(-1);
	ini_set('display_errors', 1);

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
