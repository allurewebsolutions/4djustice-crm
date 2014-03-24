<?php include("includes/db.php"); ?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<title>Untitled Document</title>
</head>

<body>
<?php include("includes/main-nav.php"); ?>

<h1 class="title">Search Leads</h1>
<table cellpadding="10" cellspacing="0" border="1">
<tr>
<td align="center"><strong>Active</strong></td>
<td align="center"><strong>All</strong></td>
</tr>
<tr>
<td align="center">
<form action="search/leads-active.php" method="get">
  <input type="text" name="keyname" placeholder="Name or ID#" /><br /><br />
  <input type="submit" value="Go" />
</form>
</td>
<td align="center">
<form action="search/leads-all.php" method="get">
  <input type="text" name="keyname" placeholder="Name or ID#" /><br /><br />
  <input type="submit" value="Go" />
</form>
</td>
</tr>
</table>

<h1 class="title">Filter Leads</h1>
<table cellpadding="10" cellspacing="0" border="1">
<tr>
<td align="center"><strong>All Assigned To</strong></td>
<td align="center"><strong>Lead Status</strong></td>
<td align="center"><strong>Payment Status</strong></td>
<td align="center"><strong>Active Assigned To</strong></td>
<td align="center"><strong>PPL</strong></td>
<td align="center"><strong>All</strong></td>
</tr>
<tr>
<td align="center">
<form action="search/display-leads-assignedto-all.php" method="get">
    <p>
		<?php 
            $results = mysql_query("SELECT firstname, lastname FROM employees WHERE status='Active'");
            $output = "";
            echo "<select name='searchassigned' id='assignedto'>";
            while($row = mysql_fetch_array($results))
            {
                $output .= "<option value='" .$row['lastname'] . "'>" . $row['firstname'] . " " . $row['lastname'] .  "</option>";
            }
            echo $output;
            echo "</select>";
        ?>
    </p>
  <input type="submit" value="Go" />
</form>
</td>
<td align="center">
<form action="search/display-leads-status.php" method="get">
    <p>
        <select name="keyname" id="leadstatus">
			<?php 
                $results = mysql_query("SELECT leadstatus FROM leadstatuses");
                $output = "";
                while($row = mysql_fetch_array($results))
                {
                    $output .= "<option value='" . $row['leadstatus'] . "'>" . $row['leadstatus'] . "</option>";
                }
                echo $output;
                echo "</select>";
            ?>
      </select>
    </p>

  <input type="submit" value="Go" />
</form>
</td>
<td align="center">
<form action="search/display-leads-payment-status.php" method="get">
    <p>
        <select name="keyname" id="paymentstatus">
			<?php 
                $results = mysql_query("SELECT paymentstatus FROM paymentstatuses");
                $output = "";
                while($row = mysql_fetch_array($results))
                {
                    $output .= "<option value='" . $row['paymentstatus'] . "'>" . $row['paymentstatus'] . "</option>";
                }
                echo $output;
            ?>
        </select>
      
    </p>

  <input type="submit" value="Go" />
</form>
</td>
<td align="center">
<form action="search/display-leads-assignedto-active.php" method="get">
    <p>
		<?php 
            $results = mysql_query("SELECT firstname, lastname FROM employees");
            $output = "";
            echo "<select name='searchassigned' id='assignedto'>";
            while($row = mysql_fetch_array($results))
            {
                $output .= "<option value='" .$row['lastname'] . "'>" . $row['firstname'] . " " . $row['lastname'] .  "</option>";
            }
            echo $output;
            echo "</select>";
        ?>
    </p>
  <input type="submit" value="Go" />
</form>
</td>
<td align="center">
<form action="search/display-leads-ppl.php" method="get">
<p>
	<?php 
            $results = mysql_query("SELECT DISTINCT ppl FROM leads");
            $output = "";
            echo "<select name='keyname' id='ppl'>";
			echo "<option value='All'>All</option>";
            while($row = mysql_fetch_array($results))
            {
                $output .= "<option value='" .$row['ppl'] . "'>" . $row['ppl'] . " " .  "</option>";
            }
            echo $output;
            echo "</select>";
        ?>
</p>
  <input type="submit" value="Go" />
</form>
</td>
<td align="center">
<form action="search/display-all.php" method="get">
  <input type="submit" value="All Leads" />
</form>
</td>
</tr>
</table>

<h1 class="title">Search Attorneys</h1>
<table cellpadding="10" cellspacing="0" border="1">
<tr>
<td align="center"><strong>Display All</strong></td>
<td align="center"><strong>By Name or ID#</strong></td>
</tr>
<tr>
<td align="center">
<form action="search/display-attorneys-all.php">
  <input type="submit" value="Display All Attorneys" />
</form>
</td>
<td align="center">
<form action="search/display-attorneys.php" method="get">
  <input type="text" name="keyname" placeholder="Name, State, or ID#" />
  <br /><br />
  <input type="submit" value="Go" />
</form>
</td>
</tr>
</table>

</body>
</html>