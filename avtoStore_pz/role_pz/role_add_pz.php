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
    AvtoStore Role
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
        <div class="card" onclick="location.href='/avtoStore_pz/role_pz.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>

    <!-- Форма для добавления нового role -->
    <div class="container mt-3">
     <h1 class="mt-5" style="text-align: center; margin-top: 100px;">Add new Role</h1>
        <form action="../../script/add_role_script.php" method="POST">
            <div class="mb-3">
                <label for="role_name" class="form-label">Name:</label>
                <input type="text" class="form-control" name="role_name" id="role_name" required>
                <?php displayErrors($errors, 'RoleNameErrorLen'); ?>
            </div>
            <div class="mb-3">
                <label for="salary" class="form-label">Salary:</label>
                <input type="text" class="form-control" name="salary" id="salary" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Role</button>
        </form>
    </div>

<?php endblock() ?>