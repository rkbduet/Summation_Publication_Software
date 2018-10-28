<?php
ob_start();
session_start();
if($_SESSION['name']!='tangail')
{
	header('location: login.php');
}
?>


<?php include("header.php")?>
<?php 
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

<div class="container">
<br>
<h2 class="title">Print Sells Memo.</h2>
<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
<br />
<form action="memo.php" method="post" >
<table celspacing="1" cellpadding="5">
<tr>
		<td>Memo No:</td>
		<td><input type="number" name="memo_no" id="" /></td>
	</tr>
<tr>
	<td></td>
	<td><button class="btn btn-success" type="submit" name="form1">Veiw Sells Memo</button></td>
</tr>


</table>

</form>


</div><!---end container--->