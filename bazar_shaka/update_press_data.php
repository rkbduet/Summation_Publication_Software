
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
}
else {
	header('location: view_press_data.php');
}
if(isset($_POST['form1'])) {

	try {
	
		if(empty($_POST['press_name'])) {
			throw new Exception(' Enter Press Name.');
		}
		
		if(empty($_POST['m_name'])) {
			throw new Exception( ' Enter Manager Name.');
		}
		
		if(empty($_POST['mobile'])) {
			throw new Exception( ' Enter Mobile Number.');
		}
		if(empty($_POST['address'])) {
			throw new Exception(' Enter Address');
		}
		
		
		
		$query=$db->prepare("update press_info set press_name=?,m_name=?,bank_no=?,mobile=?,email=?,address=? where id='$id'" );
		$query->execute(array($_POST['press_name'],$_POST['m_name'],$_POST['bank_no'],$_POST['mobile'],$_POST['email'],$_POST['address']));
		$success_message = ' Your data Chnaged successfully.';
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>
<?php include"header.php"?>

<div class="container">
<h2 class="title">Edit Press Information:</h2>
<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>

<br>
<?php
		$query=$db->prepare("select * from press_info where id='$id'");
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
	
<form action="" method="post" >
<table celspacing="1" cellpadding="5">
	<tr>
		<td>Press Name:</td>
		<td><input type="text" name="press_name" id="" value="<?php echo $press_name;?>"/></td>
	</tr>
 <tr>
 	<td>Manager Name:</td>
	<td><input type="text" name="m_name" id="" value="<?php echo $m_name;?>"/></td>
	
 </tr>
 <tr>
 	<td>Bank Acc. No:</td>
	<td><input type="text" name="bank_no" id="" value="<?php echo $bank_no;?>"/></td>
	
 </tr>
 <tr>
	<td>Mobile</td>
	<td><input type="text" name="mobile" value="<?php echo $mobile;?>" /></td>
</tr>
<tr>
 	<td>Email:</td>
	<td><input type="text" name="email" id="" value="<?php echo $email;?>"/></td>
	
 </tr>
 <tr>
	<td>Address</td>
	<td><input type="text" name="address" value="<?php echo $address;?>" /></td>
</tr>

<tr>
	<td></td>
	<td><button class="btn btn-success" type="submit" name="form1">Update</button></td>
</tr>
</table>

</form>

</div> 
</div><!---end container--->