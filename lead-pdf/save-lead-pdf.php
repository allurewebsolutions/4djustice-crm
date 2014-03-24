<?php include("../includes/db.php"); ?>
<?php
require("../fpdf/fpdf.php");

//connect to database
$idvalue = $_GET['id'];
$query = "SELECT * FROM leads WHERE id LIKE '$idvalue'";
$result = mysql_query($query)
        or die( "Could not execute sql: $sql");

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
		$practicearea = $row['practicearea'];
		$courtdate = $row['courtdate'];
		$fundingsource = $row['fundingsource'];
        $casedetails = $row['casedetails'];
		$attorney = $row['attorney'];
		$attorney2 = $row['attorney2'];
		$attorney3 = $row['attorney3'];
		
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
if ($contactrelationshop != "") {
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
$pdf->Output("4D JUSTICE Lead - " . $firstname . " " .$lastname . " (ID# ".$id.")" . " - " . $added . ".pdf","D");
?>