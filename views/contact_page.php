<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./partials/head.html" ?>
</head>

<body>
    <!-- header -->
    <?php include "./partials/header.php" ?>


    <!-----contact us----->
    <section class="contact-us">
        <div class="container-fluid py-5 px-5 mb-5" id="title-header">
            <h1 class="ml-3 ">CONTACT US</h1>
            <p class="ml-3 mt-2">Connect with Cozy Home Hotel Manila using the form below, or directly via phone or email</p>
        </div>
        <div class="container pt-5">
            <h1>CONTACT INFORMATION</h1>
            <p><b>Address: </b> 32nd St cor Lane A, Bonifacio Global City Taguig 1634 Philippines<br>
                <b>Email: </b> cozyhomereservation@gmail.com<br>
                <b>Tel No.: </b> (63-2) 7720 2000<br>

            </p>
        </div>
    </section>

    <section class="send-message mb-5 pb-5 ">
        <div class="container py-5 h-100">
            <h1 class="mt-2">SEND A MESSAGE</h1>
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body mt-1 p-4 p-md-4">
                            <form>
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">First Name</label>
                                            <input type="text" id="firstName" class="form-control form-control-md" placeholder="e.g. Juan" maxlengthlength="20" required />

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="lastName">Last Name</label>
                                            <input type="text" id="lastName" class="form-control form-control-md" placeholder="e.g Dela Cruz" maxlength="20" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" id="email" class="form-control form-control-md" placeholder="e.g. juandelacruz@gmail.com" maxlength="20" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="message">Message</label>
                                            <textarea class="form-control" id="message" minlength="10" rows="5" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-3 mb-1">
                                        <input class="btn btn-md" type="submit" value="SUBMIT" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- footer -->
    <?php include "./partials/footer.html" ?>




</body>


</html>