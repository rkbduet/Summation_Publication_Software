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

if(isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
}
else {
	header('location:application_correction.php');
}
if(isset($_POST['form1'])) {

	try {
	
		if(empty($_POST['applicate_name'])) {
			throw new Exception(' আবেদনকারীর নাম পূরণ কারুন');
		}
		
		if(empty($_POST['f_name'])) {
			throw new Exception( 'আবেদনকারীর  পিতার নাম পূরণ কারুন');
		}
		if(empty($_POST['m_name'])) {
			throw new Exception( 'আবেদনকারীর নাম পূরণ কারুন');
		}
		if(empty($_POST['b_name'])) {
			throw new Exception( 'ব্যবস্যা প্রতিষ্ঠানের নাম পূরণ কারুন');
		}
		if(empty($_POST['b_vill'])) {
			throw new Exception( 'ব্যবস্যা প্রতিষ্ঠানের ঠিকানা পুরোপুরি পূরণ করুন');
		}
		if(empty($_POST['b_holding_no'])) {
			throw new Exception( 'ব্যবস্যা প্রতিষ্ঠানের ঠিকানা পুরোপুরি পূরণ করুন');
		}
		if(empty($_POST['b_word_no'])) {
			throw new Exception( 'ব্যবস্যা প্রতিষ্ঠানের ঠিকানা পুরোপুরি পূরণ করুন');
		}
		if(empty($_POST['b_post'])) {
			throw new Exception( 'ব্যবস্যা প্রতিষ্ঠানের ঠিকানা  পুরোপুরি পূরণ করুন');
		}
		if(empty($_POST['babshar_doron'])) {
			throw new Exception( ' ব্যবস্যার ধরন নির্বাচন  করুন');
		}
		
		if(empty($_POST['p_vill'])) {
			throw new Exception( 'আবেদনকারীর বর্তমান ঠিকানা পুরোপুরি পূরণ করুন');
		}
		if(empty($_POST['p_holding_no'])) {
			throw new Exception( 'আবেদনকারীর বর্তমান ঠিকানা পুরোপুরি পূরণ করুন');
		}
		if(empty($_POST['p_post'])) {
			throw new Exception( 'আবেদনকারীর বর্তমান ঠিকানা পুরোপুরি পূরণ করুন');
		}
		if(empty($_POST['p_upzila'])) {
			throw new Exception( 'আবেদনকারীর বর্তমান ঠিকানা পুরোপুরি পূরণ করুন');
		}
		if(empty($_POST['p_district'])) {
			throw new Exception( 'আবেদনকারীর বর্তমান ঠিকানা পুরোপুরি পূরণ করুন');
		}
		if(empty($_POST['s_vill'])) {
			throw new Exception( 'আবেদনকারীর স্থায়ী ঠিকানা পুরোপুরি পূরণ করুন');
		}
		if(empty($_POST['s_holding_no'])) {
			throw new Exception( 'আবেদনকারীর স্থায়ী ঠিকানা পুরোপুরি পূরণ করুন');
		}
		if(empty($_POST['s_word_no'])) {
			throw new Exception( 'আবেদনকারীর স্থায়ী ঠিকানা পুরোপুরি পূরণ করুন');
		}
		if(empty($_POST['s_post'])) {
			throw new Exception( 'আবেদনকারীর স্থায়ী ঠিকানা পুরোপুরি পূরণ করুন');
		}
		
		if(empty($_POST['s_upzila'])) {
			throw new Exception( 'আবেদনকারীর স্থায়ী ঠিকানা পুরোপুরি পূরণ করুন');
		}
		
		if(empty($_POST['s_district'])) {
			throw new Exception( 'আবেদনকারীর স্থায়ী ঠিকানা পুরোপুরি পূরণ করুন');
		}
		if(empty($_POST['mobile_number'])) {
			throw new Exception( 'আবেদনকারীর মোবাইল নাম্বার দিন');
		}
		if(empty($_POST['treadlisence_number'])) {
			throw new Exception( 'আবেদনকারীর ট্রেড লাইসেস্ন নাম্বার দিন');
		}
		if(empty($_POST['treadlisence_year'])) {
			throw new Exception( 'কতসালে ট্রেড লাইসেস্ন নাম্বার করা হয়েছিল নির্বাচন করুন');
		}
		if(empty($_POST['data_entry_kari'])) {
			throw new Exception( 'ডাটা এন্ট্রিকারীর নাম দিন');
		}
if(empty($_POST['data_entry_kari_post'])) {
			throw new Exception( 'ডাটা এন্ট্রিকারীর  পদবী দিন');
		}
		
		
	$statement=$db->prepare("SHOW TABLE STATUS LIKE 'tred_lisence_application'");
		$statement->execute();
		$result=$statement->fetchAll();

		foreach($result as $row)
		$new_id=$row[10];
		
			
		$up_filename=$_FILES["photo"]["name"];
		$file_basename = substr($up_filename, 0, strripos($up_filename, '.')); // strip extensition
		$file_ext = substr($up_filename, strripos($up_filename, '.')); // strip name
		$f1 = $new_id.$file_ext;
		
		if(($file_ext!='.png')&&($file_ext!='.jpg')&&($file_ext!='.jpeg')&&($file_ext!='.gif'))
 {
			throw new Exception('file must be png or jpg,jpeg and gif format');
		}
		
		move_uploaded_file($_FILES["photo"]["tmp_name"],"img/applicate_image/" . $f1);

		$query=$db->prepare("update tred_lisence_application set app_serial=?,app_name=?,app_f_name=?,app_m_name=?,b_name=?,b_address_vill=?,b_address_holding_no=?,b_address_word_no=?,b_address_post=?
		,b_doron=?,app_p_vill=?,app_p_holding_no=?,app_p_word_no=?,app_p_post=?,app_p_upzila=?,app_p_zila=?,app_s_vill=?,app_s_holding_no=?,app_s_word_no=?,app_s_post=?,app_s_upzila=?,app_s_zila=?,
		app_tin_num=?,app_mobile=?,app_email=?,app_treadlisence_no=?,treadlisence_year=?,data_entry_name=?,app_photo=?,entry_post=?");
		$query->execute(array($new_id,$_POST['applicate_name'],$_POST['f_name'],$_POST['m_name'],$_POST['b_name'],$_POST['b_vill'],$_POST['b_holding_no'],$_POST['b_word_no'],$_POST['b_post'],
		$_POST['babshar_doron'],$_POST['p_vill'],$_POST['p_holding_no'],$_POST['p_word_no'],$_POST['p_post'],$_POST['p_upzila'],$_POST['p_district'],$_POST['s_vill'],$_POST['s_holding_no'],$_POST['s_word_no'],
		$_POST['s_post'],$_POST['s_upzila'],$_POST['s_district'],$_POST['tin_number'],$_POST['mobile_number'],$_POST['email'],$_POST['treadlisence_number'],$_POST['treadlisence_year'],$_POST['data_entry_kari'],$f1,$_POST['data_entry_kari_post']));
	
		
		$success_message = 'আপনার তথ্য পরিবর্তন হয়েছে ।.';
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>
<?php
		$query=$db->prepare("select * from tred_lisence_application where app_serial='$id'");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		
		
	}
	
	?>
<div class="container">
		

		<form action="" method="post" enctype="multipart/form-data" >
	<div id="application_form">
		
		<h1 style="text-align:center;color:blue">আবেদন ফরম:</h1>
		<?php  
		if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
		if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
		?>
		<div class="row">
			<div class="col-lg-3">
			<label for="">আবেদনকারীর নামঃ</label></div>
			<div class="col-lg-9"><input type="text" name="applicate_name" value="<?php echo $row["app_name"];?>"id="" style="width:70%;"  /></div>
		</div>
			
		<div class="row">
			<div class="col-lg-3"><label for="">পিতার/স্বামীর নামঃ</label></div>
			<div class="col-lg-9"><input type="text" name="f_name" value="<?php  echo $row['app_f_name'];?>"id="" style="width:70%;"/></div>
			
		</div>
		<div class="row">
			<div class="col-lg-3"><label for="">মাতার নামঃ</label></div>
			<div class="col-lg-9"><input type="text" name="m_name" value="<?php  echo $row['app_m_name'];?>"id="" style="width:70%;"/></div>
			
		</div>
		<div class="row">
			<div class="col-lg-3"><label for="">ব্যবস্যা প্রতিষ্ঠানের নামঃ</label></div>
			<div class="col-lg-9"><input type="text" name="b_name" value="<?php  echo $row['b_name'];?>"id="" style="width:70%;"/></div>
			
		</div>
		<div class="row">
			<div class="col-lg-3"><label for="">ব্যবস্যা প্রতিষ্ঠানের ঠিকানাঃ</label></div>
			<div class="col-lg-9">
			<label>গ্রাম/মহল্লা</label><input type="text" name="b_vill" value="<?php  echo $row['b_address_vill'];?>" id="" />
				<label>পোস্ট</label><input type="text" name="b_holding_no" value="<?php  echo $row['b_address_holding_no'];?>"  id="" />
				<label>উপজেলা</label><input type="text" name="b_word_no" value="<?php  echo $row['b_address_word_no'];?>"  id="" />
				<label>জেলা</label><input type="text" name="b_post" value="<?php  echo $row['b_address_post'];?>"  id="" />
				</div>
			
		</div>
		<div class="row">
			<div class="col-lg-3"><label for="">ব্যবস্যার ধরনঃ</label></div>
			<div class="col-lg-9"><input type="text" name="babshar_doron" value="<?php  echo $row['b_doron'];?>"  id=""style="width:70%;" /></div>
		
		</div>
		
		<div class="row">
			<div class="col-lg-3"><label for="">আবেদনকারীর বর্তমান ঠিকানাঃ</label></div>
			<div class="col-lg-9">
				<label>গ্রাম/মহল্লা</label><td><input type="text" name="p_vill" value="<?php  echo $row['app_p_vill'];?>"  id="" />
				<label>হোল্ডিং নং</label><input type="text" name="p_holding_no" value="<?php  echo $row['app_p_holding_no'];?>" id="" />
				<label>ওয়ার্ড নং</label><input type="text" name="p_word_no" value="<?php  echo $row['app_p_word_no'];?>" id="" />
				<label>পোস্ট অফিস</label><input type="text" name="p_post" value="<?php  echo $row['app_p_post'];?>"id="" />
				<label>উপজেলা</label><input type="text" name="p_upzila" value="<?php  echo $row['app_p_upzila'];?>"/>
				<label>জেলা</label><input type="text" name="p_district"value="<?php  echo $row['app_p_zila'];?>" id="" />
			</div>
			
		</div>
		<div class="row">
			<div class="col-lg-3"><label for="">আবেদনকারীর স্থায়ী ঠিকানাঃ</label></div>
			<div class="col-lg-9">
				<label>গ্রাম/মহল্লা</label><input type="text" name="s_vill" value="<?php  echo $row['app_s_vill'];?>"id="" />
				<label>হোল্ডিং নং</label><input type="text" name="s_holding_no" value="<?php  echo $row['app_s_holding_no'];?>" id="" />
				<label>ওয়ার্ড নং</label><input type="text" name="s_word_no" value="<?php  echo $row['app_s_word_no'];?>" id="" />
				<label>পোস্ট অফিস</label><input type="text" name="s_post" value="<?php  echo $row['app_s_post'];?>" id="" />
				<label>উপজেলা</label><input type="text" name="s_upzila" value="<?php  echo $row['app_s_upzila'];?>" />
				<label>জেলা</label><input type="text" name="s_district" value="<?php  echo $row['app_s_zila'];?>" id="" />
			</div>
			
		</div>
		<div class="row">
			<div class="col-lg-3"><label for="">টি আই এন নাম্বার :</label></div>
			<div class="col-lg-9"><input type="text" name="tin_number"value="<?php  echo $row['app_tin_num'];?>" id="" style="width:70%;"/></div>
			
		</div>
		<div class="row">
			<div class="col-lg-3"><label for="">মোবাইল/টেলিফোনঃ</label></div>
			<div class="col-lg-9"><input type="text" name="mobile_number" value="<?php  echo $row['app_mobile'];?>" id=""style="width:70%;" /></div>
			
		</div>
		
		<div class="row">
			<div class="col-lg-3"><label for="">ই-মেইলঃ</label></div>
			<div class="col-lg-9"><input type="email" name="email" value="<?php  echo $row['app_email'];?>" id=""style="width:70%;" /></div>
		
		</div>
		<div class="row">
			<div class="col-lg-3"><label for="">ট্রেড লাইসেস্ন নাম্বারঃ</label></div>
			<div class="col-lg-9"><input type="text" name="treadlisence_number" value="<?php  echo $row['app_treadlisence_no'];?>" style="width:70%;"/></div>
			
		</div>
		<div class="row">
			<div class="col-lg-3"><label for="">কতসালে ট্রেড লাইসেস্ন হয়েছিলঃ</label></div>
			<div class="col-lg-9">
			<select name="treadlisence_year" id=" selection">
					<option value="<?php  echo $row['treadlisence_year'];?>"><?php  echo $row['treadlisence_year'];?></option>
						<option value="2016">2016</option>
						<option value="2015">2015</option>
						<option value="2014">2014</option>
						<option value="2013">2013</option>
						<option value="2012">2012</option>
					</select></div>
		
		</div>
		
			
		<div class="row">
			<div class="col-lg-3"><label for="">আবেদনকারীর ছবিঃ</label></div>
			<div class="col-lg-3"><img src="img/applicate_image/<?php echo $row['app_photo']; ?>" alt="" width="250px" height="280px;"/></div>
			<div class="col-lg-6"><input type="file" name="photo"/></div>
			
		</div>
		<div class="row">
			<div class="col-lg-3"><label for="">ডাটা এন্ট্রিকারীর নামঃ</label></div>
			<div class="col-lg-3"><input type="text" name="data_entry_kari" value="<?php  echo $row['data_entry_name'];?>" style="width:70%;"/></div>
			<div class="col-lg-3"><label for="">ডাটা এন্ট্রিকারীর পদবীঃ</label></div>
			<div class="col-lg-3"><input type="text" name="data_entry_kari_post" value="<?php  echo $row['entry_post'];?>" style="width:70%;"/></div>
			
		</div>
	</div> <!---end of application_form--->
	<br />
		<button class="btn btn-success" type="submit" name="form1">পরিবর্তন করুন</button>
		
		</form>

		
		
</div><!---end container--->

<?php include('footer.php'); ?>