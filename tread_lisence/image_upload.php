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
	
		
		
				
		$tag_id = $_POST['tag_id'];
		
		
		
		$success_message = "Post is inserted successfully.";
		
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}


}

?>


<?php include("header.php"); ?>
<h2>Add New Post</h2>

<?php
if(isset($error_message)) {echo "<div class='error'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success'>".$success_message."</div>";}
?>

<form action="" method="post" enctype="multipart/form-data">
<table class="tbl1">

<tr><td>Featured Image</td></tr>
<tr><td><input type="file" name="post_image"></td></tr>

<tr><td><input type="submit" value="SAVE" name="form1"></td></tr>
</table>	
</form>
<?php include("footer.php"); ?>			