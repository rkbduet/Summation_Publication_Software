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

	<script>
		function confirm_delete() {
			return confirm('Are You sure want to Delete this Information?');
		}
	</script>
		
<?php 



if(isset($_REQUEST['shop_id']) && isset($_REQUEST['dokaner_name'])){
$input_shop_id=$_REQUEST['shop_id'];
$input_shop_name=$_REQUEST['dokan_name'];

		$query=$db->prepare("select * from client_info WHERE shop_id=? and dokaner_name=?");
		$query->execute(array($input_shop_id,$input_shop_name));
		$result=$query->rowCount();
		if($result==0) {
			header("location:view_dokan_data.php?error=1");
		}
		

	
		}
	
else{
	
	header("location:view_dokan_data.php?error=0");
}


?>
<?php

	
	$query=$db->prepare("select * from client_info  where shop_id='$input_shop_id' and dokaner_name='$input_shop_name'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) 
	{
		 
		$c_name= $row['c_name'];
		 $shop_name=$row['dokaner_name'];
		 $shop_id=$row['shop_id'];
		$address=$row['address'];
		$mobile=$row['mobile'];
		$email=$row['email'];
		
		
	}
	
	?>
<div class="container">
<h2 class="title">Client All Informations: </h2>
<table cellspacing="2" cellpadding="5" >
	<tr>
		<td>Name:</td>
		<td><?php echo $c_name;?></td>
		
	</tr>
	<tr>
		<td>Shop Name:</td>
		<td><?php echo $shop_name;?></td>
	</tr>
	<tr>
		<td>Shop ID:</td>
		<td><?php echo $shop_id;?></td>
	</tr>
	<tr>
	<td>Address:</td>
	<td><?php echo $address;?></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><?php echo $email;?></td>
	</tr>
	<tr>
		<td></td>
		<td>
	<a onclick="return confirm_delete();" href="delete.php?id=<?php echo $row['m_id']; ?>" class="btn btn-danger">Delete</a></td>
	</tr>
</table>

	
	
</div><!---end container--->
<?php include('footer.php');?>
