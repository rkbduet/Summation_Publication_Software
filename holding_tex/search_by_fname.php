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
<h1 class="title">করদাতার তথ্য অনুসন্ধান পিতা/স্বামীর নাম অনুসারে</h1>


    <?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
?>


<form action="view_kordatha_list_by_fname.php" method="post" id="" >
			<table cellspacing="1" cellpadding="5">
<tr>
<td>পিতা/স্বামীর নাম</td>
<td><input type="text" name="f_name" id="" /></td>
</tr>

<tr>
<td></td>
<td><button class="btn btn-success" name="form1" >অনুসন্ধান করুন</button></td>
</tr>
				
		</table>
			</form>
    </div>    
		
