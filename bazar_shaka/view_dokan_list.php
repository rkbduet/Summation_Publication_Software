<?php
ob_start();
session_start();
if($_SESSION['name']!='tangail')
{
	header('location: login.php');
}
?>
<?php
include('../config.php');

if(isset($_REQUEST['error'])) {
	$error_value=$_REQUEST['error'];
	
	try {
		if($error_value==1)
		
			throw new Exception( ' সঠিক তথ্য দিন ');
		}
		
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>	

<?php include("header.php")?>

<div class="container">
<br>
<h2 class="title">মার্কেটে অনুযায়ী দোকানের তালিকা  দেখুন</h2>
<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
<br />
<form action="dokan_list_by_market.php" method="post" >
<table celspacing="1" cellpadding="5">
<tr>
		<td>মার্কেটের  নাম:</td>
		<td>
		<select name="market_name" id="">
		<option value="">মার্কেটের নাম নির্বাচন  করুন</option>
	
			<?php 
		$query=$db->prepare("select * from market_data");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
		?>
			<option value="<?php echo $row['marketer_name'];?>"><?php echo $row['marketer_name'];?></option>
			<?php
		}
			
			
			?>
			
		</select>
		</td>
	</tr>
<tr>
	<td></td>
	<td><button class="btn btn-success" type="submit" name="form1">তালিকা দেখুন</button></td>
</tr>


</table>

</form>


</div><!---end container--->