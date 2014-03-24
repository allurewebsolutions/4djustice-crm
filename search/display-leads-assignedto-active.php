<?php include("../includes/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Display All Active Leads Assigned to <?=$_GET['searchassigned']?></title>
<?php include("../includes/css-js.php"); ?>
</head>

<body>
<?php include("../includes/main-nav.php"); ?>
<?php include("../includes/display-headings.php"); ?>

<?php
//capture search term and remove spaces at its both ends if the is any
$searchAssigned = trim($_GET['searchassigned']);

//check whether the name parsed is empty
if($searchAssigned == "")
{
	echo "Enter name you are searching for.";
	exit();
}

//MYSQL search statement
$query = "SELECT * FROM leads 
		  WHERE assignedto LIKE '%$searchAssigned%' AND 
		  leadstatus != 'Dead' AND 
		  paymentstatus != 'Closed' 
		  ORDER BY updated DESC
		  ";

$results = mysql_query($query);

?>

<?php include("../includes/display-table.php"); ?>

</body>

</html>