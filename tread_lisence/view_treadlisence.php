<?php
ob_start();
session_start();
if($_SESSION['name']!='tread')
{
	header('location: login.php');
}
?>
<?php include('../config.php'); ?>
<?php include("header.php");?>

		
<?php 
if(isset($_REQUEST['d_no']) && isset($_REQUEST['year'])){
	$input_tdl_no=$_REQUEST['d_no'];
	$input_year=$_REQUEST['year'];
		
		$query=$db->prepare("select * from tdl_joma WHERE tdl_no=? and tdl_budget_year=?");
		$query->execute(array($input_tdl_no,$input_year));
		$result=$query->rowCount();
		if($result==0) {
			header("location:tread_lisence.php?error=1");
		}
		

	
		}
	
else{
	
	header("location:tread_lisence.php?=error=0");
}

?>
<?php

	$query=$db->prepare("select * from tred_lisence_application t1 join tdl_joma t2  on t1.app_treadlisence_no=t2.tdl_no 
			
			where tdl_budget_year='$input_year' and tdl_no='$input_tdl_no'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) 
	{
		 $dokan_name=$row['app_name'];
		$dokan_no= $row['tdl_no'];
		$tdl_fe=$row['tdl_fe'];
		$tdl_incometex=$row['tdl_incometex'];
		$roshid_no=$row['tdl_id'];
		$address_vill=$row['b_address_vill'];
		$address_post=$row['b_address_holding_no'];
		$address_thana=$row['b_address_word_no'];
		$address_zilla=$row['b_address_post'];
		$b_dornon=$row['b_doron'];
		$jorimana=$row['tdl_jomriman'];
		$others=$row['tdl_ohers_cost'];
		$total_taka=$row['total_taka'];
		$taka_kothai = $row['taka_kothai'];
		$busines_name=$row['b_name'];
		
	}
	
	?>
	<div id="print-area" >
<div class="container" id="tread_lisence">
<img src="img/tdl-bg.jpg" alt="" class="tdl-image"/>


	
	
	
<?php 

		$date=date('d-m-Y');
		$day=substr($date,0,2);
		$month=substr($date,3,2);
		$year=substr($date,6,4);
		$year=$year+1;
?>
<div class="serial_no"><?php echo  $roshid_no;?></div>
<div class="img"><img src="img/applicate_image/<?php echo $row['app_photo']; ?>"</div>
<div class="tdl_no"><?php echo $dokan_no;?></div>
<div class="year"><?php echo $input_year;?></div>

<div class="over_date">	<?php echo $day;?>-<?php echo $month;?>-<?php echo $year;?></div>

	<div class="name"><?php echo $busines_name;?> <br /> <?php echo $busines_name;?></div>
	<div class="address"><?php echo $address_vill;?>,<?php echo $address_post; ?> ,<?php echo $address_thana; ?> ,<?php echo $address_zilla; ?></div>

	<div class="doron"><?php echo $b_dornon;?></div>
	
	<div class="tdl_fee"><?php  echo $tdl_fe;?></div>
	<div class="tex"><?php  echo $tdl_incometex;?></div>
	<div class="jorimana"><?php echo $jorimana;?></div>
	<div class="others"><?php echo $others;?></div>
	
	<div class="total"><?php echo $total_taka;?></div>
	<div class="kothai"><?php echo $taka_kothai;?></div>
	
</div><!---end container--->
</div><!--print-area--->


<a href="" class="btn btn-info "onclick="printcontent('print-area')" >প্রিন্ট</a><br/>

<?php include('footer.php');?>
