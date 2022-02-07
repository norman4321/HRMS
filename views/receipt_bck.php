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

    function CreateTableHeader($header)
    {
        // Column widths
        $w = array(40, 18, 23, 27, 27, 15, 30, 22, 25, 30);
        
        // Header
        for($i=0; $i < count($header); $i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
        $this->Ln();
    }

    function CreateTableBody($data, $border, $total)
    {
        // Column widths
        $w = array(40, 18, 23, 27, 27, 15, 30, 22, 25, 30);

        for ($i=0; $i < count($data) ; $i++) { 
            for ($j=0; $j < count($w) ; $j++) { 
                $this->Cell($w[$j],6,$data[$i][$j],$border[$i][$j],0,'C');
            }
            $this->Ln();
        }
        $this->SetFont('Times','B',10);
        $this->Cell(257,7,"Total Amount: P $total",'TLRB',0,'R');
        //$this->Cell(30,7,'Php 71,940.00',1,0,'R');
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
    $user_id = $_SESSION['user_id'];
    $transaction_id = $_SESSION['transaction'];
    #echo "Transaction: $transaction_id";
    $sql = "SELECT ts.transaction_id, ts.transaction_date, ts.total_amount, pm.method_name, up.profile_firstname, up.profile_lastname, up.profile_address, tsst.status_description AS transaction_status,
                    rs.reservation_id, rs.confirm_code, rs.arrival_date, rs.departure_date, rs.arrival_time, rs.quantity, rs.price, rsst.status_description AS reservation_status, 
                    rr.room_id, r.room_number, rt.type_name
        FROM HRMS_transaction ts 
        JOIN HRMS_user_profile up
        ON ts.client_id=up.profile_id
        JOIN HRMS_payment_method pm
        ON ts.payment_method=pm.method_id
        JOIN HRMS_transaction_status tsst 
        ON ts.transaction_status=tsst.status_id
        JOIN HRMS_reservation rs 
        ON ts.transaction_id=rs.transaction_id
        JOIN HRMS_reservation_status rsst
        ON rs.reservation_status=rsst.status_id
        JOIN HRMS_rooms_reserved rr
        ON rs.reservation_id=rr.reservation_id
        JOIN HRMS_room r
        ON rr.room_id=r.room_id
        JOIN HRMS_room_type rt
        ON r.room_type=rt.type_id
        WHERE ts.client_id = $user_id AND ts.transaction_id=$transaction_id
        GROUP BY rr.reservation_id";
    #echo $sql.'<br>';
    $data = array();
    $border = array();
    $transaction_date = '';
    $reservation_status = array();
    $room_nums = array();
    $room_numbers = '';
    $counter = 1;
    if ($rs = $conn->query($sql)) {
        if ($rs->num_rows > 0) {
            #while ($rows = $rs->fetch_assoc()) {
            for ($i=0; $rows = $rs->fetch_assoc(); $i++) {

                $reservation_status[$rows['reservation_id']] = $rows['reservation_status'];
                $nights = date_create($rows['arrival_date'])->diff(date_create($rows['departure_date']))->format("%a");
                $subtotal = $rows['quantity'] * $rows['price'] * $nights;
            
                // Execute only once - Set transaction date and status
                if ($counter == 1) {
                    $guest_name = $rows['profile_firstname'].' '.$rows['profile_lastname'];
                    $guest_address = $rows['profile_address'];
                    $transaction_date = date_format(date_create($rows['transaction_date']), "M j, Y");
                    $transaction_status = $rows['transaction_status'];
                    $total_amount = $rows['total_amount'];
                    $counter++;
                }

                // Check if room quantity is greater than 1, then get all room numbers; Else, set room number as what is on rows
                if ($rows['quantity'] > 1) {
                    $reservation_id = $rows['reservation_id'];
                    $sql = "SELECT r.room_number FROM HRMS_rooms_reserved rr
                            JOIN  HRMS_room r ON rr.room_id=r.room_id
                            WHERE reservation_id=$reservation_id";
                    ##echo $sql.'<br>';
                    if ($rd = $conn->query($sql)) {
                        if ($rd->num_rows > 0) {
                            $x = 0;
                            while ($rooms = $rd->fetch_assoc()) {
                                $room_numbers .= $rooms['room_number'] . "<br>";
                                $room_nums[$x] = $rooms['room_number'];
                                $x++;
                            }
                        } else {
                            $error_message = 'No rooms reserved.'; // Display Error Message
                        }
                    } else {
                        #echo $conn->error;  // display error for selecting count data into database
                    }
                } else {
                    $room_numbers = $rows['room_number'];
                }

                /*if ($rows['quantity'] == 1) {
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
                    for ($j=0; $j < 10; $j++) { 
                        if ($j == 0) {
                            $border[$i][$j] = 'LRB';
                        } else {
                            $border[$i][$j] = 'RB';
                        }
                    }
                } else {
                    for ($k=0; $k < $rows['quantity']; $k++) { 
                        for ($l=0; $l < 10; $l++) { 
                            if ($l != 1) {
                                $data[$i][$k] = '';
                            } else {
                                $data[$i][$k] = $room_nums[$k];
                            }
                        }
                       
                        
                    }
                }*/

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

                    for ($k=1; $k < $rows['quantity']; $k++) { 
                        for ($l=0; $l < 10; $l++) { 
                            // Content
                            if ($l != 1) {
                                $data[$k][$l] = '';
                            } else {
                                $data[$k][$l] = $room_nums[$k];
                            }

                            
                            if ($k == $rows['quantity']-1) {
                                // Border for bottom
                                if ($l == 0) {
                                    $border[$k][$l] = 'LRB';
                                } else {
                                    $border[$k][$l] = 'RB';
                                }
                            } else {
                                // Border for not bottom
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
                #print_r($data);

                $i += $rows['quantity']-1;






                /*// Check if quantity or num of rooms is greater than 1
                if ($rows['quantity'] > 1) {
                    
                }

                for ($j=0; $j < 10; $j++) { 
                    for ($k=0; $k < count($room_nums); $k++) {
                        if ($k == 0 ) {
                            # code...
                        } elseif ($k == count($room_nums)-1) {
                            # code...
                        } else {

                        }

                    }
                    
                }*/

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

            //--- Table for Transaction ---//
            // Column headings
            $header = array('Room Name', 'Room No.', 'Arrival Time', 'Arrival Date', 'Departure Date', 'Nights', 'Price (P/N)', 'Status', 'Confirm Code', 'Subtotal');

            // Data loading

            // Table Creation
            $pdf->SetFont('Times','B',10);
            $pdf->CreateTableHeader($header);
            $pdf->SetFont('Times','',10);
            $pdf->CreateTableBody($data, $border, number_format($total_amount, 2));

            // Display PDF
            $pdf->Output();



        } else {
            #echo " No reservation(s) found!";
        }
    } else {
        #echo $conn->error;  // display error for selecting data into database
    }
} else {
    header("Location: transaction_page.php");
    die;
}






?>