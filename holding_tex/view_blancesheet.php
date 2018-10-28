<?php
ob_start();
session_start();
if($_SESSION['name']!='hold')
{
	header('location: login.php');
}
?>
<?php include('../config.php'); ?>
<?php include("header.php");?>
	
<?php 

$input_year=$_REQUEST['budget_year'];
$input_month=$_REQUEST['month'];


?>
<div class="container" id="">
<div id="print_area">

<h1 class="center"><?php echo $input_year;?> অর্থবছরের <?php 
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


 ?> মাসের ব্যালেস্নশীট </h1>
<table border="1" cellspacing="0" cellpadding="5" width="1170px">
<thead>
<tr>
		<th>তারিখ</th>
		<th> খরচের বিবরন</th>
		<th>টাকা</th>
		
 </tr>
</thead>
<tbody>
	
 	<?php 
	
		$query=$db->prepare("select * from tdl_cost where year='$input_year' and month='$input_month' ");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		?>
		
		<tr>
		<td><?php echo $row['day']; ?> - <?php echo $row['month'];?> - <?php echo $row['year'];?></td>
		<td><?php echo $row['tdl_cost_b']; ?></td>
		<td><?php echo $row['tdl_cost_taka']; ?></td>
		</tr>
		
		<?php
	}
	
	?>
	<tr>
		<td></td>
		<td>মোট খরচ </td>
		<td>
		<?php 
			$query=$db->query("select SUM(tdl_cost_taka) as total_cost from tdl_cost where year='$input_year' and  month='$input_month'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_cost=$row['total_cost'];
		
	}
		
	echo $total_cost;
		?></td>
		
	</tr>
 </tbody>

 <tfoot>
 
	<td>মোট ভাড়া জমা:</td>
		<td>
		<?php 
			$query=$db->query("select SUM(tdl_fe) as total_vara from tdl_joma where joma_year='$input_year' and  joma_month='$input_month'");
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
<p class="center">কারিগরি সহায়তায় টাংগাইল কলিং লিমিটেড.</p>
</div><!----end print_area--->
<br /><br />
<a href="" class="btn btn-info center"onclick="printcontent('print_area')" >প্রিন্ট করুন</a>
</div>
</body>
</html>
<?php include("footer.php");?>