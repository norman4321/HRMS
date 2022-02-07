<?php
require('fpdf/fpdf.php');

$guest_name = 'Name of Guest';
$guest_address = 'Address of Guest';
$trans_num = '9876544567';
$trans_date = '01/01/2022';
$trans_status = 'Paid';
$user_account = '45903281';



class PDF extends FPDF 
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('../public/images/home_logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Times','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(100,10,'Hotel Reservation Receipt',0,0,'C');
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
        $this->Cell(0,10,'Date Printed: '.date("m/d/Y"),0,0,'L');
        $this->Cell(0,10,'Page: '.$this->PageNo().'/{nb}',0,0,'R');
    }

    function CreateTableHeader($header)
    {
        // Column widths
        #$w = array(25, 20, 25, 25, 25, 15, 25, 20, 25, 25);
        $w = array(40, 18, 23, 27, 27, 15, 30, 22, 25, 30);
        
        // Header
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
        $this->Ln();
        
    }

    function CreateTableBodyBCK($header, $data)
    {
        // Column widths
        #$w = array(25, 20, 25, 25, 25, 15, 25, 20, 25, 25);
        $w = array(40, 18, 25, 27, 27, 15, 30, 22, 25, 30);
        
        
        $this->Cell(40,6,'Cozy Commerce Suite','LR',0,'C');
        $this->Cell(18,6,'3001','LR',0,'C');
        $this->Cell(23,6,'12:59 PM','LR',0,'C');
        $this->Cell(27,6,'01/20/2022','LR',0,'C');
        $this->Cell(27,6,'01/22/2022','LR',0,'C');
        $this->Cell(15,6,'2','LR',0,'C');
        $this->Cell(30,6,'Php 11,990.00','LR',0,'C');
        $this->Cell(22,6,'Checked out','LR',0,'C');
        $this->Cell(25,6,'fL8Iu2Xb','LR',0,'C');
        $this->Cell(30,6,'Php 23,980.00','LR',0,'C');
        $this->Ln();

        $this->Cell(40,6,'Cozy Commerce Suite','LR',0,'C');
        $this->Cell(18,6,'3002','LR',0,'C');
        $this->Cell(23,6,'12:59 PM','LR',0,'C');
        $this->Cell(27,6,'01/20/2022','LR',0,'C');
        $this->Cell(27,6,'01/22/2022','LR',0,'C');
        $this->Cell(15,6,'2','LR',0,'C');
        $this->Cell(30,6,'Php 11,990.00','LR',0,'C');
        $this->Cell(22,6,'Checked out','LR',0,'C');
        $this->Cell(25,6,'fL8Iu2Xb','LR',0,'C');
        $this->Cell(30,6,'Php 23,980.00','LR',0,'C');
        $this->Ln();
        
        $this->Cell(40,6,'Cozy Commerce Suite','LRB',0,'C');
        $this->Cell(18,6,'3003','LRB',0,'C');
        $this->Cell(23,6,'12:59 PM','LRB',0,'C');
        $this->Cell(27,6,'01/20/2022','LRB',0,'C');
        $this->Cell(27,6,'01/22/2022','LRB',0,'C');
        $this->Cell(15,6,'2','LRB',0,'C');
        $this->Cell(30,6,'Php 11,990.00','LRB',0,'C');
        $this->Cell(22,6,'Checked out','LRB',0,'C');
        $this->Cell(25,6,'fL8Iu2Xb','LRB',0,'C');
        $this->Cell(30,6,'Php 23,980.00','LRB',0,'C');
        $this->Ln();
        
        /* Header
        foreach($header as $col)
            $this->Cell(40,7,$col,1);
        $this->Ln();

        // Data
        foreach($data as $row)
        {
            foreach($row as $col)
                $this->Cell(40,6,$col,1);
            $this->Ln();
        }*/
    }

    function CreateTableBody($header, $data)
    {
        // Column widths
        #$w = array(25, 20, 25, 25, 25, 15, 25, 20, 25, 25);
        $w = array(40, 18, 25, 27, 27, 15, 30, 22, 25, 30);
        
        
        $this->Cell(40,6,'Cozy Commerce Suite','LR',0,'C');
        $this->Cell(18,6,'3001','LR',0,'C');
        $this->Cell(23,6,'12:59 PM','LR',0,'C');
        $this->Cell(27,6,'01/20/2022','LR',0,'C');
        $this->Cell(27,6,'01/22/2022','LR',0,'C');
        $this->Cell(15,6,'2','LR',0,'C');
        $this->Cell(30,6,'Php 11,990.00','LR',0,'C');
        $this->Cell(22,6,'Checked out','LR',0,'C');
        $this->Cell(25,6,'fL8Iu2Xb','LR',0,'C');
        $this->Cell(30,6,'Php 23,980.00','LR',0,'C');
        $this->Ln();

        $this->Cell(40,6,'','LR',0,'C');
        $this->Cell(18,6,'3002','LR',0,'C');
        $this->Cell(23,6,'','LR',0,'C');
        $this->Cell(27,6,'','LR',0,'C');
        $this->Cell(27,6,'','LR',0,'C');
        $this->Cell(15,6,'','LR',0,'C');
        $this->Cell(30,6,'','LR',0,'C');
        $this->Cell(22,6,'','LR',0,'C');
        $this->Cell(25,6,'','LR',0,'C');
        $this->Cell(30,6,'','LR',0,'C');
        $this->Ln();
        
        $this->Cell(40,6,'','LRB',0,'C');
        $this->Cell(18,6,'3003','LRB',0,'C');
        $this->Cell(23,6,'','LRB',0,'C');
        $this->Cell(27,6,'','LRB',0,'C');
        $this->Cell(27,6,'','LRB',0,'C');
        $this->Cell(15,6,'','LRB',0,'C');
        $this->Cell(30,6,'','LRB',0,'C');
        $this->Cell(22,6,'','LRB',0,'C');
        $this->Cell(25,6,'','LRB',0,'C');
        $this->Cell(30,6,'','LRB',0,'C');
        $this->Ln();

        $this->Cell(40,6,'Cozy Commerce Suite','LRB',0,'C');
        $this->Cell(18,6,'3001','LRB',0,'C');
        $this->Cell(23,6,'12:59 PM','LRB',0,'C');
        $this->Cell(27,6,'01/20/2022','LRB',0,'C');
        $this->Cell(27,6,'01/22/2022','LRB',0,'C');
        $this->Cell(15,6,'2','LRB',0,'C');
        $this->Cell(30,6,'Php 11,990.00','LRB',0,'C');
        $this->Cell(22,6,'Checked out','LRB',0,'C');
        $this->Cell(25,6,'fL8Iu2Xb','LRB',0,'C');
        $this->Cell(30,6,'Php 23,980.00','LRB',0,'C');
        $this->Ln();

        //259
        $this->SetFont('Times','B',10);
        $this->Cell(257,7,'Total Amount: Php 71,940.00','TLRB',0,'R');
        //$this->Cell(30,7,'Php 71,940.00',1,0,'R');
        $this->Ln();


        
        /* Header
        foreach($header as $col)
            $this->Cell(40,7,$col,1);
        $this->Ln();

        // Data
        foreach($data as $row)
        {
            foreach($row as $col)
                $this->Cell(40,6,$col,1);
            $this->Ln();
        }*/
    }

}

