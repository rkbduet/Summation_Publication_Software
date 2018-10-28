<?php
ob_start();
session_start();
if($_SESSION['name']!='tangail')
{
	header('location: login.php');
}
?>
<script>
		function confirm_delete() {
			return confirm('Are You sure want to Delete?');
		}
</script>
<?php
include('../config.php');

if(isset($_POST['form1'])) {

	try {
		
		if(empty($_POST['book_name'])) {
			throw new Exception( 'Enter Book Name.');
		}
		
		if(empty($_POST['book_id'])) {
			throw new Exception( 'Enter Book ID.');
		}
		$query=$db->prepare("select * from book where book_id=?");
		$query->execute(array($_POST['book_id']));
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
		$book_name = $row['book_name'];
		}
			
		if($book_name!=$_POST['book_name']){
			
			throw new Exception( 'Book Name and Book ID does not match.');
			
		}
		
		if(empty($_POST['quantity'])) {
			throw new Exception( 'Enter quantity of Book.');
		}

		if(empty($_POST['price'])) {
			throw new Exception( 'Enter  Book Price.');
		}
		if(empty($_POST['total_price'])) {
			throw new Exception( 'Please Click the Total Price.');
			
		}
		
		
		$date=date('Y-m-d');
		$query=$db->prepare("insert into  sells(book_name,book_id,quantity,price,total_price,date) values(?,?,?,?,?,?)");
		$query->execute(array($_POST['book_name'],$_POST['book_id'],$_POST['quantity'],$_POST['price'],$_POST['total_price'],$date));
	
		

		$success_message = 'One Book Added Successfully.';
	
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}
//End Form1



if(isset($_REQUEST['id'])) 
{
	$id = $_REQUEST['id'];
	
	$statement = $db->prepare("DELETE FROM sells WHERE sell_id=?");
	$statement->execute(array($id));
	
	$success_message2 = "Book Data deleted successfully.";
	
}







?>
<?php include("header.php")?>

<?php 
	$query=$db->prepare("select * from book ");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) 
	{
		
		$book_name= $row['book_name']; 	 	 	 	 	 	 	 	
		 $book_id=$row['book_id'];
		$witter=$row['writer'];
		$date=$row['publish_date'];
		
	}


?>

<div class="container">
<br />

<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>

<h2 class="title">Select your Book...</h2>
<form action="" method="post" >

<table celspacing="1" cellpadding="5">
	
 <tr>
 	<th>Book Name</th>
	<th>Book ID</th>
	<th>Quantity</th>
	<th>Rate </th>
	<th>Amount</th>
</tr>

<tr>
 	<td>
		<select name="book_name" id="">
		<option value="">Select Book Name...</option>
	
			<?php 
		$query=$db->prepare("select * from book");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
		?>
			<option value="<?php echo $row['book_name'];?>"><?php echo $row['book_name'];?></option>
			<?php
		}
			
			
			?>
			
		</select>
		</td>

 	<td>
		<select name="book_id" id="">
		<option value="">Select Book ID...</option>
	
			<?php 
		$query=$db->prepare("select * from book");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
		?>
			<option value="<?php echo $row['book_id'];?>"><?php echo $row['book_id'];?></option>
			<?php
		}
			
			
			?>
			
		</select>
		</td>

 	
 	<td ><input type="number" name="quantity" class="quantity"/></td>

 	
 	<td ><input type="number" name="price" class="price"/></td>

	
	<td ><input type="number" name="total_price" class="total_price"/></td>
	
</tr>
<tr>
<td></td>
<td></td>
<td ><button class="btn btn-success" type="submit" name="form1"><i class="fa fa-plus-square"></i> </button></td>
	
</tr>

</table>

</form>

<?php 
	$query=$db->prepare("select * from book ");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) 
	{
		
		$book_name= $row['book_name']; 	 	 	 	 	 	 	 	
		 $book_id=$row['book_id'];
		$witter=$row['writer'];
		$date=$row['publish_date'];
		
	}


?>
<div class="container">
<div id="print_area">


