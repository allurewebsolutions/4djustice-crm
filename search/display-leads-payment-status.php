<?php include("../includes/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Display <?=$_GET['keyname']?> Leads</title>
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
	echo "Enter name you are searching for.";
	exit();
}


//MYSQL search statement
$query = "SELECT * FROM leads 
		  WHERE paymentstatus LIKE '$searchTerm' 
		  AND leadstatus != 'Dead' 
		  ";

$results = mysql_query($query);

?>

<?php include("../includes/display-table.php"); ?>
</table>

</body>

</html>