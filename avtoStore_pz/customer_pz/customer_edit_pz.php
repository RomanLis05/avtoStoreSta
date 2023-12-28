<?php include '../../main_base.php'?>
<style>
body{
    height: 550px;  
}
.mb-3{
    margin-bottom:20px
}
.card {
    width: 330px;
    margin: 20px;
    padding: 15px;
    text-align: center;
    background-color: #f2f2f2;
    border: 0px solid #ccc;
    border-radius: 5px;
    cursor: pointer;
}
img {
    border: 2px solid #525a61;
    border-radius: 15px;
    padding: 5px;
}

</style>
<?php startblock('link') ?>
    <link rel="stylesheet" href="../../css/style_main.css">
<?php endblock() ?>


<?php startblock('titlePage') ?>
    AvtoStore Customer
<?php endblock() ?>


<?php startblock('bodyPageMain') ?>
    <?php 
        require_once '../../script/connect.php';

        if (!isset($_SESSION['email'])) {
            header('Location: auth_page.php');
            exit();
        }
    ?>

    <div class="col-md-4" style="width: 0px">
        <div class="card" onclick="location.href='/avtoStore_pz/customer_pz.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>

    <?php
        if (isset($_GET['id'])) {
        // Получаем значение id из запроса
        $id = $_GET['id'];
    
        // Получаем данные из базы данных по указанному id
        $sql = "SELECT * FROM customer WHERE customer_id = $id";
        $result = mysqli_query($conn, $sql);
    
        // Проверяем, успешен ли запрос
        if ($result) {
            // Получаем данные строки
            $row = mysqli_fetch_assoc($result);
    
            // Проверка существования ключей в массиве
            $name = isset($row['customer_name']) ? $row['customer_name'] : '';
            $last_name = isset($row['customer_last_name']) ? $row['customer_last_name'] : '';
            $middle_name = isset($row['customer_middle_name']) ? $row['customer_middle_name'] : '';
            $phone = isset($row['customer_number']) ? $row['customer_number'] : '';
            $mail = isset($row['customer_mail']) ? $row['customer_mail'] : '';
            $birthday = isset($row['customer_birthday']) ? $row['customer_birthday'] : '';

            // Выводим форму редактирования
            echo "<div class='container mt-3'>
                <h1 class='mt-5' style='text-align: center; margin-top: 100px;'>Edit Customer</h1>
                <form action='../../script/edit_customer_script.php' method='POST'>
                    <div class='mb-3'>
                        <label for='c_name' class='form-label'>Name:</label>
                        <input type='text' class='form-control' name='c_name' id='c_name' value='$name' required>
                    </div>
                    <div class='mb-3'>
                        <label for='c_last_name' class='form-label'>Last Name:</label>
                        <input type='text' class='form-control' name='c_last_name' id='c_last_name' value='$last_name' required>
                    </div>
                    <div class='mb-3'>
                        <label for='c_middle_name' class='form-label'>Middle Name:</label>
                        <input type='text' class='form-control' name='c_middle_name' id='c_middle_name' value='$middle_name' required>
                    </div>
                    <div class='mb-3'>
                        <label for='c_phone' class='form-label'>Phone:</label>
                        <input type='tel' class='form-control' name='c_phone' id='c_phone' value='$phone' required>
                    </div>
                    <div class='mb-3'>
                        <label for='c_mail' class='form-label'>E-mail:</label>
                        <input type='email' class='form-control' name='c_mail' id='c_mail' value='$mail' required>
                    </div>
                    <div class='mb-3'>
                        <label for='c_birthday' class='form-label'>Birthday:</label>
                        <input type='date' class='form-control' name='c_birthday' id='c_birthday' value='$birthday' required>
                    </div>
                    <input type='hidden' name='id' value='$id'>
                    <button type='submit' class='btn btn-primary'>Update Customer</button>
                </form>
            </div>";
        } else {
            // Если запрос неудачен, выведите сообщение об ошибке
            echo "Ошибка при выполнении запроса: " . mysqli_error($conn);
        }
    } else {
        // Если параметр id не был передан, выведите сообщение об ошибке
        echo "Ошибка: Параметр id не был передан.";
    }
    ?>

<?php endblock() ?>


