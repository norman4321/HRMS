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
                                <form class="booking-form">
                                    <div class=" mb-1">
                                        <h4 class="col-12  p-0 mb-3 text-start">Booking Summary</h4>
                                    </div>
                                    <div class="row">
                                        <div class="card-body pt-3" style="padding: 0 1rem">
                                            <card>
                                                <div class="row text-end">
                                                    <div class="col-3">
                                                        <h6>Room</h6>
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
                                                        <h6>Amount</h6>
                                                    </div>
                                                </div>
                                            </card>
                                        </div>
                                        <div class="card-body" style="padding: 0 1rem">
                                            <div class="row text-start">
                                                <div class="col-3 ">
                                                    <p class="py-0 ">Cozy Room</p>
                                                </div>
                                                <div class="col-2  text-center">
                                                    <p class="py-0 ">12/25/2021</p>
                                                </div>
                                                <div class="col-3  text-center">
                                                    <p class="py-0 ">12/28/2021</p>
                                                </div>
                                                <div class="col-2  text-center">
                                                    <p class="py-0 ">2</p>
                                                </div>
                                                <div class="col-2  text-center">
                                                    <p class="py-0 ">P 21500.00</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body" style="padding: 0 1rem">
                                            <div class="row text-start">
                                                <div class="col-3 ">
                                                    <p class="py-0 ">Cozy Room</p>
                                                </div>
                                                <div class="col-2  text-center">
                                                    <p class="py-0 ">12/25/2021</p>
                                                </div>
                                                <div class="col-3  text-center">
                                                    <p class="py-0 ">12/28/2021</p>
                                                </div>
                                                <div class="col-2  text-center">
                                                    <p class="py-0 ">2</p>
                                                </div>
                                                <div class="col-2  text-center">
                                                    <p class="py-0 ">P 21500.00</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pb-2" style="padding: 0 1rem">
                                            <div class="row text-start">
                                                <div class="col-3 ">
                                                    <p class="py-0 ">Cozy Fort Suite</p>
                                                </div>
                                                <div class="col-2  text-center">
                                                    <p class="py-0 ">12/25/2021</p>
                                                </div>
                                                <div class="col-3  text-center">
                                                    <p class="py-0 ">12/28/2021</p>
                                                </div>
                                                <div class="col-2  text-center">
                                                    <p class="py-0 ">2</p>
                                                </div>
                                                <div class="col-2  text-center">
                                                    <p class="py-0 ">P 21500.00</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="thin">
                                    <div class="card-body pt-3 pb-2 mr-2">
                                        <card>
                                            <div class="row d-flex justify-content-end">
                                                <h5>TOTAL AMOUNT:</h5>
                                                <h5 class="pl-5">P 1242259.00</h5>
                                            </div>
                                        </card>
                                    </div>
                                </form>
                            </card>
                        </div>
                    </div>

                    <!-----personal information----->
                    <div class="card ml-5 pt-2 pb-3" style="border-radius: 10px; margin-bottom: 200px">
                        <div class="card-body">
                            <card>
                                <form class="booking-form">
                                    <div class=" mb-1">
                                        <h4 class="col-12  p-0 mb-3 text-start">Personal Information</h4>
                                    </div>
                                    <div class="row pt-3">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="firstname">First Name</label>
                                                <input type="text" name="firstname" class="form-control form-control-md" placeholder="e.g. Juan" maxlength="50" required />

                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="lastname">Last Name</label>
                                                <input type="text" name="lastname" class="form-control form-control-md" placeholder="e.g Dela Cruz" maxlength="50" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="address">Address</label>
                                                <input type="address" name="address" class="form-control form-control-md" placeholder="e.g. Lot 1 Blk 2, Brgy. 33, Manila City" maxlength="100" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="birthdate">Birthdate</label>
                                                <input type="Date" name="birthdate" class="form-control form-control-md" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="nationality">Nationality</label>
                                                <input type="text" name="nationality" class="form-control form-control-md" placeholder="e.g. Filipino" maxlength="20" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="contact">Contact Number</label>
                                                <input type="tel" name="contact" class="form-control form-control-md" placeholder="e.g. 09053922400" minlength="11" maxlength="15" pattern="[0-9]+" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" id="email" class="form-control form-control-md" maxlength="320" placeholder="e.g. juandelacruz@gmail.com" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="time">Estimated Time of Arrival</label>
                                                <input type="time" id="password" class="form-control form-control-md" required />
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="guest-selection">
                                        <div class=" mb-1">
                                            <h4 class="col-12  p-0 mb-3 text-start">Reservation For</h4>
                                        </div>
                                        <fieldset>
                                            <input type="radio" class="radio" name="guest" value="user" id="user-btn" checked />
                                            <label class="mr-4 ml-1" for="user">Myself</label>
                                            <input type="radio" class="radio" name="guest" value="guest" id="guest-btn" />
                                            <label class="ml-1" for="guest">Someone Else</label>
                                        </fieldset>
                                    </div>
                                </form>
                                <form class="guest-form" id="guest-form">

                                    <div class="row pt-3">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="firstname">First Name</label>
                                                <input type="text" name="guest-firstname" class="form-control form-control-md" placeholder="e.g. Juan" maxlength="50" required />

                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-outline">
                                                <label class="form-label" for="lastname">Last Name</label>
                                                <input type="text" name="guest-lastname" class="form-control form-control-md" placeholder="e.g Dela Cruz" maxlength="50" required />
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
                                        <p class="pb-0 mb-2 mt-n1">(choose your preferred payment method below)</p>
                                    </div>

                                    <!--GCASH-->
                                    <div class="col-11 mx-auto p-0">
                                        <button type="button" id="gcash-btn" class="btn btn-payment col-12 p-0 mt-3 mb-2">
                                            <img src="../public/images/gcash.png" alt="" class="col-12 img-fluid">
                                        </button>
                                    </div>
                                    <card>
                                        <form id="gcash-form" class="col-12 mx-auto mt-4 p-0">
                                            <div class="col-12 os-total column p-0 mx-auto mb-3">
                                                <p class="mb-0">You have to pay:</p>
                                                <h3 for="total-amount" class="mt-0 text-center">P21500.00</h3>
                                            </div>
                                            <div class="col-12 mx-auto gcash-method" id="gcash-method">
                                                <p class="method-text mb-0">Mobile number (11 digit):</p>
                                                <input type="text" placeholder="e.g. 09053922466" name="gcash-num" class="form-control method-input col-12 mt-0" id="method-input" minlength="11" maxlength="11" required>
                                                <button class="btn  btn-checkout  mt-3 w-100 p-2" type="submit">SUBMIT BOOKING</button>
                                            </div>

                                        </form>
                                    </card>


                                    <div class="col-11 mx-auto p-0">
                                        <button type="button" id="master-btn" class="btn btn-payment col-12 p-0 mt-3">
                                            <img src="../public/images/mastercard.png" alt="" class="col-12 img-fluid">
                                        </button>
                                    </div>
                                    <card>
                                        <form id="master-form" class="col-12 mx-auto mt-4 p-0">
                                            <div class="col-12 os-total column p-0 mx-auto mt-3 mb-2">
                                                <p class="mb-0">You have to pay:</p>
                                                <h3 for="total-amount" class="mt-0 text-center">P21500.00</h3>
                                            </div>
                                            <div class="col-12 mx-auto master-method" id="master-method">
                                                <p class="method-text mb-0">Name on card:</p>
                                                <input type="text" class="form-control col-12 mt-0" minlength="2" id="method-input" name="cardName" maxlength="40" required>

                                                <p class="method-text mt-3 mb-0">Card number:</p>
                                                <input type="text" class="form-control col-12 mt-0" minlength="10" id="method-input" name="cardNum" maxlength="16" required>

                                                <p class="method-text mt-3 mb-0">Security code:</p>
                                                <input type="text" name="cardCCV" class="form-control col-12 mt-0" id="method-input" minlength="3" maxlength="4" required>

                                                <p class="method-text mt-3">Expiry date:</p>
                                                <div class="row col-12 mx-auto">
                                                    <div class="col-6 p-1 mx-auto">
                                                        <p class="method-text mb-0">Month</p>
                                                        <select name="expMonth" class="expMonth form-control col-12" id="method-input">
                                                            <option value="01" selected>01</option>
                                                            <option value="02">02</option>
                                                            <option value="03">03</option>
                                                            <option value="04">04</option>
                                                            <option value="05">05</option>
                                                            <option value="06">06</option>
                                                            <option value="07">07</option>
                                                            <option value="08">08</option>
                                                            <option value="09">09</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6 p-1 mx-auto">
                                                        <p class="method-text mb-0">Year</p>
                                                        <select name="expYear" class="expYear form-control col-12" id="method-input">
                                                            <option value="2021" selected>2022</option>
                                                            <option value="2022">2023</option>
                                                            <option value="2023">2024</option>
                                                            <option value="2024">2025</option>
                                                            <option value="2025">2026</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <button class="btn  btn-checkout  mt-3 w-100 p-2" type="submit">SUBMIT BOOKING</button>


                                            </div>
                                        </form>
                                    </card>
                                </div>
                            </div>


                        </div>
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

    <script>
        $("#master-btn").click(function() {
            $("#master-form").slideDown("slow");
            $("#gcash-form").slideUp("slow");
        });

        $("#gcash-btn").click(function() {
            $("#gcash-form").slideDown("slow");
            $("#master-form").slideUp("slow");
        });


        $("#user-btn").click(function() {
            $("#guest-form").slideUp("slow");
        });

        $("#guest-btn").click(function() {
            $("#guest-form").slideDown("slow");
        });
    </script>

</body>

</html>