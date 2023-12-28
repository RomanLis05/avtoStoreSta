<?php
	session_start();
    require_once 'connect.php';
    $errors = array();
	$name = filter_var(trim($_POST['name']));
    $last_name = filter_var(trim($_POST['last_name']));
    $middle_name = filter_var(trim($_POST['middle_name']));
    $number = filter_var(trim($_POST['number']));
    $email = filter_var(trim($_POST['email']));
    $birthday = filter_var(trim($_POST['birthday']));

	
    function addError($field, $errorMessage) {
        global $errors;
        if (!isset($errors[$field])) {
            $errors[$field] = array();
        }
        $errors[$field][] = $errorMessage;
    }


    //check location length
    if (strlen($name) >= 50) {
        addError('NameErrorLen', 'Name length should be less than 50 characters.');
    }
    //check location length
    if (strlen($last_name) >= 50) {
        addError('LastNameErrorLen', 'Last Name length should be less than 50 characters.');
    }
    //check location length
    if (strlen($middle_name) >= 50) {
        addError('MiddleNameErrorLen', 'Middle Name length should be less than 50 characters.');
    }


    // Обробка запиту на додавання
    if (!empty($errors)) {
        // Виведення всіх помилок на сторінку
        $_SESSION['errors'] = $errors;
        header('Location: /avtoStore_pz/customer_pz/customer_add_pz.php');
        exit();
    } else {
        // Используйте mysqli_real_escape_string для предотвращения SQL-инъекций
        $name = mysqli_real_escape_string($conn, $name);
        $last_name = mysqli_real_escape_string($conn, $last_name);
        $middle_name = mysqli_real_escape_string($conn, $middle_name);
        $number = mysqli_real_escape_string($conn, $number);
        $email = mysqli_real_escape_string($conn, $email);
        $birthday = mysqli_real_escape_string($conn, $birthday);        
        
        $sql = "INSERT INTO customer (customer_name, customer_last_name, customer_middle_name, customer_number, customer_mail, customer_birthday) 
        VALUES ('$name', '$last_name', '$middle_name', '$number', '$email', '$birthday')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /avtoStore_pz/customer_pz/customer_show_pz.php");
        exit();
    }



    
