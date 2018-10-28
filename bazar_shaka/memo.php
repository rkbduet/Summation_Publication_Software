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

if(isset($_REQUEST['memo_no'])){
	$input_memo_no=$_REQUEST['memo_no'];

		$query=$db->prepare("select memo_num from memo_report WHERE memo_num=?");
		$query->execute(array($input_memo_no));
		$result=$query->rowCount();
		if($result==0) {
			header("location:input_memo_num.php?error=1");
		}
		
		}
	else{
	header("location:input_memo_num.php?error=0");
	
	}
	
	
	
	?>

<?php
$query=$db->prepare("select * from memo_report where memo_num=?");
	$query->execute(array($input_memo_no));
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) 
	{	
		$memo_id=$row['memo_id'];
		$memo_no=$row['memo_num'];
		$date=$row['date'];
		 $shop_name=$row['shop_name'];
		 $shop_id= $row['shop_id'];
		 
		$book_ids= $row['book_id'];
		 $quantitys=$row['quantity'];
		$rates=$row['rate'];
		$amounts=$row['price'];
		$total_price=$row['total_price'];
		$paid=$row['paid'];
		$due=$row['due'];
		
	}


?>	
<div class="container">

<?php  
if(isset($update_error)) {echo "<div class='error_message'>".$update_error."</div>";}
if(isset($update_success)) {echo "<div class='success_message'>".$update_success."</div>";}
?>

<div class="row" id="main_roshid">
	<div class="col-sm-6" style="border:1px solid; padding:5px 10px;">
	<div class="roshid_header">
	<div class="rohsid_logo pull-left"><img class="logo" src="../logo.png" alt="logo" /></div>
		
		<label class="name">Summation Publication</label>
		<address>424/24, M.A Samad Villa </br>
		DUET Gate Joydebpur, Gazipur-1700 <br />
		<label for="">Mobile: 01975377786,  01975377788</label>
		</address>
		<label for="" class="left">Memo No: <?php echo $memo_no;?></label>
		<label class="right">Date: <?php echo $date;?></label>
	</div>
	<br />

<?php
	$query_client_info=$db->prepare("select * from client_info where shop_id=?");
	$query_client_info->execute(array($shop_id));
	$result1=$query_client_info->fetchAll(PDO::FETCH_ASSOC);
	foreach($result1 as $row1) 
	{	
		
		$mobile=$row1['mobile'];
		
	}


?>	
<div style="height=25px; border-top:1px solid blue; border-bottom:1px solid blue;">
	<label for="" class="left">Customer Name:  <?php echo $shop_name;?> </label>
	<label for="" class="right">Mobile: <?php echo $mobile;?></label> 
</div>

<table class="main_memo">
<tr>
	<th width="5%">SL.NO</th>
	<th width="20%">Book Name</th>
	<th width="5%"> Quantity</th>
	<th width="10%">Rate</th>
	<th width="10%">Amount</th>
</tr>
<?php
	$arr = explode(",",$row['book_id']);
	$count_arr = count(explode(",",$row['book_id']));
	$i=0;
	$b=0;
	for($r=0;$r<$count_arr;$r++)
 {
	$i++;	
?>
		<tr>
			<td><?php echo $i;?></td>
			<td>
				<?php
				$book_ids = explode(",",$row['book_id']);
				$count_book_id = count(explode(",",$row['book_id']));
				$k=0;
					for($j=0;$j<$count_book_id;$j++)
					{
									
					$statement1 = $db->prepare("SELECT * FROM book WHERE book_id=?");
					$statement1->execute(array($book_ids[$j]));
					$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
					foreach($result1 as $row1)
						{
							$arr1[$k] = $row1['book_name'];
						}
						$k++;	
					}
					
					echo $arr1[$b];
					
				?>
								
			</td>
			
			<td>
				<?php
				$quantitys = explode(",",$row['quantity']);
				echo $quantitys[$b];
				?>
								
			</td>
			<td>
				<?php
				$rates = explode(",",$row['rate']);
				echo $rates[$b];
				?>
								
			</td>
			<td>
				<?php
				$amounts = explode(",",$row['price']);
				echo $amounts[$b];
				?>
								
			</td>
		</tr>

	
		<?php
		$b++;
	}
	?>
	<tr>
	<td></td>
	<td></td>
	<td></td>
	<td>Total:</td>
	<td><label for=""><?php echo $total_price; ?>/=</label> </td>
	</tr>
