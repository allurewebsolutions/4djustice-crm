<?php include("../includes/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Display All Attorneys</title>
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
<input type="text" placeholder="Filter by ID, Name, Contact Name, City, State, Fee Agreement" id="Filter" style="width:400px;height:25px;margin-bottom:10px;">
<style id="search_style"></style>
<script type="text/javascript">
var searchStyle = document.getElementById('search_style');
document.getElementById('Filter').addEventListener('input', function() {
  if (!this.value) {
    searchStyle.innerHTML = "";
    return;
  }
  // look ma, no indexOf!
  searchStyle.innerHTML = ".searchable:not([data-index*=\"" + this.value.toLowerCase() + "\"]) { display: none; }";
  // beware of css injections!
});
</script>
<table border="1" cellspacing="1" id="table">
<thead>
<tr style="color:#000;">
    <th width="20"></th>
    <th>Signup Date</th>
    <th>Status</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Contact</th>
    <th>City</th>
    <th>State</th>
    <th>Practice Areas</th>
    <th>Notes</th>
</tr>
</thead>
<?php
	$result = mysql_query("SELECT * FROM attorneys ORDER BY state ASC") 
	or die(mysql_error());
if(mysql_num_rows($result) >= 1)
{
	$output = "";
	while($row = mysql_fetch_array($result)) {
		$output .= "<tbody>";
		$output .= "<tr valign='top' class='searchable' data-index='" . str_replace(' ', '', strtolower($row['attorneystatus'])).str_replace(' ', '', strtolower($row['name'])).str_replace(' ', '', strtolower($row['contactname'])).$row['id'].str_replace(' ', '', strtolower($row['city'])).str_replace(' ', '', strtolower($row['state'].$row['feeagreement'])). "'>";
		$output .= "<td>" . $row['id'];
		$output .= "<br /><br />";
		$output .= "<a href='../forms/attorney-edit.php?id=" . $row['id'] . "'><img src='../images/edit-icon.png' width='20' /></a>";
		$output .= "</td>";
		$output .= "<td>" . $row['added'] . "</td>";
		$output .= "<td>" . $row['attorneystatus'] . "</td>";
		
		$output .= "<td>";
		$output .= $row['name'];
		$output .= "</td>";
		$output .= "<td>";
		$output .= "<strong>Office Phone:</strong><br />" . $row['officephone'];
		$output .= "<br /><br />";
		$output .= "<strong>Mobile Phone:</strong><br />" . $row['mobilephone'];
		$output .= "</td>";
		$output .= "<td>";
		$output .= $row['email'];
		$output .= "</td>";
		
		$output .= "<td>";
		$output .= $row['contactname'];
		$output .= "<br /><br />";
		$output .= $row['contactemail'];
		$output .= "<br /><br />";
		$output .= $row['contactphone'];
		$output .= "</td>";
		
		$output .= "<td>";
		$output .= $row['city'];
		$output .= "</td>";
		$output .= "<td>";
		$output .= $row['state'];
		$output .= "</td>";
		
		$output .= "<td>";
		$output .= $row['practiceareas'];
		$output .= "</td>";
		
		$output .= "<td>";
		$output .= $row['notes'];
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