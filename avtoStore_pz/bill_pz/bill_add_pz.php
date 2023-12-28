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



    <!-- Форма для добавления нового bill -->
    <div class="container mt-3">
     <h1 class="mt-5" style="text-align: center; margin-top: 100px;">Add new Bill</h1>
        <form action="../../script/add_bill_script.php" method="POST">
            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer:</label>
                <select class="form-select" name="customer_id" id="customer_id" required>
                <?php        
                    // Запит для отримання варіантів вибору клієнта з таблиці
                    $customer_query = "SELECT customer_id, customer_name, customer_last_name FROM customer";
                    $customer_result = mysqli_query($conn, $customer_query);
            
                    // Перевірка на наявність результатів
                    if ($customer_result) {
                        // Перебір результатів і створення опцій
                        while ($customer_row = mysqli_fetch_assoc($customer_result)) {
                            echo "<option value='" . $customer_row['customer_id'] . "'>" . $customer_row['customer_name'] . " " . $customer_row['customer_last_name'] . "</option>";
                        }
                        // Звільнення результатів
                        mysqli_free_result($customer_result);
                    } else {
                        // Обробка помилок, якщо запит не вдається
                        echo "Помилка запиту: " . mysqli_error($conn);
                    }
                ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="summa" class="form-label">Summa:</label>
                <input type="text" class="form-control" name="summa" id="summa" required>
            </div>
            <div class="mb-3">
                <label for="date_buy" class="form-label">Date Buy:</label>
                <input type="text" class="form-control" name="date_buy" id="date_buy" required>
            </div>
            <div class="mb-3">
                <label for="dealership" class="form-label">Dealership:</label>
                <select class="form-select" name="dealership_id" id="dealership_id" required>
                    <?php
                        // Запит для отримання варіантів вибору автосалону з таблиці
                        $dealership_query = "SELECT dealership_id, dealership_location FROM dealership;";
                        $dealership_result = mysqli_query($conn, $dealership_query);
                    
                        // Перевірка на наявність результатів
                        if ($dealership_result) {
                            // Перебір результатів і створення опцій
                            while ($dealership_row = mysqli_fetch_assoc($dealership_result)) {
                                echo "<option value='" . $dealership_row['dealership_id'] . "'>" . $dealership_row['dealership_location'] . "</option>";
                            }
                            // Звільнення результатів
                            mysqli_free_result($dealership_result);
                        } else {
                            // Обробка помилок, якщо запит не вдається
                            echo "Помилка запиту: " . mysqli_error($conn);
                        }
                    
                        // Закриття з'єднання з базою даних
                        mysqli_close($conn);
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Bill</button>
        </form>
    </div>

<?php endblock() ?>