<?php
require('fpdf/fpdf.php');

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

    function CreateTableHeader($w, $header)
    {
        // Header - (Widths: 40, 18, 23, 27, 27, 15, 30, 22, 25, 30)
        for($i=0; $i < count($header); $i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
        $this->Ln();
    }

    function CreateTableBody($w, $data, $border, $total)
    {
        for ($i=0; $i < count($data) ; $i++) { 
            for ($j=0; $j < count($w) ; $j++) { 
                $this->Cell($w[$j],6,$data[$i][$j],$border[$i][$j],0,'C');
            }
            $this->Ln();
        }
        $this->SetFont('Times','B',10);
        $this->Cell(257,7,"Total Amount: P $total",'TLRB',0,'R');
        $this->Ln();
    }

}

include "../config/database.php";
include "../config/functions.php";
session_start();

// Check if user is not logged in, then redirects to signin page
if (!isset($_SESSION['user_id'])) {
    header('Location: signin_page.php');
    die;
}

if (isset($_SESSION['transaction'])) {
    // Get transaction details
    $transaction_id = $_SESSION['transaction'];
    $user_id = $_SESSION['user_id'];
    $transaction = getTransactionRecord($conn, $user_id, $transaction_id);
    if (!empty($transaction)) {
        #print_r($transaction);
        $guest_name = $transaction['profile_firstname'].' '.$transaction['profile_lastname'];
        $guest_address = $transaction['profile_address'];
        $transaction_date = date_format(date_create($transaction['transaction_date']), "M j, Y");
        $transaction_status = $transaction['transaction_status'];
        $total_amount = $transaction['total_amount'];

        // Get reservation details
        $reservation = getReservationRecord($conn, $user_id, $transaction_id);
        if (!empty($reservation)) {
            #print_r($reservation);
            $room_nums = array();
            $reservation_status = array();
            $i = 0;
            foreach ($reservation as $rows) {
                $reservation_status[$rows['reservation_id']] = $rows['reservation_status'];
                $nights = date_create($rows['arrival_date'])->diff(date_create($rows['departure_date']))->format("%a");
                $subtotal = $rows['quantity'] * $rows['price'] * $nights;

                // Check if room quantity is greater than 1, then get all room numbers; Else, set room number as what is on rows
                if ($rows['quantity'] > 1) {
                    // Get room numbers
                    $reservation_id = $rows['reservation_id'];
                    $room_nums = getRoomNumbers($conn, $reservation_id);
                } else {
                    $room_nums[0] = $rows['room_number'];
                }

                // Table data creation
                $data = array();
                $border = array();
                $data[$i][0] = $rows['type_name'];
                $data[$i][1] = $rows['room_number'];
                $data[$i][2] = date_format(date_create($rows['arrival_time']), "g:i A");
                $data[$i][3] = date_format(date_create($rows['arrival_date']), "m/d/Y");
                $data[$i][4] = date_format(date_create($rows['departure_date']), "m/d/Y");
                $data[$i][5] = $nights;
                $data[$i][6] = "P ".number_format($rows['price'], 2);
                $data[$i][7] = $rows['reservation_status'];
                $data[$i][8] = $rows['confirm_code'];
                $data[$i][9] = "P ".number_format($subtotal, 2);
                
                if ($rows['quantity'] > 1) {
                    // Border for 1st row
                    for ($j=0; $j < 10; $j++) { 
                        if ($j == 0) {
                            $border[$i][$j] = 'LR';
                        } else {
                            $border[$i][$j] = 'R';
                        }
                    }
                    // Setting Border & Text
                    for ($k=1; $k < $rows['quantity']; $k++) { 
                        for ($l=0; $l < 10; $l++) { 
                            // For cell text
                            if ($l != 1) {
                                $data[$k][$l] = '';
                            } else {
                                $data[$k][$l] = $room_nums[$k];
                            }
                            // For cell border
                            if ($k == $rows['quantity']-1) { // bottom
                                if ($l == 0) { 
                                    $border[$k][$l] = 'LRB';
                                } else {
                                    $border[$k][$l] = 'RB';
                                }
                            } else { // not bottom
                                if ($l == 0) {
                                    $border[$k][$l] = 'LR';
                                } else {
                                    $border[$k][$l] = 'R';
                                }
                            }
                        }
                    }
                } else {
                    // Border for only 1 row data
                    for ($j=0; $j < 10; $j++) { 
                        if ($j == 0) {
                            $border[$i][$j] = 'LRB';
                        } else {
                            $border[$i][$j] = 'RB';
                        }
                    }
                }

                $i += $rows['quantity'];
            }

            //--- PDF CREATION ---//
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
            $pdf->Cell(45,5,$transaction_id,0,1);
            $pdf->SetFont('Times','B',12);
            $pdf->Cell(45,5,'Transaction Date: ',0,0);
            $pdf->SetFont('Times','',12);
            $pdf->Cell(45,5,$transaction_date,0,1);
            $pdf->SetFont('Times','B',12);
            $pdf->Cell(45,5,'Transaction Status: ',0,0);
            $pdf->SetFont('Times','',12);
            $pdf->Cell(45,5,$transaction_status,0,1);
            $pdf->Ln(5);

            // Column headings
            $header = array('Room Name', 'Room No.', 'Arrival Time', 'Arrival Date', 'Departure Date', 'Nights', 'Price (P/N)', 'Status', 'Confirm Code', 'Subtotal');

            // Column widths
            $w = array(40, 18, 23, 27, 27, 15, 30, 22, 25, 30);

            // Table Creation
            $pdf->SetFont('Times','B',10);
            $pdf->CreateTableHeader($w, $header);
            $pdf->SetFont('Times','',10);
            $pdf->CreateTableBody($w, $data, $border, number_format($total_amount, 2));

            // Display PDF
            $pdf->Output();

        } else {
            echo $error_message = "No reservation record has been found.";
            die;
        }
    } else {
        echo $error_message = "No transaction record has been found.";
        die;
    }
} else {
    header("Location: transaction_page.php");
    die;
}

?>