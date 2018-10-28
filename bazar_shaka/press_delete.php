<?php
ob_start();
session_start();
if($_SESSION['name']!='tangail')
{
	header('location: login.php');
}
?>
<?php
include('../config.php');

if(isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
	
	$query=$db->prepare("delete from press_info where id='$id'");
	$query->execute();
		
	header('location:view_press_data_delete.php');
}
else {
	header('location:view_press_data_delete.php');
}