<?php include("../includes/db.php"); ?>
<?php
require("../fpdf/fpdf.php");

//connect to database
$idvalue = $_GET['id'];
$attorneyvalue = $_GET['attorney'];
$query = "SELECT * FROM leads WHERE id LIKE '$idvalue'";
$result = mysql_query($query);

// build the data array from the database records.
While($row = mysql_fetch_array($result)) {
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
		$subpracticearea = $row['subpracticearea'];
		$courtdate = $row['courtdate'];
		$fundingsource = $row['fundingsource'];
        $casedetails = $row['casedetails'];
		$attorney = $row['attorney'];
		$attorney2 = $row['attorney2'];
		$attorney3 = $row['attorney3'];
		$loggedby = $row['loggedby'];
		$assignedto = $row['assignedto'];
}

if ($attorneyvalue == "attorney1") {
	$assignedattorney = $attorney;
}
elseif ($attorneyvalue == "attorney2") {
	$assignedattorney = $attorney2;
} 
else {
	$assignedattorney = $attorney3;
} 

$query2 = "SELECT * FROM attorneys WHERE name LIKE '$assignedattorney'";
$result2 = mysql_query($query2)
        or die( "Could not execute sql: $sql");

// Query for Attorney's Email
While($row2 = mysql_fetch_array($result2)) {
		$attorneyemail = $row2['email'];
}

$assignedtoExploded = explode(" ",$assignedto);
$query3 = "SELECT * FROM employees WHERE lastname LIKE '$assignedtoExploded[1]'";
$result3 = mysql_query($query3)
        or die( "Could not execute sql: $sql");

// Query for Case Manager Email
While($row3 = mysql_fetch_array($result3)) {
		$casemanager = $row3['email'];
}

$loggedbyExploded = explode(" ",$loggedby);
$query4 = "SELECT * FROM employees WHERE lastname LIKE '$loggedbyExploded[1]'";
$result4 = mysql_query($query4)
        or die( "Could not execute sql: $sql");

// Query for Logger Email
While($row4 = mysql_fetch_array($result4)) {
		$caselogger = $row4['email'];
}


class PDF extends FPDF
{
// Page header
function Header()
{
	// Address
    global $address;
    // Arial bold 15
    $this->SetFont('Arial','',12);
	$this->Write(5,$address);
		
    // Logo
    $this->Image('../images/logo.jpg',160,6,40);
	
	// Title
    global $title;
    // Arial bold 15
    $this->SetFont('Arial','B',16);
    // Calculate width of title and position
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((210-$w)/2);
    // Colors of frame, background and text
    $this->SetDrawColor(14,87,140);
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(14,87,140);
    // Thickness of frame (1 mm)
    $this->SetLineWidth(1);
    // Title
    $this->Cell($w,9,$title,1,1,'C',true);
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$name = $firstname . " " . $lastname;
$title = '4D JUSTICE Lead - ' . $added;
$address = '4D JUSTICE attn: Akira Saito
2109 Avent Ferry Rd. Ste 116 
Raleigh, NC. 27606-2137';
$pdf->SetTitle($title);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,7,'ID');
$pdf->SetFont('Times','',14);
$pdf->Cell(50,7,$id,0,1);
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,7,'Defendant Name');
$pdf->SetFont('Times','',14);
$pdf->Cell(50,7,$name,0,1);
if ($leadphone != "") {
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,7,'Defendant Phone');
$pdf->SetFont('Times','',14);
$pdf->Cell(50,7,$leadphone,0,1);
}
if ($leademail != "") {
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,7,'Defendant Email');
$pdf->SetFont('Times','',14);
$pdf->Cell(50,7,$leademail,0,1);
}
if ($contactrelationship != "") {
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,7,'Contact Relationship');
$pdf->SetFont('Times','',14);
$pdf->Cell(50,7,$contactrelationship,0,1);
}
if ($contactname != "") {
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,7,'Contact Name');
$pdf->SetFont('Times','',14);
$pdf->Cell(50,7,$contactname,0,1);
}
if ($contactphone != "") {
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,7,'Contact Phone');
$pdf->SetFont('Times','',14);
$pdf->Cell(50,7,$contactphone,0,1);
}
if ($contactemail != "") {
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,7,'Contact Email');
$pdf->SetFont('Times','',14);
$pdf->Cell(50,7,$contactemail,0,1);
}
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,7,'City');
$pdf->SetFont('Times','',14);
$pdf->Cell(50,7,$city,0,1);
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,7,'State');
$pdf->SetFont('Times','',14);
$pdf->Cell(50,7,$state,0,1);
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,7,'Practice Area');
$pdf->SetFont('Times','',14);
$pdf->Cell(50,7,$subpracticearea,0,1);
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,7,'Court Date');
$pdf->SetFont('Times','',14);
$pdf->Cell(50,7,$courtdate,0,1);
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,7,'Funding Source');
$pdf->SetFont('Times','',14);
$pdf->Cell(50,7,$fundingsource,0,1);
if ($casedetails != "") {
$pdf->SetFont('Times','B',14);
$pdf->Cell(50,7,'Case Details');
$pdf->SetFont('Times','',14);
$pdf->MultiCell(150,7,$casedetails,0,1);
}
$pdf->Output();

