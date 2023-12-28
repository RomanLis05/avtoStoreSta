<?php
    require_once 'connect.php';
    
    $id = $_POST['id'];
    $customer_id = $_POST['customer_id'];
    $summa = $_POST['summa'];
    $date_buy = $_POST['date_buy']; // Assuming date_buy is in the format 'Y-m-d H:i:s'
    $dealership_id = $_POST['dealership_id'];

    // Обработка запроса на добавление
    if (empty($errors)) {
        // Запрос к базе данных для редактирования нового role
         $sql = "UPDATE bill 
            SET customer_id = '$customer_id',
                bill_sum = '$summa',
                bill_date_buy = '$date_buy',
                dealership_id = '$dealership_id'
            WHERE bill_id = $id";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /avtoStore_pz/bill_pz/bill_show_pz.php");
    }
