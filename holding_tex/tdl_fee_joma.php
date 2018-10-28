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
if(isset($_REQUEST['error'])) {
	$error_value=$_REQUEST['error'];


	try {
	
		if($error_value==1)
		
			throw new Exception( '  সঠিক তথ্য দিন ');
		}
	
	
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>

<div class="container">
<h1 style="text-align:center;">করদাতার তথ্য অনুসন্ধান নাম অনুসারে</h1>


    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
?>


<form action="view_tdl_fee_joma.php" method="post" id="" >
			<table celspacing="1" cellpadding="5">
<tr>
<td>করদাতার নাম</td>
<td><input type="text" name="" id="" /></td>
</tr>

<tr>
<td></td>
<td><button class="btn btn-default" name="form1" >অনুসন্ধান করুন</button></td>
</tr>
				
		</table>
			</form>
    </div>    
		
