<?php 
// Check availability
if ($max > 0) {
    if ($_GET['qty'] == 'add') {
            
    // Count same type rooms with conflicting schedules
    $array_keys = array_keys($_SESSION['cart']);
    $count = 0;
    foreach ($array_keys as $key) {
        # $keyid = substr($key,0,strpos($key,"-"));
        $keyid = $_SESSION['cart'][$key]['id'];
        $keyin = $_SESSION['cart'][$key]['datein'];
        $keyout = $_SESSION['cart'][$key]['dateout'];

        // if same type
        if ($keyid == $typeid) {
            $indate = date('Y-m-d', strtotime($datein));
            $outdate = date('Y-m-d', strtotime($dateout));
            $keyindate = date('Y-m-d', strtotime($keyin));
            $keyoutdate = date('Y-m-d', strtotime($keyout));
            // if between date
            if (($indate >= $keyindate && $indate <= $keyoutdate) || ($outdate >= $keyindate && $outdate <= $keyoutdate)) {
                $count += $_SESSION['cart'][$key]['quantity'];
            }
        }
    }

    // Check if still available after filtering
    if ($max-$count < 1) {
        echo '<script type="text/javascript">alert("Sorry, the maximum number of available rooms was reached.");</script>';
    } else {
        $_SESSION['cart'][$itemid]['quantity'] += 1;
    } 

    /*if ($val < $max) {
        $_SESSION['cart'][$itemid]['quantity'] += 1;
    } else {
        echo '<script type="text/javascript">alert("Sorry, the maximum number of available rooms was reached.");</script>';
    }*/

    } elseif ($_GET['qty'] == 'min') {
        if ($val > 1) {
            $_SESSION['cart'][$itemid]['quantity'] -= 1;
        } else {
            echo '<script type="text/javascript">alert("Sorry, the quantity must be atleast 1.");</script>';
        }
    }
} else {
    $_SESSION['cart'][$itemid]['availability'] = false;
}
?>