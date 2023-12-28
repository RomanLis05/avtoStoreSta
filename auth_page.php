<?php include 'main_base.php'?>

<?php startblock('link') ?>
    <link rel="stylesheet" href="css/style_auth.css">
<?php endblock() ?>

<?php startblock('titlePage') ?>
    Grap Auth
<?php endblock() ?>


<?php startblock('bodyPageMain') ?>
    <?php
        $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();
        unset($_SESSION['errors']);

        function displayErrors($errors, $field) {
            if (!empty($errors[$field])) {
                foreach ($errors[$field] as $error) {
                    echo '<div class="alert alert-danger custom-alert_auth role="alert"><p>' . $error . '</p></div>';
                }
            }
        }
    ?>
    <div class="container container-main">
        <div class="row">
 			<div class="col-md-offset-3 col-md-6">
                <form class="form-horizontal" action="script/auth_script.php" method="POST">
 					<span class="heading">АВТОРИЗАЦІЯ</span>
 					<?php displayErrors($errors, 'dataError'); ?>  
                    <div class="form-group">
					    <input type="email" class="form-control input_default_all" id="inputEmail" placeholder="E-mail" name="emailAuth">
 					    <i class="fa fa-user"></i>
 					    <?php displayErrors($errors, 'emailAuthEmpty'); ?>  
                    </div>
 					<div class="form-group help">
 						<input type="password" class="form-control input_default_all" id="inputPassword" placeholder="Password" name="passwordAuth">
 						<i class="fa fa-lock"></i>
                        <?php displayErrors($errors, 'passwdAuthEmpty'); ?>  
 					</div>
 					<div class="form-group">
 						<button type="submit" class="btn btn-default">УВІЙТИ</button>
 					</div>
 					<div class="form-group">
 						<a class="btn btn-default" href="index.php">НАЗАД</a>
 					</div>
 				</form>
 			</div>
 		</div>
	</div>
<?php endblock() ?>