// Instanciation of inherited class
$pdf = new PDF('L','mm','Letter');
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Times','',12);
$pdf->Cell(0,5,'From',0,1);
$pdf->SetFont('Times','BI',12);
$pdf->Cell(0,5,'Cozy Home Manila',0,1);
$pdf->SetFont('Times','I',12);
$pdf->Cell(0,5,'32nd Street corner Lane A, Bonifacio Global City',0,1);
$pdf->Cell(0,5,'Taguig City, 1634 Philippines',0,1);
$pdf->Cell(0,5,'Contact Number: (63-2) 7720 2000',0,1);
$pdf->Cell(0,5,'Email: cozyhome@ite4-bsit-ab.com',0,1);
$pdf->Ln();

$pdf->SetFont('Times','',12);
$pdf->Cell(0,5,'To',0,1);
$pdf->SetFont('Times','BI',12);
$pdf->Cell(0,5,$guest_name,0,1);
$pdf->SetFont('Times','I',12);
$pdf->Cell(0,5,$guest_address,0,1);
$pdf->Ln(10);

$pdf->SetFont('Times','B',12);
$pdf->Cell(45,5,'Transaction Number: ',0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(45,5,$trans_num,0,1);
$pdf->SetFont('Times','B',12);
$pdf->Cell(45,5,'Transaction Date: ',0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(45,5,$trans_date,0,1);
$pdf->SetFont('Times','B',12);
$pdf->Cell(45,5,'Transaction Status: ',0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(45,5,$trans_status,0,1);
$pdf->Ln(5);

/*$pdf->SetFont('Times','B',12);
$pdf->Cell(22,5,'Guest: ',0,0,);
$pdf->SetFont('Times','',12);
$pdf->Cell(22,5,$guest_name,0,1);
$pdf->SetFont('Times','B',12);
$pdf->Cell(22,5,'Account: ',0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(22,5,$user_account,0,1);
$pdf->Ln(10);*/

//--- Table for Transaction ---//
// Column headings
$header = array('Room Name', 'Room No.', 'Arrival Time', 'Arrival Date', 'Departure Date', 'Nights', 'Price (P/N)', 'Status', 'Confirm Code', 'Subtotal');

// Data loading
$data = array();

// Table Creation
$pdf->SetFont('Times','B',10);
$pdf->CreateTableHeader($header);
$pdf->SetFont('Times','',10);
$pdf->CreateTableBody($header,$data);




$pdf->Output();
