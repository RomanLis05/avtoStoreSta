<?php
    require_once 'connect.php';
    
    $id = $_POST['id'];
    $location = $_POST['d_location'];
    $parks = $_POST['d_parks'];
    $access = $_POST['d_access'];
    // Обработка запроса на добавление
    if (empty($errors)) {
        // Запрос к базе данных для редактирования нового role
        $sql = "UPDATE dealership SET dealership_location = '$location', 
            dealership_parks = '$parks',
            dealership_access = '$access' WHERE dealership_id = $id";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /avtoStore_pz/dealership_pz/dealership_show_pz.php");
    }
