<?php
ob_start();
session_start();
if($_SESSION['name']!='tangail')
{
	header('location: login.php');
}
?>
<?php include"header.php"?>
<?php include('../config.php');?>

<?php 
if(isset($_POST['form1'])) {
	
	try {
		if(empty($_POST['market_name'])) {
			throw new Exception('মার্কেটের নাম নির্বাচন করুন');
		}
		if(empty($_POST['d_no'])) {
			throw new Exception('অনুগ্রহ করে দোকানের নাম্বার দিন');
		}
		
		$query=$db->prepare("select * from market_info WHERE m_no=? and m_name=? ");
		$query->execute(array($_POST['d_no'],$_POST['market_name']));
		$result=$query->rowCount();
	
	if($result==0) {
			throw new Exception( '  এই নাম্বার  কোনো দোকান নেই ');
		}
		if(empty($_POST['vara'])) {
			throw new Exception(' অনুগ্রহ মাসের ভাড়া দিন ');
		}
		if(empty($_POST['taka_kothai'])) {
			throw new Exception( 'ভাড়া টাকা কথায় লিখুন');
		}
		if(empty($_POST['year'])) {
			throw new Exception( 'অনুগ্রহ করে  বছর নির্বাচন করুন');
		}
		
		
		//
		//
		
		/***
		
		$month_name = $_POST['month_name'];
		
		$i=0;
		if(is_array($month_name))
		{
			foreach($month_name as $key=>$val)
			{
				$arr[$i] = $val;
				$i++;
			}
		}
				$month_names = implode(",",$arr);
				echo $month_names;
		
		****/
		$date=date('d-m-Y');
		
		
		$query=$db->prepare("insert into dokaner_vara(market_name,dokan_no,vara,vara_kothai,jan,feb,mar,apr,may,jun,jul,aug,sep,oct,nov,dec,year_name,joma_date) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$query->execute(array($_POST['market_name'],$_POST['d_no'],$_POST['vara'],$_POST['taka_kothai'],$_POST['january'],$_POST['february'],$_POST['march'],$_POST['april'],$_POST['may'],$_POST['june'],$_POST['july'],$_POST['august'],$_POST['september'],$_POST['october'],$_POST['november'],$_POST['december'],$_POST['year'],$date));
	
		
		$success_message = 'আপনার ভাড়া সঞ্চয়  সফল হয়েছে ।.';
	
		}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>	
	

<div class="container">
<br>
<h2 class="title">অগ্রীম মাসিক ভাড়া আদায় </h2>
    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
	
	<form action="" method="post" id="" >
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
				<td>দোকানের নং</td>
				<td><input type="text" name="d_no" id="" /></td>
				</tr>
				<tr>
					<td>মাসিক ভাড়া:</td>
					<td><input type="text" name="vara" value=""/></td>
				</tr>
				<tr>
				<tr>
					<td>ভাড়া কথায়</td>
					<td><input type="text" name="taka_kothai" id="" /></td>
				</tr>
	<tr>
					<td>মাসের নাম:</td>
					
 	<td>
		<span><input type="checkbox" name="january" id="" value ="1"/>   জানুয়ারি</span>
		<span><input type="checkbox" name="february" id="" value ="2" />  ফ্রেবুয়ারি</span>
		<span><input type="checkbox" name="march" id="" value ="3"/>  মার্চ </span>
		<span><input type="checkbox" name="april" id="" value ="4"/>  এপ্রিল</span>
		<span><input type="checkbox" name="may" id="" value ="5"/>  মে</span>
		<span><input type="checkbox" name="june" id="" value ="6"/>  জুন</span><br/>
		<span><input type="checkbox" name="july" id="" value ="7"/>  জুলাই</span>
		<span><input type="checkbox" name="august" id="" value ="8"/>   অগাস্ট</span>
		<span><input type="checkbox" name="september" id="" value ="9"/>  সেপ্টেম্বর</span>
		<span><input type="checkbox" name="october" id="" value ="10"/>  অক্টোবর</span>
		<span><input type="checkbox" name="november" id="" value ="11"/>  নভেম্বর</span>
		<span><input type="checkbox" name="december" id="" value ="12"/> ডিসেম্বর</span>
		<input type="hidden" name="" />
		
</td>
</tr>

<tr>
<td> বছরের নাম:</td>
<td><select name="year" id="">
			<option value="">বছর নির্বাচন  করুন</option>
			<option value="<?php $year= date('Y'); echo $year;?>"><?php $year= date('Y'); echo $year;?></option>
			<option value="<?php  echo $year-1;?>"><?php  echo $year-1;?></option>
			<option value="<?php echo $year-2;?>"><?php echo $year-2;?></option>
			<option value="<?php echo $year-3;?>"><?php echo $year-3;?></option>
			<option value="<?php echo $year-4;?>"><?php echo $year-4;?></option>
			<option value="<?php echo $year-5;?>"><?php echo $year-5;?></option>
			<option value="<?php echo $year-6;?>"><?php echo $year-6;?></option>
							
	</select></td>
</tr>
	<tr>
	<td></td>
					<td><button class="btn btn-success" name="form1" >সঞ্চয় করুন</button></td>
	</tr>
				
		</table>
			</form>
    </div>    
		
