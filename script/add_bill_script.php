<?php
	require_once 'connect.php';
	
    $customer_id = $_POST['customer_id'];
    $summa = trim($_POST['summa']);
    $date_buy = trim($_POST['date_buy']);
    $dealership_id = $_POST['dealership_id'];

	// Обработка запроса на добавление
    if (empty($errors)) {
        // Запрос к базе данных для добавления нового dealership
        $sql = "INSERT INTO bill (customer_id, bill_sum, bill_date_buy, dealership_id) 
            VALUES ('$customer_id', '$summa', '$date_buy', '$dealership_id')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /avtoStore_pz/bill_pz/bill_show_pz.php");
    }
