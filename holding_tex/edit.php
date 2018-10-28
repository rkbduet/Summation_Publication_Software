<?php
ob_start();
session_start();
if($_SESSION['name']!='hold')
{
	header('location: login.php');
}
?>


<?php include('header.php'); ?>
<?php
include('../config.php');

if(isset($_REQUEST['holding_no']) && isset($_REQUEST['word_no']) && isset($_REQUEST['k_id']) ) {
	$input_word_no=$_REQUEST['word_no'];
	$input_holding_no=$_REQUEST['holding_no'];
	$input_k_id = $_REQUEST['k_id'];
	
	$password=$_REQUEST['password'];
		
		$query = $db->prepare("select * from homepage_admin where a_password=? and admin_id=5");
		$query->execute(array($password));
		$num = $query->rowCount();
		
		if($num==0) 
		{

			header("location:app_data_edit.php?error=1");
		}
	
	
$query=$db->prepare("select * from kordatha_info WHERE word_no=? and  holding_no=? and kordatha_id=?");
		$query->execute(array($input_word_no,$input_holding_no,$input_k_id));
		$result=$query->rowCount();
		if($result==0) {
			header("location:app_data_edit.php?error=1");
		}
	
		}
	


?>

<?php
		$query=$db->prepare("select * from kordatha_info where word_no='$input_word_no'and  holding_no='$input_holding_no' and kordatha_id='$input_k_id'");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		
		
	}
	
	?>
<div class="container">
				
		<h2 class="title"> করদাতার তথ্য </h2>
		<table cellspacing="2" cellpadding="3">
		<tr>
			<td> ওয়ার্ড নং</td>
			<td><?php echo  $row['word_no'];?></td>
		</tr>
			<tr>
			<td>হোল্ডিং নং</td>
			<td><?php echo  $row['holding_no'];?></td>
			</tr>
			
		<tr>
			<td>করদাতার আই.ডি</td>
			<td><?php echo  $row['kordatha_id'];?></td>
			
		</tr>
		<tr>
			<td>করদাতার নাম</td>
			<td><?php echo  $row['name'];?></td>
			
		</tr>
		<tr>
			<td>পিতা/স্বামীর নাম</td>
			<td><?php echo $row['f_name'];?></td>
			
		</tr>
		<tr>
			<td>এলাকা/রাস্তার নাম</td>
			<td><?php echo $row['vill_name'];?></td>
		
		</tr>
		
		<tr>
			<td>হোল্ডিং এর ঠিকানা</td>
			<td><?php echo $row['holding_address'];?></td>
			
		</tr>
		<tr>
			<td>হোল্ডিং ব্যবহার</td>
			<td>
				
				<?php echo $row['holding_use'];?>
			</td>
			
		</tr>
		
		<tr>
			<td>করদাতার এর ধরন</td>
			<td>

				<?php echo $row['kordathar_doron'];?>
			
			</td>
			
		</tr>
		
		<tr>
			<td>হোল্ডিং এর ধরন</td>
			<td><?php echo $row['holding_doron'];?></td>
				</tr>
		
		<tr>
			<td>ব্যংকের নাম</td>
			<td>
				<?php echo $row['bank_name'];?>
			</td>
			
			
		</tr>
		
		<tr>
		
			<td>বৎসরিক মূল্যায়ন</td>
			<td><?php echo $row['yearly_tax'];?></td>
		</tr>
		<tr>
		
			<td>পূর্বের বকেয়া টাকা</td>
			<td><?php echo $row['bokia_taka'];?></td>
		</tr>
		<tr>
		
			<td>বকেয়া শুরুর বছর</td>
			<td><?php echo $row['bokia_year'];?></td>
		</tr>
		<tr>
		
			<td>বকেয়া শুরুর কিস্তি</td>
			<td><?php echo $row['bokia_kisti'];?></td>
		</tr>
	<tr>
		<td></td>
		<td><a href="kordatha_data_update.php?id=<?php echo $row['k_id']; ?>"class="btn btn-success">পরিবর্তন করুন</a></td>
	</tr>
	</table>
		
	

		
		
</div><!---end container--->

<?php include('footer.php'); ?>