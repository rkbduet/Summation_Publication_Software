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



if(isset($_REQUEST['date'])){
$input_date=$_REQUEST['date'];
		
		$query=$db->prepare("select * from tdl_cost WHERE cost_date=?");
		$query->execute(array($input_date));
		$result=$query->rowCount();
		if($result==0) {
			header("location:view_cost_roshid.php?error=1");
		}
		

	
		}
	
else{
	
	header("location:view_cost_roshid.php?error=0");
}


?>

<?php 

$i=0;	
	$query=$db->prepare("select * from tdl_cost  where cost_date='$input_date' ");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row1) 
	{
		$voucher_no=$row1['cost_id'];
		
	}

?>
<div class="container">
<div class="row" id="main_roshid">
	<div class="col-lg-8 cost_roshid">
	
<div class= "roshid_header">
	<div class="rohsid_logo"><img class="logo" src="../Pourosova.jpg" alt="logo" /></div>
		
		<p>টাংগাইল পৌরসভা</br>
		বাজার শাখা<br/>
		দৈনন্দিন খরচের ভাউচার  </p>
		<div class="roshid_no">ভাউচার নং: <?php echo $voucher_no;?></div>
		<span>তারিখ : <?php echo $input_date;?></span>
	</div>
<br />
<table cellspacing="2" cellpadding="2"> 
	
<tr>
	<th>ক্রমিক নং</th>
	<th>খরচের বিবরন </th>
	<th>টাকা</th>
</tr>
<?php

	$i=0;	
	$query=$db->prepare("select * from tdl_cost  where cost_date='$input_date' ");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) 
	{
		$i++;
		$roshid_no=$row['cost_id'];
		 $cost_biboron=$row['tdl_cost_b'];
		 $cost_taka= $row['tdl_cost_taka'];
		 $cost_date=$row['cost_date'];
		 ?>
		
		<tr>
		<td><?php echo $i;?></td>
		<td><?php echo $cost_biboron;?></td>
		<td><?php echo $cost_taka;?></td>
		
	</tr>
	<?php
		
	}
	
	?>
	<tfoot>
 <td></td>
	<td>মোট :</td>
		<td>
		<?php 
			$query=$db->query("select SUM(tdl_cost_taka) as total_vara from tdl_cost where cost_date='$input_date'");
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
<br /><br /><br />
	<strong>ভাউচারকারীর স্বাক্ষর</strong><br/>
	<p class="pull-right"> কারিগরি সহয়তায়: টাংগাইল কলিং লি. </p>
	
	</div>
</div>

	<br/>
	<h1 class="center"><a href="" class="btn btn-info "onclick="printcontent('main_roshid')" >প্রিন্ট</a></h1>
</div><!---end container--->
<?php include('footer.php');?>
