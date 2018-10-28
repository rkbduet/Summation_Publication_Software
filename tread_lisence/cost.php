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
	
		
		if(empty($_POST['c_biboron'])) {
			throw new Exception( 'খরচের বিবরন দিন');
		}
		if(empty($_POST['c_taka'])) {
			throw new Exception( 'টাকার পরিমান দিন');
		}
		
		
		
		$date=date('d-m-Y');
		$day=substr($date,0,2);
		$month=substr($date,3,2);
		$year=substr($date,6,4);
		
		$query=$db->prepare("insert into tdl_cost(tdl_cost_b,tdl_cost_taka,day,month,year) values(?,?,?,?,?)");
		$query->execute(array($_POST['c_biboron'],$_POST['c_taka'],$day,$month,$year));
	
		
		$success_message = 'আপনার  খরচের পরিমান জমা হয়েছে ।.';
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>

<div class="container">
<h1 class="title">দৈনন্দিন ব্যায় পরিমান সঞ্চয় করুন</h1>
		<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>

		<form action="" method="post"  id="tdl_table" >
		
		<table width=""  cellpadding="2px">
			<tr>
				<td>খরচের বিবরনঃ</td>
				<td><input type="text" name="c_biboron" /></td>
			</tr>
			<tr>
				<td>টাকা</td>
				<td><input type="text" name="c_taka" /></td>
			</tr>
			<tr>
			<td></td>

				<td><button class="btn btn-success" type="submit" name="form1">সংরক্ষন করুন</button> </td>
			</tr>
		</table>
	
		</form>

		
		
</div><!---end container--->
