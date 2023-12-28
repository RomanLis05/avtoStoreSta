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
img{
	border: 2px solid #525a61;
    border-radius: 15px;
	padding: 5px;
}
</style>
<?php startblock('link') ?>
    <link rel="stylesheet" href="../../css/style_main_pz.css">
<?php endblock() ?>


<?php startblock('titlePage') ?>
    AvtoStore Dealerships
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

    <h1>Show Dealerships</h1>
	
	
	

    <!-- Добавленная форма для поиска и сброса -->
    <div class="container mt-3">
	
        <form action="" method="post">
            <label for="search">Search:</label>
            <input type="text" name="search" id="search" placeholder="Enter search query">
            <button type="submit">Search</button>
            <button type="button" onclick="resetFilters()">Reset</button>
        </form>
    </div>

    <script>
        // Функция для сброса фильтров
        function resetFilters() {
            document.getElementById("search").value = "";
            // Выполните здесь дополнительные действия для полного сброса, если необходимо
            // Например, можно добавить дополнительные поля в форму и сбросить их значения
            document.forms[0].submit(); // Опционально, отправить форму после сброса
        }
    </script>

    <div class="container mt-5">
        <table class="table" style="margin-top: 50px;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Location</th>
                    <th>Parks</th>
                    <th>Access</th>
                    <th style="width: 50px;">Edit</th>
                    <th style="width: 50px;">Delete</th>	            
                </tr>
            </thead>
            <tbody>
                <?php
                // Запрос к базе данных для получения данных
                $sql = "SELECT dealership_id, dealership_location, dealership_parks, dealership_access FROM dealership";

                // Добавленный блок для обработки поискового запроса
                if(isset($_POST['search'])) {
                    $search = mysqli_real_escape_string($conn, $_POST['search']);
                    $sql .= " WHERE 
                               dealership_id LIKE '%$search%' OR 
                               dealership_location LIKE '%$search%' OR 
                               dealership_parks LIKE '%$search%' OR 
                               dealership_access LIKE '%$search%'";
                }

                $result = $conn->query($sql);

                // Вывод данных из базы данных в таблицу
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["dealership_id"] . "</td>
                                <td>" . $row["dealership_location"] . "</td>
                                <td>" . $row["dealership_parks"] . "</td>
                                <td>" . $row["dealership_access"] . "</td>
                                <td><a href='./dealership_edit_pz.php?id=" . $row["dealership_id"] . "'><img src='../../img/pencil.png' style='width: 40px; border: 0px solid #525a61;'></a></td>
                                <td><a href='../../script/del_dealership_script.php?id=" . $row["dealership_id"] . "'><img src='../../img/delete.png' style='width: 40px; border: 0px solid #525a61;'></a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No data available</td></tr>";
                }

                // Закрываем соединение
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
	

<?php endblock() ?>