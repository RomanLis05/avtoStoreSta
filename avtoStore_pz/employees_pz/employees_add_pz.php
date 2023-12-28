<?php include '../../main_base.php'?>
<style>
body{
    height: 750px;  
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
    AvtoStore Employees
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
        <div class="card" onclick="location.href='/avtoStore_pz/employees_pz.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>



    <!-- Форма для добавления нового employees -->
    <div class="container mt-3">
     <h1 class="mt-5" style="text-align: center; margin-top: 100px;">Add new Employees</h1>
        <form action="../../script/add_employees_script.php" method="POST">
            <div class="mb-3">
                <label for="name_e" class="form-label">Name:</label>
                <input type="text" class="form-control" name="name_e" id="name_e" required>
                <?php displayErrors($errors, 'Name_E_ErrorLen'); ?>
            </div>
            <div class="mb-3">
                <label for="last_name_e" class="form-label">Last Name:</label>
                <input type="text" class="form-control" name="last_name_e" id="last_name_e" required>
                <?php displayErrors($errors, 'Last_Name_E_ErrorLen'); ?>
            </div>
            <div class="mb-3">
                <label for="middle_name_e" class="form-label">Middle Name:</label>
                <input type="text" class="form-control" name="middle_name_e" id="middle_name_e" required>
                <?php displayErrors($errors, 'Middle_Name_E_ErrorLen'); ?>
            </div>
            <div class="mb-3">
                <label for="phone_e" class="form-label">Phone:</label>
                <input type="tel" class="form-control" name="phone_e" id="phone_e" required>
            </div>
            <div class="mb-3">
                <label for="email_e" class="form-label">E-mail:</label>
                <input type="email" class="form-control" name="email_e" id="email_e" required>
            </div>
            <div class="mb-3">
                <label for="birthday_e" class="form-label">Birthday:</label>
                <input type="date" class="form-control" name="birthday_e" id="birthday_e" required>
            </div>
            <div class="mb-3">
                <label for="post_time_e" class="form-label">Post Time:</label>
                <input type="date" class="form-control" name="post_time_e" id="post_time_e" required>
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
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="role_e" class="form-label">Role:</label>
                <select class="form-select" name="role_e" id="role_e" required>
                    <?php
                        // Запит для отримання варіантів вибору автосалону з таблиці
                        $role_query = "SELECT role_id, role_name FROM role;";
                        $role_result = mysqli_query($conn, $role_query);
                    
                        // Перевірка на наявність результатів
                        if ($role_result) {
                            // Перебір результатів і створення опцій
                            while ($role_row = mysqli_fetch_assoc($role_result)) {
                                echo "<option value='" . $role_row['role_id'] . "'>" . $role_row['role_name'] . "</option>";
                            }
                            // Звільнення результатів
                            mysqli_free_result($role_result);
                        } else {
                            // Обробка помилок, якщо запит не вдається
                            echo "Помилка запиту: " . mysqli_error($conn);
                        }
                    
                        // Закриття з'єднання з базою даних
                        mysqli_close($conn);
                    ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Employees</button>
        </form>
    </div>

<?php endblock() ?>