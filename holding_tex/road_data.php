<?php
ob_start();
session_start();
if($_SESSION['name']!='hold')
{
	header('location: login.php');
}
?>
<?php include('header.php'); ?>
<?php
include('../config.php');
if(isset($_POST['form'])) {

	try {
	
		
		if(empty($_POST['road_no'])) {
			throw new Exception( 'রাস্তা/মহল্লার নং দিন');
		}
		if(empty($_POST['road_name'])) {
			throw new Exception( 'রাস্তার নাম দিন');
		}
	
		
		$query=$db->prepare("insert into holding_road_data(road_no,road_name) values(?,?)");
		$query->execute(array($_POST['road_no'],$_POST['road_name']));
	
		
		$success_message = 'আপনার  তথ্য জমা হয়েছে ।.';
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>

<div class="container">
<h1 class="center">রাস্তার তথ্য সংরক্ষন</h1>
		<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>

		<form action="" method="post"  id="" >
		
		<table width=""  cellpadding="2px">
			<tr>
				<td>রাস্তা/মহল্লা নং</td>
				<td><input type="text" name="road_no" /></td>
			</tr>
			<tr>
				<td>রাস্তার নাম</td>
				<td><input type="text" name="road_name" /></td>
			</tr>
			<tr>
			<td></td>
				<td><button class="btn btn-success" type="submit" name="form">সংরক্ষন করুন</button> </td>
			</tr>
		</table>
	
		</form>

		
		
</div><!---end container--->
