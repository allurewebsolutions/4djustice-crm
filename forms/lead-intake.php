<?php include("../includes/db.php"); ?>
<?php include("../includes/func.php"); ?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Lead Intake</title>
 <?php include("../includes/css-js.php"); ?>
  <script>
  $(function() {
    var pickerOpts = {
       dateFormat:"yy-mm-dd"
    }; 
    $( "#datepicker" ).datepicker(pickerOpts);
  });
  </script>
<script type="text/javascript">
$(document).ready(function(){
$("#table tr:even").css("background-color", "#eeeeee");
$("#table tr:odd").css("background-color", "#ffffff");
});
</script>
</head>

<body>
<?php include("../includes/main-nav.php"); ?>
<div id="lead-intake-form">

<h1>Lead Intake Form</h1>
 
<form name="user_details" id="" method="post" action="../insert/lead.php">
	
    <fieldset>
    <h2>Contact Details</h2>
    <p>
    	<input type="text" name="firstname" id="firstname" placeholder="First Name" required />
    	<input type="text" name="lastname" id="lastname" placeholder="Last Name" required />
    </p>
    <p>
    	<input type="text" name="zip" id="zip" placeholder="Zip Code" />
        <!--<select name="state" id="state" required>
        
          <option value="" selected="selected" disabled="disabled">State</option>
          
          <?php //getstates(); ?>
        
        </select>
        
        <span id="wait_2" style="display: none;">
        <img alt="Please Wait" src="../images/ajax-loader.gif"/>
        </span>
        <span id="result_2" style="display: none;"></span>-->
    </p>
    <p>
    	<input type="text" name="leadphone" id="leadphone" placeholder="Lead Phone" />
    	<input type="text" name="leademail" id="leademail" placeholder="Lead Email" />
    </p>
    <p>
    	<input type="text" name="contactname" id="contactname" placeholder="Contact Name" />
    	<input type="text" name="contactphone" id="contactphone" placeholder="Contact Phone" />
    	<input type="text" name="contactemail" id="contactemail" placeholder="Contact Email" />
        <select name="contactrelationship">
        	<option value=" " disabled="disabled" selected="selected">Contact Relationship</option>
			<?php 
                $result = mysql_query("SELECT contactrelationship FROM contactrelationships ORDER BY contactrelationship ASC") 
                or die(mysql_error());
                while($row = mysql_fetch_array($result))
                {
                     echo '<option value="'.$row['contactrelationship'].'">'.$row['contactrelationship'].'</option>';
                }
            ?>
        </select>
    </p>
    </fieldset>
    
    <br />
    
    <fieldset>
    <h2>Case Details</h2>
    <p>
        <select name="practicearea" id="practicearea" required>
        
          <option value="" selected="selected" disabled="disabled">Main Practice Area</option>
          
          <?php getpracticeareas(); ?>
        
        </select>
        
        <span id="wait_1" style="display: none;">
        <img alt="Please Wait" src="../images/ajax-loader.gif"/>
        </span>
        <span id="result_1" style="display: none;"></span> 
    </p>
    <p>
    	<select name="fundingsource" required>
        	<option value=" " disabled="disabled" selected="selected">Funding Source</option>
			<?php 
                $result = mysql_query("SELECT fundingsource FROM fundingsources ORDER BY fundingsource ASC") 
                or die(mysql_error());
                while($row = mysql_fetch_array($result))
                {
                    echo '<option value="'.$row['fundingsource'].'">'.$row['fundingsource'].'</option>';
                }
            ?>
        </select>
    </p>
	<p>
    	<input type="text" id="datepicker" name="courtdate" placeholder="Court Date" />
    </p>
    <p>
    	<textarea name="casedetails" id="casedetails" rows="5" cols="60" placeholder="Case Details"></textarea>
    </p>
    
    </fieldset>
    
    <br />
    
    <fieldset>
    <h2>Case Management Details</h2>
    
    <p>
    	<select name="attorney">
        	<option value=" " disabled="disabled" selected="selected">Main Attorney</option>
            <option value="Need Attorney">Need Attorney</option>
			<?php 
                $result = mysql_query("SELECT name FROM attorneys ORDER BY name ASC") 
                or die(mysql_error());
                while($row = mysql_fetch_array($result))
                {
                    echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                }
            ?>
        </select>
    	<select name="attorney2">
        	<option value="" disabled selected="selected">Attorney 2</option>
			<?php 
                $result = mysql_query("SELECT name FROM attorneys ORDER BY name ASC") 
                or die(mysql_error());
                while($row = mysql_fetch_array($result))
                {
                    echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                }
            ?>
        </select>
    	<select name="attorney3">
        	<option value="" disabled selected="selected">Attorney 3</option>
			<?php 
                $result = mysql_query("SELECT name FROM attorneys ORDER BY name ASC") 
                or die(mysql_error());
                while($row = mysql_fetch_array($result))
                {
                    echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                }
            ?>
        </select>
    </p>
    
    <p>
    	<select name="loggedby" required>
        	<option value=" " disabled="disabled" selected="selected">Logged By</option>
			<?php 
                $result = mysql_query("SELECT firstname, lastname FROM employees WHERE status='Active'") 
                or die(mysql_error());
                while($row = mysql_fetch_array($result))
                {
                    echo '<option value="'.$row['firstname']. ' '.$row['lastname'].'">'.$row['firstname']. ' '.$row['lastname'].'</option>';
                }
            ?>
        </select>
    	<select name="assignedto" required>
        	<option value=" " disabled="disabled" selected="selected">Assigned To</option>
            <option value="Unassigned">Unassigned</option>
			<?php 
                $result = mysql_query("SELECT firstname, lastname FROM employees WHERE status='Active'") 
                or die(mysql_error());
                while($row = mysql_fetch_array($result))
                {
                    echo '<option value="'.$row['firstname']. ' '.$row['lastname'].'">'.$row['firstname']. ' '.$row['lastname'].'</option>';
                }
            ?>
        </select>
        <strong>Next:</strong>
