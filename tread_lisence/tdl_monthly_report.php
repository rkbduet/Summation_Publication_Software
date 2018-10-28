<?php
ob_start();
session_start();
if($_SESSION['name']!='tread')
{
	header('location: login.php');
}
?>
<?php include"header.php"?>
    

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
<h2 class="title">মাসিক  ট্রেড লাইসেন্স ফি জমা রিপোর্ট</h2>
    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
?>
		

<form action="tdl_month_joma_report.php" method="post" id="" >
			<table celspacing="1" cellpadding="5">
	<tr>
			<td>মাসের নাম</td>		
 	<td>
		<select name="month" id="">
			<option value="">মাসের নাম নির্বাচন  করুন</option>
			<option value="1">জানুয়ারি</option>
			<option value="2">ফ্রেবরুয়ারি</option>
			<option value="3">মাচ</option>
			<option value="4">এপ্রিল</option>
			<option value="5">মে</option>
			<option value="6">জুন</option>
			<option value="7">জুলাই</option>
			<option value="8">অগাস্ট</option>
			<option value="9">সেপ্টেম্বর</option>
			<option value="10">অক্টোবর</option>
			<option value="11">নভেম্বর</option>
			<option value="12">ডিসম্বের</option>
							
	</select>

</td>
</tr>
				<tr>
				<td></td>
					<td><button type="submit" class="btn btn-success" name="form1">রিপোর্ট দেখুন</button></td>
				</tr>
				
		</table>
			</form>
    </div>    
		
