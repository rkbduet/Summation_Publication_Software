<?php
ob_start();
session_start();
if($_SESSION['name']!='hold')
{
	header('location: login.php');
}
?>
<?php
include('../config.php');

if(isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
	
	$query=$db->prepare("delete from bank_id where bank_id='$id'");
	$query->execute();
		
	header('location: bank_list.php?');
}