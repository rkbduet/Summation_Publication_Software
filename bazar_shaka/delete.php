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
	
	$query=$db->prepare("delete from client_info where m_id='$id'");
	$query->execute();
		
	header('location:view_dokan_data.php');
}
else {
	header('location: view_dokan_data.php');
}