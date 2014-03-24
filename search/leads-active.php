<?php include("../includes/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Display Active Leads</title>
<?php include("../includes/css-js.php"); ?>
</head>

<body>
<?php include("../includes/main-nav.php"); ?>

<?php include("../includes/display-headings.php"); ?>

<?php
//capture search term and remove spaces at its both ends if the is any
$searchTerm = trim($_GET['keyname']);

//check whether the name parsed is empty
if($searchTerm == "")
{
	echo "Enter the Name or ID # you are searching for.";
	exit();
}


//Search Through Leads
$query = "SELECT * FROM leads 
		  WHERE leadstatus != 'Dead' AND 
		  leadstatus != 'Closed' AND
		  (id LIKE '$searchTerm' ||
		  firstname LIKE '$searchTerm%' ||
		  lastname LIKE '%$searchTerm' ||
		  contactname LIKE '%$searchTerm%')
		  ";

$results = mysql_query($query);

?>

<?php include("../includes/display-table.php"); ?>
</table>

</body>

</html>