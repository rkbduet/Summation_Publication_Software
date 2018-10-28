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
	if(isset($_REQUEST['id'])){
		
		$id=$_REQUEST['id'];
		
	}
	else{
		header("location:bank_list.php");
		
	}
	
	
	?>

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
		
		$query=$db->prepare("update  holding_bank_data set bank_name=?,bank_address=?,bank_acc_no=?");
		$query->execute(array($_POST['bank_name'],$_POST['bank_address'],$_POST['bank_acc_no']));
		
		$success_message = 'আপনার তথ্য পরিবর্তন হয়েছে ।.';
		header('location:bank_list.php');
	}
	
	
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>
<?php 


$query=$db->prepare("select * from holding_bank_data where bank_id='$id'");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
			
			
			
		}

?>
<div class="container">
<h1 class="title">ব্যাংকের তথ্য সংশোধন করুন</h1>


    <?php  
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}

?>

<form action="" method="post" id="" >
			<table cellspacing="1" cellpadding="5">

<tr>
	<td>ব্যাংকের নাম</td>
	<td><input type="text" name="bank_name" id="" value="<?php echo $row['bank_name'];?>"/></td>
</tr>
<tr>
	<td>ব্যাংকের ঠিকানা</td>
	<td><input type="text" name="bank_address" id="" value="<?php echo $row['bank_address'];?>"/></td>
</tr>
<tr>
	<td>হিসাব নং</td>
	<td><input type="text" name="bank_acc_no" id="" value="<?php echo $row['bank_acc_no'];?>"/></td>
</tr>

<tr>	
<td></td>	
<td><button class="btn btn-success" name="form1" >পরিবর্তন করুন</button></td>
</tr>
				
		</table>
			</form>
    </div>    
		
