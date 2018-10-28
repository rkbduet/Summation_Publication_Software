<?php
ob_start();
session_start();
if($_SESSION['name']!='tangail')
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
<h2 class="title">মাসিক ভাড়া রশীদ  প্রিন্ট করুন</h2>
    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
	
	<form action="roshid.php" method="post" id="" >
			<table celspacing="1" cellpadding="5">
	<tr>
		<td>মার্কেটের  নাম:</td>
		<td>
		<select name="market_name" id="">
		<option value="">মার্কেটের নাম নির্বাচন  করুন</option>
	
			<?php 
		$query=$db->prepare("select * from market_data");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
		?>
			<option value="<?php echo $row['marketer_name'];?>"><?php echo $row['marketer_name'];?></option>
			<?php
		}
			
			
			?>
			
		</select>
		</td>
	</tr>
	<tr>
		<td>দোকানের নং</td>
		<td><input type="text" name="d_no" id="" /></td>
	</tr>
	
	<tr>
	<td>মাসের নাম:</td>
					
 					
 	<td>
		<span><input type="checkbox" name="month_name[]" id="" value ="1"/>   জানুয়ারি</span>
		<span><input type="checkbox" name="month_name[]" id="" value ="2" />  ফ্রেবুয়ারি</span>
		<span><input type="checkbox" name="month_name[]" id="" value ="3"/>  মার্চ </span>
		<span><input type="checkbox" name="month_name[]" id="" value ="4"/>  এপ্রিল</span>
		<span><input type="checkbox" name="month_name[]" id="" value ="5"/>  মে</span>
		<span><input type="checkbox" name="month_name[]" id="" value ="6"/>  জুন</span><br/>
		<span><input type="checkbox" name="month_name[]" id="" value ="7"/>  জুলাই</span>
		<span><input type="checkbox" name="month_name[]" id="" value ="8"/>   অগাস্ট</span>
		<span><input type="checkbox" name="month_name[]" id="" value ="9"/>  সেপ্টেম্বর</span>
		<span><input type="checkbox" name="month_name[]" id="" value ="10"/>  অক্টোবর</span>
		<span><input type="checkbox" name="month_name[]" id="" value ="11"/>  নভেম্বর</span>
		<span><input type="checkbox" name="month_name[]" id="" value ="12"/> ডিসেম্বর</span>
		
</td>
</tr>
<tr>
<td> বছরের নাম:</td>
<td><select name="year" id="">
			<option value="">বছর নির্বাচন  করুন</option>
			<option value="<?php $year= date('Y'); echo $year;?>"><?php $year= date('Y'); echo $year;?></option>
			<option value="<?php  echo $year-1;?>"><?php  echo $year-1;?></option>
			<option value="<?php echo $year-2;?>"><?php echo $year-2;?></option>
			<option value="<?php echo $year-3;?>"><?php echo $year-3;?></option>
			<option value="<?php echo $year-4;?>"><?php echo $year-4;?></option>
			<option value="<?php echo $year-5;?>"><?php echo $year-5;?></option>
			<option value="<?php echo $year-6;?>"><?php echo $year-6;?></option>
							
	</select></td>
</tr>	
<tr>
<td></td>
	
<td><button class="btn btn-success" name="form1" >প্রিন্ট</button></td>
</tr>
				
		</table>
			</form>
    </div>    
		