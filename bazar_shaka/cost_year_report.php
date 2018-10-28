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
		
		$query=$db->prepare("select * from cost WHERE year=?");
		$query->execute(array($input_year));
		$result=$query->rowCount();
		if($result==0) {
			header("location:cost_yearly_report.php?error=1");
		}
		

	
		}
	
else{
	
	header("location:cost_yearly_report.php?=error=0");
}

?>
<div class="container" id="print">
<div id="print_area">
<div class="print_header">
	<img class="logo" src="../Pourosova.jpg" alt="logo" />
	<h2> টাংগাইল পৌরসভা<br>বাজার শাখা<br/>
		<span>www.tangialpourashava.gov.bd</span>
	</h2>
	
</div>
<h2 class="center"><?php echo $input_year;?>  সালের  মাস ভিত্তিক ব্যায় বিবরনী  রিপোর্ট </h2>

<div class="report_date">তারিখ: <?php echo date('d-m-Y');?></div>
<table border="1" cellspacing="0" cellpadding="1">
	<tr>
		<th>মাসের নাম</th>
		<th>ব্যায় বিবরনী</th>
		<th>টাকার পরিমান</th>
		
 </tr>
 <tr>
 	<td>জানুয়ারি</td>
 	<td><?php  
		
	$query=$db->prepare("select * from cost WHERE year='$input_year' and month='1'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
			
			?>
			  <span><?php echo $row['cost_biboron'];?></span> ,
			  
			<?php 
			
		}
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(cost_taka) as total_vara from cost where year='$input_year' and month='1'");
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
		
	$query=$db->prepare("select * from cost WHERE year='$input_year' and month='2'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
			
			?>
			  <span><?php echo $row['cost_biboron'];?></span> ,
			  
			<?php 
			
		}
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(cost_taka) as total_vara from cost where year='$input_year' and month='2'");
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
		
	$query=$db->prepare("select * from cost WHERE year='$input_year' and month='3'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
			
			?>
			  <span><?php echo $row['cost_biboron'];?></span> ,
			  
			<?php 
			
		}
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(cost_taka) as total_vara from cost where year='$input_year' and month='3'");
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
		
	$query=$db->prepare("select * from cost WHERE year='$input_year' and month='4'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
			
			?>
			  <span><?php echo $row['cost_biboron'];?></span> ,
			  
			<?php 
			
		}
	
	?></td>
	<td>
	<?php 
			$query=$db->query("select SUM(cost_taka) as total_vara from cost where year='$input_year' and month='4'");
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
		
	$query=$db->prepare("select * from cost WHERE year='$input_year' and month='5'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
			
			?>
			  <span><?php echo $row['cost_biboron'];?></span> ,
			  
			<?php 
			
		}
	
	?></td>
	
 	<td>
	<?php 
		$query=$db->query("select SUM(cost_taka) as total_vara from cost where year='$input_year' and month='5'");
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
		
	$query=$db->prepare("select * from cost WHERE year='$input_year' and month='6'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
			
			?>
			  <span><?php echo $row['cost_biboron'];?></span> ,
			  
			<?php 
			
		}
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(cost_taka) as total_vara from cost where year='$input_year' and month='6'");
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
		
	$query=$db->prepare("select * from cost WHERE year='$input_year' and month='7'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
			
			?>
			  <span><?php echo $row['cost_biboron'];?></span> ,
			  
			<?php 
			
		}
	
	?></td>
 	<td>
	<?php 
			$query=$db->query("select SUM(cost_taka) as total_vara from cost where year='$input_year' and month='7'");
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
		
	$query=$db->prepare("select * from cost WHERE year='$input_year' and month='8'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
			
			?>
			  <span><?php echo $row['cost_biboron'];?></span> ,
			  
			<?php 
			
		}
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(cost_taka) as total_vara from cost where year='$input_year' and month='8'");
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
		
	$query=$db->prepare("select * from cost WHERE year='$input_year' and month='9'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
			
			?>
			  <span><?php echo $row['cost_biboron'];?></span> ,
			  
			<?php 
			
		}
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(cost_taka) as total_vara from cost where year='$input_year' and month='9'");
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
		
	$query=$db->prepare("select * from cost WHERE year='$input_year' and month='10'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
			
			?>
			  <span><?php echo $row['cost_biboron'];?></span> ,
			  
			<?php 
			
		}
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(cost_taka) as total_vara from cost where year='$input_year' and month='10'");
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
		
	$query=$db->prepare("select * from cost WHERE year='$input_year' and month='11'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
			
			?>
			  <span><?php echo $row['cost_biboron'];?></span> ,
			  
			<?php 
			
		}
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(cost_taka) as total_vara from cost where year='$input_year' and month='11'");
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
		
	$query=$db->prepare("select * from cost WHERE year='$input_year' and month='12'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
			
			?>
			  <span><?php echo $row['cost_biboron'];?></span> ,
			  
			<?php 
			
		}
	
	?></td>
	
 	<td>
	<?php 
			$query=$db->query("select SUM(cost_taka) as total_vara from cost where year='$input_year' and month='12'");
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
	<td> মোট ব্যায়  </td>
		<td>
		
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