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
include("header.php")?>
 
<?php
if(isset($_REQUEST['error'])) {
	$error_value=$_REQUEST['error'];


	try {
	
		if($error_value==1)
		
			throw new Exception( 'Enter Correct Information.');
		}
	
	
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>	


<div class="container">
<br />
<h2 class="title">Update Last Import Book Information.</h2>
<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
<form action="view_last_stock.php" method="post" >
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
	<td><input type="date" name="date" /></td>
</tr>

<tr>
	<td></td>
	<td width=""><button type="submit" class="btn btn-success" name="form1">VIEW LAST IMPORT BOOK</button></td>
</tr>
</table>

</form>

 
</div><!---end container--->