<?php include("../includes/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Display Attorneys</title>
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
$query = "SELECT * FROM attorneys 
		  WHERE id LIKE '$searchTerm' || 
		  name LIKE '%$searchTerm%' ||
		  state LIKE '%$searchTerm%'
		  ";

$results = mysql_query($query);

?>

<table border="1" cellspacing="1" id="table">
<thead>
<tr style="color:#000;">
    <th width="20"></th>
    <th>Signup Date</th>
    <th>Status</th>
    <th>Attorney Details</th>
    <th>Contact Details</th>
    <th>Location</th>
    <th>Areas Served</th>
    <th>Agreement</th>
    <th>Notes</th>
</tr>
</thead>
<?php

/* check whethere there were matching records in the table
by counting the number of results returned */
if(mysqli_num_rows($results) >= 1)
{
	$output = "";
	while($row = mysqli_fetch_array($results))
	{
		$output .= "<tbody>";
		$output .= "<tr valign='top'>";
		$output .= "<td>" . $id = $row['id'];
		$output .= "<br /><br />";
		$output .= "<a href='../forms/attorney-edit.php?id=" . $row['id'] . "'><img src='../images/edit-icon.png' width='20' /></a>";
		$output .= "</td>";
		$output .= "<td>" . $added = $row['added'] . "</td>";
		$output .= "<td>" . $attorneystatus = $row['attorneystatus'] . "</td>";
		
		$output .= "<td>";
		$output .= "<strong>Name:</strong><br />" . $added = $row['name'];
		$output .= "<br /><br />";
		$output .= "<strong>Email:</strong><br />" . $updated = $row['email'];
		$output .= "<br /><br />";
		$output .= "<strong>Office Phone:</strong><br />" . $updated = $row['officephone'];
		$output .= "<br /><br />";
		$output .= "<strong>Mobile Phone:</strong><br />" . $updated = $row['mobilephone'];
		$output .= "</td>";
		
		$output .= "<td>";
		$output .= "<strong>Contact Name:</strong><br />" . $added = $row['contactname'];
		$output .= "<br /><br />";
		$output .= "<strong>Contact Email:</strong><br />" . $updated = $row['contactemail'];
		$output .= "<br /><br />";
		$output .= "<strong>Contact Phone:</strong><br />" . $updated = $row['contactphone'];
		$output .= "</td>";
		
		$output .= "<td>";
		$output .= "<strong>Address:</strong><br />" . $added = $row['address'];
		$output .= "<br /><br />";
		$output .= "<strong>City:</strong><br />" . $updated = $row['city'];
		$output .= "<br /><br />";
		$output .= "<strong>State:</strong><br />" . $updated = $row['state'];
		$output .= "<br /><br />";
		$output .= "<strong>Website:</strong><br />" . $updated = $row['url'];
		$output .= "</td>";
		
		$output .= "<td>";
		$output .= "<strong>Pratice Areas:</strong><br />" . $added = $row['practiceareas'];
		$output .= "</td>";
		$output .= "<td><strong>Monthly:</strong><br />" . $added = $row['monthly'];
		$output .= "<br /><br />";
		$output .= "<strong>Fee Agreement:</strong><br />" . $updated = $row['feeagreement'] . "%";
		$output .= "<br /><br />";
		$output .= "<strong>Invoice Method:</strong><br />" . $updated = $row['invoicemethod'];
		$output .= "</td>";
		
		$output .= "<td>";
		$output .= "<strong>Cases Closed:</strong><br />" . $added = $row['casesclosed'];
		$output .= "<br /><br />";
		$output .= "<strong>Notes:</strong><br />" . $updated = $row['notes'];
		$output .= "</td>";
		
		$output .= "</tr>";
		$output .= "</tbody>";
	}
	echo $output;
}
else
	echo "There was no matching record for the search: " . $searchTerm . "<br />";
?>
</table>
</body>
</html>