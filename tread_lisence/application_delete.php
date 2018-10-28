<?php
ob_start();
session_start();
if($_SESSION['name']!='tread')
{
	header('location: login.php');
}
?>
<?php include('header.php'); ?>
<?php include('../config.php');?>
<?php 
if(isset($_REQUEST['app_no'])){
	$input_app_no=$_REQUEST['app_no'];
		
		$query=$db->prepare("select * from tred_lisence_application WHERE app_serial=?");
		$query->execute(array($input_app_no));
		$result=$query->rowCount();
		if($result==0) {
			header("location:app_correction.php?error=1");
		}
		

	
		}


?>

	<?php
		$query=$db->prepare("select * from tred_lisence_application where app_serial='$input_app_no'");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){
			
			
		}
		
		
	?>
		
	
	
<script>
		function confirm_delete() {
			return confirm('আপনি কী নিশ্চিত আবেদন ফরম মুছে ফেলবেন?');
		}
	</script>

<div class="container" >
<div id="main_form">
		
	<div id="application_form">
	<div class="row">
		<div class="col-lg-4">
		<label for="">ক্রমিক নং:-</label><strong><?php echo $row['app_serial'];?></strong></div>
		<div class="col-lg-4" style=" text-align:center;font-size:25px;">
		<img class="logo" src="../Pourosova.jpg" alt="logo" /><br/>
		<strong>টাংগাইল পৌরসভা </br>
		ট্রেড লাইসেস্ন শাখার </strong><br/>
		<span >আবেদন ফরম</span>
		
		
		</div>
		<div class="col-lg-4 col-md-4"><img src="img/applicate_image/<?php echo $row['app_photo']; ?>" alt="" id="appcation_image"/></div>
	</div>
	
	<table cellspacing="0" cellpadding="2">
		<tr>
			<td width="25%"><label for="">আবেদনকারীর নামঃ</label></td>
			<td width="20%"><?php  echo $row['app_name'];?></td>
			<td width="15%"></td>
			<td width="10%"></td>
			<td width="14%"></td>
			<td width="9%"></td>
			<td width="10%"></td>
			
		</tr>
		<tr>
			<td><label for="">পিতার/স্বামীর নামঃ</label></td>
			<td><?php  echo $row['app_f_name'];?></td>
			
		</tr>
		<tr>
			<td><label for="">মাতার নামঃ</label></td>
			<td><?php  echo $row['app_m_name'];?></td>
			
		</tr>
		<tr>
			<td><label for="">ব্যবস্যা / প্রতিষ্ঠানের নামঃ</label></td>
			<td><?php  echo $row['b_name'];?></td>
			
		</tr>
		<tr>
			<td ><label for="">ব্যবস্যা প্রতিষ্ঠানের ঠিকানাঃ</label></td>
			<td style="text-align:center;"><label >গ্রাম/মহল্লাঃ-</label></td>
			<td><?php  echo $row['b_address_vill'];?></td>
			<td><label>পোস্টঃ-</label></td>
			<td><?php  echo $row['b_address_holding_no'];?></td>
			<td><label>উপজেলাঃ-</label></td>
			<td><?php  echo $row['b_address_word_no'];?></td>
		</tr>
			<td></td>
			<td style="text-align:center;"><label>জেলাঃ-</label></td>
			<td><?php  echo $row['b_address_post'];?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			
		</tr>
			
		
		<tr>
			<td><label for="">ব্যবস্যার ধরনঃ</label></td>
			<td><?php  echo $row['b_doron'];?></td>
			
		</tr>
		<tr>
			<td><label for="">আবেদনকারীর বর্তমান ঠিকানাঃ</label></td>
			<td style="text-align:center;"><label >গ্রাম/মহল্লাঃ-</label></td>
			<td><?php  echo $row['app_p_vill'];?></td>
			<td><label>হোল্ডিং নংঃ-</label></td>
			<td><?php  echo $row['app_p_holding_no'];?></td>
			<td><label>ওয়ার্ড নংঃ-</label></td>
			<td><?php  echo $row['app_p_word_no'];?></td>
			
			</tr>
			<tr>
				<td></td>
				<td style="text-align:center;"><label>পোস্ট অফিসঃ-</label></td>
			<td><?php  echo $row['app_p_post'];?></td>
			<td><label>উপজেলাঃ-</label></td>
			<td><?php  echo $row['app_p_upzila'];?></td>
			<td><label>জেলাঃ-</label></td>
			<td><?php  echo $row['app_p_zila'];?></td>
			
			
			
		</tr>
				<tr>
					<td><label for="">আবেদনকারীর স্থায়ী ঠিকানাঃ</label></td>
					<td style="text-align:center;"><label>গ্রাম/মহল্লাঃ-</label></td>
					<td><?php  echo $row['app_s_vill'];?></td>
					<td><label>হোল্ডিং নংঃ-</label></td>
					<td><?php  echo $row['app_s_holding_no'];?></td>
					<td><label>ওয়ার্ড নংঃ-</label></td>
					<td><?php  echo $row['app_s_word_no'];?></td>
					
				</tr>
					
				<tr>
					<td></td>
					<td style="text-align:center;"><label>পোস্ট অফিসঃ-</label></td>
					<td><?php  echo $row['app_s_post'];?></td>
					<td><label>উপজেলাঃ-</label></td>
					<td><?php  echo $row['app_s_upzila'];?></td>
					<td><label>জেলাঃ-</label></td>
					<td><?php  echo $row['app_s_zila'];?></td>
					<td></td>
					<td></td>
					
				</tr>
		<tr>
			<td><label for="">টি আই এন নাম্বার ঃ</label></td>
			<td><?php echo $row['app_tin_num'];?></td>
			
		</tr>
		<tr>
			<td><label for="">মোবাইল/টেলিফোনঃ</label></td>
			<td><?php echo $row['app_mobile'];?></td>
			
		</tr>
		<tr>
			<td><label for="">ই-মেইল(যদি থাকে)ঃ</label></td>
			<td><?php echo $row['app_email'];?></td>
		</tr>
		<tr>
			<td><label for="">ট্রেড লাইসেস্ন নাম্বারঃ</label></td>
			<td><?php echo $row['app_treadlisence_no'];?></td>
		</tr>
		<tr>
			
			<td><label for="">কতসালে ট্রেড লাইসেস্ন হয়েছিলঃ</label></td>
			<td><?php echo $row['treadlisence_year'];?></td>
		</tr>
		<tr>
			
			<td><label for="">ডাটা এন্ট্রিকারীর নামঃ</label></td>
			<td><?php echo $row['data_entry_name'];?></td>
		
		</tr>
		<tr>
			
			<td><label for="">ডাটা এন্ট্রিকারীর পদবীঃ</label></td>
			<td><?php echo $row['entry_post'];?></td>
		
		</tr>
	</table>
		
	</div> <!---end of application_form--->
	
	</div><!---main_from--->
	
		
		<a class="btn btn-danger" onclick="return confirm_delete();" href="delete_by_app_no.php?id=<?php echo $row['app_id']; ?>"> মুছে ফেলুন</a>
		</h1>
		
		
		
		
</div><!---end container--->

<?php include('footer.php'); ?>