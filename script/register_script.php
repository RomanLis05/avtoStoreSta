<?php
	require_once 'connect.php';
	session_start();
	$login = trim($_POST['loginReg']);
	$email = trim($_POST['emailReg']);
	$phone = trim($_POST['phoneReg']);
	$passwd = trim($_POST['passwordReg']);

	$errors = array();
	//check uniq email
	$sql_uniq_email = "SELECT email FROM user WHERE email = '$email'";
	$result_uniq_email = mysqli_query($conn, $sql_uniq_email);
	//check uniq phone
	$sql_uniq_phone = "SELECT phone FROM user WHERE phone = '$phone'";
	$result_uniq_phone = mysqli_query($conn, $sql_uniq_phone);
	

	function addError($field, $errorMessage) {
    	global $errors;
    	if (!isset($errors[$field])) {
        	$errors[$field] = array();
    	}
    	$errors[$field][] = $errorMessage;
	}



	//check login
	if (empty($login)) {
    	addError('loginRegEmpty', 'Поле LOGIN не може бути порожнім');
	} elseif (strlen($login) <= 3) {
		addError('loginRegLenght', 'Поле LOGIN не може бути менше 3 символів');
	}

	
	//check email
	if (empty($email)){
    	addError('emailRegEmpty', 'Поле Email не повинно бути порожнім');
	} elseif (mysqli_num_rows($result_uniq_email) > 0){
    	addError('emailRegIS', 'Email зайнятий');
	}

	//check phone
	if (empty($phone)){
    	addError('phoneRegEmpty', 'Поле Phone не повинно бути порожнім');
	} elseif (mysqli_num_rows($result_uniq_phone) > 0){
    	addError('phoneRegIS', 'Phone зайнятий');
	}

	//check password
	if (empty($passwd)){
    	addError('passwdRegEmpty', 'Поле PASSWORD не повинно бути порожнім');
	} elseif (strlen($passwd) <= 6) {
		addError('passwdRegLenght', 'Поле PASSWORD не повинно бути менше 6 символів');
	}



	if (!empty($errors)){
    	$_SESSION['errors'] = $errors;
    	header('Location: ../register_page.php');
    	exit();
	} else {
		$passwd_chash = md5($passwd);
		$sql = "INSERT INTO user (login, email, phone, passwd) VALUES ('$login', '$email', '$phone', '$passwd_chash')";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		header("Location: ../auth_page.php");
		exit();
	}