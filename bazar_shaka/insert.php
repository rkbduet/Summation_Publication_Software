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
	
		
		if(empty($_POST['c_name'])) {
			throw new Exception( 'Enter Name.');
		}
		
		if(empty($_POST['shop_name'])) {
			throw new Exception( 'Enter Shop Name.');
		}
		if(empty($_POST['shop_id'])) {
			throw new Exception( 'Enter Shop ID.');
		}
		if(empty($_POST['tikana'])) {
			throw new Exception( ' Enter Address.');
		}
		if(!(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $_POST['email']))) {
		throw new Exception('Please enter a valid email address');
	}
		
	$query=$db->prepare("select * from client_info where shop_id=? ");
	$query->execute(array($_POST['shop_id']));
	$result=$query->rowCount();
	if($result>0){
	throw new Exception( ' This Shop ID Already Exists.');
	}
	else{
		$query=$db->prepare("insert into  client_info(c_name,dokaner_name,shop_id,address,mobile,email) values(?,?,?,?,?,?)");
		$query->execute(array($_POST['c_name'],$_POST['shop_name'],$_POST['shop_id'],$_POST['tikana'],$_POST['mobile_no'],$_POST['email']));
	
		$success_message = 'Informaton Save Successfully.';
		}
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>
<?php include("header.php")?>

<div class="container">
<br />
<h2 class="title">Details Informaton of New Client.</h2>
<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
<form action="" method="post" >
<table celspacing="1" cellpadding="5">
	
 <tr>
 	<td>Name:</td>
 	<td><input type="text" name="c_name"/></td>
 </tr>
 <tr>
 	<td>Shop Name:</td>
 	<td><input type="text" name="shop_name"/></td>
 </tr>
 <tr>
 	<td>Shop ID:</td>
 	<td><input type="text" name="shop_id"/></td>
 </tr>
<tr>
	<td>Address:</td>
	<td><input type="text" name="tikana" /></td>
</tr>
<tr>
	<td>Mobile:</td>
	<td><input type="text" name="mobile_no" /></td>
</tr>
<tr>
	<td>Email:</td>
	<td><input type="text" name="email" /></td>
</tr>
<tr>
	<td></td>
	<td><button class="btn btn-success" type="submit" name="form1">Save</button></td>
</tr>
</table>

</form>

</div> 
</div><!---end container--->