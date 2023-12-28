<?php include '../main_base.php'?>

<?php startblock('link') ?>
    <link rel="stylesheet" href="../css/style_main_pz.css">
<?php endblock() ?>


<?php startblock('titlePage') ?>
    AvtoStore Bill
<?php endblock() ?>

<?php startblock('bodyPageMain') ?>
<h1>Bill</h1>
     <div class="container mt-5" style="margin-top: 50px;">
    <div class="row justify-content-center text-center">
        <div class="col-md-4">
            <div class="card" onclick="location.href='./bill_pz/bill_show_pz.php';">
                <img src="../img/show.png" alt="Dealership Icon">
                <h3>Show Information</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card" onclick="location.href='./bill_pz/bill_add_pz.php';">
                <img src="../img/add.png" alt="Car Icon">
                <h3>Add Information</h3>
            </div>
        </div>
        
		<div class="col-md-4">
		    <div class="card" onclick="location.href='../main_page.php';">
            <img src="../img/back_acc.png" alt="Back Icon">
            <h3>AvtoStore</h3>
            </div>
	   </div>
    </div>
</div>
	
<?php endblock() ?>