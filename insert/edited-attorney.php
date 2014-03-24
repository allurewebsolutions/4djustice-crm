<?php include("../includes/db.php"); ?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Attorney Edited Successfully</title>
</head>

<body>
<?php include("../includes/main-nav.php"); ?>
<!-- Insert Lead Into Database -->

<?php
if($_POST['submit'] == "Submit") 
{
   $id = $_POST['id'];
   $attorneystatus = $_POST['attorneystatus'];
   $name = mysql_real_escape_string($_POST['name']);
   $email = $_POST['email'];
   $officephone = $_POST['officephone'];
   $mobilephone = $_POST['mobilephone'];
   $contactname = mysql_real_escape_string($_POST['contactname']);
   $contactphone = $_POST['contactphone'];
   $contactemail = $_POST['contactemail'];
   $address = $_POST['address'];
   $city = $_POST['city'];
   $zip = $_POST['zip'];
   $state = $_POST['state'];
   $url = $_POST['url'];
   $invoicemethod = $_POST['invoicemethod'];
   $monthly = $_POST['monthly'];
   $feeagreement = $_POST['feeagreement'];
   $casesclosed = $_POST['casesclosed'];
   $notes = mysql_real_escape_string($_POST['notes']);
}
 
?>

<?php
$query =" UPDATE attorneys 
		SET attorneystatus = '$attorneystatus',
		 	name = '$name',
		 	email = '$email',
         	officephone = '$officephone',
		 	mobilephone = '$mobilephone',
		 	contactname = '$contactname',
		 	contactphone = '$contactphone',
		 	contactemail = '$contactemail',
		 	address = '$address',
		 	city = '$city',
			zip = '$zip',
		 	url = '$url',
		 	invoicemethod = '$invoicemethod',
		 	monthly= '$monthly',
		 	feeagreement = '$feeagreement',
			casesclosed = '$casesclosed',
			notes = '$notes'
		WHERE id = '$id'";

    mysql_query($query);
?>
<h1>Attorney Edited Successfully</h1>
</body>
</html>