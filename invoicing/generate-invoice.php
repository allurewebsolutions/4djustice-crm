<?php include("../includes/db.php"); ?>
<?php
require("../fpdf/fpdf.php");

//connect to database
$idvalue = $_GET['id'];
$paymentvalue = $_GET['payment'];
$query = "SELECT * FROM leads WHERE id LIKE '$idvalue'";

// build the data array from the database records.
$row = mysql_fetch_assoc( mysql_query($query) );

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

//Select Correct Invoice Amount
$invoiceamount=$row[$paymentvalue];

// Instanciation of inherited class
$pdf = new PDF();
$today = date("d-m-Y", strtotime('today'));
$title = '4D JUSTICE Invoice';
$address = '4D JUSTICE attn: Akira Saito
2109 Avent Ferry Rd. Ste 116 
Raleigh, NC. 27606-2137';
$pdf->SetTitle($title);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',14);
$pdf->Cell(50,7,'ID');
$pdf->Cell(50,7,$row['id'],0,1);
$pdf->Cell(50,7,'Date');
$pdf->Cell(50,7,$today,0,1);
$pdf->Cell(50,7,'Name');
$pdf->Cell(50,7,$row['firstname']. " " .$row['lastname'],0,1);
$pdf->Cell(50,7,'Total');
$pdf->Cell(50,7,'$'.$invoiceamount,0,1);
$pdf->Ln(30);
$pdf->SetFont('Times','',18);
$pdf->Cell(50,15,'Payment Methods',0,1);
$pdf->SetFont('Times','',16);
$pdf->Cell(50,7,'Check:',0,1);
$pdf->SetFont('Times','',14);
$pdf->MultiCell(170,7,'You may mail the check to the address above. The check should be made out to "Mike Doubintchik".',0,1);
$pdf->Ln(10);
$pdf->SetFont('Times','',16);
$pdf->Cell(50,7,'PayPal:',0,1);
$pdf->SetFont('Times','',14);
$pdf->Cell(50,7,'PayPal to payments@4djustice.com. Please use the "Send to family or friends" method.',0,1);
$pdf->Output();

?>