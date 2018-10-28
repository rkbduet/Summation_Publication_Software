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
		if($error_value==1){
			
			throw new Exception("সঠিক তথ্য দিন");
		}
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>	
	

<div class="container">
<h2 class="title">  ট্রেড লাইসেস্ন  প্রিন্ট করুন</h2>
    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
	
	<form action="tdl.php" method="post" id="" >
			<table celspacing="1" cellpadding="5" style="color:blue;">
				<tr>
				<td>ট্রেড লাইসেস্ন  নং</td>
				<td><input type="text" name="d_no" id="" /></td>
				</tr>
				<tr>
				<td>অর্থবছর</td>
					
					<td><select name="year" id="">
						<option value="">অথবছর নির্বাচন করুন</option>
						<option value="২০১৫-২০১৬">২০১৫-২০১৬</option>
						<option value="২০১৪-২০১৫">২০১৪-২০১৫</option>
						<option value="২০১৩-২০১৪">২০১৩-২০১৪</option>
						<option value="২০১২-২০১৩">২০১২-২০১৩</option>
				
							
	</select></td>
	</tr>
	</table>
	<table style="color:red;" celspacing="1" cellpadding="5" >
	<tr>
				<td>প্রিন্টকারীর নাম</td>
				<td><input type="text" name="oparetor_name" /></td>
			</tr>
			<tr>
			<td>পদবী</td>
				<td><input type="text" name="operator_post" /></td>
			</tr>
			<tr>
				<td>পাসওয়ার্ড</td>
				<td><input type="password" name="password" class="tread-fee" /></td>
				
			</tr>
	<tr>
				<td></td>
	
					<td><button class="btn btn-success" name="form1" >প্রিন্ট</button></td>
				</tr>
				
		</table>
			</form>
    </div>    
		