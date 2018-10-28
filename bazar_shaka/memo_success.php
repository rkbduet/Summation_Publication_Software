<?php
ob_start();
session_start();
if($_SESSION['name']!='tangail')
{
	header('location: login.php');
}
?>


<?php include("header.php")?>

<div class="container">
<h1 style="color: green; text-align:center; margin-top:20px;"> Sells Memo has been Created Successfully.</h1>





</div><!---end container--->