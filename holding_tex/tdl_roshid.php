<?php
ob_start();
session_start();
if($_SESSION['name']!='hold')
{
	header('location: login.php');
}
?>
<?php include"header.php"?>
<?php include('../config.php');?>

<?php 
if(isset($_REQUEST['error'])) {
	 $error_value=$_REQUEST['error'];
	try {
		if($error_value==1){
			
			throw new Exception("সঠিক তথ্য দিন");
		}

	
		}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>	
	

<div class="container">
<h2 style="text-align:center;">  করদাতার ট্যাক্স  রশীদ</h2>
    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
	
	<form action="roshid.php" method="post" id="" >
			<table celspacing="1" cellpadding="5">
				<tr>
				<td>হোল্ডি  নং</td>
				<td><input type="text" name="d_no" id="" /></td>
					
<td></td>
	
					<td><button class="btn btn-default" name="form1" >প্রিন্ট</button></td>
				</tr>
				
		</table>
			</form>
    </div>    
		