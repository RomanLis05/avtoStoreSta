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
    <h1>Show Bill</h1>

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
            document.forms[0].submit(); // Опционально, отправить форму после сброса
        }
    </script>

    <div class="container mt-5">
        <table class="table" style="margin-top: 50px;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Customer Last Name</th>
                    <th>Customer Middle Name</th>
                    <th>Sum</th>
                    <th>Date Buy</th>
                    <th>Dealership</th>   
                    <th style="width: 50px;">Edit</th>
                    <th style="width: 50px;">Delete</th>				
                </tr>
            </thead>
            <tbody>
                <?php
                // Запрос к базе данных для получения данных
                $sql = "SELECT b.bill_id,
                        c.customer_name,
                        c.customer_last_name,
                        c.customer_middle_name,
                        b.bill_sum, 
                        b.bill_date_buy,
                        d.dealership_location AS dealership
                        FROM bill b
                        LEFT JOIN customer c ON b.customer_id = c.customer_id
                        LEFT JOIN dealership d ON b.dealership_id = d.dealership_id";

                // Добавленный блок для обработки поискового запроса
                if(isset($_POST['search'])) {
                    $search = mysqli_real_escape_string($conn, $_POST['search']);
                    $sql .= " WHERE 
                        c.customer_name LIKE '%$search%' OR 
                        c.customer_last_name LIKE '%$search%' OR 
                        c.customer_middle_name LIKE '%$search%' OR 
                        b.bill_sum LIKE '%$search%' OR 
                        b.bill_date_buy LIKE '%$search%' OR 
                        d.dealership_location LIKE '%$search%'";
                }

                $result = $conn->query($sql);

                // Вывод данных из базы данных в таблицу
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["bill_id"] . "</td>
                                <td>" . $row["customer_name"] . "</td>
                                <td>" . $row["customer_last_name"] . "</td>
                                <td>" . $row["customer_middle_name"] . "</td>
                                <td>" . $row["bill_sum"] . "</td>
                                <td>" . $row["bill_date_buy"] . "</td>
                                <td>" . $row["dealership"] . "</td>
								<td><a href='./bill_edit_pz.php?id=" . $row["bill_id"] . "'><img src='../../img/pencil.png' style='width: 40px; border: 0px solid #525a61;'></a></td>
                                <td><a href='../../script/del_bill_script.php?id=" . $row["bill_id"] . "'><img src='../../img/delete.png' style='width: 40px; border: 0px solid #525a61;'></a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No data available</td></tr>";
                }

                // Закрываем соединение
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>


<?php endblock() ?>