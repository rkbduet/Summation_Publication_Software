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
	
	$query=$db->prepare("delete from memo_report where memo_id='$id'");
	$query->execute();
		
	header('location:input_memo_num.php');
}
else {
	header('location:memo.php');
}