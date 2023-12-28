<?php
	require_once 'connect.php';
	session_start();
	$email = trim($_POST['emailAuth']);
	$passwd = trim($_POST['passwordAuth']);

	$hashedPassword = md5($passwd);	

	$errors = array();
	$sql_check_auth = "SELECT * FROM user WHERE email = '$email' AND passwd = '$hashedPassword'";
	$result_check_auth = mysqli_query($conn, $sql_check_auth);

	function addError($field, $errorMessage) {
    	global $errors;
    	if (!isset($errors[$field])) {
        	$errors[$field] = array();
    	}
    	$errors[$field][] = $errorMessage;
	}
	//check login
	if (empty($email)) {
    	addError('emailAuthEmpty', 'Поле EMAIL не може бути порожнім');
	} 
	//check passwd
	if (empty($passwd)){
    	addError('passwdAuthEmpty', 'Поле PASSWORD не повинно бути порожнім');
	} 

	if (!empty($errors)){
    	$_SESSION['errors'] = $errors;
    	header('Location: ../auth_page.php');
    	exit();
	} elseif (mysqli_num_rows($result_check_auth) == 1) {
		$_SESSION['email'] = $email;
		header("Location: ../account.php");
		exit();;
	} else {
		addError('dataError', 'Дані не вірні');
		$_SESSION['errors'] = $errors;
    	header('Location: ../auth_page.php');
    	exit();
	}

	mysqli_close($conn);