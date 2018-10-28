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

if(isset($_REQUEST['book_id']) && isset($_REQUEST['date'])){
$input_book_id=$_REQUEST['book_id'];
$input_date=$_REQUEST['date'];

		$query=$db->prepare("select * from import WHERE book_id=? and date=?");
		$query->execute(array($input_book_id,$input_date));
		$result=$query->rowCount();
		if($result==0) {
			header("location:update_last_stock.php?error=1");
		}
		

	
		}


?>

<?php

	
	$query=$db->prepare("select * from import  where book_id='$input_book_id' and date='$input_date'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) 
	{
		
		$book_name= $row['book_name']; 	 	 	 	 	 	 	 	
		 $book_id=$row['book_id'];
		$form_size=$row['forma_size'];
		$press_name=$row['press_name'];
		$num_book=$row['num_book'];
		$date=$row['date'];
		
	}
	
	?>
<div class="container">
<h2 class="title">Last Import Book  Informations: </h2>
<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
<table cellspacing="2" cellpadding="5" >
	
	<tr>
 	<td>Book Name:</td>
 	<td><?php echo $book_name;?></td>
 </tr>
 <tr>
 	<td>Book ID:</td>
 	<td><?php echo $book_id;?></td>
 </tr>
 
<tr>
	<td>Forma Size:</td>
	<td><?php echo $form_size;?></td>
</tr>
<tr>
	<td>Press Name:</td>
	<td><?php echo $press_name;?></td>
</tr>

<tr>
	<td>Number of Book:</td>
	<td><?php echo $num_book;?></td>
</tr>

<tr>
	<td>Import Date</td>
	<td><?php echo $date;?></td>
</tr>
	<tr>
		<td></td>
	
	<td><a href="update_stock.php?id=<?php echo $row['import_id']; ?>" class="btn btn-success">Edit</a></td>
	</tr>
</table>

	
	
</div><!---end container--->
<?php include('footer.php');?>
