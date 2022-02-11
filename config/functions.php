<?php

/******************************** For Accomodation | Cart Pages *********************************/

// Function to create view of rooms list query
function createRoomsListView($roomtype, $numpersons, $roomstat)
{
    if ($roomtype != 0) {
        $query = "CREATE OR REPLACE VIEW rooms_list AS
                SELECT r.room_id, r.room_number, r.room_status, rt.*, rr.reservation_id FROM hrms_room r
                JOIN hrms_room_type rt ON r.room_type = rt.type_id
                LEFT JOIN hrms_rooms_reserved rr ON rr.room_id=r.room_id
                WHERE (rt.type_id=" . $roomtype . ") AND (rt.room_capacity >= " . $numpersons . ") AND (r.room_status=" . $roomstat . ")
                ORDER BY rt.type_id, r.room_id";
    } else {
        $query = "CREATE OR REPLACE VIEW rooms_list AS
                SELECT r.room_id, r.room_number, r.room_status, rt.*, rr.reservation_id FROM hrms_room r
                JOIN hrms_room_type rt ON r.room_type = rt.type_id
                LEFT JOIN hrms_rooms_reserved rr ON rr.room_id=r.room_id
                WHERE (rt.room_capacity >= " . $numpersons . ") AND (r.room_status=" . $roomstat . ")
                ORDER BY rt.type_id, r.room_id";
    }
    return $query;
}

// Function to create view of available rooms query
function createRoomsAvailableView($datein, $dateout)
{
    $today = date('Y/m/d');
    $query = "CREATE OR REPLACE VIEW rooms_available AS
            SELECT rl.*, rs.arrival_date, rs.departure_date, rs.reservation_status FROM rooms_list rl
            LEFT JOIN hrms_reservation rs ON rl.reservation_id=rs.reservation_id
            WHERE (rs.arrival_date IS NULL)
            OR (rs.reservation_status = 3 AND rs.departure_date >='$today')
            OR (rs.reservation_status = 4)
            OR (('$datein' < rs.arrival_date) AND ('$dateout' < rs.arrival_date))
            OR (('$datein' > rs.departure_date) AND ('$dateout' > rs.departure_date))
            ORDER BY rl.type_id, rl.room_id";
    return $query;
}

// Function to create room data display
function createRoomsDataDisplay($rows, $filled = true, $datein, $dateout, $numpersons)
{
    if ($filled) {
        return '
            <div class="card mb-5">
                <img src="' . $rows['room_image'] . '">
                <div class="card-body">
                    <h4 class="card-title">' . $rows['type_name'] . '</h4>
                    <p class="card-text">' . $rows['room_description'] . '</p>
                    <hr>
                    <div class="book-now">
                        <p class="card-text">₱ ' .  number_format($rows['room_price'], 2) . '</p>
                        <form action="./cart_page.php" method="POST">
                            <input type="hidden" name="typeid" value="' . $rows['type_id'] . '">
                            <input type="hidden" name="image" value="' . $rows['room_image'] . '">
                            <input type="hidden" name="name" value="' . $rows['type_name'] . '">
                            <input type="hidden" name="price" value="' . $rows['room_price'] . '">
                            <input type="hidden" name="datein" value="' . $datein . '">
                            <input type="hidden" name="dateout" value="' . $dateout . '">
                            <input type="hidden" name="numpersons" value="' . $numpersons . '">
                            <button type="button" class="btn" onclick="this.form.submit()">
                                BOOK NOW
                            </button>
                        </form>
                    </div>
                </div>
            </div>';
    } else {
        return '
            <div class="card mb-5">
                <img src="' . $rows['room_image'] . '">
                <div class="card-body">
                    <h4 class="card-title">' . $rows['type_name'] . '</h4>
                    <p class="card-text">' . $rows['room_description'] . '</p>
                    <hr>
                    <div class="book-now">
                        <p class="card-text">₱ ' . number_format($rows['room_price'], 2) . '</p>
                        <button type="button" class="btn" onclick="location.href=\'' . 'accomodation_page.php?check=rooms' . '\'">
                            BOOK NOW
                        </button>
                    </div>
                </div>
            </div>';
    }
}

