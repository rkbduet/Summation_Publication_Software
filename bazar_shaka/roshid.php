<?php
ob_start();
session_start();
if($_SESSION['name']!='tangail')
{
	header('location: login.php');
}
?>
<?php include('../config.php'); ?>
<?php include("header.php");?>

		
<?php 



if(isset($_REQUEST['d_no']) && isset($_REQUEST['month_name']) && isset($_REQUEST['year']) && isset($_REQUEST['market_name'])){
$input_dokan_no=$_REQUEST['d_no'];
$input_year=$_REQUEST['year'];

$month_name=$_REQUEST['month_name'];
		
		$i=0;
		if(is_array($month_name))
		{
			foreach($month_name as $key=>$val)
			{
				$arr[$i] = $val;
				$i++;
			}
		}
$month_names = implode(",",$arr);

$input_market_name=$_REQUEST['market_name'];
		
		$query=$db->prepare("select * from month_vara WHERE dokan_no=? and month_name=? and year_name=? and  market_name=?");
		$query->execute(array($input_dokan_no,$month_names,$input_year,$input_market_name));
		$result=$query->rowCount();
		if($result==0) {
			header("location:vara_roshid.php?error=1");
		}
		

	
		}
	
else{
	
	header("location:vara_roshid.php?error=0");
}


