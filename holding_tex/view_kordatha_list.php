
	
 	<?php
ob_start();
session_start();
if($_SESSION['name']!='hold')
{
	header('location: login.php');
}
?>
<?php include('../config.php'); ?>
<?php include("header.php");?>
	
	<?php 
	
	
	
	?>

<div class="container" id="print">
<div id="print_area">

<div class="print_header">
	<img class="logo" src="../Pourosova.jpg" alt="logo" />
	<p> টাংগাইল পৌরসভা<br>হোল্ডিং ট্যাক্স  শাখা<br/>
		<span>www.tangialpourashava.gov.bd</span>
		
	</p>
	
</div>
<h3 class="center">সকল করদাতার তালিকা </h3>

<div class="report_date">তারিখ: <?php echo date('d-m-Y');?></div>
<form action="" method="post" >
<table border="1" cellspacing="0" cellpadding="1" id="view_form">
<tr>
		<th>ক্রমিক নং</th>
		<th>হোল্ডিং   নং</th>
		<th>করদাতার আই ডি</th>
		<th>ওয়ার্ড নং </th>
		<th>করদাতার নাম</th>
		<th>পিতার নাম</th>
		<th>ঠিকানা</th>
		<th>এলাকা/রাস্তার নাম</th>
		<th>মূল্যায়ন টাকা</th>
		
		
 </tr>
 	<?php
	
	
			/* ===================== Pagination Code Starts ================== */
			$adjacents = 7;
										
					
			
			
			$statement = $db->prepare("SELECT * FROM kordatha_info ORDER BY k_id ASC");
			$statement->execute();
			$total_pages = $statement->rowCount();
							
			
			$targetpage = $_SERVER['PHP_SELF'];   //your file name  (the name of this file)
			$limit =25;                                 //how many items to show per page
			$page = @$_GET['page'];
			if($page) 
				$start = ($page - 1) * $limit;          //first item to display on this page
			else
				$start = 0;
			
						
			$statement = $db->prepare("SELECT * FROM kordatha_info ORDER BY k_id ASC LIMIT $start, $limit");
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
		<td><?php echo $row['holding_no']; ?></td>
		<td><?php echo $row['kordatha_id']; ?></td>
		<td><?php echo $row['word_no']; ?></td>
		<td><?php echo $row['name']; ?></td>
		<td><?php echo $row['f_name'];?></td>
		<td><?php echo $row['holding_address']; ?></td>
		<td><?php echo $row['vill_name']; ?></td>
		<td><?php echo $row['yearly_tax']; ?></td>
		
		<?php
	}
	
	?>
	
 
</table>
<br /><br />
<div class="report_person">রিপোর্টৈ তৈরীকারীর নাম: <br />
							পদবী:
						<br /><br /><br />
							সাক্ষর 

</div>
<span class="company_name">কারিগরি সহায়তায়  টাংগাইল কলিং লি:</span>
</div><!---end print_area--->

</div>
<div class="container">

<div class="pagination">
<?php 
echo $pagination; 
?>
</div>
<h1 class="center"><a href="" class="btn btn-info"onclick="printcontent('print')" >প্রিন্ট করুন</a></h1>
</div>
<?php include('footer.php');?>

</body>
</html>