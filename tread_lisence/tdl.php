<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>টাংগাইল পৌরসভা</title>
	<style type="text/css">
.tdl_body{
	font-size:22px;
	font-weight:bold;
}
.tdl-image{
height: 942px;
width: 1339px;}

.serial_no{left: 226px;
position: absolute;
top: 97px;}
.tdl_no{left: 243px;
position: absolute;
top: 213px;}
.year{ position: absolute;
left:990px;
top: 221px;}
.over_date{left: 371px;
position: absolute;
top: 392px;}
.name{left: 370px;
position: absolute;
top: 438px;}

.address{left: 370px;
position: absolute;
top: 535px;}

.doron{left: 370px;
position: absolute;
top: 582px;}


.tdl_fee{left: 425px;
position: absolute;
top: 654px;}
.tex{left: 427px;
position: absolute;
top: 674px;
}
.jorimana{left: 427px;
position: absolute;
top: 693px;
	
}
.others{left: 427px;
position: absolute;
top: 712px;
}

.total{left: 422px;
position: absolute;
top: 737px;}

.kothai{left: 369px;
position: absolute;
top: 778px;}
.img img {
height: 150px;
position: absolute;
left:1112px;
top: 74px;
width: 150px;
}
.print{background:gray;
padding:10px;
text-decoration:none;
margin:0 auto;
width:50px;
height:30px;
}
.print_person{left: 767px;
position: absolute;
top: 786px;}
	
	</style>
</head>
<body>
<?php
ob_start();
session_start();
if($_SESSION['name']!='tread')
{
	header('location: login.php');
}
?>
<?php include('../config.php'); ?>
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

			header("location:tread_lisence.php?error=1");
		}
	
		
		
		$query=$db->prepare("select * from tdl_joma WHERE tdl_no=? and tdl_budget_year=?");
		$query->execute(array($input_tdl_no,$input_year));
		$result=$query->rowCount();
		if($result==0) {
			header("location:tread_lisence.php?error=1");
		}
		

	
		}
	
else{
	
	header("location:tread_lisence.php?error=0");
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
<div class="tdl_body">
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

	<div class="name"><?php echo $busines_name;?> <br /><?php echo $dokan_name;?></div>
	<div class="address"><?php echo $address_vill;?>,<?php echo $address_post; ?> ,<?php echo $address_thana; ?> ,<?php echo $address_zilla; ?></div>

	<div class="doron"><?php echo $b_dornon;?></div>
	
	<div class="tdl_fee"><?php  echo $tdl_fe;?></div>
	<div class="tex"><?php  echo $tdl_incometex;?></div>
	<div class="jorimana"><?php echo $jorimana;?></div>
	<div class="others"><?php echo $others;?></div>
	
	<div class="total"><?php echo $total_taka;?></div>
	<div class="kothai"><?php echo $taka_kothai;?></div>
	<div class="print_person"> প্রিন্টকারীর নাম ও পদবী:  <?php echo $name;?>, <?php echo $post;?></div>
	
	
	</div>
</div><!---end container--->
</div><!--print-area--->
<br />
<a href="" class="print" onclick="printcontent('tread_lisence')" >প্রিন্ট</a><br/>


<?php include('footer.php');?>
</body>
</html>