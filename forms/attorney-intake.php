<?php include("../includes/db.php"); ?>
<?php include("../includes/func.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Add Attorney</title>
<?php include("../includes/css-js.php"); ?>
<script src="http://www.ryancramer.com/projects/asmselect/examples/jquery.js"></script>
<script type="text/javascript" src="http://www.ryancramer.com/projects/asmselect/jquery.asmselect.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.ryancramer.com/projects/asmselect/jquery.asmselect.css" />
 
 	<script type="text/javascript">

	$(document).ready(function() {
    $("select[multiple]").asmSelect();
}); 
	</script>
</head>

<body>
<?php include("../includes/main-nav.php"); ?>
<h1>Add Attorney</h1>
 
<form name="attorney_details" id="attorney-intake" method="post" action="../insert/attorney.php">
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
    <p>
    	<input type="text" name="name" id="name" placeholder="Full Name" required="required" />
    </p>
    <p>
    	<input type="text" name="officephone" id="officephone" placeholder="Office Phone" required="required" />
    	<input type="text" name="mobilephone" id="mobilephone" placeholder="Mobile Phone" required="required" />
    	<input type="text" name="email" id="email" placeholder="Email" required="required" />
    </p>
    <p>
    	<input type="text" name="contactname" id="contactname" placeholder="Contact Name" />
    	<input type="text" name="contactphone" id="contactphone" placeholder="Contact Phone" />
    	<input type="text" name="contactemail" id="contactemail" placeholder="Contact Email" />
    </p>
    <p>
    	<input type="text" name="address" id="address" placeholder="Address" />
    	<input type="text" name="zip" id="zip" placeholder="Zip Code" />
        <select name="state" id="state" required>
        
          <option value="" selected="selected" disabled="disabled">State</option>
          
          <?php getstates(); ?>
        
        </select>
        
        <span id="wait_2" style="display: none;">
        <img alt="Please Wait" src="../images/ajax-loader.gif"/>
        </span>
        <span id="result_2" style="display: none;"></span> 
        <input type="text" name="url" id="url" placeholder="Website" />
    </p>
    <p>
    	<select name="practiceareas[]" multiple="practiceareas" title="Select Revelant Practice Areas" required="required">
			<?php 
                $result = mysql_query("SELECT DISTINCT practicearea FROM practiceareas ORDER BY practicearea ASC") 
                or die(mysql_error());
                while($row = mysql_fetch_array($result))
                {
                    echo '<option value="'.$row['practicearea'].'">'.$row['practicearea'].'</option>';
                }
            ?>
        </select>
    </p>
    <p>
    	<label>Monthly Agreement:</label>
        	<select name="monthly" required="required">
            	<option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        <input type="text" name="feeagreement" id="feeagreement" placeholder="Fee Agreement (% or PPL)" required="required" />
    	<label>Invoice Method:</label>
        	<select name="invoicemethod" required="required">
            	<option value="Email">Email</option>
                <option value="Phone">Phone</option>
            </select>
    </p>
    <p>
    	<label>Notes:</label><br />
    	<textarea name="notes" id="notes" rows="5" cols="60"></textarea>
    </p>
    <p>
    	<label>Status</label>
        	<select name="attorneystatus" required="required">
            	<option value="<img src=../images/active-icon.png width=15 />">Active</option>
                <option value="<img src=../images/backup-icon.png width=15 />">Backup</option>
            	<option value="<img src=../images/pending-icon.png width=15 />">Pending</option>
                <option value="<img src=../images/replace-icon.png width=15 />">Replace</option>
                <option value="<img src=../images/inactive-icon.png width=15 />">Inactive</option>
            </select>
    </p>
	<p>
    	<input type="submit" name="submit" value="Submit" /> <input type="reset" name="reset" value="Reset" />
    </p>
</form>
<script>
$("#attorney-intake").validate();
</script>
</body>
</html>