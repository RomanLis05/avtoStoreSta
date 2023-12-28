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
    AvtoStore Car
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
        <div class="card" onclick="location.href='/avtoStore_pz/car_pz.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>

    <?php
        if (isset($_GET['id'])) {
        // Получаем значение id из запроса
        $id = $_GET['id'];
    
        // Получаем данные из базы данных по указанному id
        $sql = "SELECT * FROM car WHERE car_id = $id";
        $result = mysqli_query($conn, $sql);
    
        // Проверяем, успешен ли запрос
        if ($result) {
            // Получаем данные строки для автомобиля
            $car_row = mysqli_fetch_assoc($result);


            // Проверка существования ключей в массиве для автомобиля
            $car_model_id = isset($car_row['car_model_id']) ? $car_row['car_model_id'] : '';
            $year = isset($car_row['car_year']) ? $car_row['car_year'] : '';
            $vin_code = isset($car_row['car_vin_code']) ? $car_row['car_vin_code'] : '';
            

    
            // Выводим форму редактирования
            echo "<div class='container mt-3'>
                    <h1 class='mt-5' style='text-align: center; margin-top: 100px;'>Edit Car</h1>
                    <form action='../../script/edit_car_script.php' method='POST'>
                        <!-- Добавляем выпадающий список для выбора машины -->
                        <div class='mb-3'>
                            <label for='car_model_id' class='form-label'>Car Model:</label>
                            <select class='form-select' name='car_model_id' id='car_model_id' required>";
    
            // Запрос для получения вариантов выбора автомобиля из таблицы
            $car_query = "SELECT car_model_id, car_model_name,
                (SELECT name_brand FROM car_brand WHERE car_brand_id = car_model.car_brand_id) AS brand_name,
                (SELECT color FROM car_color WHERE car_color_id = car_model.car_color_id) AS color_name,
                (SELECT name_body FROM car_body WHERE car_body_id = car_model.car_body_id) AS body_name,
                (SELECT name_type_of_engine FROM car_type_of_engine WHERE car_type_of_engine_id = car_model.    car_type_of_engine_id) AS type_engine,
                (SELECT car_gearbox_name FROM car_gearbox WHERE car_gearbox_id = car_model.car_gearbox_id) AS name_gearbox  
                FROM car_model;";
            $car_result = mysqli_query($conn, $car_query);
    
            // Перебор результатов и создание опций
            while ($car_row = mysqli_fetch_assoc($car_result)) {
                $selected = ($car_row['car_model_id'] == $car_model_id) ? 'selected' : '';
                echo "<option value='" . $car_row['car_model_id'] . "' $selected>" . $car_row['car_model_name'] . 
                    " - Brand: " . $car_row['brand_name'] . 
                    " - Color: " . $car_row['color_name'] . 
                    " - Body: " . $car_row['body_name'] . 
                    " - Engine Type: " . $car_row['type_engine'] . 
                    " - Gearbox: " . $car_row['name_gearbox'] .
                    "</option>";
            }
    
            // Закрываем выпадающий список и добавляем остальные поля формы
            echo "</select>
                    </div>
                    <div class='mb-3'>
                        <label for='year' class='form-label'>Year:</label>
                        <input type='text' class='form-control' name='year' id='year' value='$year' required>
                    </div>
                    <div class='mb-3'>
                        <label for='vin_code' class='form-label'>Vin Code:</label>
                        <input type='text' class='form-control' name='vin_code' id='vin_code' value='$vin_code' required>
                    </div>
        
                    <!-- Добавляем общий скрытый input для передачи id -->
                    <input type='hidden' name='id' value='$id'>
        
                    <button type='submit' class='btn btn-primary'>Update Car</button>
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