<?php
			$result = mysql_query("SELECT assignedto FROM leads ORDER BY id DESC LIMIT 1") 
            or die(mysql_error());
            $row = mysql_fetch_assoc($result);
			if ($row['assignedto'] == "Akira Saito") {
				echo "Mike Doubintchik";
			}
			elseif ($row['assignedto'] == "Mike Doubintchik") {
				echo "Akira Saito";
			}
			else {
				echo "Mike Doubintchik";
			}
		?>
    </p>
    <p>
    	<label><strong>PPL:</strong></label><br />
      	<label>TA</label><input type="checkbox" name="ppl[]" id="TA" value="TA" />
        <label>3Q</label><input type="checkbox" name="ppl[]" id="3q" value="3Q" />
        <label>LR</label><input type="checkbox" name="ppl[]" id="lr" value="LR" />
      	<label>None</label><input type="checkbox" name="ppl[]" id="None" value="None" />
      	<label>Submit Later</label><input type="checkbox" name="ppl[]" id="Later" value="Submit Later" />
    </p>
	<p>
    	<input type="submit" name="submit" value="Submit" /> <input type="reset" name="reset" value="Reset" />
    </p>
    
    <p>
    	Insta Dead<input type="checkbox" name="instadead" value="Yes" />
    </p>
    
    </fieldset>
    
</form>
<br />
<style id="search_style"></style>
<input type="text" placeholder="Filter by Name, City, State, Practice Area" id="Filter" style="width:300px;height:20px;margin-bottom:10px;">
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
<table border="1" cellpadding="2" cellspacing="0" id="table">
	<tr>
    	<td align="center"><strong>Status</strong></td>
    	<td align="center"><strong>Attorney</strong></td>
        <td align="center"><strong>City</strong></td>
        <td align="center"><strong>State</strong></td>
        <td align="center"><strong>Phones</strong></td>
        <td align="center"><strong>Notes</strong></td>
    </tr>
<?php

	$result = mysql_query("SELECT * FROM attorneys ORDER BY state ASC") 
    or die(mysql_error());

/* check whethere there were matching records in the table
by counting the number of results returned */
	$output = "";
	while($row = mysql_fetch_array($result))
	{
		$output .= "<tr class='searchable' data-index='" . strtolower($row['name']).strtolower($row['city']).strtolower($row['state']).strtolower($row['practiceareas']) . "'>";
		$output .= "<td align=\"center\">" . $row['attorneystatus'] . "</td>";
		$output .= "<td align=\"center\"><a href=\"javascript:window.open('/includes/attorney-cities.php?attorney=".$row['name']."','".$row['name']."','width=500,height=500')\">" . $row['name'] . "</a></td>";
		$output .= "<td align=\"center\">" . $row['city'] . "</td>";
		$output .= "<td align=\"center\">" . $row['state'] . "</td>";
		$output .= "<td align=\"left\"><b>Office:</b>" . $row['officephone'] . "<br /><b>Mobile:</b>" . $row['mobilephone'] . "</td>";
		$output .= "<td align=\"center\">" . $row['notes'] . "</td>";
		$output .= "</tr>";
	}
	echo $output;
?>
</table>
</div>
<p style="clear:both">&nbsp;</p>
</body>
</html>