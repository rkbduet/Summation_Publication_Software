<?php
ob_start();
session_start();
if($_SESSION['name']!='tangail')
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
<h2 class="title">মাসিক ভাড়া প্রদেয় তালিকা দেখুন</h2>
    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
?>
		

<form action="view_joma_report.php" method="post" id="" >
			<table cellspacing="1" cellpadding="5">
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
	<td>বছর:</td>
	<td>
					
	<select name="year" id="">
			<option value="">বছর নির্বাচন  করুন</option>
			<option value="<?php $year= date('Y'); echo $year;?>"><?php $year= date('Y'); echo $year;?></option>
			<option value="<?php  echo $year-1;?>"><?php  echo $year-1;?></option>
			<option value="<?php echo $year-2;?>"><?php echo $year-2;?></option>
			<option value="<?php echo $year-3;?>"><?php echo $year-3;?></option>
			<option value="<?php echo $year-4;?>"><?php echo $year-4;?></option>
			<option value="<?php echo $year-5;?>"><?php echo $year-5;?></option>
			<option value="<?php echo $year-6;?>"><?php echo $year-6;?></option>
							
	</select>
					
		</td>
	</tr>
				<tr>
				<td></td>
					<td><button type="submit" class="btn btn-success" name="form1">তালিকা দেখুন</button></td>
				</tr>
				
		</table>
			</form>
    </div>    
		
