<?php
include "../config/database.php";
include "../config/functions.php";
session_start();
$cart_count = countCartItems(); // Count cart item/s

// Check if user is not logged in, then redirects to signin page
if (!isset($_SESSION['user_id'])) {
    header('Location: signin_page.php');
}

// Check if action and transaction number is set
if (isset($_GET['action']) && isset($_GET['transaction']) && $_GET['action'] == 'view') {
    // view room reservations
} elseif (isset($_GET['action']) && isset($_GET['transaction']) && $_GET['action'] == 'print') {
    // print transaction receipt
} 

// Display Reservation Record(s)
$reservation_record = '';
$user_id = $_SESSION['user_id'];
$sql = "SELECT ts.transaction_id, ts.transaction_date, ts.total_amount, pm.method_name, ts.client_id, 
                rs.reservation_id, rs.confirm_code, rs.arrival_date, rs.departure_date, rs.arrival_time, rsst.status_description, 
                rr.room_id, r.room_number, rt.type_name
    FROM HRMS_transaction ts 
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
    WHERE ts.client_id = $user_id";
#echo $sql.'<br>';
if ($rs = $conn->query($sql)) {
    if ($rs->num_rows > 0) {
        $reservation_data = '';
        while ($rows = $rs->fetch_assoc()) {
            $reservation_data .=
                ' <div class="row text-center">
                <div class="col-2 my-auto text-center">
                    <p>' . $rows['type_name'] . '<br>RN-' . $rows['room_number'] . '</p>
                </div>
                <div class="col-2  my-auto text-center">
                    <p>' . date_format(date_create($rows['arrival_date']), "m/d/Y") . '</p>
                </div>
                <div class="col-2  my-auto text-center">
                    <p>' . date_format(date_create($rows['departure_date']), "m/d/Y") . '</p>
                </div>
                <div class="col-2  my-auto text-center">
                    <p>' . $rows['confirm_code'] . '</p>
                </div>
                <div class="col-2 my-auto text-center">
                    <p class="status-text"><b>' . strtoupper($rows['status_description']) . '</b></p>
                </div>';
            if (strtoupper($rows['status_description']) == "CONFIRMED") {
                $reservation_data .= '
                    <div class="col-2 my-auto text-center" id="reserve-btn">
                        <button class="btn-cancel btn btn-sm mt-3">CANCEL</button>
                    </div>
                </div>
                <hr class="thin">';
            } else {
                $reservation_data .= '
                    <div class="col-2 my-auto text-center" id="reserve-btn">
                        
                    </div>
                </div>
                <hr class="thin">';
            }
            #<button class="btn-cancel btn btn-sm mt-3" style="pointer-events: none;" disabled>CANCEL</button>
            #<button class="btn btn-sm mt-1">&nbsp;PRINT&nbsp;</button>
        }
    } else {
        $reservation_data .= '
        <div class="alert alert-secondary text-center" role="alert">
            No reservation(s) found!
        </div>
        '; 
    }
} else {
    echo $conn->error;  // display error for selecting data into database
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!--Created on 12/10/2021-->
    <?php include "./partials/head.html" ?>
</head>

<body id="reservation-page">
    <!-----header----->
    <?php include "./partials/header.php" ?>

    <!-----landing----->
    <section class="reservation-history">
        <div class="container-fluid py-2 px-5" id="cart-header">
            <h1 class="ml-3 ">Reservations</h1>
        </div>
        <div class="container-fluid d-flex justify-content-center">
            <div class="row">
                <div class="col-12 col-lg-9 col-xl-7 ">
                    <div class="card mx-auto" style="padding: 0; border-radius: 10px; width: 85rem; margin-bottom: 200px">
                        <div class="card-body pt-4">
                            <card>
                                <div class="row text-start pl-3 pb-3">
                                    <h6>Transaction Number: <?php echo $_GET['transaction'] ?> </h6>
                                </div>
                                <div class="row text-center">
                                    <div class="col-2">
                                        <h6>Rooms</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Check-in Date</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Check-out Date</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Confirmation Code</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Status</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Action</h6>
                                    </div>
                                </div>
                                <hr class="solid">
                                <?php if (!empty($reservation_record)) {
                                    echo $reservation_record;
                                } else { ?>
                                    <div class="alert alert-secondary text-center" role="alert">
                                        No reservation(s) record found!
                                    </div>
                                <?php } ?>
                                <!--
                                <div class="row text-center">
                                    <div class="col-2 my-auto">
                                        <p>Cozy Room</p>
                                    </div>
                                    <div class="col-2 my-auto text-center">
                                        <p>12/25/2021</p>
                                    </div>
                                    <div class="col-2  my-auto text-center">
                                        <p>12/28/2021</p>
                                    </div>
                                    <div class="col-2  my-auto text-center">
                                        <p>P 21500.00</p>
                                    </div>
                                    <div class="col-2 my-auto text-center">
                                        <p class="status-text"><b>SUCCESSFUL</b></p>
                                    </div>
                                    <div class="col-2 my-auto text-center" id="reserve-btn">
                                        <button class="btn-cancel btn btn-md mt-3 disabled"></button>
                                    </div>
                                </div>
                                <hr class="thin">
                                <div class="row text-center">
                                    <div class="col-2 my-auto">
                                        <p>Cozy Room</p>
                                    </div>
                                    <div class="col-2 my-auto text-center">
                                        <p>12/25/2021</p>
                                    </div>
                                    <div class="col-2  my-auto text-center">
                                        <p>12/28/2021</p>
                                    </div>
                                    <div class="col-2  my-auto text-center">
                                        <p>P 21500.00</p>
                                    </div>
                                    <div class="col-2 my-auto text-center">
                                        <p class="status-text"><b>SUCCESSFUL</b></p>
                                    </div>
                                    <div class="col-2 my-auto text-center" id="reserve-btn">
                                        <button class="btn-cancel btn btn-md mt-3 disabled"></button>
                                    </div>
                                </div>
                                <hr class="thin">
-->
                            </card>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        <?php include "./partials/footer.html" ?>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // setting text color of reservation status
            $('.status-text').each(function() {
                var el = $(this);
                if (el.text() === 'CONFIRMED') {
                    el.css({
                        'color': 'orange'

                    });
                } else {
                    el.css({
                        'color': 'green'

                    });
                }
            });
        });
    </script>
</body>

</html>