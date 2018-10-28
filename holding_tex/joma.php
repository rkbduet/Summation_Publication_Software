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
		if(empty($_POST['income_tex'])) {
			throw new Exception( 'ইনকাম টেক্স এর  পরিমান দিন');
		}
		if(empty($_POST['bank_name'])) {
			throw new Exception( 'ব্যাংকের নাম নির্বাচন করুন');
		}
		if(empty($_POST['bank_ac_no'])) {
			throw new Exception( 'ব্যাংকের একাউন্ট নাম্বার দিন');
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
		
		$query=$db->prepare("insert into tdl_joma(tdl_no,tdl_budget_year,tdl_fe,tdl_incometex,tdl_bank_name,tdl_bank_no,joma_day,joma_month,joma_year)
		values(?,?,?,?,?,?,?,?,?)");
		$query->execute(array($_POST['treadlisence_number'],$_POST['budget_year'],$_POST['tread_fee'],$_POST['income_tex'],$_POST['bank_name'],$_POST['bank_ac_no'],$day,$month,$year));
	
		
		$success_message = 'আপনার তথ্য সংরক্ষন হয়েছে ।.';
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>

<div class="container">
	
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
			<td>অথবছর</td>
				<td>
				<?php 
		
					
				?>
				<select name="budget_year" id=" selection">
						<option value="">অথবছর নির্বাচন করুন</option>
						<option value="২০১৫-২০১৬">২০১৫-২০১৬</option>
						<option value="২০১৪-২০১৫">২০১৪-২০১৫</option>
						<option value="২০১৩-২০১৪">২০১৩-২০১৪</option>
						<option value="২০১২-২০১৩">২০১২-২০১৩</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>ট্রেড লাইসেস্ন ফিঃ</td>
				<td><input type="text" name="tread_fee" /></td>
				
			</tr>
			
			<tr>
				<td>ইনকাম ট্যাক্স</td>
				<td><input type="text" name="income_tex" /></td>
			</tr>
			<tr>
				<td>ব্যাংকের নাম</td>
				<td>
					<select name="bank_name" id=" selection">
						<option value="">ব্যাংকের নাম নির্বাচন</option>
						<option value="সোনালী ব্যাংক">সোনালী ব্যাংক</option>
						<option value="অগ্রনী ব্যাংক">অগ্রনী ব্যাংক</option>
						<option value="গ্রামীন ব্যাংক">গ্রামীন ব্যাংক</option>
						<option value="কৃষি ব্যাংক">কৃষি ব্যাংক</option>
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

