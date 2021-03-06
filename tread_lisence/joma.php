<?php
ob_start();
session_start();
if($_SESSION['name']!='tread')
{
	header('location: login.php');
}
?>
<?php include('header.php'); ?>
<?php
include('../config.php');
if(isset($_POST['form1'])) {

	try {
	
		
		if(empty($_POST['treadlisence_number'])) {
			throw new Exception( 'আবেদনকারীর ট্রেড লাইসেস্ন নাম্বার দিন');
		
		}
		if(empty($_POST['budget_year'])) {
			throw new Exception( 'অর্থবছর নির্বাচন করুন');
		}
		if(empty($_POST['tread_fee'])) {
			throw new Exception( 'ট্রেড লাইসেস্ন ফি দিন');
		}
		if(empty($_POST['vat'])) {
			throw new Exception( 'ভ্যাট এর  পরিমান দিন');
		}
		if(empty($_POST['income_tex'])) {
			throw new Exception( 'ইনকাম টেক্স এর  পরিমান দিন');
		}
		if(empty($_POST['bank_name'])) {
			throw new Exception( 'ব্যাংকের নাম নির্বাচন করুন');
		}
		if(empty($_POST['bank_ac_no'])) {
			throw new Exception( 'ব্যাংকের একাউন্ট নাম্বার দিন');
		}
		if(empty($_POST['total'])) {
			throw new Exception( 'মোট টাকার পরিমান দিন');
		}
		if(empty($_POST['taka_kothai'])) {
			throw new Exception( 'মোট টাকা কথায় লিখুন');
		}
		$query=$db->prepare("select * from tred_lisence_application WHERE app_treadlisence_no=?");
		$query->execute(array($_POST['treadlisence_number']));
		$result=$query->rowCount();
	
		if($result==0) {
			throw new Exception( 'ট্রেড লাইসেস্ন নাম্বারে এ ভুল আছে ');
		}
		
		$date=date('d-m-Y');
		$day=substr($date,0,2);
		$month=substr($date,3,2);
		$year=substr($date,6,4);
		
		$query=$db->prepare("insert into tdl_joma(tdl_no,tdl_budget_year,tdl_fe,vat,tdl_incometex,tdl_jomriman,tdl_ohers_cost,total_taka,taka_kothai,tdl_bank_name,tdl_bank_no,joma_day,joma_month,joma_year,joma_date)
		values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$query->execute(array($_POST['treadlisence_number'],$_POST['budget_year'],$_POST['tread_fee'],$_POST['vat'],$_POST['income_tex'],$_POST['jorimana'],$_POST['others'],$_POST['total'],$_POST['taka_kothai'],$_POST['bank_name'],$_POST['bank_ac_no'],$day,$month,$year,$date));
	
		
		$success_message = 'আপনার তথ্য সংরক্ষন হয়েছে ।.';
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>

<div class="container">
<br/>
<h2 class="title">ট্রেড লাইসেস্ন ফি. জমা করুন</h2>
	
	<?php  
		if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
		if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
		?>
		<form action="" method="post" >
		
		<table width="100%" cellpadding="2px" id="tdl_table">
			<tr>
				<td>ট্রেড লাইসেস্ন নাম্বারঃ</td>
				<td><input type="text" name="treadlisence_number" /></td>
			</tr>
			<tr>
			<td>অর্থবছর</td>
				<td>
			
				<select name="budget_year" id=" selection">
						<option value="">অর্থবছর নির্বাচন করুন</option>
						<option value="২০১৫-২০১৬">২০১৫-২০১৬</option>
						<option value="২০১৪-২০১৫">২০১৪-২০১৫</option>
						<option value="২০১৩-২০১৪">২০১৩-২০১৪</option>
						<option value="২০১২-২০১৩">২০১২-২০১৩</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>ট্রেড লাইসেস্ন ফিঃ</td>
				<td><input type="text" name="tread_fee" class="tread-fee" /></td>
				
			</tr>
			<tr>
				<td>ভ্যাট</td>
				<td><input type="text" name="vat" class="vat"/></td>
			</tr>
			<tr>
				<td>ইনকাম ট্যাক্স</td>
				<td><input type="text" name="income_tex" class="income-tex"/></td>
			</tr>
			<tr>
				<td>জরিমানা</td>
				<td><input type="text" name="jorimana" class="joriman" /></td>
			</tr>
			<tr>
				<td>অন্যান্য</td>
				<td><input type="text" name="others" class="other" /></td>
			</tr>
			<tr>
				<td>মোট</td>
				<td><input type="text" name="total" class="totals" /></td>
			</tr>
			<tr>
				<td>মোট টাকা কথায়</td>
				<td><input type="text" name="taka_kothai" class="taka_kothai" /></td>
			</tr>
			<tr>
				<td>ব্যাংকের নাম</td>
				<td>
					<select name="bank_name" id=" selection">
						<option value="">ব্যাংকের নাম নির্বাচন</option>
						<?php
				$query=$db->prepare("select * from tdl_bank_data");
				$query->execute();
				$result=$query->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row) 
					{
						?>
						<option value="<?php echo $row['bank_name'];?>"><?php echo $row['bank_name'];?></option>
					<?php	
					}
	
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>ব্যাংকের একাউন্ট নাম্বার</td>
				<td><input type="text" name="bank_ac_no" id="" /></td>
			
			</tr>
			
			<tr>
			<td></td>
			
			<td><button class="btn btn-success" type="submit" name="form1">সংরক্ষন করুন</button> </td>
			</tr>
				
			
		</table>
	
		</form>

		
		
</div><!---end container--->

<script>
    $(document).ready(function() {
		$(".tread-fee").on('change', function(e){
			
			var value = parseFloat($(this).val());
			var total_tex = parseFloat(value*15/100);
			
			$(".vat").val(total_tex);
		});
		$(".other").on('change', function(e){
			
			var tread_fee = parseFloat($('.tread-fee').val());
			var vat = parseFloat($('.vat').val());
			var income_tex = parseFloat($('.income-tex').val());
			var jomrimana = parseFloat($('.joriman').val());
			var others = parseFloat($('.other').val());
			var total_taka= parseFloat(tread_fee+vat+income_tex+jomrimana+others);
			$(".totals").val(total_taka);
		});
	});
</script>