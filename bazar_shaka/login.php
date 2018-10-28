
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Publication Management Software </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		
		
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/responsive.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

		<header>
			<div class="container">
				<img src="../Pourosova.png" alt="Your Logo" class="logo"/>
				<h1> Publication Management Software </h1>
				<h2> Wellcome to SUMMATION Publication</h2>
				<h3>Please Login.....</h3>
				
		</header>
<?php

if(isset($_POST['form_login'])) 
{
	
	try {
	
		$admin_name=$_POST['username'];
		$admin_password=$_POST['password'];
		$admin_password=md5($admin_password);
		
		if(empty($_POST['username'])) {
			throw new Exception(' Input User Name!!!');
		}
		
		if(empty($_POST['password'])) {
			throw new Exception('Input Password Name!!!');
		}
	
		include('../config.php');
		
		
		
		$query = $db->prepare("select * from homepage_admin where a_name=? and a_password=? and admin_id=4");
		$query->execute(array($admin_name,$admin_password));
		$num = $query->rowCount();
		
		if($num!=0) 
		{
			session_start();
			$_SESSION['name'] = "tangail";
			header("location: index.php");
		}
		else
		{
			throw new Exception( 'Incorrect User Name or Password.');
		}
	
	
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>


<div class="container"> 
<br />
        <h2 class="title">Only For User Login .... </h2>

<div class="login_form">
<?php
if(isset($error_message))
{
	?>
	<div class="error_message"><?php echo$error_message;?></div>
	<?php
}
?>
<br />
<form action="" method="post"  id="login_table">
<table celspacing="1" cellpadding="5">
		<tr>
			<td>User Name: </td>
			<td><input type="text" name="username"></td>
		</tr>
		<tr>
			<td>Password: </td>
			<td><input type="password" name="password"></td>
		</tr>
			
</table>
<br />
<button type="submit"name="form_login" class="btn btn-info btn-large">Login</button>
</form>
</div><!--end of login_form--->
</div><!--end container-->


