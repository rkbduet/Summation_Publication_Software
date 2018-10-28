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



if(isset($_REQUEST['month']) && isset($_REQUEST['year'])){
$input_month=$_REQUEST['month'];
$input_year=$_REQUEST['year'];

/*********
rajib sir ke question korte hobe database collumn আনুসারে query possible ki na ????????????????????????????????????????????????????????
$statement = $db->prepare("SELECT * FROM month_vara");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row)
{
		$month_name=$row['month_name'];
		
	$arr2 = explode(",",$month_name);
	$count_arr2 = count(explode(",",$month_name));
	for($j=0;$j<$count_arr2;$j++)
	{
		if($arr2[$j]==$input_month)
		{
			$month_name=$arr2[$j];
			echo $month_name;
			break;
		}
	
	}
		
		}
		*******/
		
		
	
		$query=$db->prepare("select * from month_vara WHERE month_name =? and year_name=?");
		$query->execute( array($input_month,$input_year));
		$result=$query->rowCount();
		if($result==0) {
			header("location:joma_report.php?error=1");
		}
		

	
		}
	
else{
	
	header("location:joma_report.php?=error=0");
}
	
	
?>

<div class="container" id="print">
<div id="print_area">
<div class="print_header">
	<img class="logo" src="../Pourosova.jpg" alt="logo" />
	<p> টাংগাইল পৌরসভা<br>বাজার শাখা<br/>
		<span>www.tangialpourashava.gov.bd</span>
	</p>
	
</div>
<h3><?php echo $input_year;?>  সালের  <?php
$month_name = $input_month;

if($month_name==1){echo "জানুয়ারি";}
if($month_name==2){echo "ফ্রেবরুয়ারি";}
if($month_name==3){echo "মাচ";}
if($month_name==4){echo "এপ্রিল";}
if($month_name==5){echo "মে";}
if($month_name==6){echo "জুন";}
if($month_name==7){echo "জুলাই";}
if($month_name==8){echo "অগাস্ট";}
if($month_name==9){echo "সেপ্টেম্বর";}
if($month_name==10){echo "অক্টোবর";}
if($month_name==11){echo "নভেম্বর";}		
if($month_name==12){echo "ডিসম্বের";}		
			
?>  মাসের ভাড়া প্রদেয় দোকানের তালিকা </h3>

<div class="report_date">তারিখ: <?php echo date('d-m-Y');?></div>
<form action="" method="post" >
<table border="1" cellspacing="0" cellpadding="1">
	<tr>
		<th>ক্রমিক নং</th>
		<th>ওয়ার্ড নং </th>
		<th>মার্কটের নাম</th>
		<th>বরাদ্দ বাবকের নাম</th>
		<th> দোকান নং</th>
		<th>  ঠিকানা </th>
		<th>ভাড়া</th>
		<th>মোবাইল</th>
		
 </tr>
 	<?php
	
	
			/* ===================== Pagination Code Starts ================== */
			$adjacents = 7;
										
					
			
			
			$statement = $db->prepare("SELECT * FROM market_info t1 join month_vara t2  on t1.m_no=t2.dokan_no 
			
			where month_name ='$input_month' and year_name='$input_year' ORDER BY m_id ASC");
			$statement->execute();
			$total_pages = $statement->rowCount();
							
			
			$targetpage = $_SERVER['PHP_SELF'];   //your file name  (the name of this file)
			$limit =25;                                 //how many items to show per page
			$page = @$_GET['page'];
			if($page) 
				$start = ($page - 1) * $limit;          //first item to display on this page
			else
				$start = 0;
			
						
			$statement = $db->prepare("SELECT * FROM market_info t1 join month_vara t2  on t1.m_no=t2.dokan_no 
			
			where month_name='$input_month' and year_name='$input_year' ORDER BY m_id ASC LIMIT $start, $limit");
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
			<td><?php echo $row['word_no'];?></td>
			<td><?php echo $row['m_name'];?></td>
			<td><?php echo $row['dokaner_name'];?></td>
			<td><?php $dokan_no=$row['dokan_no']; echo $dokan_no;?></td>
			<td><?php echo $row['address'];?></td>
			<td><?php echo $row['m_vara'];?></td>
			<td><?php echo $row['mobile'];?></td>
			</tr>
			
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