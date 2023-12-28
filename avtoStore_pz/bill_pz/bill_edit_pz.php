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
    AvtoStore Bill
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
        <div class="card" onclick="location.href='/avtoStore_pz/bill_pz.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>

    <?php
        $id = $_GET['id'];
        
        // Получаем данные из базы данных по указанному id
        $sql = "SELECT * FROM bill WHERE bill_id = $id";
        $result = mysqli_query($conn, $sql);
        
        // Проверяем, успешен ли запрос
        if ($result) {
            // Получение данных о счете
            $bill_row = mysqli_fetch_assoc($result);
        
            // Получение списка клиентов
            $customer_query = "SELECT customer_id, customer_name, customer_last_name, customer_middle_name FROM customer";
            $customer_result = mysqli_query($conn, $customer_query);

            // Получение списка автосалонов
            $dealership_query = "SELECT dealership_id, dealership_location FROM dealership;";
            $dealership_result = mysqli_query($conn, $dealership_query);

            while ($customer_row = mysqli_fetch_assoc($customer_result)) {
                $selected_customer = ($customer_row['customer_id'] == $bill_row['customer_id']) ? 'selected' : '';
                $customer_options .= "<option value='" . $customer_row['customer_id'] . "' $selected_customer>" . $customer_row['customer_name'] . " " . $customer_row['customer_middle_name'] . " " . $customer_row['customer_last_name'] . "</option>";
            }

            while ($dealership_row = mysqli_fetch_assoc($dealership_result)) {
                $selected_dealership = ($dealership_row['dealership_id'] == $bill_row['dealership_id']) ? 'selected' : '';
                $dealership_options .= "<option value='" . $dealership_row['dealership_id'] . "' $selected_dealership>" . $dealership_row['dealership_location'] . "</option>";
            }

            echo "<div class='container mt-3'>
                <h1 class='mt-5' style='text-align: center; margin-top: 100px;'>Edit Bill</h1>
                <form action='../../script/edit_bill_script.php' method='POST'>
                    <div class='mb-3'>
                        <label for='customer_id' class='form-label'>Customer:</label>
                        <select class='form-select' name='customer_id' required>
                            $customer_options
                        </select>
                    </div>
                    <div class='mb-3'>
                        <label for='summa' class='form-label'>Summa:</label>
                        <input type='text' class='form-control' name='summa' value='" . $bill_row['bill_sum'] . "' required>
                    </div>
                    <div class='mb-3'>
                        <label for='date_buy' class='form-label'>Date Buy:</label>
                        <input type='text' class='form-control' name='date_buy' value='" . date('Y-m-d H:i:s', strtotime($bill_row['bill_date_buy'])) . "' required>
                    </div>
                    <div class='mb-3'>
                        <label for='dealership_id' class='form-label'>Dealership:</label>
                        <select class='form-select' name='dealership_id' required>
                            $dealership_options
                        </select>
                    </div>
                    <input type='hidden' name='id' value='$id'>
                    <button type='submit' class='btn btn-primary'>Update Bill</button>
                </form>
            </div>";
        } else {
            // Если запрос не выполнен успешно, вывести сообщение об ошибке
            echo "Ошибка при выполнении запроса: " . mysqli_error($conn);
        }
    ?>

<?php endblock() ?>


