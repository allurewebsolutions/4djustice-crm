<?php include("../includes/db.php"); ?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Lead Logged Successfully</title>

</head>

<body>
<?php include("../includes/main-nav.php"); ?>
<!-- Insert Lead Into Database -->
<?php
if($_POST['submit'] == "Submit") 
{
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$leadphone = $_POST['leadphone'];
	$leademail=$_POST['leademail'];
	$contactname = $_POST['contactname'];
	$contactphone = $_POST['contactphone'];
	$contactemail = $_POST['contactemail'];
	$practicearea = $_POST['practicearea'];
	$subpracticearea = $_POST['subpracticearea'];
	$fundingsource = $_POST['fundingsource'];
	$attorney = $_POST['attorney'];
	$attorney2 = $_POST['attorney2'];
	$attorney3 = $_POST['attorney3'];
	$casedetails = $_POST['casedetails'];
	$assignedto = $_POST['assignedto'];
	$loggedby = $_POST['loggedby'];
	$ppl = implode(",",$_POST['ppl']);
	$zip = $_POST['zip'];
	$contactrelationship = $_POST['contactrelationship'];
	$courtdate = $_POST['courtdate'];
	$courtdate=$_POST['courtdate'];
	$instadead = $_POST['instadead'];
}
?>

<?php
$result = mysql_query("SELECT state_code,county,city FROM cities WHERE zip=$zip");
$row = mysql_fetch_assoc($result);
$state = $row['state_code'];
$county = $row['county'];
$city = $row['city'];
?>

<?php
//Lead Rival Submit Code

function curlSendPOST_SSL($url,$data){

$ch = curl_init();
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);	
$content = curl_exec ($ch); # This returns HTML	


//send email with error
$err_msg = curl_error($ch);
if($err_msg){
$err_msg .= " | " . $url;
//mail("info@leadrival.com","curlSendGet Error",$err_msg);
echo($err_msg);
}
curl_close ($ch);
return($content);

}

//Validate fields specific to Lead Rival
if ($leademail=='' && $contactemail=='' && $leadphone!=''){
	$phone=$leadphone;
	$email='none@none.com';
} elseif ($leademail=='' && $contactemail=='' && $contactphone!='') {
	$phone=$contactphone;
	$email='none@none.com';
} elseif ($contactemail!='' && $contactphone!='') {
	$phone=$contactphone;
	$email=$contactemail;
} elseif ($leademail!='' && $leadphone!='') {
	$phone=$leadphone;
	$email=$leademail;	
}

if ($_POST['courtdate'] != ''){
	$arrested='Y';
	$casepending='Y';
} else {
	$arrested='';
	$casepending='';
}

if ($firstname=="" || $firstname=="not provided" || $lastname=="" || $lastname=="not provided"){
	$explodedcontactname=explode(",",$contactname);
	$firstnamefinal=$explodedcontactname[0];
	$lastnamefinal=$explodedcontactname[0];
} else {
	$firstnamefinal=$firstname;
	$lastnamefinal=$lastname;
}

if ($practicearea=="Criminal") {

if ($subpracticearea=='DUI / DWI') {
	$subcode="DUI";
} else {
	$subcode="CRI";
}

$new_lead =	array("req" => "postlead",
 "SubCode" => $subcode,	
 "AffID" => 'wise',
"FirstName" => $firstnamefinal,
"LastName" => $lastnamefinal,
"HomePhone" => $phone,
"EmailAddress" => $email,
"Address" => 'none',
"ZipCode" => $zip,
"GotAtty" => 'N',
"Arrested" => $arrested,
"CasePending" => $casepending,
"Funds" => 'Y',
"Charged" => $subpracticearea,
"IncidentState" => $state,
"IncidentCounty" => $county,
"IncidentCity" => $city,
"ClientIP" => $_SERVER['REMOTE_ADDR']);	
}

if ($practicearea=="Personal Injury") {
$injurydate=date("m/d/Y");
$new_lead =	array("req" => "postlead",
 "SubCode" => 'PIP',	
 "AffID" => 'wise',
"FirstName" => $firstnamefinal,
"LastName" => $lastnamefinal,
"HomePhone" => $phone,
"EmailAddress" => $email,
"Address" => 'none',
"ZipCode" => $zip,
"GotAtty" => 'N',
"Description" => $casedetails,
"IncidentState" => $state,
"IncidentCounty" => $county,
"IncidentCity" => $city,
"AccidentType" => $subpracticearea,
"PhysicalInjury" => 'Y',
"AtFault" => 'N',
"InjuryDate" => $injurydate,
"ClientIP" => $_SERVER['REMOTE_ADDR']);	
}
?>


