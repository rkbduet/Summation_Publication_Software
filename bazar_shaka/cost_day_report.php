<?php
ob_start();
session_start();
if($_SESSION['name']!='tangail')
{
	header('location: login.php');
}
?>
<?php include"header.php"?>
    

<?php
if(isset($_REQUEST['error'])) {
	$error_value=$_REQUEST['error'];


	try {
	
		if($error_value==1)
		
			throw new Exception( '  Enter correct Date ');
		}
	
	
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>	

	

<div class="container">
<br>
<h2 class="title">Daily Cost Report</h2>
    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
?>
		

<form action="cost_daily_report.php" method="post" id="" >
			<table celspacing="1" cellpadding="5">
	<tr>
			<td>Date: </td>		
 	<td><input type="date" name="date" placeholder="d-m-Y " id="" />
</td>
</tr>
				<tr>
				<td></td>
					<td><button type="submit" class="btn btn-success" name="form1">View Report</button></td>
				</tr>
				
		</table>
			</form>
    </div>    
		
