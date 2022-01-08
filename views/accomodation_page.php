<!DOCTYPE html>
<html lang="en">

<head>
  <!--Created on 12/10/2021-->
  <?php include "./partials/head.html" ?>
</head>

<body>
  <!-----header----->
  <?php include "./partials/header.php" ?>

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
            <input type="date" name="input-datein" required placeholder="Check-in-Date">
          </div>
          <div class="box">
            <label>Check-out:</label> <br>
            <input type="date" name="input-dateout" required placeholder="Check-out-Date">
          </div>
          <div class="box">
            <label>Persons:</label> <br>
            <input type="number" name="input-persons" required placeholder="1">
          </div>
          <div class="box">
            <label>Room Type:</label> <br>
            <select class="form-select" required>
              <option selected>Room Type</option>
              <option class="room-option" value="1">Cozy Room</option>
              <option class="room-option" value="2">Cozy Junior Suite</option>
              <option class="room-option" value="3">Cozy Executive Room</option>
              <option class="aroom-option" value="4">Cozy Fort Suite</option>
              <option class="room-option" value="5">Cozy Commerce Suite</option>
              <option class="room-option" value="6">Cozy Home Suite</option>
            </select>
          </div>
          <div class="search">
            <input type="submit" value="SEARCH">
          </div>
        </div>
    </div>
    </form>
  </section>
  </section>


  <!-----room types----->
  <section class="room-types my-5 py-5">
    <div class="container">
      <p>Available room <b>From: 12/25/2021 To: 12/31/2021</b> </p>
      <div class="card-deck mt-5">
        <div class="card mb-5">
          <img src="../public/images/cozy_room.jpg" class="card-img-top">
          <div class="card-body">
            <h4 class="card-title">Cozy Room</h4>
            <p class="card-text">This 34 sq. m guestroom features a king-size bed or two single beds. The cozy ambiance offers privacy and relaxation away from the hustle and bustle.</p>
            <hr>
            <div class="book-now">
              <p class="card-text">Php 12000.00</p>
              <button type="button" class="btn" onclick="window.location.href = './cart_page.php'">
                BOOK NOW
              </button>
            </div>
          </div>
        </div>
        <div class="card mb-5">
          <img src="../public/images/cozy_junior_suite.jpg" class="card-img-top">
          <div class="card-body">
            <h4 class="card-title">Cozy Junior Suite</h4>
            <p class="card-text">These strategically located corner suites offer a spacious living area. At 43 sq. m, it has ample space to move around and floor-to-ceiling glass windows to view the city.</p>
            <hr>
            <div class="book-now">
              <p class="card-text">Php 13100.00</p>
              <button type="button" class="btn" onclick="window.location.href = './cart_page.php'">
                BOOK NOW
              </button>
            </div>
          </div>
        </div>
        <div class="card mb-5">
          <img src="../public/images/cozy_executive_suite.jpg" class="card-img-top">
          <div class="card-body">
            <h4 class="card-title">Cozy Executive Room</h4>
            <p class="card-text">This room has all the comforts of a noteworthy stay with its complete roster of guestroom amenities and extensive area. Built especially for long-staying guests, this suite is equipped with a kitchenette that has an induction cooker and a refrigerator.</p>
            <hr>
            <div class="book-now">
              <p class="card-text">Php 15200.00</p>
              <button type="button" class="btn" onclick="window.location.href = './cart_page.php'">
                BOOK NOW
              </button>
            </div>
          </div>
        </div>
        <div class="card mb-5">
          <img src="../public/images/cozy_fort_suite.jpg" class="card-img-top">
          <div class="card-body">
            <h4 class="card-title">Cozy Fort Suite</h4>
            <p class="card-text">Exceptionally designed as a primary suite for its spacious and stylish room features this suite has a living area separated from the bedroom, to provide privacy to guests when entertaining visitors.</p>
            <hr>
            <div class="book-now">
              <p class="card-text">Php 16500.00</p>
              <button type="button" class="btn" onclick="window.location.href = './cart_page.php'">
                BOOK NOW
              </button>
            </div>
          </div>
        </div>
        <div class="card mb-5">
          <img src="../public/images/cozy_commerce_suit.jpg" class="card-img-top">
          <div class="card-body">
            <h4 class="card-title">Cozy Commerce Suite</h4>
            <p class="card-text">A one-bedroom suite tastefully designed for the modern traveler, it is made to welcome guests with its inviting dining and living area as well as its pristine kitchenette. Step out of the patio and take in the breathtaking view of the city lights.</p>
            <hr>
            <div class="book-now">
              <p class="card-text">Php 18200.00</p>
              <button type="button" class="btn" onclick="window.location.href = './cart_page.php'">
                BOOK NOW
              </button>
            </div>
          </div>
        </div>
        <div class="card mb-5">
          <img src="../public/images/cozy_suite.jpg" class="card-img-top">
          <div class="card-body">
            <h4 class="card-title">Cozy Home Suite</h4>
            <p class="card-text">Combined Cozy Commerce Suite and Cozy Fort Suite that gives our guests 178 sq.m of splendid space. The suite has two bedrooms, kitchenettes, living rooms, a dining room and outdoor patios that are fully furnished for that sophisticated living experience.</p>
            <hr>
            <div class="book-now">
              <p class="card-text">Php 20500.00</p>
              <button type="button" class="btn" onclick="window.location.href = './cart_page.php'">
                BOOK NOW
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- footer -->
  <?php include "./partials/footer.html" ?>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>