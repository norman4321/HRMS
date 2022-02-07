<?php
include "../config/database.php";
include "../config/functions.php";
session_start();
$cart_count = countCartItems(); // Count cart item/s
$count = countCartItemsAvailable();

// Check if cart is not empty and there's available items, then can proceed to next
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    if ($count < 1) {
        $_SESSION['message'] = "Sorry! You can\'t checkout unavailable rooms.";
        header("Location: cart_page.php");
        die;
    }
} else {
    $_SESSION['message'] = "Sorry! You can\'t checkout while cart is empty.";
    header("Location: cart_page.php");
    die;
}


$error_message = '';
$registered = false;

$firstname = '';
$lastname = '';
$address = '';
$birthdate = '';
$nationality = '';
$contact = '';
$email = '';

$time = '';


// Check if user is logged in, then get user profile info in the database
if (isset($_SESSION['user_id'])) {
    $sql = "SELECT * FROM HRMS_user_profile WHERE profile_id=" . $_SESSION['user_id'] . " LIMIT 1";
    if ($rs = $conn->query($sql)) {
        if ($rs->num_rows > 0) {
            $user_data      = $rs->fetch_assoc();
            $registered     = true;
            $firstname      = $user_data['profile_firstname'];
            $lastname       = $user_data['profile_lastname'];
            $address        = $user_data['profile_address'];
            $birthdate      = $user_data['profile_birthdate'];
            $nationality    = $user_data['profile_nationality'];
            $contact        = $user_data['profile_contact'];
            $email          = $user_data['profile_email'];
        }
    } else {
        echo $conn->error;  // display error for selecting data into database
    }
}


