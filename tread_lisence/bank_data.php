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
	
		
		if(empty($_POST['bank_name'])) {
			throw new Exception( 'ব্যাংকের  নাম  দিন');
		
		}
		if(empty($_POST['acc_number'])) {
			throw new Exception( 'ব্যাংকের একাউন্ট নাম্বার  দিন');
		}
	
	
		/***
		$date=date('d-m-Y');
		$day=substr($date,0,2);
		$month=substr($date,3,2);
		$year=substr($date,6,4);
		****/
		
		$query=$db->prepare("insert into tdl_bank_data(bank_name,bank_acc_no)
		values(?,?)");
		$query->execute(array($_POST['bank_name'],$_POST['acc_number'],));
	
		
		$success_message = 'আপনার তথ্য সংরক্ষন হয়েছে ।.';
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>

<div class="container">
<br />
<h2 class="title">ব্যাংকের  তথ্য দিন</h2>
	
	<?php  
		if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
		if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
		?>
		<form action="" method="post" >
		
		<table width="" cellpadding="2px" id="">
			<tr>
				<td>ব্যাংকের নাম</td>
				<td><input type="text" name="bank_name" /></td>
			</tr>
			<tr>
			<td>একাউন্ট নাম্বার</td>
				<td><input type="text" name="acc_number" /></td>
			</tr>
			
			<tr>
			<td></td>
			
			<td><button class="btn btn-success" type="submit" name="form1">সংরক্ষন করুন</button> </td>
			</tr>
				
			
		</table>
	
		</form>

		
		
</div><!---end container--->

