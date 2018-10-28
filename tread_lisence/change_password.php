<?php
ob_start();
session_start();
if($_SESSION['name']!='tread')
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
			throw new Exception(" পূর্বে পাসওয়ার্ড দিন");
		}
		
		if(empty($_POST['new1'])) {
			throw new Exception(" নতুন পাসওয়ার্ড দিন");
		}
		
		if(empty($_POST['new2'])) {
			throw new Exception("  কনপার্ম পাসওয়ার্ড দিন");
		}
		
		$statement = $db->prepare("SELECT * FROM homepage_admin WHERE admin_id=2");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row)
		{
			
			$old_password = md5($_POST['old']);
			if($old_password != $row['a_password'])
			{
				throw new Exception("পুরাতন পাসওয়ার্ড ভূল আছে ");
			}
					
		}
		
		if($_POST['new1'] != $_POST['new2'])
		{
			throw new Exception("নতুন পাসওয়ার্ড ও কনপার্ম পাসওয়ার্ড মিল নাই");
		}
		
		
		$new_final_password = md5($_POST['new1']);
		
		$statement = $db->prepare("UPDATE homepage_admin SET a_password=? WHERE admin_id=2");
		$statement->execute(array($new_final_password));
		
		$success_message = "আপনার পাসওয়ার্ড  পরির্নর্তন হয়েছে";
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
	
}
?>
<div class="container">
<h1 class="center">পাসওয়ার্ড পরিবর্তন করুন</h1>

 <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>


<form action="" method="post">
<table class="tbl1">
<tr>
	<td>পুরাতন পাসওয়ার্ড</td>
	<td><input class="short" type="password" name="old"></td>
</tr>
<tr>
	<td>নতুন পাসওয়ার্ড</td>

	<td><input class="short" type="password" name="new1"></td>
</tr>
<tr>
	<td>কনপার্ম পাসওয়ার্ড</td>
	<td><input class="short" type="password" name="new2"></td>
</tr>
<tr>
<td></td>
	<td><button type="submit" class="btn btn-default" name="form1">পরিবর্নতন করুন</button></td>
</tr>
</table>	
</form>
</div>

<?php include("footer.php"); ?>			