<?php
ob_start();
session_start();
if($_SESSION['name']!='hold')
{
	header('location: login.php');
}
?>
<?php include('../config.php'); ?>
<?php include("header.php");?>
	
<?php 
$statement = $db->prepare("SHOW TABLE STATUS LIKE 'tred_lisence_application'");
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
$new_id = $row[10];
$app_serial=$new_id-1;
?>
<div class="container" id="market_info">
<h2 class="app_code">আপনার আবেদন ফরম নং : <?php echo $app_serial; ?></h2>

</div>
</body>
</html>