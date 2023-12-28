<?php include 'main_base.php'?>

<?php startblock('link') ?>
    <link rel="stylesheet" href="css/style_main_pz.css">
<?php endblock() ?>


<?php startblock('titlePage') ?>
    AvtoStore Info
<?php endblock() ?>

<?php startblock('bodyPageMain') ?>
    <?php 
		require_once 'script/connect.php';
		if (!isset($_SESSION['email'])) {
        	header('Location: auth_page.php');
        	exit();
    	}

		$email = $_SESSION['email']; // Предполагая, что почта сохраняется в сессии после успешной авторизации
		// Запрос к базе данных для получения информации о пользователе
		$sql = "SELECT login, email, phone FROM user WHERE email = '$email'";
		$result = mysqli_query($conn, $sql);
		
		// Проверка наличия результатов
		if (mysqli_num_rows($result) > 0) {
		    // Получение данных пользователя
		    $row = mysqli_fetch_assoc($result);
		    $login = $row['login'];
		    $email = $row['email'];
		    $phone = $row['phone'];
		} else {
		    echo "Інформація про користувача не знайдена";
		}
	
	
	
	
		// Закрытие соединения с базой данных
		mysqli_close($conn);


		// Функция для удаления сессии
        function logout() {
            session_unset();
            session_destroy();
            header('Location: auth_page.php');
            exit();
        }

	?>
	
	<h1>AvtoStore</h1>

<div class="card-container">
   
	
	<div class="card" onclick="location.href='avtoStore_pz/dealership_pz.php';">
        <img src="img/dealership.png" alt="Dealership Icon">
        <h3>Dealership</h3>
    </div>

    <div class="card" onclick="location.href='avtoStore_pz/car_pz.php';">
        <img src="img/car.png" alt="Car Icon">
        <h3>Car</h3>
    </div>

    <div class="card" onclick="location.href='avtoStore_pz/role_pz.php';">
        <img src="img/role.png" alt="Role Icon">
        <h3>Role</h3>
    </div>

    <div class="card" onclick="location.href='avtoStore_pz/employees_pz.php';">
        <img src="img/employees.png" alt="Employees Icon">
        <h3>Employees</h3>
    </div>    

    <div class="card" onclick="location.href='avtoStore_pz/customer_pz.php';">
        <img src="img/customer.png" alt="Customers Icon">
        <h3>Customers</h3>
    </div>
	
	 <div class="card" onclick="location.href='avtoStore_pz/bill_pz.php';">
        <img src="img/bill.png" alt="Bill Icon">
        <h3>Bill</h3>
    </div>

    <div class="card" onclick="location.href='avtoStore_pz/user_pz.php';">
        <img src="img/user.png" alt="User Icon">
        <h3>User</h3>
    </div>
	
	<div class="card" onclick="location.href='account.php';">
        <img src="img/back_acc.png" alt="Back Icon">
        <h3>Account</h3>
    </div>
</div>


    <?php
        // Проверка, была ли нажата кнопка "Выход"
        if (isset($_POST['logout'])) {
            logout();
        }
    ?>


<?php endblock() ?>