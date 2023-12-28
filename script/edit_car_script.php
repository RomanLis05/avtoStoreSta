<?php
    require_once 'connect.php';
    
    // Отримання даних з форми редагування
    $id = $_POST['id'];
    $car_model_id = $_POST['car_model_id'];
    $year = $_POST['year'];
    $vin_code = $_POST['vin_code'];

    // Обработка запроса на добавление
    if (empty($errors)) {
        // Запит до бази даних для оновлення інформації про автомобіль
        $sql = "UPDATE car SET car_model_id = '$car_model_id', 
                car_year = '$year',
                car_vin_code = '$vin_code'
                WHERE car_id = $id";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /avtoStore_pz/car_pz/car_show_pz.php");
    }
