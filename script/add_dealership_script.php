<?php
    session_start();
    
    require_once 'connect.php';
    
    $errors = array();
    $location = filter_var(trim($_POST['location']), FILTER_SANITIZE_STRING);
    $parks = filter_var(trim($_POST['parks']), FILTER_SANITIZE_STRING);
    $access = filter_var(trim($_POST['access']), FILTER_SANITIZE_STRING);
    
    function addError($field, $errorMessage) {
        global $errors;
        if (!isset($errors[$field])) {
            $errors[$field] = array();
        }
        $errors[$field][] = $errorMessage;
    }
    
    //check location length
    if (strlen($location) >= 50) {
        addError('locationErrorLen', 'Location length should be less than 50 characters.');
    }
    
    // Обробка запиту на додавання
    if (!empty($errors)) {
        // Виведення всіх помилок на сторінку
        $_SESSION['errors'] = $errors;
        header('Location: /avtoStore_pz/dealership_pz/dealership_add_pz.php');
        exit();
    } else {
        // Используйте mysqli_real_escape_string для предотвращения SQL-инъекций
        $location = mysqli_real_escape_string($conn, $location);
        $parks = mysqli_real_escape_string($conn, $parks);
        $access = mysqli_real_escape_string($conn, $access);
        
        $sql = "INSERT INTO dealership (dealership_location, dealership_parks, dealership_access) 
                    VALUES ('$location', '$parks', '$access')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /avtoStore_pz/dealership_pz/dealership_show_pz.php");
        exit();
    }
?>