// When 'Submit Booking' is clicked - Submitted Form POST
if (isset($_POST['firstname']) && isset($_SESSION['cart']) && !empty($_SESSION['cart']) && $count >0) {
    $firstname      = $_POST['firstname'];
    $lastname       = $_POST['lastname'];
    $address        = $_POST['address'];
    $birthdate      = $_POST['birthdate'];
    $nationality    = $_POST['nationality'];
    $contact        = $_POST['contact'];
    $email          = $_POST['email'];
    $time           = $_POST['time'];
    $method         = $_POST['paymethod'];
    $total_amount   = 0;
    $status         = 1; // room status = active & reservation status = confirmed

    #echo $firstname.' | '.$lastname.' | '.$address.' | '.$birthdate.' | '.$nationality.' | '.$contact.' | '.$email.' | '.$time.' | '.$method;

    //----- Create Transaction - Insert into database -----//
    // Set Payment Method
    if ($method == "GCash") {
        $method = 1; // GCash
    } else {
        $method = 2; // Credit Card
    }

    // Compute total amount - loop through each items
    foreach ($_SESSION['cart'] as $item) {
        if ($item['availability']) {     
            $total_amount += $item['price'] * $item['quantity'] * $item['nights'];;
        }
    }

    // Set Client ID - Look first if with same user profile in the database
    if ($registered) {
        $client_id = $_SESSION['user_id'];
    } else {
        $sql = "SELECT profile_id FROM HRMS_user_profile WHERE profile_firstname='$firstname' AND profile_lastname='$lastname' AND profile_address='$address' AND profile_birthdate='$birthdate' AND profile_nationality='$nationality' AND profile_contact='$contact' AND profile_email='$email' LIMIT 1";
        #echo $sql.'<br>';
        $exist = isSameProfile($conn, $sql);
        if ($exist) {
            $client_id = $exist;
        } else {
            $sql = "INSERT INTO HRMS_user_profile SET profile_firstname='$firstname', profile_lastname='$lastname', profile_address='$address', profile_birthdate='$birthdate', profile_nationality='$nationality', profile_contact='$contact', profile_email='$email'";
            #$sql = "INSERT INTO HRMS_user_profile (profile_firstname, profile_lastname, profile_address, profile_birthdate, profile_nationality, profile_contact, profile_email) VALUES ('$firstname', '$lastname', '$address', '$birthdate', '$nationality', '$contact', '$email')";
            #echo $sql.'<br>';
            if ($conn->query($sql)) {
                $client_id = $conn->insert_id;
            } else {
                echo $conn->error;  // display error for inserting data into database
                #die('Error! '.$conn->connect_error);
            }
        }
    }

    // Set transaction date & time - format: 2022-12-31 23:59:59 timezone (Asia/Manila)
    date_default_timezone_set('Asia/Manila');
    $date = date('Y-m-d H:i:s');

    // Insert transaction into database
    $sql = "INSERT INTO HRMS_transaction SET transaction_date='$date', total_amount=$total_amount, payment_method=$method, client_id=$client_id, transaction_status=1"; // 1=PAID
    #echo $sql.'<br>';
    if ($conn->query($sql)) {
        $transaction_id = $conn->insert_id;
    } else {
        echo $conn->error;  // display error for inserting data into database
    }


    //----- Reservation Process -----/
    // Check availability of each room item in the cart - loop through each items
    $total = 0; $counter = 0;
    foreach ($_SESSION['cart'] as $item) {
        if ($item['availability']) {
            $counter++;
            // Get available room for specific room type and date in/out
            createRoomsListView($item['id'], $item['numpersons'], $status);
            createRoomsAvailableView($item['datein'], $item['dateout']);
            $sql = "SELECT room_id FROM rooms_available WHERE type_id=".$item['id']." LIMIT ".$item['quantity'];
            echo $sql.'<br>';
            if ($rs = $conn->query($sql)) {
                if ($rs->num_rows > 0) {
                    // Check If available room/s is less than the quantity, then cancel transaction
                    if ($rs->num_rows < $item['quantity']) {
                        echo '<script type="text/javascript"> 
                            if (!confirm("Sorry, Only '.$rs->num_rows.' rooms remains available for '.$item['name'].'. Would you still like to proceed booking?")) {
                                window.location.href="cart_page.php?action=cancel&transaction='.$transaction_id.'";
                            }
                        </script>';
                    }
                    
                    //----- Create Reservation -----//
                    // Set Confirmation Code - Generate new confirmation code and check if code already exist, repeat if exist. 
                    do {
                        $code = generateConfirmationCode(8);
                    } while (isCodeExist($conn, $code));
                    
                    // Insert reservation into database
                    $sql = "INSERT INTO HRMS_reservation SET transaction_id=$transaction_id, confirm_code='$code', arrival_date='".$item['datein']."', departure_date='".$item['dateout']."', arrival_time='$time', quantity=$rs->num_rows, price=".$item['price'].", reservation_status=$status";
                    echo $sql.'<br>';
                    if ($conn->query($sql)) {
                        $reservation_id = $conn->insert_id;
                    } else {
                        echo $conn->error;  // display error for inserting data into database
                    }

                    // Get room number then reserved the room - repeat quantity times  
                    while ($rows = $rs->fetch_assoc()) {
                        echo 'room-id='.$rows['room_id']."<br>";
                        $total += $item['price'] * $item['nights'];

                        //----- Reserve Room ------//
                        // Insert rooms reserved into database
                        $sql = "INSERT INTO HRMS_rooms_reserved SET reservation_id=$reservation_id, room_id=".$rows['room_id'];
                        echo $sql.'<br>';
                        if (!$conn->query($sql)) {
                            echo $conn->error;  // display error for inserting data into database
                        }
                    }
                    
                } else {
                    // When there's no more available rooms for this item
                    $item['availability'] = false;
                    
                    // Check if there are other room items in the cart, then ask if will still proceed booking or cancel transaction
                    if ($count > 1 && $counter < $count) {
                        echo '<script type="text/javascript"> 
                            if (!confirm("Sorry,there\'s no more available '.$item['name'].' for '.$item['datein'].' to '.$item['dateout'].'. Would you still like to proceed booking your other rooms in cart?")) {
                                window.location.href="cart_page.php?action=cancel&transaction='.$transaction_id.'";
                            }
                        </script>';
                    } else {
                        // if no more remaining items in the cart
                        $_SESSION['message'] = "Sorry,there\'s no more available ".$item['name']." for ".$item['datein']." to ".$item['dateout'].".";
                        header("Location: cart_page.php");
                        die;
                    }
                }
            } else {
                echo $conn->error;  // display error for selecting data into database
            }
        }
    }

    // Check there's room item book
    if ($total == 0) {
        header("Location: cart_page.php?action=cancel&transaction=$transaction_id");
        die;
    }
    // Check if total is same with total amount
    elseif ($total != $total_amount) {
        $sql = "UPDATE HRMS_transaction SET total_amount=$total WHERE transaction_id=$transaction_id";
        echo $sql.'<br>';
        if (!$conn->query($sql)) {
            echo $conn->error;  // display error for deleting data into database
        }
    }

    // When the booking is successful
    // Check if registered
    if ($registered) {
        // Redirect to Transaction History and Display Success Message for Successful Booking
        removeAvailableItemsInCart();
        $_SESSION['message'] = "Success! You have successfully booked your room(s).";
        header("Location: transaction_page.php");
        die;
    } else {
        // Send email as receipt or booking confirmation to client's email
        echo 'Must Send Email';
    }

}


