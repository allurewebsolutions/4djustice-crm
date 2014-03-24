<?php include("../includes/db.php"); ?>
<?php 
	$idvalue = mysql_real_escape_string($_GET['id']);
	$result = mysql_query("SELECT * FROM leads WHERE id LIKE '$idvalue'") 
	or die(mysql_error());
	while($row = mysql_fetch_array($result)) {
		$id = $row['id'];
		$added = $row['added'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $leadphone = $row['leadphone'];
        $leademail = $row['leademail'];
        $contactname = $row['contactname'];
        $contactphone = $row['contactphone'];
        $contactemail = $row['contactemail'];
		$contactrelationship = $row['contactrelationship'];
        $city = $row['city'];
        $state = $row['state'];
		$practicearea = $row['practicearea'];
		$subpracticearea = $row['subpracticearea'];
		$fundingsource = $row['fundingsource'];
        $casedetails = $row['casedetails'];
		$casenotes = $row['casenotes'];
		$attorney = $row['attorney'];
		$attorney2 = $row['attorney2'];
		$attorney3 = $row['attorney3'];
		$assignedto = $row['assignedto'];
		$loggedby = $row['loggedby'];
		$leadfollowup = $row['leadfollowup'];
		$attorneyfollowup = $row['attorneyfollowup'];
		$followup = $row['followup'];
		$leadstatus = $row['leadstatus'];
		$quote = $row['quote'];
		$paymentstatus = $row['paymentstatus'];
		$firstpaymentamount = $row['firstpaymentamount'];
		$secondpaymentamount = $row['secondpaymentamount'];
		$thirdpaymentamount = $row['thirdpaymentamount'];
		$firstpaymentdate = $row['firstpaymentdate'];
		$secondpaymentdate = $row['secondpaymentdate'];
		$thirdpaymentdate = $row['thirdpaymentdate'];
		$ppl = explode(",",$row['ppl']);
		$zip = $row['zip'];
		$courtdate = $row['courtdate'];
	}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $firstname . " " . $lastname;?></title>
  <?php include("../includes/css-js.php"); ?>
  <script>
  $(function() {
    var pickerOpts = {
       dateFormat:"yy-mm-dd"
    }; 
    $( "#datepicker" ).datepicker(pickerOpts);
  });
  $(function() {
    var pickerOpts = {
       dateFormat:"yy-mm-dd"
    }; 
    $( "#datepicker2" ).datepicker(pickerOpts);
  });
  $(function() {
    var pickerOpts = {
       dateFormat:"yy-mm-dd"
    }; 
    $( "#datepicker3" ).datepicker(pickerOpts);
  });
  $(function() {
    var pickerOpts = {
       dateFormat:"yy-mm-dd"
    }; 
    $( "#datepicker4" ).datepicker(pickerOpts);
  });
  $(function() {
    var pickerOpts = {
       dateFormat:"yy-mm-dd"
    }; 
    $( "#datepicker5" ).datepicker(pickerOpts);
  });
  $(function() {
    var pickerOpts = {
       dateFormat:"yy-mm-dd"
    }; 
    $( "#datepicker6" ).datepicker(pickerOpts);
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

<h1>Edit Lead Form</h1>
<form name="user_details" id="" method="post" action="../insert/edited-lead.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
<div style="display:block; border:2px solid #333; margin-bottom:15px; padding:5px;">
<h2>Contact Details</h2>
    <p>
    	<input type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" placeholder="First Name" required />
    	<input type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>" placeholder="Last Name" />
    </p>
    <p>
    	<input type="text" name="leadphone" id="leadphone" value="<?php echo $leadphone; ?>" placeholder="Phone" />
    	<input type="text" name="leademail" id="leademail" value="<?php echo $leademail; ?>" placeholder="Email" />
    </p>
<h3>Location</h3>
    <p>
    	<input type="text" name="city" value="<?=$city?>" placeholder="City" />
        <input type="text" name="state" value="<?=$state?>" placeholder="State" />
    	<input type="text" name="zip" value="<?=$zip?>" placeholder="Zip Code" />
    </p>
    </p>
<h3>Lead Contact Person</h3>
    <p>
    	<input type="text" name="contactname" id="contactname"  value="<?php echo $contactname; ?>" placeholder="Contact Name"/>
    	<input type="text" name="contactphone" id="contactphone" value="<?php echo $contactphone; ?>" placeholder="Contact Phone" />
    	<input type="text" name="contactemail" id="contactemail" value="<?php echo $contactemail; ?>" placeholder="Contact Email" />
		<?php 
            echo "<strong>" . $contactrelationship . "</strong>";
        ?>
    </p>
</div>
<div style="display:block; border:2px solid #333; margin-bottom:15px; padding:5px;">
<h2>Case Details</h2>
	<p>
		<?php 
            echo "<label><strong>Funding Source:</strong> </label>";
            echo $fundingsource;
        ?>
    </p>
    <p>
    	<strong>Main Practice Area: </strong><?=$practicearea?>
    </p>
    <p>
        <select name="subpracticearea">
        	<option value="<?=$subpracticearea?>" selected><?=$subpracticearea?></option>
			<?php 
                $result = mysql_query("SELECT * FROM practiceareas WHERE practicearea='$practicearea' ORDER BY subpracticearea ASC") 
                or die(mysql_error());
                while($row = mysql_fetch_array($result))
                {
					echo '<option value="'.$row['subpracticearea'].'">'.$row['subpracticearea'].'</option>';
                }
            ?>
        </select>
    </p>
    <p>
    	<label><strong>Next Court Date:</strong> </label>
        <input type="text" id="datepicker6" name="courtdate" value="<? echo $courtdate; ?>" />
    </p>
    <p>
    	<textarea name="casedetails" id="casedetails" rows="5" cols="60" placeholder="Case Details"><?php echo $casedetails; ?></textarea>
    </p>
    <p>
    	<textarea name="casenotes" id="casenotes" rows="5" cols="60" placeholder="Notes"><?php echo $casenotes; ?></textarea>
    </p>
    <p>
    	<label><strong>PPL:</strong></label>
    </p>
    <p>
      <label>TA</label><input type="checkbox" name="ppl[]" id="TA" value="TA" <?php echo (in_array('TA',$ppl)) ? 'checked="checked"' : ''; ?> />
      <label>3Q</label><input type="checkbox" name="ppl[]" id="3Q" value="3Q" <?php echo (in_array('3Q',$ppl)) ? 'checked="checked"' : ''; ?> />
      <label>LR</label><input type="checkbox" name="ppl[]" id="LR" value="LR" <?php echo (in_array('LR',$ppl)) ? 'checked="checked"' : ''; ?> />
      <label>None</label><input type="checkbox" name="ppl[]" id="None" value="None" <?php echo (in_array('None',$ppl)) ? 'checked="checked"' : ''; ?> />
      <label>Submit Later</label><input type="checkbox" name="ppl[]" id="Later" value="Submit Later" <?php echo (in_array('Submit Later',$ppl)) ? 'checked="checked"' : ''; ?> />
    </p>
</div>
<div style="display:block; border:2px solid #333; margin-bottom:15px; padding:5px;">
<h2>Follow Up Details</h2>
    <p>
        <label><strong>Assigned to:</strong> </label>
    	<select name="assignedto" required>
            <option value="Unassigned">Unassigned</option>
			<?php 
                $result = mysql_query("SELECT firstname, lastname FROM employees") 
                or die(mysql_error());
                while($row = mysql_fetch_array($result))
                {
					echo '<option value="'.$row['firstname']. ' '.$row['lastname'].'" '.(($row['firstname']. ' '.$row['lastname']==$assignedto)?'selected="selected"':"").'>'.$row['firstname']. ' '.$row['lastname'].'</option>';
                }
            ?>
        </select>
   </p>
   <p>
		<?php 
            echo "<label><strong>Logged by:</strong> </label>";
			echo $loggedby;
        ?>
    </p>
    <p>
        <label><strong>Lead Status:</strong> </label>
    	<select name="leadstatus" required>
			<?php 
                $result = mysql_query("SELECT leadstatus FROM leadstatuses") 
                or die(mysql_error());
                while($row = mysql_fetch_array($result))
                {
					echo '<option value="'.$row['leadstatus'].'" '.(($row['leadstatus']==$leadstatus)?'selected="selected"':"").'>'.$row['leadstatus'].'</option>';
                }
            ?>
        </select>
   </p>
    <p>
    	<label><strong>Follow Up With:</strong></label>
        <select name="followup" id="followup">
            <option value="<?=$followup?>" selected><?=$followup?><option>
            <option value="Follow Up - Lead">Follow Up - Lead<option>
            <option value="Follow Up - Attorney">Follow Up - Attorney<option>
            <option value="Follow Up - Both">Follow Up - Both<option>
        </select><br />
        
    	<label><strong>Lead:</strong></label>
        <input type="text" id="datepicker" name="leadfollowup" value="<?=$leadfollowup?>" />

    	<label><strong>Attorney:</strong></label>
    	<input type="text" id="datepicker2" name="attorneyfollowup" value="<?=$attorneyfollowup?>" />
    </p>
    <p>
    	<label><strong>Attorney 1:</strong></label>
    	<select name="attorney">
        	<?php 
				if ($attorney!=''){
					echo '<option value="">Unassign</option>';
				}
				else {
					echo '<option value=""></option>';
				}
					
			?>
            <option value="Need Attorney" <?=(($attorney=='Need Attorney')?'selected="selected"':"")?>>Need Attorney</option>
			<?php 
                $result = mysql_query("SELECT name FROM attorneys ORDER BY name ASC") 
                or die(mysql_error());
                while($row = mysql_fetch_array($result))
                {
                    echo '<option value="'.$row['name'].'" '.(($row['name']==$attorney)?'selected="selected"':"").'>'.$row['name'].'</option>';
                }
            ?>
        </select>
    </p>
    <p>
			<?php 
				$attorneysearch=mysql_real_escape_string($attorney);
				$result = mysql_query("SELECT * FROM attorneys WHERE name LIKE '$attorneysearch'") 
                or die(mysql_error());
				$row = mysql_fetch_assoc($result);
				if ($attorney!='' AND $attorney!='Need Attorney') {
					echo '<strong>Attorney Office Phone:</strong> '.$row['officephone'].'<br />';
					echo '<strong>Attorney Mobile Phone:</strong> '.$row['mobilephone'].'<br />';
					echo '<strong>Attorney Email:</strong> '.$row['email'].'<br/>';
					echo '<strong>Fee Agreement:</strong> '.$row['feeagreement'].'<br />';
				}
            ?>
    </p>
    <p>
    	<label><strong>Attorney 2:</strong></label>
	    <select name="attorney2">
        	<?php 
				if ($attorney2!=''){
					echo '<option value="">Unassign</option>';
				}
			?>
        	<option value="<?=$attorney2?>" selected><?=$attorney2?></option>
            <option value="Need Attorney">Need Attorney</option>
			<?php 
                $result = mysql_query("SELECT name FROM attorneys ORDER BY name ASC") 
                or die(mysql_error());
                while($row = mysql_fetch_array($result))
                {
                    echo '<option value="'.$row['name'].'" '.(($row['name']==$attorney2)?'selected="selected"':"").'>'.$row['name'].'</option>';
                }
            ?>
        </select>
    </p>
    <p>
			<?php 
				$attorney2search=mysql_real_escape_string($attorney2);
				$result = mysql_query("SELECT * FROM attorneys WHERE name LIKE '$attorney2search'") 
                or die(mysql_error());
				$row = mysql_fetch_assoc($result);
				if ($attorney2!='' AND $attorney2!='Need Attorney') {
					echo '<strong>Attorney Office Phone:</strong> '.$row['officephone'].'<br />';
					echo '<strong>Attorney Mobile Phone:</strong> '.$row['mobilephone'].'<br />';
					echo '<strong>Attorney Email:</strong> '.$row['email'].'<br/>';
					echo '<strong>Fee Agreement:</strong> '.$row['feeagreement'].'<br />';
				}
            ?>
    </p>
    <p>
    	<label><strong>Attorney 3:</strong></label>
	    <select name="attorney3">
        	<?php 
				if ($attorney3!=''){
					echo '<option value="">Unassign</option>';
				}
			?>
        	<option value="<?=$attorney3?>" selected><?=$attorney3?></option>
            <option value="Need Attorney">Need Attorney</option>
			<?php 
                $result = mysql_query("SELECT name FROM attorneys ORDER BY name ASC") 
                or die(mysql_error());
                while($row = mysql_fetch_array($result))
                {
                    echo '<option value="'.$row['name'].'" '.(($row['name']==$attorney3)?'selected="selected"':"").'>'.$row['name'].'</option>';
                }
            ?>
        </select>
    </p>
    <p>
			<?php 
				$attorney3search=mysql_real_escape_string($attorney3);
				$result = mysql_query("SELECT * FROM attorneys WHERE name LIKE '$attorney3search'") 
                or die(mysql_error());
				$row = mysql_fetch_assoc($result);
				if ($attorney3!='' AND $attorney3!='Need Attorney') {
					echo '<strong>Attorney Office Phone:</strong> '.$row['officephone'].'<br />';
					echo '<strong>Attorney Mobile Phone:</strong> '.$row['mobilephone'].'<br />';
					echo '<strong>Attorney Email:</strong> '.$row['email'].'<br/>';
					echo '<strong>Fee Agreement:</strong> '.$row['feeagreement'].'<br />';
				}
            ?>
    </p>
</div>
<div style="display:block; border:2px solid #333; margin-bottom:15px; padding:5px;">
<h2>Payment Details</h2>
    <p>
        <select name="paymentstatus" id="paymentstatus">
        	<?php 
				if ($paymentstatus==''){
					echo '<option value="" disabled="disabled" selected="selected">Payment Status</option>';
				}
			?>
			<?php 
                $result = mysql_query("SELECT paymentstatus FROM paymentstatuses") 
                or die(mysql_error());
                while($row = mysql_fetch_array($result))
                {
					echo '<option value="'.$row['paymentstatus'].'" '.(($row['paymentstatus']==$paymentstatus)?'selected="selected"':"").'>'.$row['paymentstatus'].'</option>';
                }
                echo $output;
                echo "</select>";
            ?>
        </select>
    </p>
    <p>
    	<label>Total Quote:</label> <input type="text" name="quote" id="quote" value="<?php echo $quote; ?>" />
    </p>
    <p>
    	<?php 
			$result = mysql_query("SELECT * FROM attorneys WHERE name LIKE '$attorneysearch'") 
            or die(mysql_error());
			$row = mysql_fetch_assoc($result);
			if ($quote!='0') {
				echo 'Wiselaws Share: $'.$quote*($row['feeagreement']/100);
			}
		?>
    </p>
    <p>
    	<label>1st Payment Amount:</label> <input type="text" name="firstpaymentamount" id="firstpaymentamount" value="<?=$firstpaymentamount?>" />
        <label>Date(Invoice/Due/Received):</label><input type="text" id="datepicker3" name="firstpaymentdate" value="<?=$firstpaymentdate?>" />
        <br />
        <a target="_blank" href="../invoicing/generate-invoice.php?id=<?=$idvalue?>&payment=firstpaymentamount"><img src="../images/invoice-icon.png" width="20" /></a>
    </p>
    <p>
        <label>2nd Payment Amount:</label> <input type="text" name="secondpaymentamount" id="secondpaymentamount" value="<?=$secondpaymentamount?>" />
        <label>Date(Invoice/Due/Received):</label><input type="text" id="datepicker4" name="secondpaymentdate" value="<?=$secondpaymentdate?>" />
        <br />
        <a target="_blank" href="../invoicing/generate-invoice.php?id=<?php echo $idvalue; ?>&payment=secondpaymentamount"><img src="../images/invoice-icon.png" width="20" /></a>
    </p>
    <p>
        <label>3rd Payment Amount:</label> <input type="text" name="thirdpaymentamount" id="thirdpaymentamount" value="<?=$thirdpaymentamount?>" />
        <label>Date(Invoice/Due/Received):</label><input type="text" id="datepicker5" name="thirdpaymentdate" value="<?=$thirdpaymentdate?>" />
        <br />
        <a target="_blank" href="../invoicing/generate-invoice.php?id=<?=$idvalue?>&payment=thirdpaymentamount"><img src="../images/invoice-icon.png" width="20" /></a>
    </p>
	<p>
    	<input type="submit" name="submit" value="Submit" /> <input type="reset" name="reset" value="Reset" />
    </p>
</div>
</form>

</div>
</body>
</html>