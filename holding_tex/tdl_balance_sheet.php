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
			throw new Exception(' অনুগ্রহ বছর নির্বাচন  করুন ');
		}
		if(empty($_POST['month'])) {
			throw new Exception(' অনুগ্রহ মাস নির্বাচন  করুন ');
		}
		header("location:view_blancesheet.php");
	}
	
	
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>

<div class="container">
<h1 style="text-align:center;">ব্যাংকের তথ্য সংরক্ষন</h1>


    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
?>


<form action="view_blancesheet.php" method="post" id="" >
			<table celspacing="1" cellpadding="5">
<tr>
	<td>ব্যাংকের আইডি </td>
	<td><input type="text" name="" id="" /></td>
</tr>
<tr>
	<td>ব্যাংকের নাম</td>
	<td><input type="text" name="" id="" /></td>
</tr>
<tr>
	<td>ব্যাংকের ঠিকানা</td>
	<td><input type="text" name="" id="" /></td>
</tr>
<tr>
	<td>হিসাব নং</td>
	<td><input type="text" name="" id="" /></td>
</tr>

<tr>	
<td></td>	
<td><button class="btn btn-default" name="form1" >Add</button></td>
</tr>
				
		</table>
			</form>
    </div>    
		
