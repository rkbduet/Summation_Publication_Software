
<?php
ob_start();
session_start();
if($_SESSION['name']!='tangail')
{
	header('location: login.php');
}
?>
<?php
include('../config.php');
if(isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
}
else {
	header('location: view_last_stock.php');
}

if(isset($_POST['form1'])) {

	try {
	
		
		if(empty($_POST['book_name'])) {
			throw new Exception( 'Enter Book Name.');
		}
		
		if(empty($_POST['book_id'])) {
			throw new Exception( 'Enter Book ID.');
		}
		if(empty($_POST['forma_size'])) {
			throw new Exception( ' Enter Forma Size');
		}
		if(empty($_POST['press_name'])) {
			throw new Exception( 'Enter Press Name.');
		}
		
		if(empty($_POST['num_book'])) {
			throw new Exception( 'Enter Number of book Book.');
		}
		
		$query=$db->prepare("update  import set book_name=?,book_id=?,forma_size=?,press_name=?,num_book=?,date=? where import_id='$id'");
		$query->execute(array($_POST['book_name'],$_POST['book_id'],$_POST['forma_size'],$_POST['press_name'],$_POST['num_book'],$_POST['date']));
	
		
		$query_import_tbl=$db->prepare("select * from import  where import_id='$id'");
		$query_import_tbl->execute();
		$result_import_tbl=$query_import_tbl->fetchAll(PDO::FETCH_ASSOC);
		foreach($result_import_tbl as $row_import_tbl) 
		{
		$old_num_book=$row_import_tbl['num_book'];
		$book_id=$row_import_tbl['book_id'];
		
		}
	
		$query_select=$db->query("select * from stock_info where book_id='$book_id'");
		$query_select->execute();
		$result_select=$query_select->fetchAll(PDO::FETCH_ASSOC);
		foreach($result_select as $row_select) 
		{
		$old_stock=$row_select['count_stock'];
		
		}
		
		
		
		$input_num_book=$_POST['num_book'];
			
		$input_new_stock = $input_num_book - $old_num_book ;
	
		$new_stock = $old_stock + $input_new_stock;
		
		$query_stock=$db->prepare("update stock_info set count_stock=? where book_id=?");
		$query_stock->execute(array($new_stock,$_POST['book_id']));
		
		
		$success_message = 'Informaton update Successfully.';
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>
<?php include"header.php"?>

<div class="container">
<h2 class="title">Edit Last Import Book Informaton:</h2>
<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>

<br>
<?php
	$query=$db->prepare("select * from import  where import_id='$id'");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) 
	{
		
		$book_name= $row['book_name']; 	 	 	 	 	 	 	 	
		 $book_id=$row['book_id'];
		
		$form_size=$row['forma_size'];
		$press_name=$row['press_name'];
		$num_num_book=$row['num_book'];
		$date=$row['date'];
		
	}
	
	?>
	
<form action="" method="post" >
<table celspacing="1" cellpadding="5">
	<tr>
 	<td>Book Name:</td>
 	<td><input type="text" name="book_name" value="<?php echo $book_name;?>"/></td>
 </tr>
 <tr>
 	<td>Book ID:</td>
 	<td><input type="text" name="book_id" value="<?php echo $book_id;?>"/></td>
 </tr>
<tr>
	<td>Forma Size:</td>
	<td><input type="text" name="forma_size" value="<?php echo $form_size;?>"/></td>
</tr>
<tr>
	<td>Press Name:</td>
	<td><input type="text" name="press_name" value="<?php echo $press_name;?>"/></td>
</tr>
<tr>
	<td>Number of book:</td>
	<td><input type="text" name="num_book"value="<?php echo $num_num_book;?>" /></td>
</tr>

	<td>Import Date</td>
	<td><input type="text" name="date" value="<?php echo $date;?>"/></td>
</tr>
<tr>
	<td></td>
	<td><button class="btn btn-success" type="submit" name="form1">Update</button></td>
</tr>
</table>

</form>

</div> 
</div><!---end container--->