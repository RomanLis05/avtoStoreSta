<?php
    require_once 'connect.php';
    
    $id = $_POST['id'];
    $name = $_POST['c_name'];
    $last_name = $_POST['c_last_name'];
    $middle_name = $_POST['c_middle_name'];
    $phone = $_POST['c_phone'];
    $mail = $_POST['c_mail'];
    $birthday = $_POST['c_birthday'];

    // Обработка запроса на добавление
    if (empty($errors)) {
        // Запрос к базе данных для редактирования нового role
        $sql = "UPDATE customer SET customer_name = '$name', 
            customer_last_name = '$last_name',
            customer_middle_name = '$middle_name',
            customer_number = '$phone',
            customer_mail = '$mail',
            customer_birthday = '$birthday' WHERE customer_id = $id";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /avtoStore_pz/customer_pz/customer_show_pz.php");
    }
