<?php
session_start();
	error_reporting(-1);

	ini_set('display_errors', 1);

	require_once 'db.php';
	$db = new Database();

	$step1 = true;

	function selected($var, $value) 
{
	if (!is_array($var)) {
		$var = explode(',', $var);
	}
 
	return (in_array($value, $var)) ? ' selected' : '';
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