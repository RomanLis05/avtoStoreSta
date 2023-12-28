<?php
	$servername = "localhost";
	$username = "root";
	$password = "M9IoipwoejKvZBXkP2jGJHtIzyGDPe^";
	$dbname = "avtoStore";
	$conn = mysqli_connect($servername, $username, $password);

	// Проверяем соединение на наличие ошибок
	if (!$conn) {
    	die("Помилка підключення: " . mysqli_connect_error());
	}
	$conn->set_charset('utf8mb4_0900_ai_ci');
	// Выбираем базу данных
	mysqli_select_db($conn, $dbname);