<table class="book_tbl" cellspacing="0" cellpadding="1">
	<tr>
		<th width="5%">SL.No.</th>
		<th width="30%">Book Name:</th>
		<th width="30%">Quantity</th>
		<th width="10%">Rate</th>
		<th width="15%">Amount</th>
		<th width="10%">Action</th>
 </tr>
 	<?php
	
	
			/* ===================== Pagination Code Starts ================== */
			$adjacents = 7;
										
					
			
			
			$statement = $db->prepare("SELECT * FROM sells ORDER BY sell_id ASC");
			$statement->execute();
			$total_pages = $statement->rowCount();
							
			
			$targetpage = $_SERVER['PHP_SELF'];   //your file name  (the name of this file)
			$limit =25;                                 //how many items to show per page
			$page = @$_GET['page'];
			if($page) 
				$start = ($page - 1) * $limit;          //first item to display on this page
			else
				$start = 0;
			
						
			$statement = $db->prepare("SELECT * FROM sells ORDER BY sell_id ASC LIMIT $start, $limit");
			$statement->execute();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			
			if ($page == 0) $page = 1;                  //if no page var is given, default to 1.
			$prev = $page - 1;                          //previous page is page - 1
			$next = $page + 1;                          //next page is page + 1
			$lastpage = ceil($total_pages/$limit);      //lastpage is = total pages / items per page, rounded up.
			$lpm1 = $lastpage - 1;   
			$pagination = "";
			if($lastpage > 1)
			{   
				$pagination .= "<div class=\"pagination\">";
				if ($page > 1) 
					$pagination.= "<a href=\"$targetpage?page=$prev\">&#171; previous</a>";
				else
					$pagination.= "<span class=\"disabled\">&#171; previous</span>";    
				if ($lastpage < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
				{   
					for ($counter = 1; $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
					}
				}
				elseif($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
				{
					if($page < 1 + ($adjacents * 2))        
					{
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
						}
						$pagination.= "...";
						$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
						$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
					}
					elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
					{
						$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
						$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
						$pagination.= "...";
						for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
						}
						$pagination.= "...";
						$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
						$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
					}
					else
					{
						$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
						$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
						$pagination.= "...";
						for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
						}
					}
				}
				if ($page < $counter - 1) 
					$pagination.= "<a href=\"$targetpage?page=$next\">next &#187;</a>";
				else
					$pagination.= "<span class=\"disabled\">next &#187;</span>";
				$pagination.= "</div>\n";       
			}
			/* ===================== Pagination Code Ends ================== */	

			$i=0;
			
			foreach($result as $row){
			$i++;
			?>
			<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $row['book_name'];?></td>
			<td><?php echo $row['quantity'];?></td>
			<td><?php echo $row['price'];?></td>
			<td><?php echo $row['total_price'];?></td>
			<td><a  onclick='return confirm_delete();' href="add_sells.php?id=<?php echo $row['sell_id']; ?>"><span class="red">X</span> </a></td>
			</tr>
			
			<?php
		}
		
		
		
		
	?>
  


</table>

</div><!---end print_area--->

