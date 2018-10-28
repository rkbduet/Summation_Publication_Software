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

if(isset($_REQUEST['year'])){
	$input_year=$_REQUEST['year'];
		
		$query=$db->prepare("select * from tdl_joma WHERE tdl_budget_year=?");
		$query->execute(array($input_year));
		$result=$query->rowCount();
		if($result==0) {
			header("location:tdl_fee_joma.php?error=1");
		}
		

	
		}
	
else{
	
	header("location:tdl_fee_joma.php?=error=0");
}

?>
<div class="container"id="print" >
<div id="print_area">
<div class="print_header">
	<img class="logo" src="../Pourosova.jpg" alt="logo" />
	<p> টাংগাইল পৌরসভা<br>ট্রেড লাইসেন্স  শাখা<br/>
		<span>www.tangialpourashava.gov.bd</span>
	</p>

</div>
<h4 class="center"><?php echo $input_year;?>  অর্থবছরের ট্রেড লাইসেস্ন ফি:  প্রদেয়  তালিকা </h4>
<div class="report_date">তারিখ: <?php echo date('d-m-Y');?></div>
<table border="1" cellspacing="0" cellpadding="1">
	<tr>
		<th>ক্রমিক নং</th>
		<th>ট্রেড লাইসেস্ন  নং</th>
		<th>ট্রেড লাইসেস্ন এর সাল</th>
		<th> প্রতিষ্ঠানের নাম</th>
		<th>ব্যক্তির নাম</th>
		<th>মোবাইল</th>
		
 </tr>
 	<?php
	
			$i=0;
			
			
			$query=$db->prepare("select * from tred_lisence_application t1 join tdl_joma t2  on t1.app_treadlisence_no=t2.tdl_no 
			
			where tdl_budget_year='$input_year'");
			
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row){
			$i++;
			?>
			<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $row['tdl_no'];?></td>
			<td><?php echo $row['treadlisence_year'];?></td>
			<td><?php  echo $row['b_doron'];?></td>
			<td><?php echo $row['app_name'];?></td>
			<td><?php echo $row['app_mobile'];?></td>
			</tr>
			
			<?php
		}
	?>
 
</table>
<br /><br />
<div class="report_person">রিপোর্টৈ তৈরীকারীর নাম: <br />
							পদবী:
						<br /><br /><br />
							সাক্ষর 

</div>
</div><!----end print_area--->
<br />
<span class="company_name">কারিগরি সহায়তায়  টাংগাইল কলিং লি:</span>
</div>
<h1 class="center"><a href="" class="btn btn-info center"onclick="printcontent('print')" >প্রিন্ট করুন</a></h1>
<?php include("footer.php");?>