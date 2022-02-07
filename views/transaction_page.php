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


// Alert message if Booking is Successful from submission_page
if (isset($_SESSION['message'])) {
    echo '<script type="text/javascript"> alert("' . $_SESSION['message'] . '"); </script>';
    unset($_SESSION['message']);
}


// Display Transaction Record(s)
$transaction_record = '';
$user_id = $_SESSION['user_id'];
$sql = "SELECT ts.transaction_id, ts.transaction_date, ts.total_amount, tsst.status_description, COUNT(rr.room_id) AS num_of_rooms
    FROM HRMS_transaction ts
    JOIN HRMS_transaction_status tsst 
    ON ts.transaction_status=tsst.status_id
    JOIN HRMS_reservation rs 
    ON ts.transaction_id=rs.transaction_id
    JOIN HRMS_rooms_reserved rr
    ON rs.reservation_id=rr.reservation_id
    WHERE ts.client_id = $user_id
    GROUP BY ts.transaction_id
    ORDER BY ts.transaction_date DESC";
echo $sql.'<br>';
if ($rs = $conn->query($sql)) {
    if ($rs->num_rows > 0) {
        while ($rows = $rs->fetch_assoc()) {
            $transaction_record .= '
            <div class="row text-center">
                <div class="col-2 my-auto">
                    <p>'.$rows['transaction_id'].'</p>
                </div>
                <div class="col-2 my-auto text-center">
                    <p>'.date_format(date_create($rows['transaction_date']), "m/d/Y").'</p>
                </div>
                <div class="col-1 my-auto">
                    <p>'.$rows['num_of_rooms'].'</p>
                </div>
                <div class="col-2 my-auto text-center">
                    <p>₱ '.number_format($rows['total_amount'], 2).'</p>
                </div>
                <div class="col-2 my-auto text-center">
                    <p class="status-text">'.strtoupper($rows['status_description']).'</p>
                </div>
                <div class="col-3" id="reserve-btn">
                    <button class="btn btn-md mt-3 mx-3 px-4 view" data-transaction='.$rows['transaction_id'].'>View</button>
                    <button class="btn btn-md mt-3 mx-3 px-4 print" data-transaction='.$rows['transaction_id'].'>Print</button>
                </div>
            </div>
            <hr class="thin">';
        }
    } else {
        $reservation_data .= '
        <div class="alert alert-secondary text-center" role="alert">
            You don\'t have any transactions made yet!
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
            <h1 class="ml-3 ">Transaction History</h1>
        </div>
        <div class="container-fluid d-flex justify-content-center">
            <div class="row">
                <div class="col-12 col-lg-9 col-xl-7 ">
                    <div class="card mx-auto" style="padding: 0; border-radius: 10px; width: 85rem; margin-bottom: 200px">
                        <div class="card-body pt-4">
                            <card>
                                <div class="row text-center">
                                    <div class="col-2">
                                        <h6>Transaction No.</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Transaction Date</h6>
                                    </div>
                                    <div class="col-1">
                                        <h6>No. of Rooms</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Total Amount</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Status</h6>
                                    </div>
                                    <div class="col-3">
                                        <h6>Action</h6>
                                    </div>
                                </div>
                                <hr class="solid">
                                <?php echo $transaction_record;  ?>
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
                if (el.text() === 'Canceled') {
                    el.css({
                        'color': 'red'
                    });
                } else if (el.text() === 'Pending') {
                    el.css({
                        'color': 'orange'
                    });
                } else {
                    el.css({
                        'color': 'green'
                    });
                }
            });

            // when view is clicked
            $('.view').click(function (e) {
                var transaction = $(this).attr('data-transaction');
                window.location.href="reservation_page.php?action=view&transaction="+transaction;
            });

            // when print is clicked
            $('.print').click(function (e) {
                var transaction = $(this).attr('data-transaction');
                window.location.href="reservation_page.php?action=print&transaction="+transaction;
            });
        });
    </script>
</body>

</html>