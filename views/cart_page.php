<?php
include "../config/database.php";
include "../config/functions.php";
session_start();
$cart_count = countCartItems(); // Count cart item/s

#unset($_SESSION['cart']);
#unset($_SESSION['unavailable']);
#print_r($_SESSION);

// When quantity is changed 
if (isset($_SESSION['cart']) && isset($_GET['item']) && isset($_GET['qty'])) {
    $itemid = $_GET['item'];
    $typeid = substr($itemid,0,strpos($itemid,"-"));
    $numpersons = $_SESSION['cart'][$itemid]['numpersons'];
    $datein = $_SESSION['cart'][$itemid]['datein'];
    $dateout = $_SESSION['cart'][$itemid]['dateout'];
    $val = $_SESSION['cart'][$itemid]['quantity'];
    
    // Get maximum number available rooms for specific room type and date in/out 
    $max = countAvailableRooms ($conn, $typeid, $numpersons, 1, $datein, $dateout);
    
    // if available, then proceed
    if ($max > 0) {
        
        // Check operator - if add qty
        if ($_GET['qty'] == 'add') {
            $array_keys = array_keys($_SESSION['cart']);

            // Check if there's conflicting schedules in the cart - Count same type rooms with conflicting schedules
            $count = scanCartForConflictingSchedule($array_keys, $typeid, $datein, $dateout);
            # $keyid = substr($key,0,strpos($key,"-"));

            // Check if still available after scanning and filtered
            if ($max - $count < 1) {
                echo '<script type="text/javascript">alert("Sorry, the maximum number of available rooms was reached.");</script>';
            } else {
                $_SESSION['cart'][$itemid]['quantity'] += 1;
            }

        } elseif ($_GET['qty'] == 'min') {
            // if minus qty
            if ($val > 1) {
                $_SESSION['cart'][$itemid]['quantity'] -= 1;
            } else {
                echo '<script type="text/javascript">alert("Sorry, the quantity must be atleast 1.");</script>';
            }
        }
    } else {
        // if not available, then set availability to false
        $_SESSION['cart'][$itemid]['availability'] = false;
    }
}

// When 'Book Now' is clicked & form is filled - Submitted Form POST from accomodation_page.php
if (isset($_POST['typeid'])) {
    $typeid = (int) $_POST['typeid'];
    $image = $_POST['image'];
    $name = $_POST['name'];
    $price = (float) $_POST['price'];
    $datein = $_POST['datein']; // format: Y-m-d
    $dateout = $_POST['dateout']; // format: Y-m-d
    $numpersons = $_POST['numpersons'];
    $itemid = $typeid.'-'.$datein.$dateout;
    # $datein = date_format(date_create($_POST['datein']),"m/d/Y");
    # $dateout = date_format(date_create($_POST['dateout']),"m/d/Y");
    # echo $typeid.$image.$name.$price.$datein.$dateout;

    // Get maximum number available rooms for specific room type and date in/out, then set availability
    $max = countAvailableRooms ($conn, $typeid, $numpersons, 1, $datein, $dateout); // $roomstat = 1;
    ($max > 0) ? $availability = true : $availability = false;

    // Create array of newly booked item to be added in session cart 
    $item_array = array( 
        $itemid => array (
        'id'            =>  $typeid,
        'image'		    =>	$image,
        'name'			=>	$name,
        'price'		    =>	$price,
        'quantity'		=>	1,
        'datein'		=>	$datein,
        'dateout'		=>	$dateout,
        'numpersons'	=>	$numpersons,
        'availability'  =>  $availability,
        )
    );
    
    // Start add to cart process - Create/update the session variable for the cart
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $array_keys = array_keys($_SESSION['cart']);

        // Check if there's conflicting schedules in the cart - Count same type rooms with conflicting schedules
        $count = scanCartForConflictingSchedule($array_keys, $typeid, $datein, $dateout);

        // Check if same item (same room/datein/dateout) already exists in cart, then just update the quantity
        if (in_array($itemid,$array_keys)) {

            // Check if still available after scanning and filtered
            if ($max - $count < 1) {
                echo '<script type="text/javascript">alert("Sorry, the maximum number of available rooms for '.$name.' was reached.");</script>';
            } else {
                $_SESSION['cart'][$itemid]['quantity'] += 1;
            }

        } else {
            // If there's no same item in the cart
            // Check if still available after scanning and filtered, if not set availability to false
            if ($max - $count < 1) {
                $item_array[$itemid]['availability'] = false;
            }
            
            // Add item into cart, then update cart number badge
            $_SESSION['cart'] = array_merge($item_array,$_SESSION['cart']);
            $cart_count = countCartItems();
        }
    } else {
        // if cart is empty - add the first item to cart, then update cart number badge
        $_SESSION['cart'] = $item_array;
        $cart_count = countCartItems();
    }
}

