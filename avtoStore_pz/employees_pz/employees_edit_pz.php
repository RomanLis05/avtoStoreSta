<?php include '../../main_base.php'?>
<style>
body{
    height: 700px;  
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
    AvtoStore Employees
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
        <div class="card" onclick="location.href='/avtoStore_pz/employees_pz.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>

    <?php
        if (isset($_GET['id'])) {
        // Получаем значение id из запроса
        $id = $_GET['id'];
    
        // Получаем данные из базы данных по указанному id
        $sql = "SELECT * FROM employees WHERE employees_id = $id";
        $result = mysqli_query($conn, $sql);
    
        // Проверяем, успешен ли запрос
        if ($result) {
            // Отримання даних про працівника
            $e_row = mysqli_fetch_assoc($result);
    
            // Отримання списку автосалонів
            $dealership_query = "SELECT dealership_id, dealership_location FROM dealership;";
            $dealership_result = mysqli_query($conn, $dealership_query);
    
            // Отримання списку ролей
            $role_query = "SELECT role_id, role_name FROM role;";
            $role_result = mysqli_query($conn, $role_query);
    
            while ($dealership_row = mysqli_fetch_assoc($dealership_result)) {
                $selected = ($dealership_row['dealership_id'] == $e_row['dealership_id']) ? 'selected' : '';
                $dealership_options .= "<option value='" . $dealership_row['dealership_id'] . "' $selected>" . $dealership_row['dealership_location'] . "</option>";
            }
            while ($role_row = mysqli_fetch_assoc($role_result)) {
                $selected = ($role_row['role_id'] == $e_row['role_id']) ? 'selected' : '';
                $role_options .= "<option value='" . $role_row['role_id'] . "' $selected>" . $role_row['role_name'] . "</option>";
            }

            // Виведення форми редагування
            echo "<div class='container mt-3'>
                    <h1 class='mt-5' style='text-align: center; margin-top: 100px;'>Edit Employees</h1>
                    <form action='../../script/edit_employees_script.php' method='POST'>
                        <div class='mb-3'>
                            <label for='e_name' class='form-label'>Name:</label>
                            <input type='text' class='form-control' name='e_name' value='" . $e_row['employees_name'] . "' required>
                        </div>
                        <div class='mb-3'>
                            <label for='e_last_name' class='form-label'>Last Name:</label>
                            <input type='text' class='form-control' name='e_last_name' value='" . $e_row['employees_last_name'] . "' required>
                        </div>
                        <div class='mb-3'>
                            <label for='e_middle_name' class='form-label'>Middle Name:</label>
                            <input type='text' class='form-control' name='e_middle_name' value='" . $e_row['employees_middle_name'] . "' required>
                        </div>
                        <div class='mb-3'>
                            <label for='e_phone' class='form-label'>Phone:</label>
                            <input type='text' class='form-control' name='e_phone' value='" . $e_row['employees_phone'] . "' required>
                        </div>
                        <div class='mb-3'>
                            <label for='e_mail' class='form-label'>Email:</label>
                            <input type='email' class='form-control' name='e_mail' value='" . $e_row['employees_mail'] . "' required>
                        </div>
                        <div class='mb-3'>
                            <label for='e_birthday' class='form-label'>Birthday:</label>
                            <input type='date' class='form-control' name='e_birthday' value='" . $e_row['employees_birthday'] . "' required>
                        </div>
                        <div class='mb-3'>
                            <label for='e_post_time' class='form-label'>Post Time:</label>
                            <input type='date' class='form-control' name='e_post_time' value='" . $e_row['employees_post_time'] . "' required>
                        </div>
                        <div class='mb-3'>
                            <label for='dealership_id' class='form-label'>Dealership:</label>
                            <select class='form-select' name='dealership_id' required>
                                $dealership_options
                            </select>
                        </div>
                        <div class='mb-3'>
                            <label for='role_id' class='form-label'>Role:</label>
                            <select class='form-select' name='role_id' required>
                                $role_options
                            </select>
                        </div>
                        <input type='hidden' name='id' value='$id'>
                        <button type='submit' class='btn btn-primary'>Update Employee</button>
                    </form>
                </div>";
        } else {
            // Якщо запити не вдалися, виведіть повідомлення про помилку
            echo "Помилка при виконанні запитів: " . mysqli_error($conn);
        }
    } else {
        // Якщо параметр id не був переданий, виведіть повідомлення про помилку
        echo "Помилка: Параметр id не був переданий.";
    }
?>

<?php endblock() ?>


