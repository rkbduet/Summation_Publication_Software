<?php
ob_start();
session_start();
if($_SESSION['name']!='tread')
{
	header('location: login.php');
}
?>
<?php include('header.php'); ?>
<?php
include('../config.php');
if(isset($_POST['form1'])) {

	try {
	
		
		if(empty($_POST['oparetor_name'])) {
			throw new Exception( 'ডাটা এন্ট্রিকারীর নাম  দিন');
		
		}
		if(empty($_POST['operator_post'])) {
			throw new Exception( 'পদবী  দিন');
		}
		if(empty($_POST['password'])) {
			throw new Exception( 'পাসওয়ার্ড  দিন');
		}
		if(empty($_POST['confirm_password'])) {
			throw new Exception( 'পাসওয়ার্ড কনপার্ম করুন');
		}
		if($_POST['password'] != $_POST['confirm_password']){
			
				throw new Exception(" পাসওয়ার্ড ও কনপার্ম পাসওয়ার্ড মিল নাই");
		}
		$password = md5($_POST['confirm_password']);
		
		$date=date('d-m-Y');
		$day=substr($date,0,2);
		$month=substr($date,3,2);
		$year=substr($date,6,4);
		
		$query=$db->prepare("insert into operator_data(operator_name,operator_post,operator_password)
		values(?,?,?)");
		$query->execute(array($_POST['oparetor_name'],$_POST['operator_post'],$password));
	
		
		$success_message = 'আপনার তথ্য সংরক্ষন হয়েছে ।.';
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>

<div class="container">
<br />
<h2 class="title">নতুন ডাটা এন্ট্রিকারীর তথ্য</h2>
	
	<?php  
		if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
		if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
		?>
		<form action="" method="post" >
		
		<table width="" cellpadding="2px" id="">
			
			
			<tr>
				<td>প্রিন্ট পাসওয়ার্ড</td>
				<td><input type="password" name="confirm_password" class="tread-fee" /></td>
				
			</tr>
			
			<tr>
			<td></td>
			
			<td><button class="btn btn-success" type="submit" name="form1">সংরক্ষন করুন</button> </td>
			</tr>
				
			
		</table>
	
		</form>

		
		
</div><!---end container--->

