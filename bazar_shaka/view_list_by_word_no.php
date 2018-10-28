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
<h2 class="title">ওয়ার্ড নং অনুযায়ী দোকানের তালিকা  দেখুন</h2>
<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
<br />
<form action="dokan_list_by_word_no.php" method="post" >
<table cellspacing = "1" cellpadding="5">
<tr>
		<td>ওয়ার্ড নং:</td>
		<td>
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
	</td>
	</tr>
<tr>
	<td></td>
	<td><button class="btn btn-success" type="submit" name="form1">তালিকা দেখুন</button></td>
</tr>


</table>

</form>


</div><!---end container--->