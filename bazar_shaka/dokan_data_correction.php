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

if(isset($_REQUEST['error'])) {
	$error_value=$_REQUEST['error'];
	
	try {
		if($error_value==1)
		
			throw new Exception( ' Enter Correct Inofrmation. ');
		}
		
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>	

<?php include("header.php")?>

<div class="container">
<br>
<h2 class="title">Edit Client Information.</h2>
<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
<br />
<form action="view_data.php" method="post" >
<table celspacing="1" cellpadding="5">
<tr>
		<td>Shop Name:</td>
		<td>
		<select name="dokan_name" id="">
		<option value="">Select Shop Name...</option>
	
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
	</tr>
	<tr>
		<td>Shop ID:</td>
		<td><input type="text" name="shop_id" id="" /></td>
	</tr>
<tr>
	<td></td>
	<td><button class="btn btn-success" type="submit" name="form1">View Details</button></td>
</tr>


</table>

</form>


</div><!---end container--->