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
			throw new Exception('সঠিক আবেদন  নাম্বার দিন');
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
	
	<form action="application_view.php" method="post" id="" >
			<table celspacing="1" cellpadding="5">
				<tr>
				<td>আবেদন নং </td>
				<td><input type="text" name="d_no" id="" /></td>
				</tr>
				<tr>
				<td></td>
					<td><button class="btn btn-success" name="form1" >প্রিন্ট করুন </button></td>
				</tr>
				
		</table>
			</form>
    </div>    
		