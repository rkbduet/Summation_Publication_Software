<?php
ob_start();
session_start();
if($_SESSION['name']!='hold')
{
	header('location: login.php');
}
?>
<?php include"header.php"?>
    

<?php
if(isset($_REQUEST['error'])) {
	$error_value=$_REQUEST['error'];


	try {
	
		if($error_value==1)
		
			throw new Exception( '  সঠিক তথ্য দিন ');
		}
	
	
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>	

	

<div class="container">
<br>
<h2 class="title">সকল বিল প্রিন্ট  করুন</h2>
    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
?>
		

<form action="view_kordatha_list_vill_name.php" method="post" id="" >
<div class="bill_print_heading">
		<label>অর্থবছর: </label><span>
		<?php 

		$date=date("d-m-Y");
		$month=substr($date,3,2);
		$year=substr($date,6,4);
		if($month>6 && $month<=12){
		echo $year;
			
		}
		else{
			
			$old_year=$year-1;

			echo $old_year;
			}



		?> -
		<?php 

		$date=date("d-m-Y");
		$month=substr($date,3,2);
		$year=substr($date,6,4);
		
		if($month<=6){
		echo $year;
			
		}
		else{
			
			$old_year=$year+1;

			echo $old_year;
			}



		?>
		
		</span>
		<label>কিস্তি:</label>
		<span>
		<?php 

		$date=date("d-m-Y");
		$month=substr($date,3,2);
		$year=substr($date,6,4);
		if($month>6 && $month<=9){
		 echo "১ম ";
			
		}
		else if($month>9 && $month<=12){
		 echo "২য় ";
			
		}
		else if($month>0 && $month<=3){
		 echo "৩য়";
			
		}
		else if($month>3 && $month<=6){
		 echo "৪র্থ";
			
		}


		?></span>
		
		
	
	</div>
			<table cellspacing="1" cellpadding="5">
	<tr>
			<td>করদাতার এর ধরন </td>		
	<td>
				<select name="kordatar_doron" id="">
					<option value="">করদাতার ধরন নির্বাচন করুন</option>
					<option value="প্রাইভেট">প্রাইভেট</option>
					<option value="সরকারী">সরকারী</option>
					<option value="আধা সরকারী">আধা সরকারী</option>
					<option value="এন জিও">এন জিও</option>
					
				</select>
</td>
</tr>
				<tr>
				<td></td>
					<td><button type="submit" class="btn btn-success" name="form1">বিল প্রিন্ট করুন</button></td>
				</tr>
				
		</table>
			</form>
    </div>    
		
