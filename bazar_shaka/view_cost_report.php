<?php
ob_start();
session_start();
if($_SESSION['name']!='tangail')
{
	header('location: login.php');
}
?>
<?php include('../config.php'); ?>
<?php include("header.php");?>
	
<?php 

if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && isset($_REQUEST['cost_type'])){
$input_start_date=$_REQUEST['start_date'];
$input_end_date=$_REQUEST['end_date'];
$input_cost_type=$_REQUEST['cost_type'];

switch($input_cost_type){
	case 1:
	$cost_type = "Electricity Bill";
	break;
	case 2:
	$cost_type = "Accessories";
	break;
	case 3:
	$cost_type = "Salary";
	break;
	
	case 4:
	$cost_type="Other";
	
	
	}	

		$query=$db->prepare("select * from cost WHERE cost_type=? and cost_date BETWEEN '$input_start_date' and '$input_end_date'");
		$query->execute(array($input_cost_type,));
		$result=$query->rowCount();
		if($result==0) {
			header("location:cost_report.php?error=1");
		}
		
		
		}
	else{
		
		header("location: cost_report.php?error=0");
	}
		

?>
<div class="container" id="print">
<div id="print_area">
<div class="print_header">
	<img class="logo" src="../Pourosova.jpg" alt="logo" />
	<label class="name"> SUMMATON Publication</label> <br />
	<label class="center"> <?php echo $cost_type;?> Cost Reprot From <?php echo $input_start_date;?> to <?php echo $input_end_date;?></label>
</div>


<form action="" method="post" >
<div class="report_date"> Report Date: <?php echo date('d-m-Y');?></div>
<table border="1" cellspacing="0" cellpadding="1">
	<tr>
		<th>Sl. No</th>
		<th>Cost Discrption</th>
		<th>Cost Date</th>
		<th>Ammount</th>
		
 </tr>
 	<?php
	
			/* ===================== Pagination Code Starts ================== */
			$adjacents = 7;
										
					
			
			
			$statement = $db->prepare("SELECT * FROM  cost where cost_type='$input_cost_type' and cost_date BETWEEN '$input_start_date' and '$input_end_date' ORDER BY cost_id ASC");
			$statement->execute();
			$total_pages = $statement->rowCount();
							
			
			$targetpage = $_SERVER['PHP_SELF'];   //your file name  (the name of this file)
			$limit =25;                                 //how many items to show per page
			$page = @$_GET['page'];
			if($page) 
				$start = ($page - 1) * $limit;          //first item to display on this page
			else
				$start = 0;
			
						
			$statement = $db->prepare("SELECT * FROM cost where cost_type='$input_cost_type' and cost_date BETWEEN '$input_start_date' and '$input_end_date' ORDER BY cost_id ASC LIMIT $start, $limit");
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
			
			foreach($result as $row){
			$i++;
			?>
			<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $row['cost_biboron'];?></td>
			<td><?php echo $row['cost_date'];?></td>
			<td><?php echo $row['cost_taka'];?></td>
			</tr>
			
			<?php
		}
	?>
  <tfoot>
 <td></td>
 <td></td>
	<td>Total cost :</td>
		<td>
		<?php 
			$query=$db->query("select SUM(cost_taka) as total_cost from cost where cost_type='$input_cost_type' and cost_date BETWEEN '$input_start_date' and '$input_end_date'");
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) 
	{
		$total_cost=$row['total_cost'];
		
	}
		
	echo $total_cost;
		?></td>
	</tr>
 
 </tfoot>
</table>
<br />

</div><!----end print_area--->
</div>

<div class="pagination">
<?php 
echo $pagination; 
?>
</div>
<h1 class="center"><a href="" class="btn btn-info "onclick="printcontent('print')" >Print</a></h1>
<?php include("footer.php");?>