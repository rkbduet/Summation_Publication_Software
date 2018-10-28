<?php
ob_start();
session_start();
if($_SESSION['name']!='localhost')
{
	header('location: login.php');
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
<header>
	<img class="logo" src="logo.png" alt="logo" />
	<h1>Publication Management Software</h1>
	<h3>Please Select Your Option. </h3>
</header>
	<nav>
		<ul>
			<li><a href="bazar_shaka/index.php">Summation</a></li>
			<li><a href="tread_lisence/login.php">DUET Boi-Bitan</a></li>
			
		</ul>

	</nav>


</body>
</html>



