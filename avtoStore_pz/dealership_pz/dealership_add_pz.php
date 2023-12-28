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
    AvtoStore Dealership
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
        <div class="card" onclick="location.href='/avtoStore_pz/dealership_pz.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>

    <!-- Форма для добавления нового dealership -->
    <div class="container mt-3">
        <h1 class="mt-5" style="text-align: center; margin-top: 100px;">Add new Dealership</h1>
        <form action="../../script/add_dealership_script.php" method="POST">
            <div class="mb-3">
                <label for="location" class="form-label">Location:</label>
                <input type="text" class="form-control" name="location" id="location" required>
                <?php displayErrors($errors, 'locationErrorLen'); ?>
            </div>
            <div class="mb-3">
                <label for="parks" class="form-label">Parks:</label>
                <input type="text" class="form-control" name="parks" id="parks" required>
            </div>
            <div class="mb-3">
                <label for="access" class="form-label">Access:</label>
                <input type="text" class="form-control" name="access" id="access" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Dealership</button>
        </form>
    </div>

<?php endblock() ?>
