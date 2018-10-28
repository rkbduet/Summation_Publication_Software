<?php
ob_start();
session_start();
if($_SESSION['name']!='tread')
{
	header('location: login.php');
}
?>
<?php
include('../config.php');

if(isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
	
	$query=$db->prepare("delete from tred_lisence_application where app_serial='$id'");
	$query->execute();
		
	header('location: application_form.php');
}
else {
	header('location: view.php');
}