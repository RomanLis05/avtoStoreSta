<?php
	require_once 'connect.php';
	
    // Assuming you have validated and sanitized the input data
    $id = $_GET['id'];

    // Обработка запроса на удаление
    $sql = "DELETE FROM employees WHERE employees_id = $id";

    // Проверка успешности запроса
    if (mysqli_query($conn, $sql)) {
        // Закрываем соединение с базой данных
        mysqli_close($conn);

        // Перенаправляем пользователя после успешного удаления
        header("Location: /avtoStore_pz/employees_pz/employees_show_pz.php");
    } else {
        // Если запрос не выполнен успешно, выводим сообщение об ошибке
        echo "Ошибка при выполнении запроса: " . mysqli_error($conn);
    }
