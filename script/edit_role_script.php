<?php
	require_once 'connect.php';
	
    $id = $_POST['id'];
    $roleName = $_POST['role_name'];
    $salary = $_POST['salary'];

	// Обработка запроса на добавление
    if (empty($errors)) {
        // Запрос к базе данных для редактирования нового role
        $sql = "UPDATE role SET role_name = '$roleName', employees_salary = '$salary' WHERE role_id = $id";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /avtoStore_pz/role_pz/role_show_pz.php");
    }
