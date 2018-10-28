<?php
ob_start();
session_start();
if($_SESSION['name']!='tangail')
{
	header('location: login.php');
}
?>
<?php include('../config.php'); ?>
<?php include("header.php");?>

<?php 

if(isset($_POST['update'])) {

	$query=$db->prepare("select * from memo_report where memo_num=?");
	$query->execute(array($_POST['memo_num']));
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) 
	{	
		$memo_id=$row['memo_id'];
		$memo_no=$row['memo_num'];
		$date=$row['date'];
		 $shop_name=$row['shop_name'];
		 $shop_id= $row['shop_id'];
		 
		$book_ids= $row['book_id'];
		 $quantitys=$row['quantity'];
		$rates=$row['rate'];
		$amounts=$row['price'];
		$total_price=$row['total_price'];
		$paid=$row['paid'];
		$due=$row['due'];
		
	}
	
		
		$query_update = $db->prepare("UPDATE memo_report SET memo_num=?,shop_name=?,shop_id=?,total_price=?, paid=?,due=?,date=? WHERE memo_id=?");
		$query_update->execute(array($_POST['memo_num'],$_POST['shop_name'],$_POST['shop_id'],$total_price,$paid,$due,$_POST['date'],$_POST['hdn']));
	
		header("location:memo.php?error=0");
	

	}
	
	else {
		header("location: memo.php?error=1");
	}
	

?>
	
