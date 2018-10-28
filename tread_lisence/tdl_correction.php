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
if(isset($_REQUEST['error'])) {
	$error_value=$_REQUEST['error'];
	try {
		if($error_value==1) {
			throw new Exception('সঠিক তথ্য দিন');
		}
		
		
		}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>	
	

<div class="container">
<br />
<h2 class="title">ট্রেড লাইসেন্স এর তথ্য দেখুন</h2>
    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
?>
	
	<form action="treadlisence_correction.php" method="post" id="" >
			<table celspacing="1" cellpadding="5">
				<tr>
				<td>ট্রেড লাইসেন্স নং : </td>
				<td><input type="text" name="tdl_no" id="" /></td>
				</tr>
				<tr>
				<td style="color:red;">পাসওয়ার্ড</td>
				<td><input type="password" name="password" class="" /></td>
				</tr>
				<tr>
				<td></td>
					<td><button class="btn btn-success" name="form1" >তথ্য দেখুন </button></td>
				</tr>
				
		</table>
			</form>
    </div>    
		