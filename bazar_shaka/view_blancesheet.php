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


if(isset($_REQUEST['month']) && isset($_REQUEST['year'])){
$input_month=$_REQUEST['month'];
$input_year=$_REQUEST['year'];

	
		$query=$db->prepare("select * from month_vara WHERE month_name =? and year_name=?");
		$query->execute( array($input_month,$input_year));
		$result=$query->rowCount();
		if($result==0) {
			header("location:balance_sheet.php?error=1");
		}
		

	
		}
	
else{
	
	header("location:balance_sheet.php?=error=0");
}
	
	

?>
<div class="container" id="market_info">
<div id="print_area">
<div class="print_header">
	<img class="logo" src="../Pourosova.jpg" alt="logo" />
	<p> টাংগাইল পৌরসভা<br>বাজার শাখা<br/>
		<span>www.tangialpourashava.gov.bd</span>
	</p>

<h4 class="center"><?php echo $input_year;?>  সালের  <?php 
if($input_month==1){echo "জানুয়ারি";}
if($input_month==2){echo "ফ্রেবরুয়ারি";}
if($input_month==3){echo "মাচ";}
if($input_month==4){echo "এপ্রিল";}
if($input_month==5){echo "মে";}	
if($input_month==6){echo "জুন";}
if($input_month==7){echo "জুলাই";}	
if($input_month==8){echo "অগাস্ট";}	
if($input_month==9){echo "সেপ্টেম্বর";}		
if($input_month==10){echo "অক্টোবর";}		
if($input_month==11){echo "নভেম্বর";}		
if($input_month==12){echo "ডিসম্বের";}			



?>  মাসের ব্যালেস্নশীট </h4>
</div>
<div class="report_date">তারিখ: <?php echo date('d-m-Y');?></div>
<table border="1" cellspacing="0" cellpadding="5" id="b_sheet_tbl">
<tr>
		<th>তারিখ</th>
		<th> জমার বিবরন</th>
		<th>টাকা</th>
		
 </tr>
 	<?php 
	
		$query=$db->prepare("select * from month_vara where year_name='$input_year' and month_name='$input_month' ");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		?>
		
		<tr>
		<td><?php echo  $row['joma_date'];?></td>
		<td>মাসিক ভাড়া</td>
		<td><?php echo $row['vara']; ?></td>
		</tr>
		
		<?php
	}
	
	?>
<tr>
 <td></td>
	<td>মোট ভাড়া জমা:</td>
		<td>
		<?php 
			$query=$db->query("select SUM(vara) as total_vara from month_vara where year_name='$input_year' and  month_name='$input_month'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara=$row['total_vara'];
		
	}
		
	echo $total_vara;
		?></td>
	</tr>
 
</table>
<br /><br />
<div class="report_person">রিপোর্টৈ তৈরীকারীর নাম: <br />
							পদবী:
						<br /><br /><br />
							সাক্ষর 

</div>
<span class="company_name">কারিগরি সহায়তায় টাংগাইল কলিং লিমিটেড.</span>
</div><!----out put print area---->
<br/><br/>
<a href="" class="btn btn-info "onclick="printcontent('print_area')" >প্রিন্ট করুন</a>
</div>
</body>
</html>
<?php include('footer.php');?>