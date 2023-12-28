<?php include '../../main_base.php'?>
<style>
body{
    height: 300px;  
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
    AvtoStore Dealership
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
        <div class="card" onclick="location.href='/avtoStore_pz/dealership_pz.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>

    <?php
        if (isset($_GET['id'])) {
        // Получаем значение id из запроса
        $id = $_GET['id'];
    
        // Получаем данные из базы данных по указанному id
        $sql = "SELECT * FROM dealership WHERE dealership_id = $id";
        $result = mysqli_query($conn, $sql);
    
        // Проверяем, успешен ли запрос
        if ($result) {
            // Получаем данные строки
            $row = mysqli_fetch_assoc($result);
    
            // Проверка существования ключей в массиве
            $location = isset($row['dealership_location']) ? $row['dealership_location'] : '';
            $parks = isset($row['dealership_parks']) ? $row['dealership_parks'] : '';
            $access = isset($row['dealership_access']) ? $row['dealership_access'] : '';

            // Выводим форму редактирования
            echo "<div class='container mt-3'>
                <h1 class='mt-5' style='text-align: center; margin-top: 100px;'>Edit Dealership</h1>
                <form action='../../script/edit_dealership_script.php' method='POST'>
                    <div class='mb-3'>
                        <label for='d_location' class='form-label'>Location:</label>
                        <input type='text' class='form-control' name='d_location' id='d_location' value='$location' required>
                    </div>
                    <div class='mb-3'>
                        <label for='d_parks' class='form-label'>Parks:</label>
                        <input type='text' class='form-control' name='d_parks' id='d_parks' value='$parks' required>
                    </div>
                    <div class='mb-3'>
                        <label for='d_access' class='form-label'>Access:</label>
                        <input type='text' class='form-control' name='d_access' id='d_access' value='$access' required>
                    </div>
                    <input type='hidden' name='id' value='$id'>
                    <button type='submit' class='btn btn-primary'>Update Dealership</button>
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


