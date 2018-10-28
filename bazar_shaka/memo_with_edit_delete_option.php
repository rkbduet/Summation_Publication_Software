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

		

	
	
	
	
	?>
<?php 
if(isset($_POST['update'])) {

	try {
		
		if(empty($_POST['paid'])) {
			throw new Exception( 'Enter Enter Paid Ammount.');
		}
		
		
		$query_update = $db->prepare("UPDATE memo_report SET shop_name=?,shop_id=?,total_price=?, paid=?,due=?,date=? WHERE memo_id=?");
		$query_update->execute(array($_POST['shop_name'],$_POST['shop_id'],$total_price,$_POST['paid'],$due,$_POST['date'],$_POST['hdn']));
	
		$book_ids = explode(",",$row['book_id']);
				$count_book_id = count(explode(",",$row['book_id']));
				$k=0;
					for($j=0;$j<$count_book_id;$j++)
					{
									
					$arr1[$k] = $book_ids[$j];	
					$k++;	
					}
					
					echo $arr1[$b];
		
		
		
		$update_success = 'Memo UPDATE Successfully.';
	
		
	
	}
	
	catch(Exception $e) {
		$update_error = $e->getMessage();
	}
	
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
<div class="customer_address">
	<label for="" class="left">Customer Name:  <?php echo $shop_name;?> </label>
	<label for="" class="right">Shop ID: <?php echo $shop_id;?></label> 
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
	<label for="" class="right">Shop ID: <?php echo $shop_id;?></label> 
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

	<h1 class="center"><a href="" class="btn btn-info "onclick="printcontent('main_roshid')" >Print</a> 

	<a class="fancybox btn btn-success"  href="#inline<?php echo $i; ?>">Edit</a>
			<div id="inline<?php echo $i; ?>" style="width:750px;display: none;">
				<p>
					
					
					<form action="" method="post">
					<input type="hidden" name="hdn" value="<?php echo $row['memo_id']; ?>">
	
	<div class="col-lg-12 ">
<table class="memo_update_tbl">
	<tr>
		<td>Memo No:</td>
		<td><input type="text" name="memo_no" value="<?php echo $memo_no;?>"/></td>
	<td>Date:</td>
	<td><input type="date" name="date" value="<?php echo $date;?>"/></td>
	
	</tr>
	<tr>
		<td>Customer Name:</td>
		<td><select name="shop_name" id="">
		<option value="<?php echo $shop_name;?>"><?php echo $shop_name;?></option>
	
			<?php 
		$query_client=$db->prepare("select * from client_info");
		$query_client->execute();
		$result_client=$query_client->fetchAll(PDO::FETCH_ASSOC);
		foreach($result_client as $row_client){
		?>
			<option value="<?php echo $row_client['dokaner_name'];?>"><?php echo $row_client['dokaner_name'];?></option>
			<?php
		}
			
			
			?>
			
		</select></td>
		<td>Shop ID:</td>
		<td><select name="shop_id" id="">
		<option value="<?php echo $shop_id;?>"><?php echo $shop_id;?> </option>
	
			<?php 
		$query_shop_id=$db->prepare("select * from client_info");
		$query_shop_id->execute();
		$result_shop_id=$query_shop_id->fetchAll(PDO::FETCH_ASSOC);
		foreach($result_shop_id as $row_shop_id){
		?>
			<option value="<?php echo $row_shop_id['shop_id'];?>"><?php echo $row_shop_id['shop_id'];?></option>
			<?php
		}
			
			
			?>
			
		</select></td>
	</tr>
</table>



<table class="memo_update_tbl">
<tr>
	<th width="10%">SL.NO</th>
	<th width="20%">Book Name</th>
	<th width="20%"> Book ID </th>
	<th width="20%"> Quantity</th>
	<th width="20%">Rate</th>
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
			<select name="book_name" id="">
		<option value="<?php
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
					
				?> "><?php
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
					
				?></option>
	
			<?php 
		$query_book_name=$db->prepare("select * from book");
		$query_book_name->execute();
		$result_book_name=$query_book_name->fetchAll(PDO::FETCH_ASSOC);
		foreach($result_book_name as $row_book_name){
		?>
			<option value="<?php echo $row_book_name['book_name'];?>"><?php echo $row_book_name['book_name'];?></option>
			<?php
		}
			
			
			?>
			
		</select>
				
								
			</td>
			
			<td>
		<select name="book_id" id="">
		<option value="<?php
				$book_ids = explode(",",$row['book_id']);
				$count_book_id = count(explode(",",$row['book_id']));
				$k=0;
					for($j=0;$j<$count_book_id;$j++)
					{
									
					$arr1[$k] = $book_ids['$j'];	
					$k++;	
					}
					
					echo $arr1[$b];
					
				?> "><?php
				$book_ids = explode(",",$row['book_id']);
				$count_book_id = count(explode(",",$row['book_id']));
				$k=0;
					for($j=0;$j<$count_book_id;$j++)
					{
									
					$arr1[$k] = $book_ids[$j];	
					$k++;	
					}
					
					echo $arr1[$b];
					
				?></option>
	
			<?php 
		$query_book_id=$db->prepare("select * from book");
		$query_book_id->execute();
		$result_book_id=$query_book_id->fetchAll(PDO::FETCH_ASSOC);
		foreach($result_book_id as $row_book_id){
		?>
			<option value="<?php echo $row_book_id['book_id'];?>"><?php echo $row_book_id['book_id'];?></option>
			<?php
		}
			
			
			?>
			
		</select>
		</td>
			
			
			<td>
				<input type="number" name="quantity" value="<?php
				$quantitys = explode(",",$row['quantity']);
				echo $quantitys[$b];
				?>" />
								
			</td>
			<td>
				<input type="number" name="rate" value="<?php
				$rates = explode(",",$row['rate']);
				echo $rates[$b];
				?>" />
								
			</td>
			<td>
				<input type="number" name="amount" value="<?php
				$amounts = explode(",",$row['price']);
				echo $amounts[$b];
				?>" />
								
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
	<td></td>
	<td></td>
	<td> <label for="">Total: <?php echo $total_price; ?>/=</label> </td>
	</tr>
</table>

<table>
	<tr>
		<td>PAID: </td>
		<td><input type="number" name="paid" value="<?php echo $paid;?>"/></td>
		
	</tr>
</table>

<h2 class="center"> <button class="btn btn-success center" type="submit" name="update">UPDATE</button></h2>

</div><!---end of rohsid Second Part--->
					
					</form>
				</p>
			</div>


	<a onclick="return confirm_delete();" href="memo_delete.php?id=<?php echo $memo_id; ?>" class="btn btn-danger">Delete</a></h1>
</div><!---end container--->
<script>
		function confirm_delete() {
			return confirm('Are You sure want to Delete?');
		}
</script>
<?php include('footer.php');?>
