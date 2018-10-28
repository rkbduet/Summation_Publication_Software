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
if(isset($_REQUEST['error'])) {
	$error_value=$_REQUEST['error'];
	
	try {
		if($error_value==1)
		
			throw new Exception( '  সঠিক তথ্য দিন ');
		}
		
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>	
	

<div class="container">
<br>
<h2 class="title">দৈনন্দিন খরচের ভাউচার প্রিন্ট করুন</h2>
    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
	
	<form action="cost_roshid.php" method="post" id="" >
			<table celspacing="1" cellpadding="5">
		<tr>
		<td>তারিখ</td>
		<td><input type="date" name="date" id="" placeholder="দিন - মাস - বছর" /></td>
		
<tr>
<td></td>
	
					<td><button class="btn btn-success" name="form1" >প্রিন্ট</button></td>
				</tr>
				
		</table>
			</form>
    </div>    
		