<?php
	session_start();
    require_once 'connect.php';
    $errors = array();
	$role_name = filter_var(trim($_POST['role_name']));
    $salary = filter_var(trim($_POST['salary']));

    function addError($field, $errorMessage) {
        global $errors;
        if (!isset($errors[$field])) {
            $errors[$field] = array();
        }
        $errors[$field][] = $errorMessage;
    }

    //check location length
    if (strlen($role_name) >= 30) {
        addError('RoleNameErrorLen', 'Role Name length should be less than 50 characters.');
    }



    // Обробка запиту на додавання
    if (!empty($errors)) {
        // Виведення всіх помилок на сторінку
        $_SESSION['errors'] = $errors;
        header('Location: /avtoStore_pz/role_pz/role_add_pz.php');
        exit();
    } else {
        // Используйте mysqli_real_escape_string для предотвращения SQL-инъекций
        $role_name = mysqli_real_escape_string($conn, $role_name);
        $salary = mysqli_real_escape_string($conn, $salary);
        
        $sql = "INSERT INTO role (role_name, employees_salary) 
        VALUES ('$role_name', '$salary')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /avtoStore_pz/role_pz/role_show_pz.php");
        exit();
    }



    