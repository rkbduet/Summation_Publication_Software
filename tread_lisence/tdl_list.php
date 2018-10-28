<?php
ob_start();
session_start();
if($_SESSION['name']!='tread')
{
	header('location: login.php');
}
?>
<?php include('header.php'); ?>
<?php include('../config.php');?>
<div class="container" id="print">
<div id="print_area">
<div class="print_header">
	<img class="logo" src="../Pourosova.jpg" alt="logo" />
	<p> টাংগাইল পৌরসভা<br>ট্রেড লাইসেন্স  শাখা<br/>
		<span>www.tangialpourashava.gov.bd</span>
	</p>
</div>
<h3 class="center">সকল ট্রেড লাইসেন্স  তালিকা</h3> 

<table border="1" cellspacing="0" cellpadding="5" id="view_form">
	<tr>
		<th>ক্রমিক নং</th>
		<th>ট্রেড লাইসেন্স নং</th>
		<th>ব্যাবসা/প্রতিষ্ঠানের নাম</th>
		<th>মালিকের নাম</th>
		<th>ঠিকানা</th>
		<th>মোবাইল নাম্বার</th>
		
 </tr>
 	<?php
	
	
			/* ===================== Pagination Code Starts ================== */
			$adjacents = 7;
										
					
			
			
			$statement = $db->prepare("SELECT * FROM tred_lisence_application ORDER BY app_id ASC");
			$statement->execute();
			$total_pages = $statement->rowCount();
							
			
			$targetpage = $_SERVER['PHP_SELF'];   //your file name  (the name of this file)
			$limit =25;                                 //how many items to show per page
			$page = @$_GET['page'];
			if($page) 
				$start = ($page - 1) * $limit;          //first item to display on this page
			else
				$start = 0;
			
						
			$statement = $db->prepare("SELECT * FROM tred_lisence_application ORDER BY app_id ASC LIMIT $start, $limit");
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
			<td><?php echo $row['app_name']; ?></td>
			<td><?php  echo $row['app_p_post'];?>,<?php  echo $row['app_p_upzila'];?>,<?php  echo $row['app_p_zila'];?></td>
			<td><?php echo $row['app_mobile']; ?></td>
		</tr>
		
		<?php
	}
	
	?>
	
 
</table>

<span class="company_name">কারিগরি সহায়তায়  টাংগাইল কলিং লি:</span>
</div>
</div><!----print---->
<div class="container">
<h1 class="center"><a href="" class="btn btn-info"onclick="printcontent('print')" >প্রিন্ট করুন</a></h1>
</div>
<?php include('footer.php');?>

</body>
</html>