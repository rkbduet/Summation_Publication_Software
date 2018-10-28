<?php
ob_start();
session_start();
if($_SESSION['name']!='tread')
{
	header('location: login.php');
}
?>
<?php include('header.php'); 
include('../config.php');

?>

<?php 
if(isset($_REQUEST['bank_name']) && isset($_REQUEST['acc_no'])){
	$input_bank_name=$_REQUEST['bank_name'];
	$input_acc_no=$_REQUEST['acc_no'];
		
		$query=$db->prepare("select * from tdl_bank_data WHERE bank_name=? and bank_acc_no=?");
		$query->execute(array($input_bank_name,$input_acc_no));
		$result=$query->rowCount();
		if($result==0) {
			header("location:view_bank_data.php?error=1");
		}
		

	
		}



?>



<?php
		$query=$db->prepare("select * from tdl_bank_data  where bank_name='$input_bank_name' and bank_acc_no='$input_acc_no'");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		
		
	}
	
	?>
<div class="container">
<br />
<h2 class="title">ব্যাংকের  তথ্য </h2>
		
		<table width="" cellpadding="2px" id="">
			<tr>
				<td>ব্যাংকের নাম</td>
				<td><?php echo $row['bank_name'];?></td>
			</tr>
			<tr>
			<td>একাউন্ট নাম্বার</td>
				<td><?php echo $row['bank_acc_no'];?></td>
			</tr>
			
			<tr>
			<td></td>
			
			<td><a href="update_bank_data.php?id=<?php echo $row['bank_id']; ?>" class="btn btn-success">সংশোধন</a> </td>
			</tr>
				
			
		</table>
	
		</form>

		
		
</div><!---end container--->

