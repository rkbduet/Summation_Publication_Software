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


if(isset($_REQUEST['budget_year']) && isset($_REQUEST['month'])){
	$input_year=$_REQUEST['budget_year'];
	$input_month=$_REQUEST['month'];
		
		$query=$db->prepare("select * from tdl_cost WHERE month=? and year=?");
		$query->execute(array($input_month,$input_year));
		$result=$query->rowCount();
		if($result==0) {
			header("location:tdl_balance_sheet.php?error=1");
		}
		

	
		}
	
else{
	
	header("location:tdl_balance_sheet.php?error=0");
}


?>
<div class="container" id="print">
<div id="print_area">
<div class="print_header">
	<img class="logo" src="../Pourosova.jpg" alt="logo" />
	<p> টাংগাইল পৌরসভা<br>ট্রেড লাইসেন্স  শাখা<br/>
		<span>www.tangialpourashava.gov.bd</span>
	</p>
 </div>
<h4 class="center"><?php echo $input_year;?> অর্থবছরের <?php 
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


 ?> মাসের ব্যালেস্নশীট </h4>
 <div class="report_date">তারিখ: <?php echo date('d-m-Y');?></div>

<table border="1" cellspacing="0" cellpadding="5" width="1170px">
<thead>
<tr>
		<th>তারিখ</th>
		<th> জমার বিবরন</th>
		<th>টাকা</th>
		
 </tr>
</thead>
<tbody>
	
 	<?php 
	
		$query=$db->prepare("select * from tdl_joma where joma_year='$input_year' and joma_month='$input_month' ");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		?>
		
		<tr>
		<td><?php echo $row['joma_day']; ?>-<?php echo $row['joma_month'];?>-<?php echo $row['joma_year'];?></td>
		<td> ট্রেড লাইসেন্স </td>
		<td><?php echo $row['total_taka']; ?></td>
		</tr>
		
		<?php
	}
	
	?>
 </tbody>

 <tfoot>
 <td></td>
	<td>মোট  জমা:</td>
		<td>
		<?php 
			$query=$db->query("select SUM(total_taka) as total_vara from tdl_joma where joma_year='$input_year' and  joma_month='$input_month'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara=$row['total_vara'];
		
	}
		
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
<p class="center">কারিগরি সহায়তায় টাংগাইল কলিং লিমিটেড.</p>
</div><!----end print_area--->
</div>
<h1 class="center"><a href="" class="btn btn-info center"onclick="printcontent('print')" >প্রিন্ট করুন</a></h1>

<?php include("footer.php");?>