?>
<?php

	
	$query=$db->prepare("select * from market_info t1 join month_vara t2  on t1.m_no=t2.dokan_no 
			
			where m_no='$input_dokan_no' and month_name='$month_names' and year_name='$input_year' ");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) 
	{
		 $dokan_name=$row['market_name'];
		 $word_no= $row['word_no'];
		$dokan_no= $row['m_no'];
		 $dokaner_name=$row['dokaner_name'];
		$dokaner_malik=$row['m_malik'];
		$dokan_address=$row['address'];
		$dokan_mobile=$row['mobile'];
		$month=$row['month_name'];
		$vara=$row['vara'];
		$roshid_no=$row['vara_id'];
		
	}
	
	?>
<div class="container">
<div class="row" id="main_roshid">
	<div class="col-lg-6 roshid">
	<div class="roshid_header">
	<div class="rohsid_logo pull-left"><img class="logo" src="../Pourosova.jpg" alt="logo" /></div>
		
		<p>টাংগাইল পৌরসভা</br>
		অফিস কপি</br>
		দোকানের ভাড়া আদায়ের রশীদ </p>
		<span>তারিখ : <?php echo $row['joma_date'];?></span>
	</div>
<table cellspacing="2" cellpadding="5" >
	<tr>
		<td>রশীদ নং:</td>
		<td><?php echo $roshid_no;?></td>
	</tr>
	<tr>
		<td>দোকান নং:</td>
		<td><?php echo $dokan_no;?></td>
		
	</tr>
	<tr>
	<td>মার্কেটের  নাম:</td>
	<td><?php echo $dokan_name;?></td>
	</tr>
	<tr>
	<td>ওয়ার্ড নং :</td>
	<td><?php echo $word_no;?></td>
	</tr>
	<tr>
		<td>বরাদ্দ প্রাপকের নাম:</td>
		<td><?php echo $dokaner_name;?></td>
	</tr>
	<tr>
		<td>পিতা / স্বামীর  নাম:</td>
		<td><?php echo $dokaner_malik;?></td>
	</tr>
	<tr>
	<td> ঠিকানা:</td>
	<td><?php echo $dokan_address;?></td>
	</tr>
	<tr>
		<td>মাসের নাম:</td>
		<td>
		
	<?php
		$arr = explode(",",$month_names);
		$count_arr = count(explode(",",$month_names));
		for($j=1;$j<=$count_arr;$j++)
		{									
			if($j==1){echo "জানুয়ারি";}
			if($j==2){echo "ফ্রেবরুয়ারি";}
			if($j==3){echo "মাচ";}
			if($j==4){echo "এপ্রিল";}
			if($j==5){echo "মে";}	
			if($j==6){echo "জুন";}
			if($j==7){echo "জুলাই";}	
			if($j==8){echo "অগাস্ট";}	
			if($j==9){echo "সেপ্টেম্বর";}		
			if($j==10){echo "অক্টোবর";}		
			if($j==11){echo "নভেম্বর";}		
			if($j==12){echo "ডিসম্বের";}
			echo ",";
		}
	?>

</td>
	</tr>
	<tr>
		<td>মাসিক ভাড়া:</td>
		<td><?php echo $vara;?></td>
	</tr>
	<tr>
		<td>কথায় : </td>
		<td><?php echo $row['vara_kothai'];?></td>
	</tr>
</table>
	<strong>আদায়কারীর স্বাক্ষর</strong><br/>
	<p class="pull-left">সময়মত দোকান ভাড়া পরিশোধ করুন </p>
	<p class="pull-right"> কারিগরি সহয়তায়: টাংগাইল কলিং লি. </p>
	
	</div><!---end of rohsid--->
<div class="col-lg-6 roshid">
	<div class="roshid_header">
	<div class="rohsid_logo pull-left"><img class="logo" src="../Pourosova.jpg" alt="logo" /></div>
		
		<p>টাংগাইল পৌরসভা</br>
		গ্রাহক কপি</br>
		দোকানের ভাড়া আদায়ের রশীদ </p>
		
		<span>তারিখ :<?php echo $row['joma_date'];?></span>
	</div>

<table cellspacing="2" cellpadding="5" >
	<tr>
		<td>রশীদ নং:</td>
		<td><?php echo $roshid_no;?></td>
	</tr>
	<tr>
		<td>দোকান নং:</td>
		<td><?php echo $dokan_no;?></td>
		
	</tr>
	<tr>
	<td>মার্কেটের নাম:</td>
	<td><?php echo $dokan_name;?></td>
	</tr>
	<tr>
	<td>ওয়ার্ড নং :</td>
	<td><?php echo $word_no;?></td>
	</tr>
	<tr>
		<td>বরাদ্দ প্রাপকের নাম:</td>
		<td><?php echo $dokaner_name;?></td>
	</tr>
	<tr>
		<td>পিতা / স্বামীর  নাম:</td>
		<td><?php echo $dokaner_malik;?></td>
	</tr>
	<tr>
	<td> ঠিকানা:</td>
	<td><?php echo $dokan_address;?></td>
	</tr>
	<tr>
		<td>মাসের নাম:</td>
		<td>
			<?php
		$arr = explode(",",$month_names);
		$count_arr = count(explode(",",$month_names));
		for($j=1;$j<=$count_arr;$j++)
		{									
			if($j==1){echo "জানুয়ারি";}
			if($j==2){echo "ফ্রেবরুয়ারি";}
			if($j==3){echo "মাচ";}
			if($j==4){echo "এপ্রিল";}
			if($j==5){echo "মে";}	
			if($j==6){echo "জুন";}
			if($j==7){echo "জুলাই";}	
			if($j==8){echo "অগাস্ট";}	
			if($j==9){echo "সেপ্টেম্বর";}		
			if($j==10){echo "অক্টোবর";}		
			if($j==11){echo "নভেম্বর";}		
			if($j==12){echo "ডিসম্বের";}	
			echo ",";
		}
	?>

		
		</td>
	</tr>
	<tr>
		<td>মাসিক ভাড়া:</td>
		<td><?php echo $vara;?></td>
	</tr>
	<tr>
		<td>কথায় : </td>
		<td><?php echo $row['vara_kothai'];?></td>
	</tr>
	
</table>

	<strong>আদায়কারীর স্বাক্ষর</strong><br/>
	<p class="pull-left">সময়মত দোকান ভাড়া পরিশোধ করুন </p>
	<p class="pull-right">কারিগরি সহয়তায়: টাংগাইল কলিং লি.</p>

	</div>
</div>

	<h1 class="center"><a href="" class="btn btn-info "onclick="printcontent('main_roshid')" >প্রিন্ট</a></h1>
</div><!---end container--->
<?php include('footer.php');?>
