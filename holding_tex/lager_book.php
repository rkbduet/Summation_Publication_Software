<?php
ob_start();
session_start();
if($_SESSION['name']!='hold')
{
	header('location: login.php');
}
?>
<?php include"header.php"?>
    

<?php
if(isset($_POST['form1'])) {
	

	try {
	
		if(empty($_POST['year'])) {
			throw new Exception(' অর্থবছর নির্বাচন করুন ');
		}
		
		
		header("location:view_tdl_bokeia.php");

		}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>	

	<?php
	
	
	?>
	

<div class="container">
<h1 class="center">করদাতার লেজার বই</h1>
    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
?>
		

<form action="view_tdl_bokeia.php" method="post" id="tdl_table" >
			<table celspacing="1" cellpadding="5" id="">
	<tr>
			<td>হোল্ডিং নং</td>
			<td><input type="text" name="" id="" /></td>
	<tr/>
	<tr>
		<td>করদাতার আইডি</td>
		<td><input type="text" name="" id="" /></td>
	</tr>
	<tr>
		<td></td>
		<td><button type="submit" class="btn btn-default" name="" >তালিকা দেখুন</button></td>
	</tr>
				
		</table>
			</form>
    </div>    
		