</div>
<?php 
// Create Memo Insert Query.
if(isset($_POST['create_memo']))
{
	try {
	
		if(empty($_POST['paid'])) {
			throw new Exception( 'Enter Paid Value.');
		}
		
		if(empty($_POST['shop_name'])) {
			throw new Exception( 'Enter Shop Name.');
		}
		if(empty($_POST['memo_no'])) {
			throw new Exception( 'Enter Memo No.');
		}
		if(empty($_POST['shop_id'])) {
			throw new Exception( 'Enter Shop ID.');
		}
		
			
	$query=$db->prepare("select * from memo_report where memo_num=?");
	$query->execute(array($_POST['memo_no']));
	$result=$query->rowCount();

	if($result>0){
		throw new Exception( 'This Memo No Already Exists.');
	}
		
		$query2=$db->prepare("select * from client_info where shop_id=?");
		$query2->execute(array($_POST['shop_id']));
		$result2=$query2->fetchAll(PDO::FETCH_ASSOC);
		foreach($result2 as $row2){
		$shop_name=$row2['dokaner_name'];
		}
			
		if($shop_name!=$_POST['shop_name']){
			
			throw new Exception( 'Shop Name and Shop ID does not match.');
			
		}
		
	$query=$db->prepare("select * from sells ");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
	$i=0;
	foreach($result as $row1) 
	{
				
				$arr_book_id[$i] = $row1['book_id'];
				$arr_quantity[$i] = $row1['quantity'];
				$arr_rate[$i] = $row1['price'];
				$arr_price[$i] = $row1['total_price'];
				
				$sell_id=$row1['sell_id'];
				$i++;
	}
			$book_ids = implode(",",$arr_book_id);
			$quantitys = implode(",",$arr_quantity);
			$rates = implode(",",$arr_rate);
			$prices = implode(",",$arr_price);
		
			$query=$db->query("select SUM(total_price) as total_price from sells");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
		{
		$total_price=$row['total_price'];
		
		}
		
			$paid =$_POST['paid'];
			$due = $total_price - $paid;
			$memo_num=$_POST['memo_no'];
			$shop_name=$_POST['shop_name'];
			$shop_id=$_POST['shop_id'];
			
			$date=date('Y-m-d');
		
					$statement1 = $db->prepare("SELECT * FROM sells");
					$statement1->execute();
					$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
					foreach($result1 as $rows)
						{
							$input_book_id = $rows['book_id'];
							$input_quantity=$rows['quantity'];
							
								$query4=$db->query("select * from stock_info where book_id='$input_book_id'");
								$query4->execute();
								$result4=$query4->fetchAll(PDO::FETCH_ASSOC);
								foreach($result4 as $row2) 
								{
									$old_stock=$row2['count_stock'];
								}
		
								$new_stock=$old_stock-$input_quantity;
								
		
								$query3=$db->prepare("update stock_info set count_stock=? where book_id=?");
								$query3->execute(array($new_stock,$input_book_id));
		
							
						}
		
		
		$statement=$db->prepare("insert into  memo_report(memo_num,shop_name,shop_id,book_id,quantity,rate,price,total_price,paid,due,date) values(?,?,?,?,?,?,?,?,?,?,?)");
		$statement->execute(array($memo_num,$shop_name,$shop_id,$book_ids,$quantitys ,$rates,$prices,$total_price,$paid,$due,$date));
		
		$statement=$db->prepare("insert into  sells_account(shop_id,paid,due,date) values(?,?,?,?)");
		$statement->execute(array($shop_id,$paid,$due,$date));
		
		$statement = $db->prepare("DELETE FROM sells where status=? ");
		$statement->execute(array($_POST['status']));
		
		header('location: memo_success.php');
		
	}
	catch(Exception $e) {
		$error_message1 = $e->getMessage();
	}
		
}


?>
<div class="container">

<div class="pagination">
<?php 
echo $pagination; 
?>
</div>



<form action=""  method="post">
<table>
	<tr>
		<td width="10%">Paid Amount:</td>
		<td width="10%"><input name ="paid" type="number" /></td>
		<td width="5%"></td>
		<td width="10%">Total Amount: </td>
		<td width="10%">
		<h2>
		<?php 
			$query=$db->query("select SUM(total_price) as total_price from sells");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_price=$row['total_price'];
		
	}
		
	echo $total_price;
		?>  T.K </h2></td>
	</tr>
	<tr><td>
	<input type="hidden" name="status" value="<?php echo $status; ?>"/></td></tr>
</table>
<div class="container">

<?php  
if(isset($error_message1)) {echo "<div class='error_message'>".$error_message1."</div>";}

?>
	<div class="row">
	
	<table celspacing="1" cellpadding="5" border="1px">
 <tr>
		<td>Memo No.</td>
		<td><input type="number" name="memo_no" /></td>
 
		<td>Customer Name:</td>
		<td>
		<select name="shop_name" id="">
		<option value="">Select Customer Name</option>
	
			<?php 
		$query=$db->prepare("select * from client_info");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
		?>
			<option value="<?php echo $row['dokaner_name'];?>"><?php echo $row['dokaner_name'];?></option>
			<?php
		}
			
			
			?>
			
		</select>
		</td>
		<td>Shop ID:</td>
		<td>
		<select name="shop_id" id="">
		<option value="">Select Shop ID </option>
	
			<?php 
		$query=$db->prepare("select * from client_info");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
		?>
			<option value="<?php echo $row['shop_id'];?>"><?php echo $row['shop_id'];?></option>
			<?php
		}
			
			
			?>
			
		</select>
		</td>
	</tr>
	
</table>
	
	</div>
</div><!-container---!>
<br />

<div class="row">
	<div class="col-lg-4"></div>
	<div class="col-lg-4"><button class="btn btn-success center" type="submit" name="create_memo"> Create Memo </button></div>
	<div class="col-lg-4"></div>
</div>
 
</form>


</div>
<script>
    $(document).ready(function() {
		$(".price").on('change', function(e){
			
			var quantity = parseFloat($('.quantity').val());
			var price = parseFloat($('.price').val());
			var total_price = parseFloat(quantity*price);
			$(".total_price").val(total_price);
		});
	});
</script>
<?php include('footer.php');?>

