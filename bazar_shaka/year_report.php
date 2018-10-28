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



if(isset($_REQUEST['year'])){
$input_year=$_REQUEST['year'];
		
		$query=$db->prepare("select * from month_vara WHERE year_name=?");
		$query->execute(array($input_year));
		$result=$query->rowCount();
		if($result==0) {
			header("location:yearly_report.php?error=1");
		}
		

	
		}
	
else{
	
	header("location:yearly_report.php?=error=0");
}

?>
<div class="container" id="print">
<div id="yearly_report">
<div class="print_header">
	<img class="logo" src="../Pourosova.jpg" alt="logo" />
	<h2> টাংগাইল পৌরসভা<br>বাজার শাখা<br/>
		<span>www.tangialpourashava.gov.bd</span>
	</h2>
	
</div>
<h2 class="center"><?php echo $input_year;?>  সালের  মাস ভিত্তিক ভাড়া আদায়ের  রিপোর্ট </h2>

<div class="report_date">তারিখ: <?php echo date('d-m-Y');?></div>
<table border="1" cellspacing="0" cellpadding="1">
	<tr>
		<th>মাসের নাম</th>
		<th>ভাড়া দোকান সংখ্যা</th>
		<th>টাকার পরিমান</th>
		
 </tr>
 <tr>
 	<td>জানুয়ারি</td>
 	<td><?php  
		
	$query=$db->prepare("select * from month_vara WHERE year_name=? and month_name='1'");
		$query->execute(array($input_year));
		$result1=$query->rowCount();
		echo $result1;
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(vara) as total_vara from month_vara where year_name='$input_year' and month_name='1'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara1=$row['total_vara'];
		
	}
		
	echo $total_vara1;
		?>
	
	</td>
 </tr>
 <tr>
 	<td>ফেব্রয়ারি</td>
 	<td><?php  
		
	$query=$db->prepare("select * from month_vara WHERE year_name=? and month_name='2'");
		$query->execute(array($input_year));
		$result2=$query->rowCount();
		echo $result2;
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(vara) as total_vara from month_vara where year_name='$input_year' and month_name='2'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara2=$row['total_vara'];
		
	}
		
	echo $total_vara2;
		?>
	
	</td>
 </tr>
 <tr>
 	<td>মার্চ</td>
 	<td><?php  
		
	$query=$db->prepare("select * from month_vara WHERE year_name=? and month_name='3'");
		$query->execute(array($input_year));
		$result3=$query->rowCount();
		echo $result3;
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(vara) as total_vara from month_vara where year_name='$input_year' and month_name='3'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara3=$row['total_vara'];
		
	}
		
	echo $total_vara3;
		?>
	
	</td>
 </tr>
 <tr>
 	<td>এপ্রিল</td>
 	<td><?php  
		
	$query=$db->prepare("select * from month_vara WHERE year_name=? and month_name='4'");
		$query->execute(array($input_year));
		$result4=$query->rowCount();
		echo $result4;
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(vara) as total_vara from month_vara where year_name='$input_year' and month_name='4'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara4=$row['total_vara'];
		
	}
		
	echo $total_vara4;
		?>
	
	</td>
 </tr>
 <tr>
 	<td>মে</td>
 	<td><?php  
		
	$query=$db->prepare("select * from month_vara WHERE year_name=? and month_name='5'");
		$query->execute(array($input_year));
		$result5=$query->rowCount();
		echo $result5;
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(vara) as total_vara from month_vara where year_name='$input_year' and month_name='5'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara5=$row['total_vara'];
		
	}
		
	echo $total_vara5;
		?>
	
	</td>
 </tr>
 <tr>
 	<td>জুন</td>
 	<td><?php  
		
	$query=$db->prepare("select * from month_vara WHERE year_name=? and month_name='6'");
		$query->execute(array($input_year));
		$result6=$query->rowCount();
		echo $result6;
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(vara) as total_vara from month_vara where year_name='$input_year' and month_name='6'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara6=$row['total_vara'];
		
	}
		
	echo $total_vara6;
		?>
	
	</td>
 </tr>
 <tr>
 	<td>জুলাই</td>
 	<td><?php  
		
	$query=$db->prepare("select * from month_vara WHERE year_name=? and month_name='7'");
		$query->execute(array($input_year));
		$result7=$query->rowCount();
		echo $result7;
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(vara) as total_vara from month_vara where year_name='$input_year' and month_name='7'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara7=$row['total_vara'];
		
	}
		
	echo $total_vara7;
		?>
	
	</td>
 </tr>
 <tr>
 	<td>আগস্ট</td>
 	<td><?php  
		
	$query=$db->prepare("select * from month_vara WHERE year_name=? and month_name='8'");
		$query->execute(array($input_year));
		$result8=$query->rowCount();
		echo $result8;
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(vara) as total_vara from month_vara where year_name='$input_year' and month_name='8'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara8=$row['total_vara'];
		
	}
		
	echo $total_vara8;
		?>
	
	</td>
 </tr>
 <tr>
 	<td>সেপ্টেম্বর</td>
 	<td><?php  
		
	$query=$db->prepare("select * from month_vara WHERE year_name=? and month_name='9'");
		$query->execute(array($input_year));
		$result9=$query->rowCount();
		echo $result9;
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(vara) as total_vara from month_vara where year_name='$input_year' and month_name='9'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara9=$row['total_vara'];
		
	}
		
	echo $total_vara9;
		?>
	
	</td>
 </tr>
 <tr>
 	<td>অক্টোবর</td>
 	<td><?php  
		
	$query=$db->prepare("select * from month_vara WHERE year_name=? and month_name='10'");
		$query->execute(array($input_year));
		$result10=$query->rowCount();
		echo $result10;
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(vara) as total_vara from month_vara where year_name='$input_year' and month_name='10'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara10=$row['total_vara'];
		
	}
		
	echo $total_vara10;
		?>
	
	</td>
 </tr>
 <tr>
 	<td>নভেম্বর </td>
 	<td><?php  
		
	$query=$db->prepare("select * from month_vara WHERE year_name=? and month_name='11'");
		$query->execute(array($input_year));
		$result11=$query->rowCount();
		echo $result11;
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(vara) as total_vara from month_vara where year_name='$input_year' and month_name='11'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara11=$row['total_vara'];
		
	}
		
	echo $total_vara11;
		?>
	
	</td>
 </tr>
 <tr>
 	<td>ডিসেম্বর</td>
 	<td><?php  
		
	$query=$db->prepare("select * from month_vara WHERE year_name=? and month_name='12'");
		$query->execute(array($input_year));
		$result12=$query->rowCount();
		echo $result12;
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(vara) as total_vara from month_vara where year_name='$input_year' and month_name='12'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara12=$row['total_vara'];
		
	}
		
	echo $total_vara12;
		?>
	
	</td>
 </tr>
 	
  <tfoot>
  <td></td>
	<td style="text-align:left;">  মোট  দোকান সংখ্যা    :    <?php $total_dokan=  $result1+ $result2+ $result3+ $result4+ $result5+ $result6+ $result7+ $result8+ $result9+ $result10+ $result11+ $result12 ;echo $total_dokan;?></td>
		<td style="text-align:left;">
		মোট ভাড়া  : 
		<?php $total_vara = $total_vara1+$total_vara2+$total_vara3+$total_vara4+$total_vara5+$total_vara6+$total_vara7+$total_vara8+$total_vara9+$total_vara10+$total_vara11+$total_vara12;
		echo $total_vara;
		?></td>
	</tr>
 
 </tfoot>
</table>
<br /><br />
<div class="report_person">রিপোর্টৈ তৈরীকারীর নাম: <br />
							পদবী:
						<br /><br /><br />
							সাক্ষর 

</div>
<span class="company_name">কারিগরি সহায়তায় টাংগাইল কলিং লিমিটেড.</span>
</div><!----end print_area--->
</div>

<h1 class="center"><a href="" class="btn btn-info "onclick="printcontent('print')" >প্রিন্ট করুন</a></h1>
<?php include("footer.php");?>