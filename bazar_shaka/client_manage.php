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
if(isset($_POST['form2'])) {
try {
	
	
		if(empty($_POST['c_name'])) {
			throw new Exception( 'Enter Client Name.');
		}
		if(empty($_POST['shop_name'])) {
			throw new Exception( 'Enter Shop Name.');
		}
		if(empty($_POST['shop_id'])) {
			throw new Exception( 'Enter Shop ID.');
		}
	
		
		if(empty($_POST['tikana'])) {
			throw new Exception( 'Enter Address.');
		}
		
		if(empty($_POST['mobile'])) {
			throw new Exception( 'Enter Mobile Number.');
		}
		$query=$db->prepare("update client_info set c_name=?,dokaner_name=?,shop_id=?,address=?,mobile=?,email=?  where m_id=?" );
		$query->execute(array($_POST['c_name'],$_POST['shop_name'],$_POST['shop_id'],$_POST['tikana'],$_POST['mobile'],$_POST['email'],$_POST['hdn']));
		
		$success_message = 'Your Information update Successfully.';
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

if(isset($_POST['form1']))
{
	try {
	
		
		if(empty($_POST['c_name'])) {
			throw new Exception( 'Enter Name.');
		}
		
		if(empty($_POST['shop_name'])) {
			throw new Exception( 'Enter Shop Name.');
		}
		if(empty($_POST['shop_id'])) {
			throw new Exception( 'Enter Shop ID.');
		}
		if(empty($_POST['tikana'])) {
			throw new Exception( ' Enter Address.');
		}
		if(!(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $_POST['email']))) {
		throw new Exception('Please enter a valid email address');
	}
		
	$query=$db->prepare("select * from client_info where shop_id=? ");
	$query->execute(array($_POST['shop_id']));
	$result=$query->rowCount();
	if($result>0){
	throw new Exception( ' This Shop ID Already Exists.');
	}
	else{
		$query=$db->prepare("insert into  client_info(c_name,dokaner_name,shop_id,address,mobile,email) values(?,?,?,?,?,?)");
		$query->execute(array($_POST['c_name'],$_POST['shop_name'],$_POST['shop_id'],$_POST['tikana'],$_POST['mobile_no'],$_POST['email']));
	
		$success_message = 'Informaton Save Successfully.';
		}
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
		
}

if(isset($_REQUEST['id'])) 
{
	$id = $_REQUEST['id'];
	
	$statement = $db->prepare("DELETE FROM client_info WHERE m_id=?");
	$statement->execute(array($id));
	
	$success_message2 = "Data deleted successfully.";
	
}

?>
<?php include("header.php")?>

<div class="container">
<br />
<h2 class="title">Add New Client.</h2>
<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
<form action="" method="post" >
<table celspacing="1" cellpadding="5">
	
 <tr>
 	<td width="10%">Client Name:</td>
 	<td width="20%"><input type="text" name="c_name"/></td>
 
	<td width="5%" >Address:</td>
	<td width="10%"><input type="text" name="tikana" /></td>
	<td width="5%"></td>
</tr>
<tr>
 	<td width="10%">Shop Name:</td>
 	<td width="25%"><input type="text" name="shop_name"/></td>

	<td width="10%">Shop ID:</td>
	<td width="10%"><input type="text" name="shop_id"/></td>
	<td width="5%"></td>
</tr>
<tr>
	<td width="10%" >Mobile:</td>
	<td width="25%"><input type="text" name="mobile_no" /></td>

	<td width="10%">Email:</td>
	<td width="25%"><input type="text" name="email" /></td>
	<td width="12%"><button class="btn btn-success" type="submit" name="form1">Save</button></td>
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
<div class="container" id="print">
<div id="print_area">
<div class="print_header">
	<span class="center"><u> All Client List</u></sapn>
</div>


<table class="" border = "1px solid;" cellspacing="0" cellpadding="1">
	<tr>
	
		<th width="5%">SL.</th>
		<th width="20%">Client Name</th>
		<th width="20%">Shop Name</th>
		<th width="10%">Shop ID</th>
		<th width="15%">Address</th>
		<th width="10">Mobile</th>
		<th width="10%">Email</th>
		<th width="10%">Action</th>
 </tr>
 	<?php
	
	
			/* ===================== Pagination Code Starts ================== */
			$adjacents = 7;
										
					
			
			
			$statement = $db->prepare("SELECT * FROM client_info ORDER BY m_id ASC");
			$statement->execute();
			$total_pages = $statement->rowCount();
							
			
			$targetpage = $_SERVER['PHP_SELF'];   //your file name  (the name of this file)
			$limit =25;                                 //how many items to show per page
			$page = @$_GET['page'];
			if($page) 
				$start = ($page - 1) * $limit;          //first item to display on this page
			else
				$start = 0;
			
						
			$statement = $db->prepare("SELECT * FROM client_info ORDER BY m_id ASC LIMIT $start, $limit");
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
			<td><?php echo $row['c_name']; ?></td>
			<td><?php echo $row['dokaner_name'];?></td>
			<td><?php echo $row['shop_id'];?></td>
			<td><?php echo $row['address']; ?></td>
			<td><?php echo $row['mobile']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td>
			<a class="fancybox" href="#inline<?php echo $i; ?>">Edit</a>
			<div id="inline<?php echo $i; ?>" style="width:500px;display: none;">
				<h3 class="title"> Edit Client Informaton</h3>
	
				<p>
					<form action="" method="post">
					<input type="hidden" name="hdn" value="<?php echo $row['m_id']; ?>">
					<table width="100%">
						<tr>
							<td>Client Name: </td>
							<td><input type="text" name="c_name" value="<?php echo $row['c_name'];?>"/></td>
						</tr>
						<tr>
							<td>Shop Name: </td>
							<td><input type="text" name="shop_name" value="<?php echo $row['dokaner_name']; ?>"></td>
						</tr>
						<tr>
							<td>Shop ID: </td>
							<td><input type="text" name="shop_id" value="<?php echo $row['shop_id']; ?>"></td>
						</tr>
						<tr>
							<td>Address: </td>
							<td><input type="text" name="tikana" value="<?php echo $row['address']; ?>"></td>
						</tr>
						<tr>
							<td>Mobile: </td>
							<td><input type="text" name="mobile" value="<?php echo $row['mobile']; ?>"></td>
						</tr>
						<tr>
							<td>Email: </td>
							<td><input type="email" name="email" value="<?php echo $row['email']; ?>"></td>
						</tr>
						<tr>
							<td></td>
							<td><button class="btn btn-success" type="submit" name="form2">UPDATE</button></td>
						</tr>
					</table>
					</form>
				</p>
			</div>
			&nbsp;|&nbsp;
			<a onclick='return confirm_delete();' href="client_manage.php?id=<?php echo $row['m_id']; ?>">Delete</a></td>
			</tr>
			
			<?php
		}
	?>
  
	

</table>

</div><!---end print_area--->

</div>
<div class="container">

<div class="pagination">
<?php 
echo $pagination; 
?>
</div>
<h1 class="center"><a href="" class="btn btn-info"onclick="printcontent('print')" >Print</a></h1>
</div>
<?php include('footer.php');?>

