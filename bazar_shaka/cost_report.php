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
		
			throw new Exception( ' Enter Correct Data.');
		}
		
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>	

<?php include("header.php")?>

<div class="container">
<br>
<h2 class="title">View Press All Information </h2>
<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
<br />
<form action="view_cost_report.php" method="post" >
<table celspacing="1" cellpadding="5">
<tr>
		<td width="12%" >Select Date: </td>		
		<td width="15%"><input type="date" name="start_date" placeholder="d-m-Y " id="" /></td>
		<td width="3%" class="red">to</td>	
		<td width="15%"><input type="date" name="end_date" placeholder="d-m-Y " id="" /></td>
	
				<td width="10%" class="label">Cost Type:</td>
				<td width="12%">
				<select name="cost_type" id="">
					<option value="">Select Type</option>
					<option value="1">Current Bill</option>
					<option value="2">Accessories</option>
					<option value="3">Salary</option>
					<option value="4">others</option>
					
				</select>
				</td>
 
	<td width="33%"><button class="btn btn-success" type="submit" name="form1">VIEW REPORT</button></td>
</tr>


</table>

</form>


</div><!---end container--->