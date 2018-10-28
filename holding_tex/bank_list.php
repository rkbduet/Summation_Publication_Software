<?php
ob_start();
session_start();
if($_SESSION['name']!='hold')
{
	header('location: login.php');
}
?>
<?php include("header.php");include('../config.php');?>
    

<script>
		function confirm_delete() {
			return confirm('আপনি কী নিশ্চিত তথ্য মুছে ফেলবেন?');
		}
</script>
<div class="container">
<h1 class="title">ব্যাংকের তথ্য তালিকা</h1>

<table border="1" cellspacing="0" cellpadding="5">
<thead>
<tr>
	<th>ক্রমিক নং</th>
	<th>ব্যাংকের নাম</th>
	<th>ব্যাংকের ঠিকানা</th>
	<th>হিসাব নং</th>
	<th>সংশোধন/পরিবর্তন</th>

</tr>

</thead>

<tbody>
<?
	$i=0;
		$query=$db->prepare("select * from holding_bank_data");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
			$i++;
			?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $row['bank_name'];?></td>
				<td><?php echo $row['bank_address'];?></td>
				<td><?php echo $row['bank_acc_no'];?></td>
				<td><a href="bank_data_edit.php?id=<?php echo $row['bank_id'];?>">সংশোধন</a> / <a onclick="return confirm_delete();" href="bank_delete.php?id=<?php echo $row['bank_id']; ?>"> মুছে ফেলুন</a></td>
			</tr>
<?php
		}
		
		
	
?>

		</tbody>		
		</table>
    </div>    
		
