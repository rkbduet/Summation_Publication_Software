<?php
ob_start();
session_start();
if($_SESSION['name']!='tread')
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
<h2 class="title">ট্রেড লাইসেন্স ফি:   বকেয়া দেখুন</h2>
    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
?>
		

<form action="view_tdl_bokeia.php" method="post" id="tdl_table" >
			<table celspacing="1" cellpadding="5" id="">
	<tr>
			<td>অর্থবছর</td>
				<td>
				<select name="year" id=" selection">
						<option value="">অর্থবছর নির্বাচন করুন</option>
						<option value="২০১৫-২০১৬">২০১৫-২০১৬</option>
						<option value="২০১৪-২০১৫">২০১৪-২০১৫</option>
						<option value="২০১৩-২০১৪">২০১৩-২০১৪</option>
						<option value="২০১২-২০১৩">২০১২-২০১৩</option>
					</select>
				</td>
		</tr>
		<tr>
		<td></td>
					<td><button type="submit" class="btn btn-success" name="form1" >তালিকা দেখুন</button></td>
				</tr>
				
		</table>
			</form>
    </div>    
		
