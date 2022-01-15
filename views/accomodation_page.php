<!DOCTYPE html>
<html lang="en">

<head>
    <!--Created on 12/10/2021-->
    <?php include "./partials/head.html" ?>
</head>

<body>
    <!-----header----->
    <?php include "./partials/header.php" ?>

    <!----- PHP ----->
    <?php include "../config/database.php";

    // When 'Book Now' is clicked and form is still empty
    if (isset($_GET['check'])) {
        $info_message = "Please fill up the form to check availability of rooms"; // Info Message
    }

    // When Submitting Form GET
    $rooms_data = '';
    $datein = '';
    $dateout = '';
    $numpersons = '';
    $roomtype = 0;
    
    if (isset($_GET['datein'])) {
        $datein = $_GET['datein'];
        $dateout = $_GET['dateout'];
        $numpersons = $_GET['numpersons'];
        $roomtype = $_GET['roomtype'];
        $roomstat = 1;

        // Check if arrival date is >= current date   
        if ($datein > date('Y/m/d')) {
            echo $error_message = "Invalid arrival date! It must be present and future date."; // Error Message
        // Check if departure date is <= arrival date   
        } elseif ($dateout <= $datein) {
            echo $error_message = "Invalid departure date! It must be later than arrival date."; // Error Message
        } else {
            // Check if room type is specified
            if ($roomtype != 0) {
                // Create needed views: rooms_list & rooms_available
                $sql = createRoomsListView($roomtype, $numpersons, $roomstat);
                if ($conn->query($sql)) {
                    $sql = createRoomsAvailableView($datein, $dateout);
                    if ($conn->query($sql)) {
                        // SELECT type of available rooms
                        $sql = "SELECT type_id, type_name, room_description, room_size, room_amenities, room_capacity, room_price, room_image FROM rooms_available LIMIT 1";
                        if ($rs = $conn->query($sql)) {
                            if ($rs->num_rows > 0) {
                                // Display available room type
                                while ($rows = $rs->fetch_assoc()) {
                                    $rooms_data .= createRoomsDataDisplay($rows);
                                }
                            } else {
                                echo $error_message = "No rooms available"; // Error Message
                            }
                        } else {
                            echo $conn->error;  // display error for selecting data into database
                        }
                    } else {
                        echo $conn->error;  // display error for creating view
                    }
                } else {
                    echo $conn->error;  // display error for creating view
                }
            } else {
                // If room type is not specified, FOR ALL ROOM TYPES.
                // Create needed views: rooms_list & rooms_available
                $sql = createRoomsListView($roomtype, $numpersons, $roomstat);
                if ($conn->query($sql)) {
                    $sql = createRoomsAvailableView($datein, $dateout);
                    if ($conn->query($sql)) {
                        // SELECT type(s) of available rooms
                        $sql = "SELECT type_id, type_name, room_description, room_size, room_amenities, room_capacity, room_price, room_image FROM rooms_available ORDER BY type_id";
                        if ($rs = $conn->query($sql)) {
                            if ($rs->num_rows > 0) {                                
                                // Display available room types
                                $prev = 0;
                                while ($rows = $rs->fetch_assoc()) {
                                    if ($rows['type_id'] != $prev) {
                                        $prev = $rows['type_id'];
                                        $rooms_data .= createRoomsDataDisplay($rows);
                                    }
                                }                            
                            } else {
                                echo $error_message = "No rooms available"; // Error Message
                            }
                        } else {
                            echo $conn->error;  // display error for selecting data into database
                        }
                    } else {
                        echo $conn->error;  // display error for creating view
                    }
                } else {
                    echo $conn->error;  // display error for creating view
                }
            }
        } 
    } else {
        // if GET is not set
        // Display all room types
        $sql = "SELECT type_id, type_name, room_description, room_size, room_amenities, room_capacity, room_price, room_image FROM HRMS_room_type ORDER BY type_id";
        if ($rs = $conn->query($sql)) {
            if ($rs->num_rows > 0) {
                while ($rows = $rs->fetch_assoc()) {
                    $rooms_data .= createRoomsDataDisplay($rows, false);
                }                            
            } else {
                echo $error_message = "No rooms available"; // Error Message
            }
        } else {
            echo $conn->error;  // display error for selecting data into database
        }
    }


    // Set options for room types 
    $options = '';
    ($roomtype==0) ? $options .= '<option value="0" selected>All Room Types</option>': $options .= '<option value="0">All Room Types</option>';
    $sql = "SELECT type_id, type_name FROM HRMS_room_type";
    if ($rs = $conn->query($sql)) {
        if ($rs->num_rows > 0) {
            while ($rows = $rs->fetch_assoc()) {
                if ($roomtype==$rows["type_id"]) {
                    $options .= '<option class="room-option" value='.$rows["type_id"].' selected>'.$rows["type_name"].'</option>';
                } else {
                    $options .= '<option class="room-option" value='.$rows["type_id"].'>'.$rows["type_name"].'</option>';
                }
            }
        }
    } else {
        echo $conn->error;  // display error for selecting data into database
    }


    /*********** FUNCTIONS ************/

    // Function to create view of rooms list query
    function createRoomsListView($roomtype, $numpersons, $roomstat) {
        if ($roomtype != 0) {
            $query = "CREATE OR REPLACE VIEW rooms_list AS 
                SELECT r.room_id, r.room_number, r.room_status, rt.*, rr.reservation_id FROM HRMS_room r 
                JOIN HRMS_room_type rt ON r.room_type = rt.type_id 
                LEFT JOIN HRMS_rooms_reserved rr ON rr.room_id=r.room_id
                WHERE (rt.type_id=".$roomtype.") AND (rt.room_capacity >= ".$numpersons.") AND (r.room_status=".$roomstat.") 
                ORDER BY rt.type_id, r.room_id";
        } else {
            $query = "CREATE OR REPLACE VIEW rooms_list AS 
                SELECT r.room_id, r.room_number, r.room_status, rt.*, rr.reservation_id FROM HRMS_room r 
                JOIN HRMS_room_type rt ON r.room_type = rt.type_id 
                LEFT JOIN HRMS_rooms_reserved rr ON rr.room_id=r.room_id
                WHERE (rt.room_capacity >= ".$numpersons.") AND (r.room_status=".$roomstat.") 
                ORDER BY rt.type_id, r.room_id";
        }
        return $query;
    }

    // Function to create view of available rooms query
    function createRoomsAvailableView($datein, $dateout) {
        $today = date('Y/m/d');
        $query = "CREATE OR REPLACE VIEW rooms_available AS 
            SELECT rl.*, rs.arrival_date, rs.departure_date, rs.reservation_status FROM rooms_list rl
            LEFT JOIN HRMS_reservation rs ON rl.reservation_id=rs.reservation_id
            WHERE (rs.arrival_date IS NULL) 
            OR (rs.reservation_status = 3 AND rs.departure_date >='$today') 
            OR (rs.reservation_status = 4)
            OR (('$datein' < rs.arrival_date) AND ('$dateout' < rs.arrival_date)) 
            OR (('$datein' > rs.departure_date) AND ('$dateout' > rs.departure_date))
            ORDER BY rl.type_id, rl.room_id";
        return $query;
    }
    
    // Function to create room data display 
    function createRoomsDataDisplay($rows, $filled = true) {
        if ($filled) {
            return '
            <div class="card mb-5">
                <img src="'.$rows['room_image'].'">
                <div class="card-body">
                    <h4 class="card-title">'.$rows['type_name'].'</h4>
                    <p class="card-text">'.$rows['room_description'].'</p>
                    <hr>
                    <div class="book-now">
                        <p class="card-text">Php '.$rows['room_price'].'</p>
                        <button type="button" class="btn" onclick="location.href=\''.'./cart_page.php'.'\'">
                            BOOK NOW
                        </button>
                    </div>
                </div>
            </div>'; 
        } else {
            return '
            <div class="card mb-5">
                <img src="'.$rows['room_image'].'">
                <div class="card-body">
                    <h4 class="card-title">'.$rows['type_name'].'</h4>
                    <p class="card-text">'.$rows['room_description'].'</p>
                    <hr>
                    <div class="book-now">
                        <p class="card-text">Php '.$rows['room_price'].'</p>
                        <button type="button" class="btn" onclick="location.href=\''.'accomodation_page.php?check=rooms'.'\'">
                            BOOK NOW
                        </button>
                    </div>
                </div>
            </div>'; 
        }
    }

    ?>

    <!-----landing----->
    <section class="acco">
        <div class="container-fluid py-5 px-5 mb-3" id="title-header">
            <h1 class="ml-3 ">ACCOMODATION</h1>
            <p class="ml-3 mt-2">Reserve your stylish room or suite at Cozy Home Hotel Manila</p>
        </div>
    </section>

    <!-----search for booking----->
    <section class="book">
        <div class="container flex">
            <form>
                <div class="input grid">
                    <div class="box">
                        <label>Check-in:</label> <br>
                        <input type="date" name="datein" id="datein" required placeholder="Check-in-Date" value="<?= $datein ?>">
                    </div>
                    <div class="box">
                        <label>Check-out:</label> <br>
                        <input type="date" name="dateout" id="dateout" required placeholder="Check-out-Date" value="<?= $dateout ?>">
                    </div>
                    <div class="box">
                        <label>Persons:</label> <br>
                        <input type="number" name="numpersons" required min="1" placeholder="0" value="<?= $numpersons ?>">
                    </div>
                    <div class="box">
                        <label>Room Type:</label> <br>
                        <select class="form-select" name="roomtype" required> 
                            <?php echo $options; ?>
                        </select>
                    </div>
                    <div class="search">
                        <input type="submit" value="SEARCH">
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-----room types----->
    <section class="room-types my-5 py-5">
        <div class="container">

        <!---- error/info message ---->
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger alert-dismissible mb-3">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($info_message)): ?>
            <div class="alert alert-info alert-dismissible mb-3">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $info_message; ?>
            </div>
        <?php endif; ?>

            <?php if (isset($_GET['datein'])): ?>
                <p>Available room <b>From: <?= date_format(date_create($datein),"m/d/Y") ?> To: <?=  date_format(date_create($dateout),"m/d/Y") ?></b> </p>
            <?php endif; ?>
            <div class="card-deck mt-5">
                <?php echo $rooms_data; ?>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include "./partials/footer.html" ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        // When document ready... Set age limit by setting max birthdate
        $(function() {
            var today = new Date();
            var mm = today.getMonth() + 1;
            mm = mm < 10 ? '0' + mm : mm;
            var dd = today.getDate();
            dd = dd < 10 ? '0' + dd : dd;
            var yyyy = today.getFullYear();
            var date = yyyy + '-' + mm + '-' + dd;
            var input = document.getElementById("datein").min = date;
            var input = document.getElementById("dateout").min = date;

            $('#datein').change(function(e) {
                var datein = new Date(document.getElementById("datein").value);
                var mm = datein.getMonth() + 1;
                mm = mm < 10 ? '0' + mm : mm;
                var dd = datein.getDate();
                dd = dd < 10 ? '0' + dd : dd;
                var yyyy = datein.getFullYear();
                var dateout = yyyy + '-' + mm + '-' + (dd + 1);
                var input = document.getElementById("dateout").min = dateout;
            });

        });
    </script>
</body>

</html>