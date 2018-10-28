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



if(isset($_REQUEST['dokan_name']) && isset($_REQUEST['shop_id'])){
$input_dokan_name=$_REQUEST['dokan_name'];
$input_shop_id=$_REQUEST['shop_id'];

		$query=$db->prepare("select * from client_info WHERE dokaner_name=? and shop_id=?");
		$query->execute(array($input_dokan_name,$input_shop_id));
		$result=$query->rowCount();
		if($result==0) {
			header("location:dokan_data_correction.php?error=1");
		}
		

	
		}
	
else{
	
	header("location:dokan_data_correction.php?error=0");
}


?>
<?php

	
	$query=$db->prepare("select * from client_info  where dokaner_name='$input_dokan_name' and shop_id=
	'$input_shop_id'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) 
	{
		
		$client_name= $row['c_name'];
		 $dokaner_name=$row['dokaner_name'];
		$shop_id=$row['shop_id'];
		$address=$row['address'];
		$mobile=$row['mobile'];
		$email=$row['email'];
		
		
	}
	
	?>
<div class="container">
<h2 class="title">Client Details Informations: </h2>
<table cellspacing="2" cellpadding="5" >
	
	<tr>
	<td>Name:</td>
	<td><?php echo $client_name;?></td>
	</tr>
	<tr>
		<td>Shop Name:</td>
		<td><?php echo $dokaner_name;?></td>
	</tr>
	<tr>
		<td>Shop ID:</td>
		<td><?php echo $shop_id;?></td>
	</tr>
	<tr>
	<td>Address:  </td>
	<td><?php echo $address;?></td>
	</tr>
	<tr>
		<td>Mobile:</td>
		<td><?php echo $mobile;?></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><?php echo $email;?></td>
	</tr>
	<tr>
		<td></td>
		<td>
	<a href="update.php?id=<?php echo $row['m_id']; ?>" class="btn btn-success">Edit</a>
	</tr>
</table>

	
	
</div><!---end container--->
<?php include('footer.php');?>
