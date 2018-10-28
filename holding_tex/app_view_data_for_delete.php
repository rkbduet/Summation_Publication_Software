<?php
ob_start();
session_start();
if($_SESSION['name']!='hold')
{
	header('location: login.php');
}
?>
<?php include('header.php'); ?>
<?php include('../config.php');?>
<?php 
if(isset($_REQUEST['holding_no']) && isset($_REQUEST['word_no'])  && isset($_REQUEST['k_id'])) {
	$input_word_no=$_REQUEST['word_no'];
	$input_holding_no=$_REQUEST['holding_no'];
	$input_k_id = $_REQUEST['k_id'];
	
	$password=$_REQUEST['password'];
		
		$query = $db->prepare("select * from homepage_admin where a_password=? and admin_id=5");
		$query->execute(array($password));
		$num = $query->rowCount();
		
		if($num==0) 
		{

			header("location:app_data_delete.php?error=1");
		}
	
	
$query=$db->prepare("select * from kordatha_info WHERE word_no=? and holding_no=? and kordatha_id=?");
		$query->execute(array($input_word_no,$input_holding_no,$input_k_id));
		$result=$query->rowCount();
		if($result==0) {
			header("location:app_data_delete.php?error=1");
		}
	
		}
	

?>

	<?php
		$query=$db->prepare("select * from kordatha_info WHERE word_no='$input_word_no' and  holding_no='$input_holding_no' and kordatha_id='$input_k_id'");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
			
			
		}
		
		
	?>
		
	
	
<script>
		function confirm_delete() {
			return confirm('আপনি কী নিশ্চিত তথ্য মুছে ফেলবেন?');
		}
	</script>

<div class="container" >
	<h2 class="title">করদাতার তথ্য মুছুন</h2>
	<table cellspacing="0" cellpadding="2">
		<tr>
			<td>করদাতার নাম:</td>
			<td><?php echo $row['name'];?></td>
		</tr>
		<tr>
				<td>ওয়ার্ড  নং</td>
				<td><?php echo $row['word_no'];?></td>
				</tr>
				<tr>
		<tr>
			<td>হোল্ডিং নং :</td>
			<td><?php echo $row['holding_no'];?></td>
		</tr>
		<tr>
			<td>করদাতার আই ডি</td>
			<td><?php echo $row['kordatha_id'];?></td>
		</tr>
		
		<tr>
			<td></td>
			<td><a class="btn btn-danger" onclick="return confirm_delete();" href="kordatha_delete.php?id=<?php echo $row['k_id']; ?>"> মুছে ফেলুন</a></td>
		</tr>
		
	</table>
		
	</div> <!---end of application_form--->

	
		
		
</div><!---end container--->

<?php include('footer.php'); ?>