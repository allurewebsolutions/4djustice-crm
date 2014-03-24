<?php include("includes/db.php"); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Dashboard</title>
</head>

<body>
<?php include("includes/main-nav.php"); ?>
<?php $lastmont = date("Y-m-d"); echo $today; ?>
<?php
	$result = mysql_query("SELECT * FROM leads WHERE leadstatus!='Dead' AND paymentstatus!='Closed'");
	
	$result2 = mysql_query("SELECT * FROM leads WHERE leadstatus!='Dead' AND paymentstatus!='Closed' AND assignedto='Akira Saito'");
	
	$result3 = mysql_query("SELECT * FROM leads WHERE leadstatus!='Dead' AND paymentstatus!='Closed' AND assignedto='Mike Doubintchik'");
	
	$result4 = mysql_query("SELECT * FROM leads WHERE ppl='3Q' || ppl='TA'");
	
	$result5 = mysql_query("SELECT * FROM leads WHERE ppl='3Q' || ppl='TA' AND added > DATE_SUB( NOW(), INTERVAL 1 MONTH )");
	
	$result6 = mysql_query("SELECT * FROM leads WHERE leadstatus='Closed' AND paymentstatus='Closed'");
	
	$result7 = mysql_query("SELECT * FROM leads WHERE leadstatus='Closed' AND paymentstatus='Closed' AND added > DATE_SUB( NOW(), INTERVAL 1 MONTH )");
	
	$result8 = mysql_query("SELECT * FROM leads");
	
	$result9 = mysql_query("SELECT * FROM leads WHERE leadstatus='Closed' AND paymentstatus='Closed' AND assignedto='Akira Saito'");
	
	$result10 = mysql_query("SELECT * FROM leads WHERE leadstatus='Closed' AND paymentstatus='Closed' AND assignedto='Mike Doubintchik'");
	
	$result11 = mysql_query("SELECT * FROM leads WHERE ppl='Submit Later'");
	
	$result12 = mysql_query("SELECT (SUM(firstpaymentamount)+SUM(secondpaymentamount)+SUM(thirdpaymentamount)) AS total FROM leads WHERE paymentstatus='Closed' AND loggedby='Akira Saito' AND assignedto='Akira Saito'");
	$row = mysql_fetch_assoc($result12);
	
	$result13 = mysql_query("SELECT (SUM(firstpaymentamount)+SUM(secondpaymentamount)+SUM(thirdpaymentamount)) AS total FROM leads WHERE paymentstatus='Closed' AND loggedby='Mike Doubintchik' AND assignedto='Mike Doubintchik'");
	$row2 = mysql_fetch_assoc($result13);
	
 ?>
<p>Total Logged: <?php echo mysql_num_rows($result8);?></p>
<p>Total Active Leads: <?php echo mysql_num_rows($result);?></p>
<p>Total Active (Akira): <?php echo mysql_num_rows($result2);?></p>
<p>Total Active (Mike): <?php echo mysql_num_rows($result3);?></p>
<p>Total Submitted to PPL: <?php echo mysql_num_rows($result4);?></p>
<p>Total Submitted to PPL (Last 30 Days): <?php echo mysql_num_rows($result5);?></p>
<p>Total Closed: <?php echo mysql_num_rows($result6);?></p>
<p>Total Closed (Last 30 Days): <?php echo mysql_num_rows($result7);?></p>
<p>Total Closed (Akira): <?php echo mysql_num_rows($result9);?> ($<?=$row['total']?>)</p>
<p>Total Closed (Mike): <?php echo mysql_num_rows($result10);?> ($<?=$row2['total']?>)</p>
<p>Need to Submit to PPL: <a href="/search/display-leads-ppl.php?keyname=Submit+Later" target="_blank"><?php echo mysql_num_rows($result11);?></a></p>
</body>
</html>