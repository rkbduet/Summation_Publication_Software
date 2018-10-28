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
if(isset($_REQUEST['error'])) {
	$error_value=$_REQUEST['error'];

	try {
	
		if($error_value==1) {
			throw new Exception( 'সঠিক তথ্য দিন');
		}
	
	
		
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>
<?php 
		$date=date('d-m-Y');
		$day=substr($date,0,2);
		$month=substr($date,3,2);
		$year=substr($date,6,4);
?>
<div class="container">
<br/>
<h2 class="title">ট্রেড লাইসেস্ন  তালিকা অর্থবছর অনুযয়ী </h2>
	
	<?php  
		if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
		if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
		?>
		<form action="view_tdl_lis_by_year.php" method="post" >
		
		<table cellpadding="2px">
			
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
			
			<td><button class="btn btn-success" type="submit" name="form1">তালিকা দেখুন</button> </td>
			</tr>
				
			
		</table>
	
		</form>

		
		
</div><!---end container--->