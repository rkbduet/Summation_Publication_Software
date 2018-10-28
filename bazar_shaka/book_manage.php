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
		if(empty($_POST['writter_name'])) {
			throw new Exception( 'Enter Writter Name.');
		}

		if(empty($_POST['pub_date'])) {
			throw new Exception( 'Enter Publish Date.');
		}
		
	$query=$db->prepare("select * from book where book_id=?");
	$query->execute(array($_POST['book_id']));
	$result=$query->rowCount();

	if($result>0){
		throw new Exception( 'This Book ID Already Exists.');
	}
		
	else{
		$query=$db->prepare("insert into  book(book_name,book_id,writer,publish_date) values(?,?,?,?)");
		$query->execute(array($_POST['book_name'],$_POST['book_id'],$_POST['writter_name'],$_POST['pub_date']));
	
		$success_message = 'Informaton Save Successfully.';
	}
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

if(isset($_POST['form2']))
{
	try {
		
		if(empty($_POST['book_name'])) {
			throw new Exception( 'Enter Book Name.');
		}
		
		if(empty($_POST['book_id'])) {
			throw new Exception( 'Enter Book ID.');
		}
		if(empty($_POST['writter_name'])) {
			throw new Exception( 'Enter Writter Name.');
		}

		if(empty($_POST['pub_date'])) {
			throw new Exception( 'Enter Publish Date.');
		}
		
		$statement = $db->prepare("UPDATE book SET book_name=?,book_id=?,writer=?,publish_date=? WHERE b_id=?");
		$statement->execute(array($_POST['book_name'],$_POST['book_id'],$_POST['writter_name'],$_POST['pub_date'],$_POST['hdn']));
		
		$success_message = "Book Data updated successfully.";
		
	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
		
}

if(isset($_REQUEST['id'])) 
{
	$id = $_REQUEST['id'];
	
	$statement = $db->prepare("DELETE FROM book WHERE b_id=?");
	$statement->execute(array($id));
	
	$success_message2 = "Book Data deleted successfully.";
	
}

?>
<?php include("header.php")?>

<div class="container">
<br />
<h2 class="title">Add New Book.</h2>
<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
<form action="" method="post" >
<table celspacing="1" cellpadding="5">
	
 <tr>
 	<td width="10%">Book Name:</td>
 	<td width="20%"><input type="text" name="book_name"/></td>
 
 	<td width="5%">Book ID:</td>
 	<td width="10%"><input type="text" name="book_id"/></td>
	<td width="5%"></td>
</tr>
<tr>
 	<td width="10%">Writter's Name:</td>
 	<td width="25%"><input type="text" name="writter_name"/></td>

	<td width="10%">Publish Date:</td>
	<td width="10%"><input type="date" name="pub_date" /></td>
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
	<span class="center"><u> All Book List</u></sapn>
</div>


<table class="book_tbl" cellspacing="0" cellpadding="1">
	<tr>
		<th width="5%">SL.No.</th>
		<th width="30%">Book Name:</th>
		<th width="30%">Writter Name</th>
		<th width="10%">Book ID</th>
		<th width="15%">Publish Date</th>
		<th width="10%">Action</th>
 </tr>
 	<?php
	
	
			/* ===================== Pagination Code Starts ================== */
			$adjacents = 7;
										
					
			
			
			$statement = $db->prepare("SELECT * FROM book ORDER BY b_id DESC");
			$statement->execute();
			$total_pages = $statement->rowCount();
							
			
			$targetpage = $_SERVER['PHP_SELF'];   //your file name  (the name of this file)
			$limit =25;                                 //how many items to show per page
			$page = @$_GET['page'];
			if($page) 
				$start = ($page - 1) * $limit;          //first item to display on this page
			else
				$start = 0;
			
						
			$statement = $db->prepare("SELECT * FROM book ORDER BY b_id DESC LIMIT $start, $limit");
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
			<td><?php echo $row['writer'];?></td>
			<td><?php echo $row['book_id'];?></td>
			<td><?php echo $row['publish_date'];?></td>
			<td>
			<a class="fancybox" href="#inline<?php echo $i; ?>">Edit</a>
			<div id="inline<?php echo $i; ?>" style="width:400px;display: none;">
				<h3 class="title"> Edit Book Data</h3>
				<p>
					<form action="" method="post">
					<input type="hidden" name="hdn" value="<?php echo $row['b_id']; ?>">
					<table>
						<tr>
							<td>Book Name: </td>
							<td><input type="text" name="book_name" value="<?php echo $row['book_name'];?>"/></td>
						</tr>
						<tr>
							<td>Writter Name: </td>
							<td><input type="text" name="writter_name" value="<?php echo $row['writer']; ?>"></td>
						</tr>
						<tr>
							<td>Book ID: </td>
							<td><input type="text" name="book_id" value="<?php echo $row['book_id']; ?>"></td>
						</tr>
						<tr>
							<td>Publish Date: </td>
							<td><input type="date" name="pub_date" value="<?php echo $row['publish_date']; ?>"></td>
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
			<a onclick='return confirm_delete();' href="book_manage.php?id=<?php echo $row['b_id']; ?>">Delete</a></td>
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

