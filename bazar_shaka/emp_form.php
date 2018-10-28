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
if(isset($_POST['form1'])) {

	try {
	
		
		if(empty($_POST['emp_name'])) {
			throw new Exception( 'Enter Employee Name.');
		}
		
		if(empty($_POST['emp_f_name'])) {
			throw new Exception( 'Enter Father Name .');
		}
		if(empty($_POST['emp_nid'])) {
			throw new Exception( 'Enter NID Number.');
		}
		if(empty($_POST['emp_mobile'])) {
			throw new Exception( 'Enter Mobile or Phone Number ');
		}
		if(empty($_POST['post'])) {
			throw new Exception( 'Enter Employee Degination.');
		}
		
		if(empty($_POST['join_date'])) {
			throw new Exception( 'Enter Joining Date.');
		}
		
		
	$query=$db->prepare("select * from emp_info ");
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) 
	{	 	 	 	 	 	 	 	
		 $emp_nid=$row['nid'];
		
	}
	if($emp_nid==$_POST['emp_nid']){
	$error_message='This NID ID Already Exists.';
	}
		
	else{
		$date=date('Y-m-d');
		$query=$db->prepare("insert into  emp_info(emp_name ,emp_f_name, address,nid, mobile, email, degination, join_date,resign_date) values(?,?,?,?,?,?,?,?,?)");
		$query->execute(array($_POST['emp_name'],$_POST['emp_f_name'],$_POST['emp_address'],$_POST['emp_nid'],$_POST['emp_mobile'],$_POST['emp_email'],$_POST['post'],$_POST['join_date'],$_POST['resign_date']));
	
		$success_message = 'Informaton Save Successfully.';
	}
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>
<?php include("header.php")?>

<div class="container">
<br />
<h2 class="title">Employee Details Information Form.</h2>
<?php  
if(isset($error_message)) {echo "<div class='error_message'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success_message'>".$success_message."</div>";}
?>
<form action="" method="post" >
<table celspacing="1" cellpadding="5">

 <tr>
 	<td>Employee Name:</td>
 	<td><input type="text" name="emp_name"/></td>
 </tr>
 <tr>
 	<td>Father Name:</td>
 	<td><input type="text" name="emp_f_name"/></td>
 </tr>
 <tr>
 	<td>Parmanent Addres:</td>
 	<td><input type="text" name="emp_address"/></td>
 </tr>
<tr>
	<td>National ID No:</td>
	<td><input type="text" name="emp_nid" /></td>
</tr>
<tr>
	<td>Mobile / Phone:</td>
	<td><input type="text" name="emp_mobile" /></td>
</tr>
<tr>
	<td>Email:</td>
	<td><input type="text" name="emp_email" /></td>
</tr>
<tr>
	<td>Degination:</td>
	<td><input type="text" name="post" /></td>
</tr>

<tr>
	<td>Joining Date:</td>
	<td><input type="date" name="join_date" /> </td>
</tr>
<tr>
	<td>Resign Date:</td>
	<td><input type="date" name="resign_date" /></td>
</tr>

<tr>
	<td></td>
	<td><button class="btn btn-success" type="submit" name="form1">Save</button></td>
</tr>
</table>

</form>

</div> 
</div><!---end container--->