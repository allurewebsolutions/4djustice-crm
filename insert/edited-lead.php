<?php include("../includes/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Lead Edited Successfully</title>
<?php include("../includes/css-js.php"); ?>
</head>

<body>
<?php include("../includes/main-nav.php"); ?>

<?php
if($_POST['submit'] == "Submit") 
{
   $id = $_POST['id'];
   $firstname = mysql_real_escape_string($_POST['firstname']);
   $lastname = mysql_real_escape_string($_POST['lastname']);
   $city = $_POST['city'];
   $state = $_POST['state'];
   $leadphone = $_POST['leadphone'];
   $leademail = $_POST['leademail'];
   $contactname = mysql_real_escape_string($_POST['contactname']);
   $contactphone = mysql_real_escape_string($_POST['contactphone']);
   $contactemail = $_POST['contactemail'];
   $practicearea = $_POST['practicearea'];
   $subpracticearea = $_POST['subpracticearea'];
   $attorney = mysql_real_escape_string($_POST['attorney']);
   $attorney2 = mysql_real_escape_string($_POST['attorney2']);
   $attorney3 = mysql_real_escape_string($_POST['attorney3']);
   $casedetails = mysql_real_escape_string($_POST['casedetails']);
   $casenotes = mysql_real_escape_string($_POST['casenotes']);
   $assignedto = $_POST['assignedto'];
   $leadfollowup = $_POST['leadfollowup'];
   $attorneyfollowup = $_POST['attorneyfollowup'];
   $followup = $_POST['followup'];
   $leadstatus = $_POST['leadstatus'];
   $quote = $_POST['quote'];
   $paymentstatus = $_POST['paymentstatus'];
   $firstpaymentamount = $_POST['firstpaymentamount'];
   $secondpaymentamount = $_POST['secondpaymentamount'];
   $thirdpaymentamount = $_POST['thirdpaymentamount'];
   $firstpaymentdate = $_POST['firstpaymentdate'];
   $secondpaymentdate = $_POST['secondpaymentdate'];
   $thirdpaymentdate = $_POST['thirdpaymentdate'];
   $ppl = implode(",",$_POST['ppl']);
   $zip = $_POST['zip'];
   $courtdate = $_POST['courtdate'];
}
 
?>

<?php $today = date("Y-m-d", strtotime('today')); ?>

<?php
$sql =" UPDATE leads 
		SET updated = '$today',
			firstname = '$firstname',
		 	lastname = '$lastname',
		 	city = '$city',
         	state = '$state',
		 	leadphone = '$leadphone',
		 	leademail = '$leademail',
		 	contactname = '$contactname',
		 	contactphone = '$contactphone',
		 	contactemail = '$contactemail',
		 	subpracticearea = '$subpracticearea',
		 	attorney = '$attorney',
			attorney2 = '$attorney2',
			attorney3 = '$attorney3',
			casedetails = '$casedetails',
			casenotes = '$casenotes',
			assignedto = '$assignedto',
			leadfollowup = '$leadfollowup',
		 	attorneyfollowup = '$attorneyfollowup',
			followup = '$followup',
		 	leadstatus = '$leadstatus',
			quote = '$quote',
			paymentstatus = '$paymentstatus',
		    firstpaymentamount = '$firstpaymentamount',
		    secondpaymentamount = '$secondpaymentamount',
		    thirdpaymentamount = '$thirdpaymentamount',
		    firstpaymentdate = '$firstpaymentdate',
		    secondpaymentdate = '$secondpaymentdate',
		    thirdpaymentdate = '$thirdpaymentdate' ,
			ppl = '$ppl' ,
			zip = '$zip',
			courtdate = '$courtdate'
		WHERE id = '$id'
		AND leadphone = '$leadphone'";

    mysql_query($sql);
?>

<h1>Lead Edited Successfully</h1>
</body>
</html>