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
            <h1 class="ml-3 ">Reservation History</h1>
        </div>
        <div class="container-fluid d-flex justify-content-center">
            <div class="row">
                <div class="col-12 col-lg-9 col-xl-7 ">
                    <div class="card mx-auto" style="padding: 0; border-radius: 10px; width: 85rem; margin-bottom: 200px">
                        <div class="card-body pt-4">
                            <card>
                                <div class="row text-center">
                                    <div class="col-2">
                                        <h6>Room</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Check-in Date</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Check-out Date</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Amount</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Status</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Action</h6>
                                    </div>
                                </div>
                                <hr class="solid">
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
                                        <p class="status-text"><b>CONFIRMED</b></p>
                                    </div>
                                    <div class="col-2 my-auto text-center" id="reserve-btn">
                                        <button class="btn-cancel btn btn-md mt-3">CANCEL</button>
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
                            </card>
                        </div>
                        <div class="card-body pb-4 mr-2" id="reserve-btn">
                            <card>
                                <div class="row d-flex justify-content-end">
                                    <button class=" btn btn-md mt-5 mx-2">PRINT TRANSACTIONS</button>

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
    <script>
        $(document).ready(function() {

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