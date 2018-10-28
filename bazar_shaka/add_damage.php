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
			throw new Exception( 'Enter Book ID.');
		}
		
		if(empty($_POST['damage'])) {
			throw new Exception( ' Enter Number of Damage Book.');
		
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
		$input_book_id=$_POST['book_id'];
		
	
		$query=$db->query("select * from stock_info where book_id='$input_book_id'");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
		{
		$old_stock=$row['count_stock'];
		$old_damage=$row['count_damage'];
		}
	
		
		$new_stock=$old_stock - $_POST['damage'];
		$new_damage=$old_damage + $_POST['damage'];
		
		
		$query=$db->prepare("update stock_info set count_damage=?, count_stock=? where book_id=?");
		$query->execute(array($new_damage,$new_stock,$_POST['book_id']));
		
		$success_message = 'Informaton Update Successfully.';
		
		
		
		
	
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>
<?php include("header.php")?>

<div class="container">
<br />
<h2 class="title">Add Damage Book.</h2>
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

<tr>
	<td>Number of Damage:</td>
	<td><input type="text" name="damage" /></td>
</tr>
<tr>
	<td></td>
	<td><button class="btn btn-success" type="submit" name="form1">Add</button></td>
</tr>
</table>

</form>

</div> 
</div><!---end container--->