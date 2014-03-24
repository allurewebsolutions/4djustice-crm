<?php include("../includes/db.php"); ?>

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

<table width="800">
<tr>
<td valign="top">
<h3>Check Coverage</h3>
<?php $zip=$_POST['zip']; ?>
<form method="post">
<input type="text" name="zip" placeholder="Zip Code" /><br />
<input type="submit" />
</form>

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

if ($zip!="") {
$ping_cri = array("req" => "ping",
"SubCode" => 'CRI',
"AffID" => 'wise',
"ZipCode" => $zip);

$url = "https://www.leadrival.com/partner/lr_post.php";

//Ping the lead
$send_ping = curlSendPOST_SSL($url,$ping_cri);

print_r($send_ping);

echo " for ";

print_r($zip);
}
?>
</td>
<td valign="top">
<h3>Submit Lead to LeadRival</h3>
<form method="post" action="lr-submit-lead.php">
<input type="hidden" name="zip" value="<?=$zip?>" />
<input type="text" name="firstname" placeholder="First Name" required /><br />
<input type="text" name="lastname" placeholder="Last Name" required /><br />
<input type="text" name="phone" placeholder="Phone (numbers only)" required />
<h5>Optional Fields</h5>
<input type="text" name="email" placeholder="Email" /><br />
<input type="text" name="address" placeholder="Address" />
<input type="text" name="city" placeholder="City" />
<select name="state">
    <option value=" " disabled="disabled" selected="selected">Select State</option>
    <?php 
		$result = mysql_query("SELECT state_code FROM states ORDER BY state_code ASC") 
			or die(mysql_error());
		while($row = mysql_fetch_array($result))
		{
			echo '<option value="'.$row['state_code'].'">'.$row['state_code'].'</option>';
		}
    ?>
</select><br />
<select name="arrested">
	<option value=" " disabled selected>Has the client been arrested?</option>
    <option value="Y">Yes</option>
    <option value="N">No</option>
</select><br />
<select name="casepending">
	<option value=" " disabled selected>Is there a case pending??</option>
    <option value="Y">Yes</option>
    <option value="N">No</option>
</select><br />
<textarea name="description" placeholder="Description (keep it short)"></textarea><br />
<input type="submit" />
</td>
</tr>
</table>

</body>
</html>