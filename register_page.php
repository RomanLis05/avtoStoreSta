<?php require_once 'main_base.php'?>

<?php startblock('link') ?>
    <link rel="stylesheet" href="css/style_register.css">
<?php endblock() ?>
	
<?php startblock('titlePage') ?>
    Grap Registration
<?php endblock() ?>



<?php startblock('bodyPageMain') ?>
    <?php
        $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();
		unset($_SESSION['errors']);

		function displayErrors($errors, $field) {
    		if (!empty($errors[$field])) {
        		foreach ($errors[$field] as $error) {
            		echo '<div class="alert alert-danger custom-alert_register role="alert"><p>' . $error . '</p></div>';
        		}
    		}
		}
    ?>
    <div class="container container-main">
 		<div class="row">
 			<div class="col-md-offset-3 col-md-6">
 				<form class="form-horizontal" action="script/register_script.php" method="POST">
 					<span class="heading">РЕЄСТРАЦІЯ</span>
 					<div class="form-group">
						<input type="text" class="form-control input_default_all" id="inputLogin" placeholder="Login" name="loginReg">
 						<i class="fa fa-user"></i>
 						<?php displayErrors($errors, 'loginRegEmpty'); ?>
 						<?php displayErrors($errors, 'loginRegLenght'); ?>					
 					</div>
 					<div class="form-group">
						<input type="email" class="form-control input_default_all" id="inputEmail" placeholder="E-mail" name="emailReg">
 						<i class="fa fa-envelope-o"></i>
 						<?php displayErrors($errors, 'emailRegEmpty'); ?>
 						<?php displayErrors($errors, 'emailRegIS'); ?>
 					</div>
 					<div class="form-group">
 						<input type="tel" class="form-control input_default_all" id="inputPhone" placeholder="066-123-45-67" pattern="[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}" name="phoneReg">
 						<i class="fa fa-mobile"></i>
 						<?php displayErrors($errors, 'phoneRegEmpty'); ?>
 						<?php displayErrors($errors, 'phoneRegIS'); ?>
 					</div>
 					<div class="form-group">
 						<input type="password" class="form-control input_default_all" id="inputPassword" placeholder="Password" name="passwordReg">
 						<i class="fa fa-lock"></i>
 						<?php displayErrors($errors, 'passwdRegEmpty'); ?>
 						<?php displayErrors($errors, 'passwdRegLenght'); ?>
 					</div>
 					<div class="form-group">
 						<button type="submit" class="btn btn-default">ЗАРЕЄСТРУВАТИСЯ</button>
 					</div>
 					<div class="form-group">
 						<a class="btn btn-default" href="index.php">НАЗАД</a>
 					</div>
 				</form>
 			</div>
 		</div>
	</div>
<?php endblock() ?>