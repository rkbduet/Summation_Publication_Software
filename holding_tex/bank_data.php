<?php
ob_start();
session_start();
if($_SESSION['name']!='hold')
{
	header('location: login.php');
}
?>
<?php include("header.php");include('../config.php');?>
    

<?php 
if(isset($_POST['form1'])) {
	


	try {
	
		if(empty($_POST['bank_name'])) {
			throw new Exception('ব্যাংকের নাম দিন ');
		}
		if(empty($_POST['bank_address'])) {
			throw new Exception('ব্যাংকের ঠিকানা  দিন ');
		}
		
		if(empty($_POST['bank_acc_no'])) {
			throw new Exception(' ব্যাংকের একাউন্ট নাম্বার দিন ');
		}
		
		$query=$db->prepare("insert into  holding_bank_data(bank_name,bank_address,bank_acc_no) values(?,?,?)");
		$query->execute(array($_POST['bank_name'],$_POST['bank_address'],$_POST['bank_acc_no']));
		
		$success_message = 'আপনার তথ্য সংরক্ষন হয়েছে ।.';
	}
	
	
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>

<div class="container">
<h1 class="title">ব্যাংকের তথ্য সংরক্ষন</h1>


    <?php  
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}

?>


<form action="" method="post" id="" >
			<table celspacing="1" cellpadding="5">

<tr>
	<td>ব্যাংকের নাম</td>
	<td><input type="text" name="bank_name" id="" /></td>
</tr>
<tr>
	<td>ব্যাংকের ঠিকানা</td>
	<td><input type="text" name="bank_address" id="" /></td>
</tr>
<tr>
	<td>হিসাব নং</td>
	<td><input type="text" name="bank_acc_no" id="" /></td>
</tr>

<tr>	
<td></td>	
<td><button class="btn btn-success" name="form1" >Add</button></td>
</tr>
				
		</table>
			</form>
    </div>    
		