// email stuff (change data below)
$to = $attorneyemail; 
$from = $casemanager;
$cc = $casemanager . "," . $caselogger;
$subject = "New Lead from 4D JUSTICE: " . $firstname . " " . $lastname; 
$message = "<p>Lead Details -- Also attached in PDF</p>";
$message .= "<strong>Defendant Name:</strong> " . $firstname . " " . $lastname . "<br />";
$message .= "<strong>Defendant Phone:</strong> " . $leadphone . "<br />";
$message .= "<strong>Defendant Email:</strong> " . $leademail . "<br />";
$message .= "<strong>Contact Relationship:</strong> " . $contactrelationship . "<br />";
$message .= "<strong>Contact Name:</strong> " . $contactname . "<br />";
$message .= "<strong>Contact Phone:</strong> " . $contactphone . "<br />";
$message .= "<strong>Contact Email:</strong> " . $contactemail . "<br />";
$message .= "<strong>City:</strong> " . $city . "<br />";
$message .= "<strong>State:</strong> " . $state . "<br />";
$message .= "<strong>Practice Area:</strong> " . $subpracticearea . "<br />";
$message .= "<strong>Court Date:</strong> " . $courtdate . "<br />";
$message .= "<strong>Funding Source:</strong> " . $fundingsource . "<br />";
$message .= "<strong>Case Details:</strong> " . $casedetails . "<br />";
// a random hash will be necessary to send mixed content
$separator = md5(time());
// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;
// attachment name
$filename = "4D JUSTICE Lead - " . $firstname . " " .$lastname . " (ID# ".$id.")" . " - " . $added . ".pdf";
// encode data (puts attachment in proper format)
$pdfdoc = $pdf->Output("", "S");
$attachment = chunk_split(base64_encode($pdfdoc));
// main header (multipart mandatory)
$headers  = "From: ".$from.$eol;
$headers .= "CC: ".$cc.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol.$eol; 
$headers .= "Content-Transfer-Encoding: 7bit".$eol;
$headers .= "This is a MIME encoded message.".$eol.$eol;
// message
$headers .= "--".$separator.$eol;
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$headers .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$headers .= $message.$eol.$eol;
// attachment
$headers .= "--".$separator.$eol;
$headers .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
$headers .= "Content-Transfer-Encoding: base64".$eol;
$headers .= "Content-Disposition: attachment".$eol.$eol;
$headers .= $attachment.$eol.$eol;
$headers .= "--".$separator."--";
// send message
mail($to, $subject, "", $headers);

?>