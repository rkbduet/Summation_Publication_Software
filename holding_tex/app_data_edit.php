<?php
ob_start();
session_start();
if($_SESSION['name']!='hold')
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
<h2 class="title">করদাতার তথ্য সংশোধন করুন</h2>
    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
?>
	
	<form action="edit.php" method="post" id="" >
			<table cellspacing="1" cellpadding="5">
				<tr>
				<td>ওয়ার্ড  নং</td>
				<td><input type="text" name="word_no" id="" /></td>
				</tr>
				<tr>
				<td>হোল্ডিং  নং</td>
				<td><input type="text" name="holding_no" id="" /></td>
				</tr>
				<tr>
				<td>করদাতার আই.ডি</td>
				<td><input type="text" name="k_id" id="" /></td>
				</tr>
				<tr>
				<td style="color:red;">পাসওয়ার্ড</td>
				<td><input type="password" name="password" class="" /></td>
				</tr>
				<td></td>
					<td><button class="btn btn-success" name="form" >তথ্য দেখুন</button></td>
				</tr>
				
		</table>
			</form>
    </div>    
		