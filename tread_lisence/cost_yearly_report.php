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
<h2 class="title">বৎসরিক ব্যায় বিবরনী  রিপোর্ট</h2>
    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
?>
		

<form action="cost_year_report.php" method="post" id="" >
			<table celspacing="1" cellpadding="5">
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
					<td><button type="submit" class="btn btn-success" name="form1">রিপোর্ট দেখুন</button></td>
				</tr>
				
		</table>
			</form>
    </div>    
		
