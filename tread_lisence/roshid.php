<?php
ob_start();
session_start();
if($_SESSION['name']!='tread')
{
	header('location: login.php');
}
?>
<?php 


?>
<?php include('../config.php'); ?>
<?php include("header.php");?>

		
<?php 
if(isset($_REQUEST['d_no']) && isset($_REQUEST['year'])){
	$input_tdl_no=$_REQUEST['d_no'];
	$input_year=$_REQUEST['year'];
	$name=$_REQUEST['oparetor_name'];
	$post=$_REQUEST['operator_post'];
	$password=$_REQUEST['password'];
	$password=md5($password);
		
		$query = $db->prepare("select * from homepage_admin where a_password=? and admin_id=2");
		$query->execute(array($password));
		$num = $query->rowCount();
		
		if($num==0) 
		{

			header("location:tdl_roshid.php?error=1");
		}
	
		$query=$db->prepare("select * from tdl_joma WHERE tdl_no=? and tdl_budget_year=?");
		$query->execute(array($input_tdl_no,$input_year));
		$result=$query->rowCount();
		if($result==0) {
			header("location:tdl_roshid.php?error=1");
		}
		

	
		}
	
else{
	
	header("location:tdl_roshid.php?=error=0");
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
		$tdl_incometext=$row['tdl_incometex'];
		$roshid_no=$row['tdl_id'];
		$day=$row['joma_day'];
		$month=$row['joma_month'];
		$year=$row['joma_year'];
		
	}
	
	?>
<div class="container">
<div class="row" id="main_roshid">
<div class="col-lg-4 roshid">
	<div class="roshid_header">
		<div class="rohsid_logo"><img class="logo" src="../Pourosova.jpg" alt="logo" /></div>
		<p>টাংগাইল পৌরসভা</br>
		অফিস কপি</br>
		ট্রেড লাইসেন্স ফি আদায়ের রশীদ
		</p>
	</div>
<strong><span class="pull-left">রশীদ নং:  <?php echo $roshid_no;?></span><span class="pull-right">তারিখ : <?php echo $day;?>-<?php echo $month;?>-<?php echo $year;?></span></strong>

<table cellspacing="2" cellpadding="5" >
	<tr>
	<td>গ্রহকের  নাম:</td>
	<td><?php echo $dokan_name;?></td>
	</tr>
	<tr>
		<td>ট্রেড লাইসেন্স নং:</td>
		<td><?php echo $dokan_no;?></td>
		
	</tr>
	
	<tr>
		<td>ট্রেড লাইসেন্স ফি:</td>
		<td><?php echo $tdl_fe;?></td>
	</tr>
	<tr>
		<td>ইনকাম ট্যাক্স ফি:</td>
		<td><?php echo $tdl_incometext;?></td>
	</tr>
	<tr>
		<td>মোট:</td>
		<td> <strong><?php $total= $tdl_fe+ $tdl_incometext; echo $total; ?></strong></td>
	</tr>
	<tr>
		<td>মোট টাকা (কথায়) :</td>
		<td><strong><?php echo $row['taka_kothai'];?></strong></td>
	</tr>
	<tr>
		<td>প্রিন্টকারীর নাম: <?php echo $name;?></td>
		<td>প্রিন্টকারীর পদবী: <?php echo $post;?></td>
	</tr>
	
</table>
<div class="bank_info"> 
	<strong><label>ব্যাংকের নাম : </label> <span><?php echo $row['tdl_bank_name'];?></span>
	<br />
	
	<label>একাউন্ট নাম্বার : </label> <span><?php echo $row['tdl_bank_no'];?></span></strong>
	

</div>
<br/><br/>
<div class="roshid_sign">
<strong class="pull-left">কর্মকর্তার সাক্ষর <br/><span>তারিখ:....................<span></strong>
<strong class="pull-right">আদায়কারীর স্বাক্ষর <br/><span>তারিখ:....................<span></strong>


</div>
<br/><br/><br/>
<div class="c_name"><p class="center">কারিগরি সহায়তায় : টাংগাইল কলিং লি:</p></div>
	
	</div><!---end of rohsid--->
<div class="col-lg-4 roshid">
	<div class="roshid_header">
		<div class="rohsid_logo"><img class="logo" src="../Pourosova.jpg" alt="logo" /></div>
		<p>টাংগাইল পৌরসভা</br>
		গ্রাহক কপি</br>
		ট্রেড লাইসেন্স ফি আদায়ের রশীদ
		</p>
	</div>
<strong><span class="pull-left">রশীদ নং:  <?php echo $roshid_no;?></span><span class="pull-right">তারিখ : <?php echo $day;?>-<?php echo $month;?>-<?php echo $year;?></span></strong>

