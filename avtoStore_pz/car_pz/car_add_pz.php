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
select{
    margin: 0;
    font: inherit;
    color: inherit;
    padding: 7px;
    border-radius: 5px;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    margin-left: 10px;
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
        $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();
        unset($_SESSION['errors']);
    
        function displayErrors($errors, $field) {
            if (isset($errors[$field]) && is_array($errors[$field])) {
                foreach ($errors[$field] as $error) {
                    echo '<div class="alert alert-danger custom-alert_register" role="alert"><p>' . $error . '</p></div>';
                }
            }
        }
    ?>

    <div class="col-md-4" style="width: 0px">
        <div class="card" onclick="location.href='/avtoStore_pz/car_pz.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>



    <!-- Форма для добавления нового employees -->
    <div class="container mt-3">
     <h1 class="mt-5" style="text-align: center; margin-top: 100px;">Add new Car</h1>
        <form action="../../script/add_car_script.php" method="POST">
            <div class="mb-3">
                <label for="car_model_id" class="form-label">Car Model:</label>
                <select class="form-select" name="car_model_id" id="car_model_id" required>
                    <?php
                        // Запит для отримання варіантів вибору автосалону з таблиці
                        $car_query = "SELECT car_model_id, car_model_name,
                        (SELECT name_brand FROM car_brand WHERE car_brand_id = car_model.car_brand_id) AS brand_name,
                        (SELECT color FROM car_color WHERE car_color_id = car_model.car_color_id) AS color_name,
                        (SELECT name_body FROM car_body WHERE car_body_id = car_model.car_body_id) AS body_name,
                        (SELECT name_type_of_engine FROM car_type_of_engine WHERE car_type_of_engine_id = car_model.car_type_of_engine_id) AS type_engine,
                        (SELECT car_gearbox_name FROM car_gearbox WHERE car_gearbox_id = car_model.car_gearbox_id) AS name_gearbox  FROM car_model;";
                        $car_result = mysqli_query($conn, $car_query);
                    
                        // Перевірка на наявність результатів
                        if ($car_result) {
                            // Перебір результатів і створення опцій
                            while ($car_row = mysqli_fetch_assoc($car_result)) {
                                echo "<option value='" . $car_row['car_model_id'] . "'>" . $car_row['car_model_name'] . 
                                    " - Brand: " . $car_row['brand_name'] . 
                                    " - Color: " . $car_row['color_name'] . 
                                    " - Body: " . $car_row['body_name'] . 
                                    " - Engine Type: " . $car_row['type_engine'] . 
                                    " - Gearbox: " . $car_row['name_gearbox'] .
                                "</option>";
                            }
                            // Звільнення результатів
                            mysqli_free_result($car_result);
                        } else {
                            // Обробка помилок, якщо запит не вдається
                            echo "Помилка запиту: " . mysqli_error($conn);
                        }
                    ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="year" class="form-label">Year:</label>
                <input type="date" class="form-control" name="year" id="year" required>
            </div>
            <div class="mb-3">
                <label for="car_vin_code" class="form-label">VIN code:</label>
                <input type="text" class="form-control" name="car_vin_code" id="car_vin_code" required>
                <?php displayErrors($errors, 'VinCodeErrorLen'); ?>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Car</button>
        </form>
    </div>

<?php endblock() ?>