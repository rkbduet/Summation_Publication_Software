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
if(isset($_POST['form1'])) {
	

	try {
	
		if(empty($_POST['year'])) {
			throw new Exception(' অর্থবছর নির্বাচন করুন ');
		}
		
		
		header("location:view_tdl_bokeia.php");

		}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>	

	<?php
	
	
	?>
	

<div class="container">
<h2 style="text-align:center;">ট্রেড লাইসেন্স ফি:   বকেয়া দেখুন</h2>
    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
?>
		

<form action="view_tdl_bokeia.php" method="post" id="tdl_table" >
			<table celspacing="1" cellpadding="5" id="">
	<tr>
			<td>অথবছর</td>
				<td>
				<select name="year" id=" selection">
						<option value="">অথবছর নির্বাচন করুন</option>
						<option value="২০১৫-২০১৬">২০১৫-২০১৬</option>
						<option value="২০১৪-২০১৫">২০১৪-২০১৫</option>
						<option value="২০১৩-২০১৪">২০১৩-২০১৪</option>
						<option value="২০১২-২০১৩">২০১২-২০১৩</option>
					</select>
				</td>
					<td><button type="submit" class="btn btn-default" name="form1" >তালিকা দেখুন</button></td>
				</tr>
				
		</table>
			</form>
    </div>    
		
