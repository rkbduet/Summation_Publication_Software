<?php 
	if(isset($_POST['login_button'])){
	
	try{
	
	$admin_name=$_POST['user_name'];
	$admin_password=$_POST['user_password'];
	$admin_password = md5($admin_password);
	
	if(empty($admin_name))
	{
	throw new Exception("User Name field Cannot be empty.");
	}
	
	if(empty($admin_password)){
	throw new Exception("Password field Name Cannot be empty.");
	}
	include("config.php");
	
	$query = $db->prepare("select * from homepage_admin where a_name=? and a_password=?  and  admin_id='1'");
	$query->execute(array($admin_name,$admin_password));
	$num=$query->rowCount();
	
	if($num!=0){
	session_start();
	$_SESSION['name']="localhost";
	header("location: index.php");
	
	}
	else{
		throw new Exception("Invalid user name or Password.");
	
	}
	
	
	}
	
	catch(Exception $e){
		$error_message = $e->getMessage();
	}
	
	
	
	}
	


?>
		
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Publication Management Software</title>
	<link rel="stylesheet" type="text/css" href="style.css" media="all" />
</head>
<body>
	<div class="login_form">
	<img class="logo" src="logo.png" alt="logo" />
	<h1>Welcome to Publication Management Software</h1>
		
	<h2>Please Login for Management....</h2>
		
	
		<form action="" method="post"  id="login_table">
		<?php
			if(isset($error_message)){
				echo "<h1 id='error_message'>".$error_message."</h1>";
			}
		
		?>
	<table celspacing="1" cellpadding="5">
		<tr>
			<td>User Name:</td>
			<td><input type="text" name="user_name"/></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="user_password"/></td>
		</tr>
			
	</table>
	<button type="submit"name="login_button" class="">Login</button>
	</form>
	
 <h3 id="company_name"> Copy @right to Md.Rakibul Islam (CSE,DUET)</h3> 
	</div>
	
</body>
</html>