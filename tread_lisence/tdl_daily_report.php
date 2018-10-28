<?php
ob_start();
session_start();
if($_SESSION['name']!='tread')
{
	header('location: login.php');
}
?>
<?php include('../config.php'); ?>
<?php include("header.php");?>
	
<?php 



if(isset($_REQUEST['date'])){
$input_date=$_REQUEST['date'];
		
		$query=$db->prepare("select * from tdl_joma WHERE joma_date=?");
		$query->execute(array($input_date));
		$result=$query->rowCount();
		if($result==0) {
			header("location:tdl_day_report.php?error=1");
		}
		

	
		}
	
else{
	
	header("location:tdl_day_report.php?error=0");
}

?>
<div class="container" id="print">
<div id="print_area">
<div class="print_header">
	<img class="logo" src="../Pourosova.jpg" alt="logo" />
	<p> টাংগাইল পৌরসভা<br>টেড লাইসেন্স  শাখা<br/>
		<span>www.tangialpourashava.gov.bd</span>
	</p>
	
</div>
<h4><?php echo $input_date;?>  তারিখের জমার রিপোর্ট </h4>


<form action="" method="post" >
<div class="report_date">তারিখ: <?php echo date('d-m-Y');?></div>
<table border="1" cellspacing="0" cellpadding="1">
	<tr>
		<th>ক্রমিক নং</th>
		<th>ট্রেড লাইসেন্স নং</th>
		<th>প্রতিষ্ঠানের নাম</th>
		<th>ট্রেড লাইসেন্স ফি</th>
		<th>ভ্যাট</th>
		<th>ইনকাম ট্যাক্স</th>
		<th>জরিমানা</th>
		<th>অন্যান্য</th>
		<th>মোট</th>
		
		
 </tr>
 	<?php
			/* ===================== Pagination Code Starts ================== */
			$adjacents = 7;
										
					
			
			
			$statement = $db->prepare("SELECT * FROM tred_lisence_application t1 join tdl_joma t2  on t1.app_treadlisence_no=t2.tdl_no where joma_date='$input_date' ORDER BY tdl_id ASC");
			$statement->execute();
			$total_pages = $statement->rowCount();
							
			
			$targetpage = $_SERVER['PHP_SELF'];   //your file name  (the name of this file)
			$limit =25;                                 //how many items to show per page
			$page = @$_GET['page'];
			if($page) 
				$start = ($page - 1) * $limit;          //first item to display on this page
			else
				$start = 0;
			
						
			$statement = $db->prepare("SELECT * FROM tred_lisence_application t1 join tdl_joma t2  on t1.app_treadlisence_no=t2.tdl_no where joma_date='$input_date' ORDER BY tdl_id ASC LIMIT $start, $limit");
			$statement->execute();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			
			if ($page == 0) $page = 1;                  //if no page var is given, default to 1.
			$prev = $page - 1;                          //previous page is page - 1
			$next = $page + 1;                          //next page is page + 1
			$lastpage = ceil($total_pages/$limit);      //lastpage is = total pages / items per page, rounded up.
			$lpm1 = $lastpage - 1;   
			$pagination = "";
			if($lastpage > 1)
			{   
				$pagination .= "<div class=\"pagination\">";
				if ($page > 1) 
					$pagination.= "<a href=\"$targetpage?page=$prev\">&#171; previous</a>";
				else
					$pagination.= "<span class=\"disabled\">&#171; previous</span>";    
				if ($lastpage < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
				{   
					for ($counter = 1; $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
					}
				}
				elseif($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
				{
					if($page < 1 + ($adjacents * 2))        
					{
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
						}
						$pagination.= "...";
						$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
						$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
					}
					elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
					{
						$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
						$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
						$pagination.= "...";
						for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
						}
						$pagination.= "...";
						$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
						$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
					}
					else
					{
						$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
						$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
						$pagination.= "...";
						for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
						}
					}
				}
				if ($page < $counter - 1) 
					$pagination.= "<a href=\"$targetpage?page=$next\">next &#187;</a>";
				else
					$pagination.= "<span class=\"disabled\">next &#187;</span>";
				$pagination.= "</div>\n";       
			}
			/* ===================== Pagination Code Ends ================== */	
	$i=0;
	foreach($result as $row) 
	{
		$i++;
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $row['app_treadlisence_no']; ?></td>
			<td><?php echo $row['b_name']; ?></td>
			<td><?php echo $row['tdl_fe']; ?></td>
			<td><?php  echo $row['vat'];?></td>
			<td><?php echo $row['tdl_incometex']; ?></td>
			<td><?php echo $row['tdl_jomriman'];?></td>
			<td><?php echo $row['tdl_ohers_cost'];?></td>
			<td><?php echo $row['total_taka'];?></td>
		</tr>
		<?php 
	}
	
	?>
<tr>
	<td></td>
	<td></td>
	<td>মোট </td>
	<td>
	<?php 
			$query=$db->query("select SUM(tdl_fe) as total_vara from tdl_joma where joma_date='$input_date'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara1=$row['total_vara'];
		
	}
		
	echo $total_vara1;
	
	?></td>
	<td>
	<?php 
			$query=$db->query("select SUM(vat) as total_vara from tdl_joma where joma_date='$input_date'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara2=$row['total_vara'];
		
	}
		
	echo $total_vara2;
	
	?>
	</td>
	<td>
	<?php 
			$query=$db->query("select SUM(tdl_incometex) as total_vara from tdl_joma where joma_date='$input_date'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara3=$row['total_vara'];
		
	}
		
	echo $total_vara3;
	
	?>
	
	</td>
	<td>
	<?php 
			$query=$db->query("select SUM(tdl_jomriman) as total_vara from tdl_joma where joma_date='$input_date'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara4=$row['total_vara'];
		
	}
		
	echo $total_vara4;
	
	?>
	
	</td>
	<td>
	<?php 
			$query=$db->query("select SUM(tdl_ohers_cost) as total_vara from tdl_joma where joma_date='$input_date'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara5=$row['total_vara'];
		
	}
		
	echo $total_vara5;
	
	?>
	
	</td>
	<td>
	<?php 
			$query=$db->query("select SUM(total_taka) as total_vara from tdl_joma where joma_date='$input_date'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_vara6=$row['total_vara'];
		
	}
		
	echo $total_vara6;
	
	?>
	
	</td>
</tr>
</table>
<br /><br />
<div class="report_person">রিপোর্টৈ তৈরীকারীর নাম: <br />
							পদবী:
						<br /><br /><br />
							সাক্ষর 

</div>
<span class="company_name">কারিগরি সহায়তায় টাংগাইল কলিং লিমিটেড.</span>
</div><!----end print_area--->
</div>

<div class="pagination">
<?php 
echo $pagination; 
?>
</div>
<h1 class="center"><a href="" class="btn btn-info "onclick="printcontent('print')" >প্রিন্ট করুন</a></h1>
<?php include("footer.php");?>