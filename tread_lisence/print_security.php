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

$name=$_POST['oparetor_name'];
$password = md5($_POST['password']);

	try {
	
		
		if(empty($_POST['oparetor_name'])) {
			throw new Exception( 'ডাটা এন্ট্রিকারীর নাম  দিন');
		
		}
		if(empty($_POST['password'])) {
			throw new Exception( 'পাসওয়ার্ড  দিন');
		}
	
		
		
		$query = $db->prepare("select * from operator_data where  operator_name=? and operator_password=?");
		$query->execute(array($name,$password));
		$num = $query->rowCount();
		
		if($num!=0) 
		{
			header("location:tdl_roshid.php");
		}
		else
		{
			throw new Exception( 'সঠিক তথ্য দিন');
		}
	
		
		
		
		$date=date('d-m-Y');
		$day=substr($date,0,2);
		$month=substr($date,3,2);
		$year=substr($date,6,4);
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>

<div class="container">
<br />
<h2 class="title"> প্রিন্টকারীর  তথ্য পূরন  করুন</h2>
	
	<?php  
		if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
		if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
		?>
		<form action="" method="post" >
		
		<table width="" cellpadding="2px" id="">
			<tr>
				<td>ডাটা এন্ট্রিকারীর নাম</td>
				<td><input type="text" name="oparetor_name" /></td>
			</tr>
			<tr>
				<td>প্রিন্ট পাসওয়ার্ড</td>
				<td><input type="password" name="password" class="tread-fee" /></td>
				
			</tr>
			
			
			<tr>
			<td></td>
			
			<td><button class="btn btn-success" type="submit" name="form1">সংরক্ষন করুন</button> </td>
			</tr>
				
			
		</table>
	
		</form>

		
		
</div><!---end container--->

