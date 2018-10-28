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
	
	$query=$db->prepare("delete from emp_info where emp_id='$id'");
	$query->execute();
		
	header('location:emp_info_delete.php');
}
else {
	header('location:view_emp_delete.php');
}