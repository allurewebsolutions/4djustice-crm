<?php include("../includes/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Attorney Added Successfully</title>
</head>

<body>
<?php include("../includes/main-nav.php"); ?>

<?php
if($_POST['submit'] == "Submit") 
{
   $name = $_POST['name'];
   $officephone = $_POST['officephone'];
   $mobilephone = $_POST['mobilephone'];
   $email = $_POST['email'];
   $address = $_POST['address'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $zip = $_POST['zip'];
   $url = $_POST['url'];
   $contactname = $_POST['contactname'];
   $contactphone = $_POST['contactphone'];
   $contactemail = $_POST['contactemail'];
   $practiceareas = implode ( ", ", $_POST['practiceareas']);
   $monthly = $_POST['monthly'];
   $feeagreement = $_POST['feeagreement'];
   $invoicemethod = $_POST['invoicemethod'];
   $notes = $_POST['notes'];
   $attorneystatus = $_POST['attorneystatus'];
   $errorMessage = "There are some issues";
}
 
?>

<?php
//Insert Attorney into Database
$casesclosed = "0";
$sql = "INSERT INTO attorneys (name, email, officephone, mobilephone, address, city, state, zip, url, practiceareas, invoicemethod, feeagreement, casesclosed, monthly, notes, attorneystatus, contactname, contactphone, contactemail, added) VALUES (".
         PrepSQL($name) . ", " .
		 PrepSQL($email) . ", " .
		 PrepSQL($officephone) . ", " .
         PrepSQL($mobilephone) . ", " .
		 PrepSQL($address) . ", " .
		 PrepSQL($city) . ", " .
		 PrepSQL($state) . ", " .
		 PrepSQL($zip) . ", " .
		 PrepSQL($url) . ", " .
		 PrepSQL($practiceareas) . ", " .
		 PrepSQL($invoicemethod) . ", " .
		 PrepSQL($feeagreement) . ", " .
		 PrepSQL($casesclosed) . ", " .
		 PrepSQL($monthly) . ", " .
		 PrepSQL($notes) . ", " .
		 PrepSQL($attorneystatus) . ", " .
		 PrepSQL($contactname) . ", " .
		 PrepSQL($contactphone) . ", " .
		 PrepSQL($contactemail) . ",
		 now())";
  
function PrepSQL($value)
{
    // Stripslashes
    if(get_magic_quotes_gpc()) 
    {
        $value = stripslashes($value);
    }
 
    // Quote
    $value = "'" . mysql_real_escape_string($value) . "'";
 
    return($value);
} 

    mysql_query($sql);
?>
<h1>Attorney Added Successfully</h1>
</body>
</html>