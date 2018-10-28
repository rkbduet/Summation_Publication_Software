<?php
ob_start();
session_start();
if($_SESSION['name']!='tread')
{
	header('location: login.php');
}
?>
<?php include"header.php"?>
    
			
        
		