// When transaction is cancelled
if (isset($_GET['action']) && $_GET['action'] == 'cancel' && isset($_GET['transaction'])) {
    // Delete all reserved rooms from rooms reserved table
    // Delete all reservations from reservation table
    // Delete transaction from transaction table
    $sql = "DELETE FROM HRMS_transaction WHERE transaction_id=".$_GET['transaction'];
    echo $sql;
    if (!$conn->query($sql)) {
        echo $conn->error;  // display error for deleting data into database
    }
    header("Location: cart_page.php");
    die;
}


// Function to create options for card expiration month
function getMonthOptions()
{
    $option_months = '';
    for ($i=1; $i <= 12; $i++) { 
        if ($i == 1) {
            $option_months .= "<option value=$i selected>0$i</option>";
        } elseif ($i < 10) {
            $option_months .= "<option value=$i >0$i</option>";
        } else {
            $option_months .= "<option value=$i >$i</option>";
        }
    }
    return  $option_months;
} 


// Function to create options for card expiration year
function getYearOptions()
{
    // Get current year and print till next 5 years
    $year = (int) date("Y");
    $option_years = "";
    $option_years .= "<option value=$year selected>$year</option>";
    for ($i=1; $i <= 5; $i++) { 
        $option_years .= "<option value=".$year+$i.">".$year+$i."</option>";
    }
    return  $option_years;
}

