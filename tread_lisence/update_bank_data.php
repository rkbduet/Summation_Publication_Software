
<?php
ob_start();
session_start();
if($_SESSION['name']!='tread')
{
	header('location: login.php');
}
?>
<?php
include('../config.php');
if(isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
}
else {
	header('location: bank_data_correction.php');
}

if(isset($_POST['form2'])) {

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
		
		$query=$db->prepare("update tdl_bank_data set bank_name=?,bank_acc_no=? where bank_id='$id'");
		$query->execute(array($_POST['bank_name'],$_POST['acc_number']));
	
		
		$success_message = 'আপনার তথ্য সংরক্ষন হয়েছে ।.';
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>
<?php include"header.php"?>

<?php
		$query=$db->prepare("select * from tdl_bank_data  where bank_id='$id'");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		
		
	}
	
	?>
<div class="container">
<br />
<h2 class="title">ব্যাংকের  তথ্য </h2>
	
	<?php  
		if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
		if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
		?>
		<form action="" method="post" >
		
		<table width="" cellpadding="2px" id="">
			<tr>
				<td>ব্যাংকের নাম</td>
				<td><input type="text" name="bank_name" value="<?php echo $row['bank_name'];?>"/></td>
			</tr>
			<tr>
			<td>একাউন্ট নাম্বার</td>
				<td><input type="text" name="acc_number" value="<?php echo $row['bank_acc_no'];?>"/></td>
			</tr>
			
			<tr>
			<td></td>
			
			<td><button class="btn btn-success" type="submit" name="form2">পরিবর্তন করুন</button> </td>
			</tr>
				
			
		</table>
	
		</form>

		
		
</div><!---end container--->