<?php
	session_start();
    require_once 'connect.php';
    $errors = array();
	$name_e = filter_var(trim($_POST['name_e']));
    $last_name_e = filter_var(trim($_POST['last_name_e']));
    $middle_name_e = filter_var(trim($_POST['middle_name_e']));
    $phone_e = filter_var(trim($_POST['phone_e']));
    $email_e = filter_var(trim($_POST['email_e']));
    $birthday_e = filter_var(trim($_POST['birthday_e']));
    $post_time_e = filter_var(trim($_POST['post_time_e']));
    $dealership_id = filter_var(trim($_POST['dealership_id']));
    $role_e = filter_var(trim($_POST['role_e']));



    function addError($field, $errorMessage) {
        global $errors;
        if (!isset($errors[$field])) {
            $errors[$field] = array();
        }
        $errors[$field][] = $errorMessage;
    }


    //check location length
    if (strlen($name_e) >= 50) {
        addError('Name_E_ErrorLen', 'Name length should be less than 50 characters.');
    }
    //check location length
    if (strlen($last_name_e) >= 50) {
        addError('Last_Name_E_ErrorLen', 'Last Name length should be less than 50 characters.');
    }
    //check location length
    if (strlen($middle_name_e) >= 50) {
        addError('Middle_Name_E_ErrorLen', 'Middle Name length should be less than 50 characters.');
    }


    // Обробка запиту на додавання
    if (!empty($errors)) {
        // Виведення всіх помилок на сторінку
        $_SESSION['errors'] = $errors;
        header('Location: /avtoStore_pz/employees_pz/employees_add_pz.php');
        exit();
    } else {
        // Используйте mysqli_real_escape_string для предотвращения SQL-инъекций
        $name_e = mysqli_real_escape_string($conn, $name_e);
        $last_name_e = mysqli_real_escape_string($conn, $last_name_e);
        $middle_name_e = mysqli_real_escape_string($conn, $middle_name_e);
        $phone_e = mysqli_real_escape_string($conn, $phone_e);
        $email_e = mysqli_real_escape_string($conn, $email_e);
        $birthday_e = mysqli_real_escape_string($conn, $birthday_e);
        $post_time_e = mysqli_real_escape_string($conn, $post_time_e);
        $dealership_id = mysqli_real_escape_string($conn, $dealership_id);
        $role_e = mysqli_real_escape_string($conn, $role_e);
        
        
        $sql = "INSERT INTO employees (employees_name, employees_last_name, employees_middle_name, employees_phone, employees_mail, employees_birthday, employees_post_time, dealership_id, role_id) 
            VALUES ('$name_e', '$last_name_e', '$middle_name_e', '$phone_e', '$email_e', '$birthday_e', '$post_time_e', '$dealership_id', '$role_e')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /avtoStore_pz/employees_pz/employees_show_pz.php");
        exit();
    }


