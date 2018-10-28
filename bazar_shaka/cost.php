<?php
ob_start();
session_start();
if($_SESSION['name']!='tangail')
{
	header('location: login.php');
}
?>

<?php include('../config.php');?>
<?php include"header.php"?>
    
			

<?php 
if(isset($_POST['form1'])) {
	

	try {
		if(empty($_POST['cost_type'])) {
			throw new Exception('Select Cost Type ');
		}
		if(empty($_POST['c_biboron'])) {
			throw new Exception('Enter Cost Discription ');
		}
		if(empty($_POST['c_taka'])) {
			throw new Exception('  Enter Ammount. ');
		}
		if(empty($_POST['date'])) {
			throw new Exception(' Select a Date ');
		}
		
		/**
		$date=date('d-m-Y');
		$day=substr($date,0,2);
		$month=substr($date,3,2);
		$year=substr($date,6,4);
		**/
		
		$query=$db->prepare("insert into cost(cost_type,cost_biboron,cost_taka,cost_date) values(?,?,?,?)");
		$query->execute(array($_POST['cost_type'],$_POST['c_biboron'],$_POST['c_taka'],$_POST['date']));
	
		
		$success_message = 'Your cost Successfully Added.';
		


		}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>	
	

<div class="container">
<br>
<h2 class="title">Add Your Cost</h2>
    <?php  
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
?>
			<form action="" method="post" id="" >
			<table celspacing="1" cellpadding="5">
			<tr>
				<td>Cost Type:</td>
				<td>
				<select name="cost_type" id="">
					<option value="">Select Type</option>
					<option value="1">Current Bill</option>
					<option value="2">Accessories</option>
					<option value="3">Salary</option>
					<option value="4">others</option>
					
				</select>
				</td>
				</tr>
				<tr>
				<td>Discription:</td>
				<td><input type="text" name="c_biboron" id="" /></td>
				</tr>
				<tr>
				<td>Date: </td>		
				<td><input type="date" name="date" id="" /></td>
				</tr>
				<tr>
					<td>Amount:</td>
					<td><input type="text" name="c_taka"/></td>
				</tr>
				<tr>
				<td></td>
					<td><button class="btn btn-success" name="form1" >Add</button></td>
				</tr>
				
		</table>
			</form>
    </div>    
		
