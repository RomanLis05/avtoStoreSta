<?php
    require_once 'connect.php';
    
    $id = $_POST['id'];
    $name = $_POST['e_name'];
    $last_name = $_POST['e_last_name'];
    $middle_name = $_POST['e_middle_name'];
    $phone = $_POST['e_phone'];
    $mail = $_POST['e_mail'];
    $birthday = $_POST['e_birthday'];
    $post_time = $_POST['e_post_time'];
    $dealership_id = $_POST['dealership_id'];
    $role_id = $_POST['role_id'];

    // Обработка запроса на добавление
    if (empty($errors)) {
        // Запрос к базе данных для редактирования нового role
        $sql = "UPDATE employees 
            SET employees_name = '$name', 
                employees_last_name = '$last_name',
                employees_middle_name = '$middle_name',
                employees_phone = '$phone',
                employees_mail = '$mail',
                employees_birthday = '$birthday',
                employees_post_time = '$post_time',
                dealership_id = '$dealership_id',
                role_id = '$role_id'
            WHERE employees_id = $id";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /avtoStore_pz/employees_pz/employees_show_pz.php");
    }
