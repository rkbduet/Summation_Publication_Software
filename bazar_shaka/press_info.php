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
if(isset($_POST['form1'])) {

	try {
	
		if(empty($_POST['press_name'])) {
			throw new Exception(' Enter Press Name.');
		}
		
		if(empty($_POST['manager_name'])) {
			throw new Exception( ' Enter Manager Name.');
		}
		
		if(empty($_POST['mobile'])) {
			throw new Exception( ' Enter Mobile Number.');
		}
		if(empty($_POST['address'])) {
			throw new Exception(' Enter Address');
		}
		
		$query=$db->prepare("insert into  press_info(press_name,m_name,bank_no,mobile,email,address) values(?,?,?,?,?,?)");
		$query->execute(array($_POST['press_name'],$_POST['manager_name'],$_POST['bank_no'],$_POST['mobile'],$_POST['email'],$_POST['address']));
	
		
		$success_message = 'Your data Add Successfully.';
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>
<?php include("header.php")?>

<div class="container">
<br>
<h2 class="title">Add New Press Information</h2>
<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
<br />
<form action="" method="post" >
<table celspacing="1" cellpadding="5">
	<tr>
		<td>Press Name:</td>
		<td><input type="text" name="press_name"/></td>
	</tr>
	<tr>
		<td>Manager Name:</td>
		<td><input type="text" name="manager_name"/></td>
	</tr>
	
	<tr>
		<td>Bank Account No:</td>
		<td><input type="text" name="bank_no"/></td>
	</tr>
	<tr>
		<td>Mobile:</td>
		<td><input type="text" name="mobile"/></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><input type="text" name="email"/></td>
	</tr>
	<tr>
		<td>Address:</td>
		<td><input type="text" name="address"/></td>
	</tr>
<tr>
	<td></td>
	<td><button class="btn btn-success" type="submit" name="form1">Save</button></td>
</tr>


</table>

</form>

</div><!---end container--->