// Function to remove available items in the cart
function removeAvailableItemsInCart()
{
    $array_keys = array_keys($_SESSION['cart']);
    foreach ($array_keys as $key) {
        if ($_SESSION['cart'][$key]['availability']) {
            unset($_SESSION['cart'][$key]);
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!--Created on 12/10/2021-->
    <?php include "./partials/head.html" ?>
</head>

<body id="cart-page">
    <!-----header----->
    <?php include "./partials/header.php" ?>

    <!-----landing----->
    <section class="booking-submission">
        <div class="container-fluid py-2 px-5" id="submission-header">
            <h1 class="ml-3 ">Booking Submission</h1>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-7">
                    <!-----booking summary----->
                    <div class="card ml-5 pt-2" style="border-radius: 10px; margin-bottom: 20px">
                        <div class="card-body">
                            <card>
                                <div class=" mb-1">
                                    <h4 class="col-12  p-0 mb-3 text-start">Booking Summary</h4>
                                </div>
                                <!-- info message -->
                                <?php if ($count < $cart_count) : $info_message = 'Not available room(s) on your cart cannot be booked, only available rooms can proceed with booking.'; ?>
                                    <small><?php include "./partials/info_message.php" ?></small>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="card-body pt-3" style="padding: 0 1rem">
                                        <card>
                                            <div class="row text-end">
                                                <div class="col-2">
                                                    <h6>Room</h6>
                                                </div>
                                                <div class="col-1 text-center">
                                                    <h6>Qty.</h6>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <h6>Check-in Date</h6>
                                                </div>
                                                <div class="col-3 text-center">
                                                    <h6>Check-out Date</h6>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <h6>Nights</h6>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <h6>Subtotal</h6>
                                                </div>
                                            </div>
                                        </card>
                                    </div>
                                    <?php if ($count) { // Check if there's room to book 
                                        $total_price = 0; ?>
                                        <?php foreach ($_SESSION['cart'] as $item) { ?>
                                            <?php if ($item['availability']) { ?>
                                                <div class="card-body" style="padding: 0 1rem">
                                                    <div class="row text-start">
                                                        <div class="col-2 ">
                                                            <p class="py-0 "><?= $item['name'] ?></p>
                                                        </div>
                                                        <div class="col-1 text-center">
                                                            <p class="py-0"><?= $item['quantity'] ?></p>
                                                        </div>
                                                        <div class="col-2  text-center">
                                                            <p class="py-0 "><?= date_format(date_create($item['datein']), "m/d/Y"); ?></p>
                                                        </div>
                                                        <div class="col-3  text-center">
                                                            <p class="py-0 "><?= date_format(date_create($item['dateout']), "m/d/Y"); ?></p>
                                                        </div>
                                                        <div class="col-2  text-center">
                                                            <p class="py-0 "><?= $item['nights'] ?></p>
                                                        </div>
                                                        <div class="col-2  text-center">
                                                            <p class="py-0 ">₱ <?php $total_price += $item['price'] * $item['quantity'] * $item['nights']; echo number_format($item['price'] * $item['quantity'] * $item['nights'], 2) ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <hr class="thin">
                                <div class="card-body pt-3 pb-2 mr-2">
                                    <card>
                                        <div class="row d-flex justify-content-end">
                                            <h5>TOTAL AMOUNT:</h5>
                                            <h5 class="pl-5">₱ <?= number_format($total_price, 2) ?></h5>
                                        </div>
                                    </card>
                                </div>
                            </card>
                        </div>
                    </div>

                    <!-----personal information----->
                    <div class="card ml-5 pt-2 pb-3" style="border-radius: 10px; margin-bottom: 200px">
                        <div class="card-body">
                            <card>
                                <!-- Booking Form -->
                                <form class="booking-form" action="" method="POST">
                                    <div class=" mb-1">
                                        <h4 class="col-12  p-0 mb-3 text-start">Personal Information</h4>
                                        <!---- info message ---->
                                        <?php if ($registered) : $info_message = 'Please indicate estimated time of your arrival.'; ?>
                                            <small><?php include "./partials/info_message.php" ?></small>
                                        <?php else : $info_message = 'Please fill up this form.'; ?>
                                            <small><?php include "./partials/info_message.php" ?></small>
                                        <?php endif; ?>
                                    </div>
                                    <div class="row pt-3">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="firstname">First Name</label>
                                                <input type="text" name="firstname" class="form-control form-control-md" placeholder="e.g. Juan" maxlength="50" required <?= $registered ? "readonly" : "" ?> value="<?= $firstname ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="lastname">Last Name</label>
                                                <input type="text" name="lastname" class="form-control form-control-md" placeholder="e.g Dela Cruz" maxlength="50" required <?= $registered ? "readonly" : "" ?> value="<?= $lastname ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="address">Address</label>
                                                <input type="address" name="address" class="form-control form-control-md" placeholder="e.g. Lot 1 Blk 2, Brgy. 33, Manila City" maxlength="100" required <?= $registered ? "readonly" : "" ?> value="<?= $address ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="birthdate">Birthdate</label>
                                                <input type="Date" name="birthdate" id="birthdate" class="form-control form-control-md" required <?= $registered ? "readonly" : "" ?> value="<?= $birthdate ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="nationality">Nationality</label>
                                                <input type="text" name="nationality" class="form-control form-control-md" placeholder="e.g. Filipino" maxlength="20" required <?= $registered ? "readonly" : "" ?> value="<?= $nationality ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="contact">Contact Number</label>
                                                <input type="tel" name="contact" class="form-control form-control-md" placeholder="e.g. 09053922400" minlength="8" maxlength="15" pattern="^[+]?[\d]+([\-][\d]+)*\d$" required <?= $registered ? "readonly" : "" ?> value="<?= $contact ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" name="email" class="form-control form-control-md" maxlength="320" placeholder="e.g. juandelacruz@gmail.com" required <?= $registered ? "readonly" : "" ?> value="<?= $email ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="time">Estimated Time of Arrival</label>
                                                <input type="time" name="time" class="form-control form-control-md" required value="<?= $time ?>" />
                                            </div>
                                        </div>
                                    </div>
                                <!-- </form> -->
                            </card>
                        </div>
                    </div>
                </div>

                <!--Payment Method-->
                <div class="col-5">
                    <div id="payment-method" class="col-10 payment-method column mr-4 mb-4">
                        <div class="card" style="border-radius: 10px; margin-bottom: 200px">
                            <div class="card-body">
                                <div class="col-12 mx-auto mb-2 ">
                                    <div class="top-os mt-2 mb-2">
                                        <h4 class="col-12  p-0 mb-2 text-center">Payment Method</h4>
                                        <!--<p class="pb-0 mb-2 mt-n1">(choose your preferred payment method below)</p>-->
                                        <!--<small><p class="pb-0 mb-2 mt-n1" style="background-color:#D1ECF1;border-radius:5px;">(choose your preferred payment method)</p></small> -->
                                        <?php $info_message = 'Please choose your preferred payment method.'; ?>
                                        <small><?php include "./partials/info_message.php" ?></small>
                                    </div>

                                    <!--GCASH-->
                                    <div class="col-11 mx-auto p-0">
                                        <button type="button" id="gcash-btn" class="btn btn-payment col-12 p-0 mt-3 mb-2">
                                            <img src="../public/images/gcash.png" alt="" class="col-12 img-fluid">
                                        </button>
                                    </div>
                                    <card>
                                        <!--GCash Form-->
                                        <div id="gcash-form" class="col-12 mx-auto mt-4 p-0">
                                            <div class="col-12 os-total column p-0 mx-auto mb-3">
                                                <p class="mb-0">You have to pay:</p>
                                                <h3 for="total-amount" class="mt-0 text-center">₱ <?= number_format($total_price, 2) ?></h3>
                                            </div>
                                            <div class="col-12 mx-auto gcash-method" id="gcash-method">
                                                <p class="method-text mb-0">Mobile number (11 digit):</p>
                                                <input type="hidden" name="paymethod" id="paymethod">
                                                <input type="text" class="form-control method-input col-12 mt-0 method-input" placeholder="e.g. 09053922466" minlength="11" maxlength="11" name="gcashnum" id="gcash-num" required>
                                                <button class="btn btn-checkout mt-3 w-100 p-2" type="submit">SUBMIT BOOKING</button>
                                            </div>
                                        </div>
                                        <!--end GCash Form-->
                                    </card>

                                    <!--MASTER CARD-->
                                    <div class="col-11 mx-auto p-0">
                                        <button type="button" id="master-btn" class="btn btn-payment col-12 p-0 mt-3">
                                            <img src="../public/images/mastercard.png" alt="" class="col-12 img-fluid">
                                        </button>
                                    </div>
                                    <card>
                                        <!--Master Card Form-->
                                        <div id="master-form" class="col-12 mx-auto mt-4 p-0">
                                            <div class="col-12 os-total column p-0 mx-auto mt-3 mb-2">
                                                <p class="mb-0">You have to pay:</p>
                                                <h3 for="total-amount" class="mt-0 text-center">₱ <?= number_format($total_price, 2) ?></h3>
                                            </div>
                                            <div class="col-12 mx-auto master-method" id="master-method">
                                                <p class="method-text mb-0">Name on card:</p>
                                                <input type="text" class="form-control col-12 mt-0 method-input" minlength="2" maxlength="40" id="card-name" name="cardname" required>

                                                <p class="method-text mt-3 mb-0">Card number:</p>
                                                <input type="text" class="form-control col-12 mt-0 method-input" minlength="10" maxlength="16" id="card-num" name="cardnum" required>

                                                <p class="method-text mt-3 mb-0">Security code:</p>
                                                <input type="text" class="form-control col-12 mt-0 method-input" minlength="3" maxlength="4" id="card-ccv" name="cardccv" required>

                                                <p class="method-text mt-3">Expiry date:</p>
                                                <div class="row col-12 mx-auto">
                                                    <div class="col-6 p-1 mx-auto">
                                                        <p class="method-text mb-0">Month</p>
                                                        <select class="expMonth form-control col-12 method-input" id="exp-month" name="expmonth">
                                                            <?php echo getMonthOptions(); ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-6 p-1 mx-auto">
                                                        <p class="method-text mb-0">Year</p>
                                                        <select class="expyear form-control col-12 method-input" id="exp-year" name="expyear" >
                                                            <?php echo getYearOptions(); ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <button class="btn btn-checkout mt-3 w-100 p-2" type="submit">SUBMIT BOOKING</button>
                                            </div>
                                        </div>
                                        <!--End Master Card Form-->
                                    </card>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        <?php include "./partials/footer.html" ?>

    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        // When document ready... Set age limit to 18 by setting max birthdate
        $(function() {
            var today = new Date();
            var mm = today.getMonth()+1;
            mm = mm<10 ? '0'+mm : mm;
            var dd = today.getDate();
            dd = dd<10 ? '0'+dd : dd;
            var yyyy = today.getFullYear()-18;
            var date = yyyy+'-'+mm+'-'+dd;
            var input = document.getElementById("birthdate").max = date;
        });
    </script>
    <script>
        $("#master-btn").click(function() {
            $("#master-form").slideDown("slow");
            $("#gcash-form").slideUp("slow");
            $("#paymethod").val("Credit Card")
            // require
            $("#card-name").attr("required", true);
            $("#card-num").attr("required", true);
            $("#card-ccv").attr("required", true);
            $("#exp-month").attr("required", true);
            $("#exp-year").attr("required", true);
            // unrequire
            $("#gcash-num").attr("required", false);
        });

        $("#gcash-btn").click(function() {
            $("#gcash-form").slideDown("slow");
            $("#master-form").slideUp("slow");
            $("#paymethod").val("GCash")
            // require
            $("#gcash-num").attr("required", true);
            // unrequire
            $("#card-name").attr("required", false);
            $("#card-num").attr("required", false);
            $("#card-ccv").attr("required", false);
            $("#exp-month").attr("required", false);
            $("#exp-year").attr("required", false);
        });
    </script>

</body>

</html>