<table cellspacing="2" cellpadding="5" >
	<tr>
	<td>গ্রহকের  নাম:</td>
	<td><?php echo $dokan_name;?></td>
	</tr>
	<tr>
		<td>ট্রেড লাইসেন্স নং:</td>
		<td><?php echo $dokan_no;?></td>
		
	</tr>
	
	<tr>
		<td>ট্রেড লাইসেন্স ফি:</td>
		<td><?php echo $tdl_fe;?></td>
	</tr>
	<tr>
		<td>ইনকাম ট্যাক্স ফি:</td>
		<td><?php echo $tdl_incometext;?></td>
	</tr>
	<tr>
		<td>মোট:</td>
		<td> <strong><?php $total= $tdl_fe+ $tdl_incometext; echo $total; ?></strong></td>
	</tr>
	<tr>
		<td>মোট টাকা (কথায়) :</td>
		<td><strong><?php echo $row['taka_kothai'];?></strong></td>
	</tr>
	<tr>
		<td>প্রিন্টকারীর নাম: <?php echo $name;?></td>
		<td>প্রিন্টকারীর পদবী: <?php echo $post;?></td>
	</tr>
	
</table>
<div class="bank_info"> 
	<strong><label>ব্যাংকের নাম : </label> <span><?php echo $row['tdl_bank_name'];?></span>
	<br />
	
	<label>একাউন্ট নাম্বার : </label> <span><?php echo $row['tdl_bank_no'];?></span></strong>
	

</div>
<br/><br/>
<div class="roshid_sign">
<strong class="pull-left">কর্মকর্তার সাক্ষর <br/><span>তারিখ:....................<span></strong>
<strong class="pull-right">আদায়কারীর স্বাক্ষর <br/><span>তারিখ:....................<span></strong>


</div>
<br/><br/><br/>
<div class="c_name"><p class="center">কারিগরি সহায়তায় : টাংগাইল কলিং লি:</p></div>
	
	</div><!---end of rohsid--->
<div class="col-lg-4 roshid">
	<div class="roshid_header">
		<div class="rohsid_logo"><img class="logo" src="../Pourosova.jpg" alt="logo" /></div>
		<p>টাংগাইল পৌরসভা</br>
		ব্যাংক কপি</br>
		ট্রেড লাইসেন্স ফি আদায়ের রশীদ
		</p>
	</div>
<strong><span class="pull-left">রশীদ নং:  <?php echo $roshid_no;?></span><span class="pull-right">তারিখ : <?php echo $day;?>-<?php echo $month;?>-<?php echo $year;?></span></strong>

<table cellspacing="2" cellpadding="5" >
	<tr>
	<td>গ্রহকের  নাম:</td>
	<td><?php echo $dokan_name;?></td>
	</tr>
	<tr>
		<td>ট্রেড লাইসেন্স নং:</td>
		<td><?php echo $dokan_no;?></td>
		
	</tr>
	
	<tr>
		<td>ট্রেড লাইসেন্স ফি:</td>
		<td><?php echo $tdl_fe;?></td>
	</tr>
	<tr>
		<td>ইনকাম ট্যাক্স ফি:</td>
		<td><?php echo $tdl_incometext;?></td>
	</tr>
	<tr>
		<td>মোট:</td>
		<td> <strong><?php $total= $tdl_fe+ $tdl_incometext; echo $total; ?></strong></td>
	</tr>
	<tr>
		<td>মোট টাকা (কথায়) :</td>
		<td><strong><?php echo $row['taka_kothai'];?></strong></td>
	</tr>
	<tr>
		<td>প্রিন্টকারীর নাম: <?php echo $name;?></td>
		<td>প্রিন্টকারীর পদবী: <?php echo $post;?></td>
	</tr>
	
</table>
<div class="bank_info"> 
	<strong><label>ব্যাংকের নাম : </label> <span><?php echo $row['tdl_bank_name'];?></span>
	<br />
	
	<label>একাউন্ট নাম্বার : </label> <span><?php echo $row['tdl_bank_no'];?></span></strong>
	

</div>
<br/><br/>
<div class="roshid_sign">
<strong class="pull-left">কর্মকর্তার সাক্ষর <br/><span>তারিখ:....................<span></strong>
<strong class="pull-right">আদায়কারীর স্বাক্ষর <br/><span>তারিখ:....................<span></strong>


</div>
<br/><br/><br/>
<div class="c_name"><p class="center">কারিগরি সহায়তায় : টাংগাইল কলিং লি:</p></div>
	
	</div><!---end of rohsid--->
</div><!---main_roshid--->
<br/><br/>
<a href="" class="btn btn-info "onclick="printcontent('main_roshid')" >প্রিন্ট</a>
</div><!---end container--->

<?php include('footer.php');?>
