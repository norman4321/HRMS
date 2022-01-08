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
    <section class="booking-cart">
        <div class="container-fluid py-2 px-5" id="cart-header">
            <h1 class="ml-3 ">Booking Cart</h1>
        </div>
        <div class="container-fluid d-flex justify-content-center">
            <div class="row">
                <div class="col-12 col-lg-9 col-xl-7 ">
                    <div class="card mx-auto" style="border-radius: 10px; width: 85rem; margin-bottom: 200px">
                        <div class="card-body pt-4">
                            <card>
                                <div class="row text-center">
                                    <div class="col-2">
                                        <h6>Room</h6>
                                    </div>
                                    <div class="col-3">
                                        <h6>Check-in Date</h6>
                                    </div>
                                    <div class="col-3">
                                        <h6>Check-out Date</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Amount</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Remove</h6>
                                    </div>
                                </div>
                                <hr class="solid">
                            </card>
                        </div>
                        <div class="card-body">
                            <card>
                                <div class="row text-center">
                                    <div class="col-2 p-3 mx-auto">
                                        <img src='../public/images/cozy_executive_suite.jpg' class="img-fluid">
                                    </div>
                                    <div class="col-3 p-3 mx-auto text-center">
                                        <p class="py-0 ">12/25/2021</p>
                                    </div>
                                    <div class="col-3 p-3 mx-auto text-center">
                                        <p class="py-0 ">12/28/2021</p>
                                    </div>
                                    <div class="col-2 p-3 mx-auto text-center">
                                        <p class="py-0 ">P 21500.00</p>
                                    </div>
                                    <div class="col-2 p-3 my-auto text-center">
                                        <a href="#"><i class=" fas fa-times fa-2x"></i></a>
                                    </div>
                                </div>
                                <hr class="thin">
                            </card>
                        </div>
                        <div class="card-body">
                            <card>
                                <div class="row text-center">
                                    <div class="col-2 p-3 mx-auto">
                                        <img src='../public/images/cozy_suite.jpg' class="img-fluid">
                                    </div>
                                    <div class="col-3 p-3 mx-auto text-center">
                                        <p class="py-0 ">12/25/2021</p>
                                    </div>
                                    <div class="col-3 p-3 mx-auto text-center">
                                        <p class="py-0 ">12/28/2021</p>
                                    </div>
                                    <div class="col-2 p-3 mx-auto text-center">
                                        <p class="py-0 ">P 21500.00</p>
                                    </div>
                                    <div class="col-2 p-3 my-auto text-center">
                                        <a href="#"><i class=" fas fa-times fa-2x"></i></a>
                                    </div>
                                </div>
                                <hr class="thin">
                            </card>
                        </div>
                        <div class="card-body">
                            <card>
                                <div class="row text-center">
                                    <div class="col-2 p-3 mx-auto">
                                        <img src='../public/images/cozy_room.jpg' class="img-fluid">
                                    </div>
                                    <div class="col-3 p-3 mx-auto text-center">
                                        <p class="py-0 ">12/25/2021</p>
                                    </div>
                                    <div class="col-3 p-3 mx-auto text-center">
                                        <p class="py-0 ">12/28/2021</p>
                                    </div>
                                    <div class="col-2 p-3 mx-auto text-center">
                                        <p class="py-0 ">P 21500.00</p>
                                    </div>
                                    <div class="col-2 p-3 my-auto text-center">
                                        <a href="#"><i class=" fas fa-times fa-2x"></i></a>
                                    </div>
                                </div>
                                <hr class="thin">
                            </card>
                        </div>
                        <div class="card-body pb-4 mr-2" id="cart-btn">
                            <card>
                                <div class="row d-flex justify-content-end">
                                    <button class="btn btn-md mt-5 mx-2 btn-clear ">CLEAR CART</button>
                                    <button class=" btn btn-md mt-5 mx-2" onclick="window.location.href = './submission_page.php'"></i>CONTINUE BOOKING</button>
                                </div>
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
</body>

</html>