// Function count available rooms for specific room type and date in/out
function countAvailableRooms($conn, $typeid, $numpersons, $roomstat, $datein, $dateout)
{
    createRoomsListView($typeid, $numpersons, $roomstat);
    createRoomsAvailableView($datein, $dateout);
    $sql = "SELECT COUNT(room_id) AS count FROM rooms_available WHERE type_id=$typeid";
    if ($rs = $conn->query($sql)) {
        $data = $rs->fetch_assoc();
        return (int) $data['count'];
    } else {
        echo $conn->error;  // display error for selecting count data into database
        return 0;
    }
}

// Function to check if there's conflicting schedule in the cart that can affect availablity of rooms
function scanCartForConflictingSchedule($array_keys, $typeid, $datein, $dateout)
{
    $count = 0;
    foreach ($array_keys as $key) {
        $keyid = $_SESSION['cart'][$key]['id'];
        $keyin = $_SESSION['cart'][$key]['datein'];
        $keyout = $_SESSION['cart'][$key]['dateout'];

        // Check if same type of room, then proceed
        if ($keyid == $typeid) {
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
    return $count;
}

/******************************** For Submission Page *********************************/

// Function to generate confirmation code
function generateConfirmationCode($length = 8)
{
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[random_int(0, strlen($characters) - 1)];
    }
    return $code;
}

function isCodeExist($conn, $code)
{
    $status = false;
    $sql = "SELECT confirm_code FROM hrms_reservation WHERE confirm_code='$code' LIMIT 1";
    if ($rs = $conn->query($sql)) {
        if ($rs->num_rows > 0) {
            $status = true;
        }
    } else {
        echo $conn->error;  // display error for selecting data into database
    }
    return $status;
}

// Function to check if confirmation code already exist
function isSameProfile($conn, $sql)
{
    if ($rs = $conn->query($sql)) {
        if ($rs->num_rows > 0) {
            $profile_data = $rs->fetch_assoc();
            return (int) $profile_data['profile_id'];
        }
    } else {
        echo $conn->error;  // display error for selecting data into database
        return 0;
    }
}

// Function to get available room for specific room type and date in/out
function getAvailableRoom($conn, $typeid, $numpersons, $roomstat, $datein, $dateout)
{
    createRoomsListView($typeid, $numpersons, $roomstat);
    createRoomsAvailableView($datein, $dateout);
    $sql = "SELECT room_id FROM rooms_available WHERE type_id=$typeid";
    if ($rs = $conn->query($sql)) {
        if ($rs->num_rows > 0) {
            $room_data = $rs->fetch_assoc();



        } else {
            echo 'No user found!';
        }
    } else {
        echo $conn->error;  // display error for selecting count data into database
        return 0;
    }
}

/******************************** For All Pages *********************************/

// Function to count item/s in the cart
function countCartItems()
{
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        return count(array_keys($_SESSION['cart']));
    } else {
        return 0;
    }
}

// Function to count ONLY AVAILABLE item/s in the cart
function countCartItemsAvailable()
{
    $count = 0;
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $array_keys = array_keys($_SESSION['cart']);
        foreach ($array_keys as $key) {
            if ($_SESSION['cart'][$key]['availability']) {
                $count++;
            }
        }
    }
    return $count;
}

/*// Function to retrieve cart from database (Signin Page)
// Retrieve Cart Items
retrieveCart($user_data['user_id']);
function retrieveCart($conn, $userid)
{
    $sql = "SELECT * FROM hrms_cart WHERE user_id='$userid'";
    if ($rs = $conn->query($sql)) {
        $data = $rs->fetch_assoc();
        return (int) $data['count'];
    } else {
        echo $conn->error;  // display error for selecting count data into database
        return 0;
    }
}
*/
