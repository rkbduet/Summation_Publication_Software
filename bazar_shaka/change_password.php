<?php
ob_start();
session_start();
if($_SESSION['name']!='tangail')
{
	header('location: login.php');
}
?>
<?php include"header.php"?>
<?php include('../config.php');?>

<?php
if(isset($_POST['form1'])) {
	
	try {
	
		if(empty($_POST['old'])) {
			throw new Exception(" Enter Old password.");
		}
		
		if(empty($_POST['new1'])) {
			throw new Exception(" Enter New Password.");
		}
		
		if(empty($_POST['new2'])) {
			throw new Exception("  Enter Confirm Password.");
		}
		
		$statement = $db->prepare("SELECT * FROM homepage_admin WHERE admin_id=4");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row)
		{
			
			$old_password = md5($_POST['old']);
			if($old_password != $row['a_password'])
			{
				throw new Exception("Incorrect Old Password. ");
			}
					
		}
		
		if($_POST['new1'] != $_POST['new2'])
		{
			throw new Exception("New Password and Confirm Password is not equal.");
		}
		
		
		$new_final_password = md5($_POST['new1']);
		
		$statement = $db->prepare("UPDATE homepage_admin SET a_password=? WHERE admin_id=4");
		$statement->execute(array($new_final_password));
		
		$success_message = "Your Password Changed Successfully.";
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
	
}
?>
<div class="container">
<h1 class="title">Changed Password</h1>

 <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>


<form action="" method="post">
<table class="" cellpadding="5" cellspacing="0" >
<tr>
	<td>Old Password:</td>
	<td><input class="short" type="password" name="old"></td>
</tr>
<tr>
	<td>New Password:</td>

	<td><input class="short" type="password" name="new1"></td>
</tr>
<tr>
	<td>Confirm Password:</td>
	<td><input class="short" type="password" name="new2"></td>
</tr>
<tr>
<td></td>
	<td><button type="submit" class="btn btn-success" name="form1">Change Password.</button></td>
</tr>
</table>	
</form>
</div>

<?php include("footer.php"); ?>			