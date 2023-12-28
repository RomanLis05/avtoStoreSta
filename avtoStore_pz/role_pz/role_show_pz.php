<?php include '../../main_base.php'?>
<style>
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
    <link rel="stylesheet" href="../../css/style_main_pz.css">
<?php endblock() ?>


<?php startblock('titlePage') ?>
    AvtoStore Role
<?php endblock() ?>

<?php startblock('bodyPageMain') ?>

    <?php 
        require_once '../../script/connect.php';
        if (!isset($_SESSION['email'])) {
            header('Location: auth_page.php');
            exit();
        }

        // Инициализация переменной для поиска
        $search = '';

        // Обработка поискового запроса
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $search = mysqli_real_escape_string($conn, $_POST['search']);
        }

        // Запрос к базе данных для получения данных
        $sql = "SELECT role_id, role_name, employees_salary FROM role";

        // Добавление условия поиска, если есть запрос
        if (!empty($search)) {
            $sql .= " WHERE 
                role_id LIKE '%$search%' OR 
                role_name LIKE '%$search%' OR 
                employees_salary LIKE '%$search%'";
        }

        $result = $conn->query($sql);
    ?>

<div class="col-md-4" style="width: 0px">
    <div class="card" onclick="location.href='/avtoStore_pz/role_pz.php';">
        <img src="../../img/back_acc.png" alt="Back Icon">
    </div>
</div>

<h1>Show Role</h1>

<!-- Добавленная форма для поиска и сброса -->
<div class="container mt-3">
    <form action="" method="post">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search" placeholder="Enter search query" value="<?php echo $search; ?>">
        <button type="submit">Search</button>
        <button type="button" onclick="resetFilters()">Reset</button>
    </form>
</div>

<script>
    // Функция для сброса фильтров
    function resetFilters() {
        document.getElementById("search").value = "";
        document.forms[0].submit(); // Опционально, отправить форму после сброса
    }
</script>

<div class="container mt-5">
    <table class="table" style="margin-top: 50px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Position</th>
                <th>Salary</th>
                <th style="width: 50px;">Edit</th>
                <th style="width: 50px;">Delete</th>	           
            </tr>
        </thead>
        <tbody>
            <?php
            // Вывод данных из базы данных в таблицу
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["role_id"] . "</td>
                            <td>" . $row["role_name"] . "</td>
                            <td>" . $row["employees_salary"] . "</td>
                            <td><a href='./role_edit_pz.php?id=" . $row["role_id"] . "'><img src='../../img/pencil.png' style='width: 40px; border: 0px solid #525a61;'></a></td>
                            <td><a href='../../script/del_role_script.php?id=" . $row["role_id"] . "'><img src='../../img/delete.png' style='width: 40px; border: 0px solid #525a61;'></a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No data available</td></tr>";
            }

            // Закрываем соединение
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<?php endblock() ?>