</table>
<div class="paid_area">
<label for="" class="left">PAID : <?php echo $paid;?> /= </label>
<label for="" class="right"> DUE : <?php echo $due; ?> /=</label>

</div>


</div><!---end of rohsid 1st Part--->
<div class="col-sm-6" style="border:1px solid; padding:5px 10px;">
	<div class="roshid_header">
	<div class="rohsid_logo pull-left"><img class="logo" src="../logo.png" alt="logo" /></div>
		
		<label class="name">Summation Publication</label>
		<address>424/24, M.A Samad Villa </br>
		DUET Gate Joydebpur, Gazipur-1700 <br />
		<label for="">Mobile: 01975377786,  01975377788</label>
		</address>
		<label for="" class="left">Memo No: <?php echo $memo_no;?></label>
		<label class="right">Date: <?php echo $date;?></label>
	</div>
	<br />
<div class="customer_address">
	<label for="" class="left">Customer Name:  <?php echo $shop_name;?> </label>
	<label for="" class="right">Mobile: <?php echo $mobile;?></label> 
</div>

<table class="main_memo">
<tr>
	<th width="5%">SL.NO</th>
	<th width="20%">Book Name</th>
	<th width="5%"> Quantity</th>
	<th width="10%">Rate</th>
	<th width="10%">Amount</th>
</tr>
<?php
	$arr = explode(",",$row['book_id']);
	$count_arr = count(explode(",",$row['book_id']));
	$i=0;
	$b=0;
	for($r=0;$r<$count_arr;$r++)
 {
	$i++;	
?>
		<tr>
			<td><?php echo $i;?></td>
			<td>
				<?php
				$book_ids = explode(",",$row['book_id']);
				$count_book_id = count(explode(",",$row['book_id']));
				$k=0;
					for($j=0;$j<$count_book_id;$j++)
					{
									
					$statement1 = $db->prepare("SELECT * FROM book WHERE book_id=?");
					$statement1->execute(array($book_ids[$j]));
					$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
					foreach($result1 as $row1)
						{
							$arr1[$k] = $row1['book_name'];
						}
						$k++;	
					}
					
					echo $arr1[$b];
					
				?>
								
			</td>
			
			<td>
				<?php
				$quantitys = explode(",",$row['quantity']);
				echo $quantitys[$b];
				?>
								
			</td>
			<td>
				<?php
				$rates = explode(",",$row['rate']);
				echo $rates[$b];
				?>
								
			</td>
			<td>
				<?php
				$amounts = explode(",",$row['price']);
				echo $amounts[$b];
				?>
								
			</td>
		</tr>

	
		<?php
		$b++;
	}
	?>
	<tr>
	<td></td>
	<td></td>
	<td></td>
	<td>Total:</td>
	<td><label for=""><?php echo $total_price; ?>/=</label> </td>
	</tr>
</table>
<div class="paid_area">
<label for="" class="left">PAID: <?php echo $paid;?> /= </label>
<label for="" class="right"> DUE: <?php echo $due; ?> /=</label>

</div>


</div><!---end of rohsid Second Part--->
	
 


	
</div><!-- end of main roshid-->

	<h1 class="center"><a href="" class="btn btn-info "onclick="printcontent('main_roshid')" >Print</a> </h1>
</div><!---end container--->

<?php include('footer.php');?>
