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
	
	if(empty($_POST['word_no'])) {
			throw new Exception(' ওয়ার্ড নং নির্বাচন করুন ');
		}
		if(empty($_POST['holding_no'])) {
			throw new Exception(' করদাতার হোল্ডিং নং দিন ');
		}
		
		
		if(empty($_POST['kordata_id'])) {
			throw new Exception( 'করদাতার আই ডি নং দিন');
		}
		if(empty($_POST['kordata_name'])) {
			throw new Exception( 'করদাতার নাম পূরণ কারুন');
		}
		
		if(empty($_POST['f_name'])) {
			throw new Exception( 'করদাতার পিতা/স্বামীর নাম দিন');
		}
		if(empty($_POST['road_name'])) {
			throw new Exception( 'মহল্লা / রাস্তার নাম দিন');
		}
		if(empty($_POST['holding_address'])) {
			throw new Exception( 'হোল্ডিং এর  ঠিকানা পুরোপুরি পূরণ করুন');
		}
		if(empty($_POST['holing_baboher'])) {
			throw new Exception( 'হোল্ডিং এর ব্যবহার নির্বাচন করুন');
		}
		if(empty($_POST['yearly_taka'])) {
			throw new Exception( 'বাৎসারিক মূল্যায়ন দিন');
		}
		
		
		if(empty($_POST['kordatar_doron'])) {
			throw new Exception( ' করদাতার ধরন নির্বাচন  করুন');
		}
	
		if(empty($_POST['holding_doron'])) {
			throw new Exception( 'হোল্ডিং ধরন নির্বাচন  করুন');
		}
		
		if(empty($_POST['bokia_start_y'])) {
			throw new Exception( 'বকেয়া শুরুর বছর নির্বাচন  করুন');
		}
		if(empty($_POST['bank_name'])) {
			throw new Exception( 'ব্যংকের নাম নির্বাচন করুন');
		}
		
		if(empty($_POST['bokia_kisti'])) {
			throw new Exception( 'বকেয়া কিস্তি নির্বাচন করুন');
		}
		
		if(empty($_POST['data_entry_person'])) {
			throw new Exception( 'ডাটা এন্ট্রিকারীর নাম দিন');
		}
		
	if(empty($_POST['data_entry_post'])) {
			throw new Exception( 'ডাটা এন্ট্রিকারীর পদবী  দিন');
		}
		$query=$db->prepare("select * from kordatha_info WHERE word_no=? and holding_no=? ");
		$query->execute(array($_POST['word_no'],$_POST['holding_no']));
		$result=$query->rowCount();
	
		if($result>0) {
			throw new Exception( '  এই ওয়ার্ড এই নাম্বরে হোল্ডিং আছে  ');
		}
		
		$query=$db->prepare("insert into  kordatha_info(word_no,holding_no,kordatha_id,name,f_name,vill_name,holding_address,holding_use,kordathar_doron,holding_doron,bank_name,yearly_tax,bokia_taka,bokia_year,bokia_kisti,d_entry_name,d_entry_post) 
		values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$query->execute(array($_POST['word_no'],$_POST['holding_no'],$_POST['kordata_id'],$_POST['kordata_name'],$_POST['f_name'],$_POST['road_name'],$_POST['holding_address'],$_POST['holing_baboher'],$_POST['kordatar_doron'],$_POST['holding_doron'],$_POST['bank_name'],$_POST['yearly_taka'],$_POST['bokia_taka'],$_POST['bokia_start_y'],$_POST['bokia_kisti'],$_POST['data_entry_person'],$_POST['data_entry_post']));
	
		
		$success_message = 'আপনার তথ্য সংরক্ষন হয়েছে ।.';
		
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>

<div class="container">
		

		<form action="" method="post" >
	<div id="application_form">
		
		<h2 class="title"> করদাতার তথ্য ফরম </h2>
		<?php  
		if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
		if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
		?>
		<div class="row">
			<div class="col-lg-3"><label for="">ওয়ার্ড  নং</label></div>
			<div class="col-lg-9">
				<select name="word_no" id="">
					<option value="">ওয়ার্ড  নং  নির্বাচন করুন</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
				</select>
			</div>
			
			
		</div>
		<div class="row">
			<div class="col-lg-3">
			<label for="">হোল্ডিং নং</label></div>
			<div class="col-lg-9"><input type="text" name="holding_no" id="" style="width:70%;"  /></div>
		</div>
			
		<div class="row">
			<div class="col-lg-3"><label for="">করদাতার আই.ডি </label></div>
			<div class="col-lg-9"><input type="text" name="kordata_id" id="" style="width:70%;"/></div>
			
		</div>
		<div class="row">
			<div class="col-lg-3"><label for="">করদাতার নাম</label></div>
			<div class="col-lg-9"><input type="text" name="kordata_name" id="" style="width:70%;"/></div>
			
		</div>
		<div class="row">
			<div class="col-lg-3"><label for="">পিতা/স্বামীর নাম</label></div>
			<div class="col-lg-9"><input type="text" name="f_name" id="" style="width:70%;"/></div>
			
		</div>
		<div class="row">
			<div class="col-lg-3"><label for="">এলাকা/রাস্তার নাম</label></div>
			<div class="col-lg-9"><input type="text" name="road_name" id=""style="width:70%;" /></div>
		
		</div>
		
		<div class="row">
			<div class="col-lg-3"><label for="">হোল্ডিং এর ঠিকানা</label></div>
			<div class="col-lg-9"><input type="text" name="holding_address" id="" style="width:70%;"/></div>
			
		</div>
		<div class="row">
			<div class="col-lg-3"><label for="">হোল্ডিং ব্যবহার</label></div>
			<div class="col-lg-3">
				<select name="holing_baboher" id="">
				<option value="">হোল্ডিং এর ব্যবহার নির্বাচন করুন </option>
					<option value="ব্যবস্যায়িক">ব্যবস্যায়িক</option>
					<option value="শিল্প কারখানা">শিল্প কারখানা</option>
					<option value="আবাসিক">আবাসিক</option>
					<option value="ধর্মীয়">ধর্মীয়</option>
					<option value="শিক্ষা প্রতিষ্ঠান">শিক্ষা প্রতিষ্ঠান</option>
					<option value="মিশ্র ব্যবহার">মিশ্র ব্যবহার</option>
					<option value="অব্যবহিত">অব্যবহিত</option>
				</select>
			
			</div>
			
			
			<div class="col-lg-6"><label for="">বৎসরিক মূল্যায়ন</label>
			<input type="text" name="yearly_taka" id="" /></div>
		</div>
		
		<div class="row">
			<div class="col-lg-3"><label for="">করদাতার এর ধরন</label></div>
			<div class="col-lg-3">
				<select name="kordatar_doron" id="">
					<option value="">করদাতার ধরন নির্বাচন করুন</option>
					<option value="প্রাইভেট">প্রাইভেট</option>
					<option value="সরকারী">সরকারী</option>
					<option value="আধা সরকারী">আধা সরকারী</option>
					<option value="এন জিও">এন জিও</option>
					
				</select>
			
			</div>
			
			
			<div class="col-lg-6">
			<label for="">পূর্বের বকেয়া টাকা</label>
			<input type="text" name="bokia_taka" id="" />
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-3"><label for="">হোল্ডিং এর ধরন</label></div>
			<div class="col-lg-3">
				<select name="holding_doron" id="">
					<option value="">হোল্ডিং ধরন নির্বাচন করুন</option>
					<option value="পাকা">পাকা</option>
					<option value="কাচা">কাচা</option>
					<option value="আধা পাকা">আধা পাকা</option>
					<option value="মিশ্র ব্যবহার">মিশ্র ব্যবহার</option>
					
				</select>
			</div>
			
			
			<div class="col-lg-6">
			<label for="">বকেয়া শুরুর বছর</label>
			<select name="bokia_start_y" id="">
				<option value="">বছর নির্বাচন করুন</option>
				<?php 
				$current_date=date("d-m-Y");
				$current_year=substr($current_date,6,4);
				
				
				for( $y=$current_year;$y>=1990;$y--){
					?>
					 <option value="<?php $year1=$y-1; echo $year1;?> - <?php echo $y;?>"><?php $year1=$y-1; echo $year1;?> - <?php echo $y;?> </option>
			<?		   
		}
				
				?>
				
			</select>
			
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-3"><label for="">ব্যাংকের নাম</label></div>
			<div class="col-lg-3">
				<select name=" bank_name" id="">
					<option value="">ব্যংকের নাম নির্বাচন করুন</option>
					<?php 
					
					$query= $db->prepare("SELECT * FROM holding_bank_data");
					$query->execute();
					$result=$query->fetchAll(PDO::FETCH_ASSOC);
					foreach($result as $row){
						?>
						<option value="<?php echo $row['bank_name'];?>"><?php echo $row['bank_name'];?></option>
						<?php 
						
					}
					
					?>
					
				</select>
			</div>
			<div class="col-lg-6">
			<label for="">বকেয়া  শুরুর কিস্তি</label>
	
				<select name=" bokia_kisti" id="">
					<option value="">কিস্তি  নির্বাচন করুন</option>
					<option value="1">১ম</option>
					<option value="2">২য়</option>
					<option value="3">৩য়</option>
					<option value="4">৪র্থ</option>
				
				</select>
			</div>
			
			
		</div>
		
		
		<div class="row">
		<h2 class="title">ডাটা এন্ট্রিকারীর  তথ্য</h2>
			<div class="col-lg-2"></div>
			<div class="col-lg-5"><label for="">ডাটা এন্ট্রিকারীর নাম</label><input type="text" name="data_entry_person" id="" /></div>
			<div class="col-lg-5"><label for="">পদবী</label><input type="text" name="data_entry_post" id="" /></div>
		</div>
	</div> <!---end of application_form--->
<div class="row">
	<div class="col-lg-4"></div>
	<div class="col-lg-8"><button class="btn btn-success" type="submit" name="form1">সংরক্ষন করুন</button> </div>
</div>
		
		
		</form>
		<br/>

		
		
</div><!---end container--->
<?php include('footer.php'); ?>