<?php
//Validate Insta Dead vs Need Attorney vs Active Lead
if ($instadead == "Yes") {
	$leadstatus = "Dead";
	$followup = "";
	$tomorrow = "";
	$attorney = "";
}
else {	
if ($attorney == "Need Attorney") {
	$leadstatus = "Finding Attorney";
	$followup = "Follow Up - Lead";
	$tomorrow = date("Y-m-d", strtotime('tomorrow'));
}
else {
	$leadstatus = "Initial Contact Needed";
	$followup = "Follow Up - Both";
	$tomorrow = date("Y-m-d", strtotime('tomorrow'));
}
}
?>
<?php
//Insert New Lead Into Database
$sql = "INSERT INTO leads (firstname, lastname, city, state, leadphone, leademail, contactname, contactphone, contactemail, practicearea, subpracticearea, fundingsource, attorney, attorney2, attorney3, casedetails, assignedto, loggedby, leadfollowup, attorneyfollowup, leadstatus, followup, ppl, zip, contactrelationship, courtdate, added) VALUES (".
         PrepSQL($firstname) . ", " .
		 PrepSQL($lastname) . ", " .
		 PrepSQL($city) . ", " .
         PrepSQL($state) . ", " .
		 PrepSQL($leadphone) . ", " .
		 PrepSQL($leademail) . ", " .
		 PrepSQL($contactname) . ", " .
		 PrepSQL($contactphone) . ", " .
		 PrepSQL($contactemail) . ", " .
		 PrepSQL($practicearea) . ", " .
		 PrepSQL($subpracticearea) . ", " .
		 PrepSQL($fundingsource) . ", " .
		 PrepSQL($attorney) . ", " .
		 PrepSQL($attorney2) . ", " .
		 PrepSQL($attorney3) . ", " .
		 PrepSQL($casedetails) . ", " .
		 PrepSQL($assignedto) . ", " .
		 PrepSQL($loggedby) . ", " .
		 PrepSQL($tomorrow) . ", " .
		 PrepSQL($tomorrow) . ", " .
		 PrepSQL($leadstatus) . ", " .
		 PrepSQL($followup) . ", ".
		 PrepSQL($ppl) . ", ".
		 PrepSQL($zip) . ", " .
		 PrepSQL($contactrelationship) . ", " .
		 PrepSQL($courtdate) . ",
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
?>
<?php mysql_query($sql); ?>
<h1>Lead Logged Successfully for <?php echo $firstname . " " . $lastname; ?></h1>
<?php
$result = mysql_query("SELECT * FROM leads WHERE firstname='$firstname' AND lastname='$lastname'");
$row = mysql_fetch_assoc($result);
?>

Email PDF:  <?php echo $attorney; ?>
<br />
<a href="../lead-pdf/email-lead-pdf.php?id=<?php echo $row['id']; ?>&attorney=attorney1" target="_blank"><img src="../images/email-icon.png" width="50" /><a>
<br />
Email PDF:  <?php echo $attorney2; ?>
<br />
<a href="../lead-pdf/email-lead-pdf.php?id=<?php echo $row['id']; ?>&attorney=attorney2" target="_blank"><img src="../images/email-icon.png" width="50" /><a>
<br />
Email PDF: <?php echo $attorney3; ?>
<br />
<a href="../lead-pdf/email-lead-pdf.php?id=<?php echo $row['id']; ?>&attorney=attorney3" target="_blank"><img src="../images/email-icon.png" width="50" /><a>
<br /><br />
Generate PDF for <?php echo $firstname . " " . $lastname . ": "; ?>
<br />
<a href="../lead-pdf/generate-lead-pdf.php?id=<?php echo $row['id']; ?>" target="_blank"><img src="../images/generate-pdf-icon.png" width="50" /></a>

<h1>Pay Per Lead Submission Status</h1>
<?php
if (strpos($ppl,'LR') !== false) {
//Post the Lead
$url = "https://www.leadrival.com/partner/lr_post.php";
$send_lead = curlSendPOST_SSL($url,$new_lead);

//Display Lead Rival Status
echo "<h2>Lead Rival:</h2>";
if ($send_lead!='Array ( [response] => No Coverage )') {
	echo "<h3>".$send_lead."</h3>";
} else {
	echo "<h3>No Coverage</h3>";
}

echo 'First: '.$firstnamefinal . '<br />';
echo 'Last: '.$lastnamefinal . '<br />';
echo 'Phone: '.$phone . '<br />';
echo 'Email: '.$email . '<br />';
echo 'Zip: '.$zip . '<br />';
echo 'Arrested? '.$arrested . '<br />';
echo 'Case Pending? '.$casepending . '<br />';
echo 'Description: '.$casedetails . '<br />';
echo 'Incident State: '.$state . '<br />';
echo 'Incident County: '.$county . '<br />';
echo 'Incident City: '.$city . '<br />';
echo $_SERVER['REMOTE_ADDR'];
}
?>

</body>
</html>