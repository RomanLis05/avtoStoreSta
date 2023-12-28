<?php
    session_start();
    require_once 'connect.php';
    $errors = array();
    $car_model_id = filter_var(trim($_POST['car_model_id']));
    $year = filter_var(trim($_POST['year']));
    $car_vin_code = filter_var(trim($_POST['car_vin_code']));



    function addError($field, $errorMessage) {
        global $errors;
        if (!isset($errors[$field])) {
            $errors[$field] = array();
        }
        $errors[$field][] = $errorMessage;
    }

    //check location length
    if (strlen($car_vin_code) !== 17) {
        addError('VinCodeErrorLen', 'Vin Code length should be less or more than 17 characters.');
    }

    // Обробка запиту на додавання
    if (!empty($errors)) {
        // Виведення всіх помилок на сторінку
        $_SESSION['errors'] = $errors;
        header('Location: /avtoStore_pz/car_pz/car_add_pz.php');
        exit();
    } else {
        // Используйте mysqli_real_escape_string для предотвращения SQL-инъекций
        $car_model_id = mysqli_real_escape_string($conn, $car_model_id);
        $year = mysqli_real_escape_string($conn, $year);
        $car_vin_code = mysqli_real_escape_string($conn, $car_vin_code);
        
        $sql = "INSERT INTO car (car_model_id, car_year, car_vin_code) 
            VALUES ('$car_model_id', '$year', '$car_vin_code')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /avtoStore_pz/car_pz/car_show_pz.php");
        exit();
    }
