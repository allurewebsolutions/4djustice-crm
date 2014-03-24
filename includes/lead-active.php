<?php include("../includes/constants.php"); ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<script src="http://tablesorter.com/jquery-latest.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#table tr:even").css("background-color", "#eeeeee");
$("#table tr:odd").css("background-color", "#ffffff");
});
</script>
</head>

<body>
<?php include("../includes/main-nav.php"); ?>
<table border="1" cellspacing="0">
<thead>
<tr style="color:#000;">
	<th width="30">Actions</th>
    <th width="10">ID</th>
    <th>Date</th>
    <th>Status</th>
    <th>Follow Up</th>
    <th>Lead</th>
    <th>Contact</th>
    <th>Assigned Attorneys</th>
    <th>Case Details</th>
    <th>Case Notes</th>
    <th>Payment Details</th>
    <th>Logged/Assigned</th>
</tr>
</thead>
<?php
//capture search term and remove spaces at its both ends if the is any
$searchTerm = trim($_GET['keyname']);

//check whether the name parsed is empty
if($searchTerm == "")
{
	echo "Enter name you are searching for.";
	exit();
}


//Search Through Leads
$query = "SELECT * FROM leads 
		  WHERE id LIKE '$searchTerm' || 
		  lastname LIKE '$searchTerm' AND 
		  leadstatus != 'Dead' AND 
		  leadstatus != 'Closed'
		  ";

$results = mysqli_query($link, $query);

?>

<?php include("../includes/display-table.php"); ?>
</table>

</body>

</html>