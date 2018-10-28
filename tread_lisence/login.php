
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>টাংগাইল পৌরসভা </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		
		
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/responsive.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
		
		<style type="text/css">
		
		
		.logo{width:110px;height:110px;margin:0 auto;}
		#login_btn{font-size:20px;padding:10px 30px;}
		</style>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
<header>
			<div class="container">
				<img src="../Pourosova.jpg" alt="Your Logo" class="logo"/>
				<h1> টাংগাইল পৌরসভা সফটওয়্যার ম্যানেজমেন্ট </h1>
				<h2>  লাইসেন্স শাখা</h2>
				<h3>কারিগরি সহায়তায় টাংগাইল কলিং লি:</h3>
				
		</header>
<?php

if(isset($_POST['form_login'])) 
{
	
	try {
	
		$admin_name=$_POST['username'];
		$admin_password=$_POST['password'];
		$admin_password=md5($admin_password);
		
		if(empty($_POST['username'])) {
			throw new Exception(' অনুগ্রহ করে ব্যবহারকারীর নাম দিন');
		}
		
		if(empty($_POST['password'])) {
			throw new Exception('অনুগ্রহ করে ব্যবহারকারীর পাসওয়াড দিন');
		}
	
		include('../config.php');
		
		
		
		$query = $db->prepare("select * from homepage_admin where  a_name=? and a_password=? and admin_id=2");
		$query->execute(array($admin_name,$admin_password));
		$num = $query->rowCount();
		
		if($num!=0) 
		{
			session_start();
			$_SESSION['name'] = "tread";
			header("location: index.php");
		}
		else
		{
			throw new Exception( 'আপনার ব্যবহারকারীর নাম অথবা পাসওয়াড ভূল আছে');
		}
	
	
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>


<div class="container"> 
       <br />
        <h2 class="title">লাইসেন্স শাখার ইউজার লগইন </h2>
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
			<td>ব্যবহারকারীর নাম</td>
			<td><input type="text" name="username"></td>
		</tr>
		<tr>
			<td>ব্যবহারকারীর পাসওয়ার্ড</td>
			<td><input type="password" name="password"></td>
		</tr>
			
<tr>
	<td></td>
	<td><button type="submit"name="form_login" class="btn btn-info btn-large" id="login_btn">লগইন</button></td>
</tr>

</table>
</form>
</div><!--end of login_form--->
</div><!--end container-->


