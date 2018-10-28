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
if(isset($_POST['form1'])) {

	try {
	
		
		if(empty($_POST['book_name'])) {
			throw new Exception( 'Enter Book Name.');
		}
		if(empty($_POST['book_id'])) {
			throw new Exception( 'Enter ID Name.');
		}
		if(empty($_POST['forma_size'])) {
			throw new Exception( ' Enter Forma Size');
		}
		if(empty($_POST['press_name'])) {
			throw new Exception( 'Enter Press Name.');
		}
		
		
		if(empty($_POST['num_book'])) {
			throw new Exception( 'Enter Number of num_book Book.');
		}
	
		$query=$db->prepare("select * from book where book_id=?");
		$query->execute(array($_POST['book_id']));
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
		$book_name=$row['book_name'];
		}
			
		if($book_name!=$_POST['book_name']){
			
			throw new Exception( ' Book Name and Book ID does not match.');
			
		}
			
		
		$date=date('Y-m-d'); 
		$query=$db->prepare("insert into  import(book_name,book_id,forma_size,press_name,num_book,date) values(?,?,?,?,?,?)");
		$query->execute(array($_POST['book_name'],$_POST['book_id'],$_POST['forma_size'],$_POST['press_name'],$_POST['num_book'],$date));
		
		$input_book_id=$_POST['book_id'];
		
		$query=$db->prepare("select * from stock_info WHERE book_id=?");
		$query->execute(array($input_book_id));
		$result=$query->rowCount();
		if($result>0) {
			
		
		$query=$db->query("select * from stock_info where book_id='$input_book_id'");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
		{
		$old_stock=$row['count_stock'];
		}
		$new_stock=$old_stock+$_POST['num_book'];
		
		$query=$db->prepare("update stock_info set count_stock=? where book_id=?");
		$query->execute(array($new_stock,$_POST['book_id']));
		}
		else{
		$query=$db->prepare("insert into  stock_info(book_name,book_id,count_stock) values(?,?,?)");
		$query->execute(array($_POST['book_name'],$_POST['book_id'],$_POST['num_book']));
		}
		
		$success_message = 'Informaton Save Successfully.';
	
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>
<?php include("header.php")?>

<div class="container">
<br />
<h2 class="title">Details Informaton of Import Book.</h2>
<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
<form action="" method="post" >
<table celspacing="1" cellpadding="5">
	
 <tr>
 	<td>Book Name:</td>
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
 </tr>
<tr>
<tr>
 	<td>Book ID:</td>
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
 </tr>
	<td>Forma Size:</td>
	<td><input type="text" name="forma_size" /></td>
</tr>
<tr>
	<td>Press Name:</td>
	<td>
		<select name="press_name" id="">
		<option value="">Select Shop Name...</option>
	
			<?php 
		$query=$db->prepare("select * from press_info");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
		?>
			<option value="<?php echo $row['press_name'];?>"><?php echo $row['press_name'];?></option>
			<?php
		}
			
			
			?>
			
		</select>
		</td>
</tr>
<tr>
	<td>Number of Book:</td>
	<td><input type="text" name="num_book" /></td>
</tr>

<tr>
	<td></td>
	<td><button class="btn btn-success" type="submit" name="form1">ADD STOCK</button></td>
</tr>
</table>

</form>

 
</div><!---end container--->