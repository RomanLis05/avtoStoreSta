<?php require_once 'timplate.php' ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1B3K1XXF41"></script>
    <script>
  		window.dataLayer = window.dataLayer || [];
  		function gtag(){dataLayer.push(arguments);}
  		gtag('js', new Date());

  		gtag('config', 'G-1B3K1XXF41');
	</script>
    <?php startblock('link') ?><?php endblock() ?>
	<title><?php startblock('titlePage') ?><?php endblock() ?></title>
</head>
<body>
	<?php 
		session_start();
		startblock('bodyPageMain') ?><?php endblock() 
	?>
	<!-- Google tag (gtag.js) -->
	
	
</body>
</html>