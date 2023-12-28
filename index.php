<?php include 'main_base.php'?>

<?php startblock('link') ?>
    <link rel="stylesheet" href="css/style_main.css">
<?php endblock() ?>


<?php startblock('titlePage') ?>
    AvtoStore
<?php endblock() ?>

<?php startblock('bodyPageMain') ?>
    <div class="block-main">
        <h1 class="greeting">Вітаємо</h1>
        <a class="button" href="auth_page.php">Авторизація</a>
        <a class="button" href="register_page.php">Реєстрація</a>
    </div>
<?php endblock() ?>