<?php include("../includes/db.php"); ?>
<?php include("../includes/func.php"); ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>LeadRival Submit</title>
<?php include("../includes/css-js.php"); ?>

</head>

<body>
<?php include("../includes/main-nav.php"); ?>
<h1>Submit to Lead Rival</h1>

<?php 
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$phone=$_POST['phone'];
$zip=$_POST['zip'];

if ($_POST['email'] != ''){
	$email=$_POST['email'];
} else {
	$email='none@none.com';
}
if ($_POST['address'] != ''){
	$address=$_POST['address'];
} else {
	$address='none';
}
if ($_POST['city'] != ''){
	$city=$_POST['city'];
} else {
	$city='';
}
if ($_POST['state'] != ''){
	$state=$_POST['state'];
} else {
	$state='';
}
$arrested=$_POST['arrested'];
$casepending=$_POST['casepending'];
$description=$_POST['description'];
?>

<?php
$result = mysql_query("SELECT state_code,county,city FROM cities WHERE zip=$zip") 
or die(mysql_error());
$row = mysql_fetch_assoc($result);
$incidentstate = $row['state_code'];
$incidentcounty = $row['county'];
$incidentcity = $row['city'];
?>

<?php

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


$new_crilead =	array("req" => "postlead",
 "SubCode" => 'CRI',	
 "AffID" => 'wise',
"FirstName" => $firstname,
"LastName" => $lastname,
"HomePhone" => $phone,
"EmailAddress" => $email,
"Address" => $address,
"City" => $city,
"State" => $state,
"ZipCode" => $zip,
"GotAtty" => 'N',
"Arrested" => $arrested,
"CasePending" => $casepending,
"Funds" => 'Y',
"Description" => $description,
"IncidentState" => $incidentstate,
"IncidentCounty" => $incidentcounty,
"IncidentCity" => $incidentcity,
"ClientIP" => $_SERVER['REMOTE_ADDR']);	



$url = "https://www.leadrival.com/partner/lr_post.php";


//Post the Lead
$send_lead = curlSendPOST_SSL($url,$new_crilead);

echo "<h2>";
echo $send_lead;
echo "</h2>";

echo 'First: '.$firstname . '<br />';
echo 'Last: '.$lastname . '<br />';
echo 'Phone: '.$phone . '<br />';
echo 'Email: '.$email . '<br />';
echo 'Address: '.$address . '<br />';
echo 'City: '.$city . '<br />';
echo 'State: '.$state . '<br />';
echo 'Zip: '.$zip . '<br />';
echo 'Arrested? '.$arrested . '<br />';
echo 'Case Pending? '.$casepending . '<br />';
echo 'Description: '.$description . '<br />';
echo 'Incident State: '.$incidentstate . '<br />';
echo 'Incident County: '.$incidentcounty . '<br />';
echo 'Incident City: '.$incidentcity . '<br />';
echo $_SERVER['REMOTE_ADDR'];	

?>

</body>
</html>