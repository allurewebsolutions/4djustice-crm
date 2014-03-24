<?php include("../includes/db.php"); ?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script type="text/javascript" src="http://www.ryancramer.com/projects/asmselect/jquery.asmselect.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <link rel="stylesheet" type="text/css" href="http://www.ryancramer.com/projects/asmselect/jquery.asmselect.css" />
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
  </script>

<script type="text/javascript">
$(document).ready(function(){
$("#table tr:even").css("background-color", "#eeeeee");
$("#table tr:odd").css("background-color", "#ffffff");
});
</script>
 	<script type="text/javascript">

	$(document).ready(function() {
    $("select[multiple]").asmSelect();
}); 
	</script>
</head>

<body>
<?php include("../includes/main-nav.php"); ?>
<div id="lead-intake-form" style="float:left;">

<h1>Edit Attorney</h1>
<?php 
	$idvalue = $_GET['id'];
	$result = mysql_query("SELECT * FROM attorneys WHERE id LIKE '$idvalue'") 
	or die(mysql_error());
	while($row = mysql_fetch_array($result)) {
		$id = $row['id'];
		$added = $row['added'];
		$attorneystatus = $row['attorneystatus'];
        $name = $row['name'];
        $email = $row['email'];
        $officephone = $row['officephone'];
		$mobilephone = $row['mobilephone'];
        $contactname = $row['contactname'];
        $contactphone = $row['contactphone'];
        $contactemail = $row['contactemail'];
		$address = $row['address'];
        $city = $row['city'];
		$zip = $row['zip'];
        $state = $row['state'];
		$url = $row['url'];
		$practiceareas = $row['practiceareas'];
        $invoicemethod = $row['invoicemethod'];
		$monthly = $row['monthly'];
		$feeagreement = $row['feeagreement'];
		$casesclosed = $row['casesclosed'];
		$notes = $row['notes'];
	}
?>
<form name="attorney_details" id="attorney-edit" method="post" action="../insert/edited-attorney.php">
  <input type="hidden" name="id" value="<?=$id?>" />
  <p>
    <input type="text" name="name" id="name" value="<?=$name?>" placeholder="Full Name" required />
  </p>
  <p>
    <input type="text" name="officephone" id="officephone" value="<?=$officephone?>" placeholder="Office Phone" required />
    <input type="text" name="mobilephone" id="mobilephone" value="<?=$mobilephone?>" placeholder="Mobile Phone" />
    <input type="text" name="email" id="email" value="<?=$email?>" placeholder="Email" required />
  </p>
  <p>
    <input type="text" name="contactname" id="contactname" value="<?=$contactname?>" placeholder="Contact Name" />
    <input type="text" name="contactphone" id="contactphone" value="<?=$contactphone?>" placeholder="Contact Phone" />
    <input type="text" name="contactemail" id="contactemail" value="<?=$contactemail?>" placeholder="Contact Email" />
  </p>
  <p>
    <input type="text" name="address" id="address" value="<?=$address?>" placeholder="Address" />
    <input type="text" name="city" id="city" value="<?=$city?>" placeholder="City" required />
    <input type="text" name="zip" id="zip" value="<?=$zip?>" placeholder="Zip Code" required />
    <input type="text" name="url" id="url" value="<?=$url?>" placeholder="Website" />
  </p>
  <p>
  	<strong>Locations Served:</strong><br />
    	<ul style="display:block;width:600px;float:left;">
       	<?php 
			$result = mysql_query("SELECT DISTINCT city,state_code FROM cities WHERE attorney1='$name' OR attorney2='$name' OR attorney3='$name' ORDER BY city ASC") 
			or die(mysql_error());
			while($row = mysql_fetch_array($result))
			{
				echo '<li style="display:block;float:left;width:150px;">'.$row['city'] . ", " . $row['state_code'].'</li>';
            }
        ?>
        </ul>
  </p>
  <p style="clear:both;">
  	<strong>Practice Areas:</strong><br />
    	<ul>
       	<?php 
            $result = mysql_query("SELECT practiceareas FROM attorneys WHERE id='$idvalue'") 
			or die(mysql_error());
			while($row = mysql_fetch_array($result))
            {
                echo '<li>'.$row['practiceareas'].'</li>';
            }
        ?>
        </ul>
  </p>
  <p>
    <label>Monthly Agreement:</label>
    <select name="monthly"  required="required">
      <option value="<?=$monthly?>"><?=$monthly?></option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
    </select>
    <input type="text" name="feeagreement" id="feeagreement" value="<?=$feeagreement?>" placeholder="Fee Agreement (% or PPL)" required />
    <label>Invoice Method:</label>
    <select name="invoicemethod" required="required">
      <option value="<?=$invoicemethod?>"><?=$invoicemethod?></option>
      <option value="Email">Email</option>
      <option value="Phone">Phone</option>
    </select>
  </p>
  <p>
	<?php 
		$result = mysql_query("SELECT * FROM leads WHERE leadstatus='Closed' AND attorney='$name'") 
			or die(mysql_error());
		$casesclosednumber=mysql_num_rows($result);
    ?>
  	<label><strong>Cases Closed:</strong></label>
    <input type="text" name="casesclosed" id="casesclosed" value="<?=$casesclosednumber?>" placeholder="# of Cases Closed" />
  </p>
  <p>
    <textarea name="notes" id="notes" placeholder="Notes" rows="5" cols="60"><?php echo $notes; ?></textarea>
  </p>
  <p>
    <label>Status</label>
    <select name="attorneystatus" id="attorneystatus">
      <option value="<?=$attorneystatus?>">No Change</option>
      <option value="<img src=../images/active-icon.png width=15 />">Active</option>
      <option value="<img src=../images/backup-icon.png width=15 />">Backup</option>
      <option value="<img src=../images/pending-icon.png width=15 />">Pending</option>
      <option value="<img src=../images/replace-icon.png width=15 />">Replace</option>
      <option value="<img src=../images/inactive-icon.png width=15 />">Inactive</option>
    </select>
    <br />
    <?=$attorneystatus?>
  </p>
  <p>
    <input type="submit" name="submit" value="Submit" />
    <input type="reset" name="reset" value="Reset" />
  </p>
</form>
</div>

</body>
</html>