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
			return confirm('Are You sure want to Delete?');
		}
</script>
		
<?php 



if(isset($_REQUEST['emp_name'] )){
$input_emp_name=$_REQUEST['emp_name'];

		$query=$db->prepare("select * from emp_info WHERE emp_name=?");
		$query->execute(array($input_emp_name));
		$result=$query->rowCount();
		if($result==0) {
			header("location:emp_info_delete.php?error=1");
		}
		

	
		}
	

?>
<?php

	$query=$db->prepare("select * from emp_info  where emp_name='$input_emp_name'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) 
	{
		 $emp_name=$row['emp_name'];
		 $emp_f_name= $row['emp_f_name'];
		$address=$row['address'];
		$nid=$row['nid'];
		$mobile=$row['mobile'];
		 $email= $row['email'];
		$degination=$row['degination'];
		$join_date= $row['join_date'];
		$resign_date=$row['resign_date'];
	}
	
	?>
<div class="container">
<h2 class="title">Employee  Details Information</h2>
<table cellspacing="2" cellpadding="5">
	<td>Employee Name:</td>
	<td><?php echo $emp_name;?></td>
	</tr>
	<tr>
		<td>Father Name:</td>
		<td><?php echo $emp_f_name;?></td>
	</tr>
	<tr>
	<td>Parmanent Address:</td>
	<td><?php echo $address;?></td>
	</tr>
	<tr>
	<td>National ID:</td>
	<td><?php echo $nid;?></td>
	</tr>
	<tr>
	<td>Mobile / Phone:</td>
	<td><?php echo $mobile;?></td>
	</tr>
	<tr>
	<td>Email:</td>
	<td><?php echo $email;?></td>
	</tr>
	<tr>
	<td>Degination:</td>
	<td><?php echo $degination;?></td>
	</tr>
	<tr>
	<td>Joining Date:</td>
	<td><?php echo $join_date;?></td>
	</tr>
	<tr>
	<td>Resign Date:</td>
	<td><?php if($row['resign_date']<=0){
		echo "Running" ; 
		}
		else {
		echo $row['resign_date'];
		}?></td>
	</tr>
	<tr>
	<td></td>
	<td>
	<a onclick="return confirm_delete();" href="emp_delete.php?id=<?php echo $row['emp_id']; ?>" class="btn btn-danger">Delete</a></td>
	</tr>
</table>

	
	
</div><!---end container--->
<?php include('footer.php');?>
