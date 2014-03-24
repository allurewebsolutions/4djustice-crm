<?php include("../includes/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Display All Leads</title>
<?php include("../includes/css-js.php"); ?>
</head>

<body>
<?php include("../includes/main-nav.php"); ?>

<?php include("../includes/display-headings.php"); ?>
<?php

//Search Through Leads
$query = "SELECT * FROM leads";

$results = mysql_query($query);
?>

<?php include("../includes/display-table.php"); ?>

</table>
</body>
</html>