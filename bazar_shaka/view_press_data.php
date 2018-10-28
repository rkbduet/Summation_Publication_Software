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



if(isset($_REQUEST['press_name'] )){
$input_press_name=$_REQUEST['press_name'];

		$query=$db->prepare("select * from press_info WHERE press_name=?");
		$query->execute(array($input_press_name));
		$result=$query->rowCount();
		if($result==0) {
			header("location:press_correction.php?error=1");
		}
		

	
		}
	
else{
	
	header("location:press_correction.php?error=0");
}


?>
<?php

	$query=$db->prepare("select * from press_info  where press_name='$input_press_name'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) 
	{
		 $press_name=$row['press_name'];
		 $m_name= $row['m_name'];
		$bank_no=$row['bank_no'];
		$mobile=$row['mobile'];
		 $email= $row['email'];
		$address=$row['address'];
	}
	
	?>
<div class="container">
<h2 class="title">Press Details Information</h2>
<table cellspacing="2" cellpadding="5" >
	<td>Press Name:</td>
	<td><?php echo $press_name;?></td>
	</tr>
	<tr>
		<td>Manager Name:</td>
		<td><?php echo $m_name;?></td>
	</tr>
	<tr>
	<td>Bank Acc. NO:</td>
	<td><?php echo $bank_no;?></td>
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
	<td>Address:</td>
	<td><?php echo $address;?></td>
	</tr>
	
	<tr>
	<td></td>
	<td>
	<a href="update_press_data.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a>
	</tr>
</table>

	
	
</div><!---end container--->
<?php include('footer.php');?>
