<?php include '../../main_base.php'?>
<style>
body{
    height: 500px;  
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
    AvtoStore Customer
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
        <div class="card" onclick="location.href='/avtoStore_pz/customer_pz.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>

    
    <div class="container mt-3">
        <h1 class="mt-5" style="text-align: center; margin-top: 100px;">Add new Customer</h1>
        <form action="../../script/add_customer_script.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" name="name" id="name" required>
                <?php displayErrors($errors, 'NameErrorLen'); ?>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name:</label>
                <input type="text" class="form-control" name="last_name" id="last_name" required>
                <?php displayErrors($errors, 'LastNameErrorLen'); ?>
            </div>
            <div class="mb-3">
                <label for="middle_name" class="form-label">Middle Name:</label>
                <input type="text" class="form-control" name="middle_name" id="middle_name" required>
                <?php displayErrors($errors, 'MiddleNameErrorLen'); ?>
            </div>
            <div class="mb-3">
                <label for="number" class="form-label">Phone:</label>
                <input type="tel" class="form-control" name="number" id="number" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="mb-3">
                <label for="birthday" class="form-label">Birthday:</label>
                <input type="date" class="form-control" name="birthday" id="birthday" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Customer</button>
        </form>
    </div>


<?php endblock() ?>