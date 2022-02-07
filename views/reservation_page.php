<?php
include "../config/database.php";
include "../config/functions.php";
session_start();
$cart_count = countCartItems(); // Count cart item/s

// Check if user is not logged in, then redirects to signin page
if (!isset($_SESSION['user_id'])) {
    header('Location: signin_page.php');
    die;
}


// Check if action and transaction number is set
if (isset($_GET['action']) && isset($_GET['transaction']) && $_GET['action'] == 'view') {
    
    // Get transaction details
    $transaction_id = $_GET['transaction'];
    $user_id = $_SESSION['user_id'];
    $transaction = getTransactionRecord($conn, $user_id, $transaction_id);
    if (!empty($transaction)) {
        #print_r($transaction);
        $transaction_date = date_format(date_create($transaction['transaction_date']), "M j, Y");
        $transaction_status = $transaction['transaction_status'];
        $total_amount = $transaction['total_amount'];

        // Get reservation details
        $reservation = getReservationRecord($conn, $user_id, $transaction_id);
        if (!empty($reservation)) {
            #print_r($reservation);
            $reservation_record = '';
            $reservation_status = array();
            foreach ($reservation as $rows) {
                $room_numbers = '';
                $reservation_status[$rows['reservation_id']] = $rows['reservation_status'];
                $nights = date_create($rows['arrival_date'])->diff(date_create($rows['departure_date']))->format("%a");
                $subtotal = $rows['quantity'] * $rows['price'] * $nights;

                // Check if room quantity is greater than 1, then get all room numbers; Else, set room number as what is on rows
                if ($rows['quantity'] > 1) {
                    // Get room numbers
                    $reservation_id = $rows['reservation_id'];
                    $room_nums = getRoomNumbers($conn, $reservation_id);
                    if (!empty($room_nums)) {
                        foreach ($room_nums as $room_num) {
                            $room_numbers .= $room_num . '<br>';
                        }
                    }
                } else {
                    $room_numbers = $rows['room_number'];
                }

                // Display reservation record
                $reservation_record .= '
                <tr>
                    <td>' . $rows['type_name'] . '</td>
                    <td>' . $room_numbers . '</td>
                    <td>' . date_format(date_create($rows['arrival_time']), "g:i A") . '</td>
                    <td>' . date_format(date_create($rows['arrival_date']), "m/d/Y") . '</td>
                    <td>' . date_format(date_create($rows['departure_date']), "m/d/Y") . '</td>
                    <td>' . $nights . '</td>
                    <td>₱ ' . number_format($rows['price'], 2) . '</td>
                    <td class="status-text">' . $rows['reservation_status'] . '</td>
                    <td>' . $rows['confirm_code'] . '</td>
                    <td class="text-right">₱ ' . number_format($subtotal, 2) . '</td>
                </tr>';
            }
            $reservation_record .= '
            <tr class="text-left">
                <td colspan="10"><b>Total Amount:</b> ₱ ' . number_format($total_amount, 2) . '</td>
            </tr>';
        } else {
            $error_message = "No reservation record has been found.";
        }
    } else {
        $error_message = "No transaction record has been found.";
    }

} elseif (isset($_GET['action']) && isset($_GET['transaction']) && $_GET['action'] == 'print') {
    // Print transaction receipt - redirect to receipt page
    $_SESSION['transaction'] = $_GET['transaction'];
    header("Location: receipt.php");
    die;
} else {
    header("Location: transaction_page.php");
    die;
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
                                <!-- Error Message -->
                                <?php if (!empty($error_message)) { ?>
                                    <div class="alert alert-danger mb-3 text-center">
                                        <strong>Error! </strong> <?php echo $error_message; ?>
                                    </div>
                                <?php die; } ?>

                                <div class="pb-2">
                                    <h6>Transaction No.: <?= $transaction_id ?></h6>
                                    <h6>Transaction Date: <?= $transaction_date ?></h6>
                                    <h6>Status: <span class="status-text"><?= $transaction_status ?></span></h6>
                                </div>
                                <table class="table reservation text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Room Name</th>
                                            <th scope="col">Room No.</th>
                                            <th scope="col">Arrival Time</th>
                                            <th scope="col">Arrival Date</th>
                                            <th scope="col">Departure Date</th>
                                            <th scope="col">Nights</th>
                                            <th scope="col">Price (P/N)</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Confirmation Code</th>
                                            <th scope="col">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $reservation_record; ?>
                                    </tbody>
                                </table>
                            </card>
                        </div>
                        <div class="pb-4 mr-5" id="reserve-btn">
                            <div class="row d-flex justify-content-end">

                                <?php if (in_array("Confirmed", $reservation_status)) : ?>
                                    <button class="btn btn-md mt-5 mx-2 cancel" data-token="<?= $transaction_id ?>">CANCEL</button>
                                <?php endif; ?>
                                
                                <button class="btn btn-md mt-5 mx-2 print" data-transaction="<?= $transaction_id ?>">PRINT</button>
                            </div>
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
            // setting text color of status
            $('.status-text').each(function() {
                var el = $(this);
                if (el.text() === 'Canceled') {
                    el.css({
                        'color': 'red'
                    });
                } else if (el.text() === 'Pending' || el.text() === 'Confirmed') {
                    el.css({
                        'color': 'orange'
                    });
                } else {
                    el.css({
                        'color': 'green'
                    });
                }
            });

            // when print is clicked
            $('.print').click(function (e) {
                var transaction = $(this).attr('data-transaction');
                window.location.href="reservation_page.php?action=print&transaction="+transaction;
            });

            // when cancel transaction is clicked
            $('.cancel').click(function (e) {
                var token = $(this).attr('data-token');
                if (confirm('All reservations you made under this transaction would be canceled. Incase your reservation(s) is beyond 72 hours before the check-in date, It would be subjected to cancel cancellation policy of the Cozy Home. Are you sure to cancel this transaction?')) {
                    window.location.href="cancellation.php?token="+token;
                }
            });
        });
    </script>
</body>

</html>