// Alert message if 'Continue Booking' is clicked while cart is empty or there's no available items (from submission_page)
if (isset($_SESSION['message'])) {
    echo '<script type="text/javascript"> alert("' . $_SESSION['message'] . '"); </script>';
    unset($_SESSION['message']);
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
    <section class="booking-cart">
        <div class="container-fluid py-2 px-5" id="cart-header">
            <h1 class="ml-3 ">Booking Cart</h1>
        </div>
        <div class="container-fluid d-block justify-content-center">
            <div class="row" style="display:block">
                <div class="col-12 col-xs-7">
                    <div class="card mx-5" style="border-radius: 10px; margin-bottom: 200px">
                        <div class="card-body pt-4">
                            <card>
                                <div class="row text-center">
                                    <div class="col-2">
                                        <h6>Room</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Price</h6>
                                    </div>
                                    <div class="col-1">
                                        <h6>Qty.</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Check-in Date</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Check-out Date</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Subtotal</h6>
                                    </div>
                                    <div class="col-1">
                                        <h6>Remove</h6>
                                    </div>
                                </div>
                                <hr class="solid">
                            </card>
                        </div>
                        
                        <?php if (isset($_SESSION['cart']) && (!empty($_SESSION['cart']))) { 
                            $total_price = 0; ?>
                            <?php foreach ($_SESSION['cart'] as $item) { 
                                $max = countAvailableRooms($conn, $item['id'], $item['numpersons'], 1, $item['datein'], $item['dateout']); // $roomstat = 1; 
                                $itemkey = $item['id'].'-'.$item['datein'].$item['dateout']; ?>
                                <?php if ($max > 0) { 
                                    $typeid = $_SESSION['cart'][$itemkey]['id'];
                                    $datein = $_SESSION['cart'][$itemkey]['datein'];
                                    $dateout = $_SESSION['cart'][$itemkey]['dateout'];
                                    $array_keys = array_keys($_SESSION['cart']);

                                    // Count same type rooms with conflicting schedules
                                    $count = 0;
                                    foreach ($array_keys as $key) {
                                        $keyid = $_SESSION['cart'][$key]['id'];
                                        $keyin = $_SESSION['cart'][$key]['datein'];
                                        $keyout = $_SESSION['cart'][$key]['dateout'];

                                        // Check if same type of room, then proceed
                                        if ($keyid == $typeid && ($_SESSION['cart'][$itemkey] != $_SESSION['cart'][$key])) {
                                            $indate = date('Y-m-d', strtotime($datein));
                                            $outdate = date('Y-m-d', strtotime($dateout));
                                            $keyindate = date('Y-m-d', strtotime($keyin));
                                            $keyoutdate = date('Y-m-d', strtotime($keyout));
                                            
                                            // Next, Check if in/out date is between (key) in/out date of items already added on cart
                                            if (($indate >= $keyindate && $indate <= $keyoutdate) || ($outdate >= $keyindate && $outdate <= $keyoutdate)) {
                                                $count += $_SESSION['cart'][$key]['quantity'];
                                            }
                                        }
                                    }

                                    // Check if still available after filtering
                                    if ($max - $count < 1) {
                                        $_SESSION['cart'][$itemkey]['availability'] = false;
                                    } else {
                                        $_SESSION['cart'][$itemkey]['availability'] = true;
                                    }
                                    
                                } else {
                                    $_SESSION['cart'][$itemkey]['availability'] = false;
                                } // endif max ?>
                                <?php if ($_SESSION['cart'][$itemkey]['availability']) { ?>
                                    <div class="card-body">
                                        <card>
                                            <div class="row text-center">
                                                <div class="col-2 p-3 mx-auto">
                                                    <img src='<?= $item['image'] ?>' class="img-fluid mb-0">
                                                    <p class="py-0 mt-0"><?= $item['name'] ?></p>
                                                </div>
                                                <div class="col-2 p-3 mx-auto text-center">
                                                    <p class="py-0 ">₱ <?= number_format($item['price'],2) ?></p>
                                                </div>
                                                <div class="col-1 py-3 px-1  mt-4  text-center">
                                                    <button class="qty-btn qty-min" type="button">-</button>
                                                    <input class="qty-input" type="number" data-item="<?= $itemkey ?>" value="<?= $item['quantity'] ?>" min="1" max="<?= $max ?>" readonly>
                                                    <button class="qty-btn qty-add" type="button">+</button>
                                                </div>
                                                <div class="col-2 p-3 mx-auto text-center">
                                                    <p class="py-0 "><?= date_format(date_create($item['datein']),"m/d/Y"); // $item['datein'] ?></p>
                                                </div>
                                                <div class="col-2 p-3 mx-auto text-center">
                                                    <p class="py-0 "><?= date_format(date_create($item['dateout']),"m/d/Y"); // $item['dateout'] ?></p>
                                                </div>
                                                <div class="col-2 p-3 mx-auto text-center">
                                                    <p class="py-0 ">₱ <?php $total_price += $item['price'] * $item['quantity']; echo number_format($item['price'] * $item['quantity'],2) ?></p>
                                                </div>
                                                <div class="col-1 p-3 mt-4 text-center">
                                                <a href="remove_cart.php?action=remove&item=<?= $itemkey ?>"><i class="fas fa-times fa-2x pt-1"></i></a>
                                                </div>
                                            </div>
                                            <hr class="thin">
                                        </card>
                                    </div>
                                <?php } else { // display unavailable items - disabled rooms ?>
                                    <div class="card-body">
                                        <card>
                                            <div class="row text-center">
                                                <div class="col-2 p-3 mx-auto">
                                                    <img src='<?= $item['image'] ?>' class="img-fluid mb-0">
                                                    <p class="py-0 mt-0"><?= $item['name'] ?></p>
                                                </div>
                                                <div class="col-2 p-3 mx-auto text-center">
                                                    <p class="py-0 ">₱ <?= number_format($item['price'],2) ?></p>
                                                </div>
                                                <div class="col-1 py-3 px-1  mt-4  text-center">
                                                    <div class="alert alert-danger" role="alert">
                                                        <small>Not Available!</small>
                                                    </div>
                                                </div>
                                                <div class="col-2 p-3 mx-auto text-center">
                                                    <p class="py-0 "><?= date_format(date_create($item['datein']),"m/d/Y"); // $item['datein'] ?></p>
                                                </div>
                                                <div class="col-2 p-3 mx-auto text-center">
                                                    <p class="py-0 "><?= date_format(date_create($item['dateout']),"m/d/Y"); // $item['dateout'] ?></p>
                                                </div>
                                                <div class="col-2 p-3 mx-auto text-center">
                                                    <p class="py-0 "></p>
                                                </div>
                                                <div class="col-1 p-3 mt-4 text-center">
                                                    <a href="remove_cart.php?action=remove&unavailable=<?= $itemkey ?>"><i class="fas fa-times fa-2x pt-1"></i></a>
                                                </div>
                                            </div>
                                            <hr class="thin">
                                        </card>
                                    </div>
                                <?php } // end if display according to availability
                            } // end foreach ?>
                            
                            <div class="card-body pt-3 pb-2 mr-2">
                                <card>
                                    <div class="row d-flex justify-content-end">
                                        <h5>TOTAL AMOUNT:</h5>
                                        <h5 class="pl-5 mr-2">₱ <?= number_format($total_price,2) ?></h5>
                                    </div>
                                </card>
                            </div>
                            <div class="card-body pb-4 mr-2" id="cart-btn">
                                <card>
                                    <div class="row d-flex justify-content-end">
                                        <button class="btn btn-md mt-5 mx-2 btn-clear" onclick="window.location.href='remove_cart.php?action=clear'">CLEAR CART</button>
                                        <button class=" btn btn-md mt-5 mx-2" style="<?php echo (countCartItemsAvailable()) ?  "" : "pointer-events: none;" ?>" onclick="window.location.href='./submission_page.php'" <?php echo (countCartItemsAvailable()) ?  "" : "disabled" ?>></i>CONTINUE BOOKING</button>
                                    </div>
                                </card>
                            </div>
                        <?php } else { ?>
                            <div class="card-body"> 
                                <card>
                                    <div class="row text-center">
                                        <div class="col-12">
                                            <div class="alert alert-secondary" role="alert">
                                                Your cart is empty!
                                            </div>
                                        </div>
                                    </div>
                                </card>
                            </div>
                        <?php } ?>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('.qty-min').click(function (e) {
                var item = $(this).next().attr('data-item');
                window.location.href="cart_page.php?item="+item+"&qty=min";
            });
            $('.qty-add').click(function (e) {
                var item = $(this).prev().attr('data-item');
                window.location.href="cart_page.php?item="+item+"&qty=add";
            });
        });
    </script>
    
</body>

</html>