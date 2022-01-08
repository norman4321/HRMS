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
  <section class="home" id="home">
    <div class="landing-container">
      <div class="landing-box">
        <div class="text">
          <h1>YOUR HOME <br> AWAY FROM HOME</h1>
          <hr class="solid">
          <p>Cozy Home brings you to a home away from home where you can allow yourself to feel most like you.
            Giving you a safe and comfortable place to enjoy.</p>
          <button type="button" class="book-btn">BOOK NOW</button>
        </div>
      </div>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../public/images/slide1.jpg" class="d-block w-100">
          </div>
          <div class="carousel-item">
            <img src="../public/images/slide2.jpg" class="d-block w-100">
          </div>
          <div class="carousel-item">
            <img src="../public/images/slide3.png" class="d-block w-100">
          </div>
          <div class="carousel-item">
            <img src="../public/images/slide4.jpg" class="d-block w-100">
          </div>
        </div>
      </div>
    </div>

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

  <!-----welcome message----->
  <section class="welcome">
    <div class="container">
      <h1>HOME SWEET HOME</h1>
      <p>Your new home is thoughtfully designed and well-appointed <br>
        with luxurious amenities, offers a one-of-a-kind yet comfortable hotel experience. <br>
        From design details to exhibitions and events, discover what makes our hotel so unique.</p>
    </div>
  </section>

  <!-----welcome image----->
  <section class="main-image">
    <div class="container flex">
      <div class="text-bg">
        <div class="image-text">
          <div class="box">

            <h1>COZY HOME IS CALLING</h1>
            <p>
            <p>Immerse in the warmth of Filipino Hospitality as Cozy Home Hotel Manila opens
              its doors with bright smiles and utmost care that is #SimplyHeartfelt.
              Located at the center of the business and commercial district, center of the Metro,
              we introduce sound amenities and conveniences that promote the indulgence of
              local culture through culinary delights, design, and ambiance.
              Welcome home, welcome to Cozy Home.
            </p>
          </div>

        </div>
        <div class="image">
          <div class="box">
            <img class="disp-image" src="../public/images/cozyhome_image.jpg" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-----cozy offers----->
  <section class="offers">
    <div class="container">
      <div class="intro">
        <h1>COZY OFFERS</h1>
        <p>Each offer draws inspiration from local culture and tradition while celebrating
          innovation and the French art de vivre to offer a one-of-a-kind, luxurious hotel
          experience. From design details to exhibitions and events, discover what makes our
          hotel so unique. </p>
      </div>
      <div class="card-group">
        <div class="card">
          <img class="card-img-top" src="../public/images/offers_accomodation.jpg">
          <div class="card-body">
            <h4 class="card-title">Accomodations</h4>
            <p class="card-text">Cozy Home’s 261 rooms — your breathing space. Our well-appointed
              guestrooms have the signature Cozy Dream Bed- an orthopedic bed designed for that
              rejuvenating, serene sleep, and assured rest and respite.</p>

          </div>
        </div>
        <div class="card">
          <img class="card-img-top" src="../public/images/offers_facilities.jpeg">
          <div class="card-body">
            <h4 class="card-title">Facilities</h4>
            <p class="card-text">Cozy Home has facilities for your business and leisure activities.
              This hotel with pool has top-notch services in their spa and restaurant. Take care of
              your well-being with our excellent services.</p>

          </div>
        </div>
      </div>
      <div class="card-group">
        <div class="card">
          <img class="card-img-top" src="../public/images/offers_dining.jpg">
          <div class="card-body">
            <h4 class="card-title">Dining</h4>
            <p class="card-text">Cozy Home's restaurants present delectable offerings with a rich
              selection of cuisines that will bring each and every guest an excellent gastronomic experience.</p>
          </div>
        </div>
        <div class="card">
          <img class=" card-img-top" src="../public/images/offers_events.jpeg">
          <div class="card-body">
            <h4 class="card-title">Celebrations</h4>
            <p class="card-text">Our formula is simple. Impeccable venues. Exemplary packages. Outstanding catering.
              Dedicated and detail-oriented event specialists. And lastly, the signature Cozy way of service. </p>

          </div>
        </div>
      </div>
  </section>

  <!-----cozy promotions----->
  <section class="promotions mb-2">
    <div class=" container">
      <div class="intro">
        <h1>COZY PROMOTIONS</h1>
        <p>Generous rooms offer ample space to relax in our captivating Cozy Home hotel,
          and spacious comfy suites offering mesmerising views.
        </p>
      </div>
    </div>
  </section>
  <section class="room-types mb-5 pb-5">
    <div class="container">
      <div class="card-deck mt-5">
        <div class="card mb-5">
          <img src="../public/images/promo1.jpg" class="card-img-top">
          <div class="card-body">
            <h4 class="card-title">SAFE LIKE HOME (For Quarantine Guests)</h4>
            <p class="card-text">Best available rate for our returning Kababayans! Get a special rate of Php 3,800 net per night if you book directly at our website. Minimum of 6 nights to avail of the promo.</p>
          </div>
        </div>
        <div class="card mb-5">
          <img src="../public/images/promo2.jpg" class="card-img-top">
          <div class="card-body">
            <h4 class="card-title">NON-QUARANTINE ROOM PROMO</h4>
            <p class="card-text">Feel safe like home at Cozy Home Hotel Manila. Book and enjoy 45% off from our Best Available Rate (BAR)</p>
          </div>
        </div>
        <div class="card mb-5">
          <img src="../public/images/promo3.jpg" class="card-img-top">
          <div class="card-body">
            <h4 class="card-title">COZY RATE</h4>
            <p class="card-text">Feel the essence of the holiday season filled with comfort and a happy experience! #CozyHome's Crazy Rate for only Php 3,500 net per night with breakfast for two (2) is available for Non-Quarantine guests. Just book directly at our website to avail of the promo!</p>
          </div>
        </div>
        <div class="card mb-5">
          <img src="../public/images/promo4.jpg" class="card-img-top">
          <div class="card-body">
            <h4 class="card-title">ELECTRIC STUDIO PROMO</h4>
            <p class="card-text">Elevate your quarantine moments by staying fit and well during your isolation period. Cozy Hotel Manila, in partnership with Electric Studio, offers a quality, fun and healthy stay program for you for only PhP 5,350 net per night.</p>
          </div>
        </div>
      </div>
    </div>
  </section>




  <!-- footer -->
  <?php include "./partials/footer.html" ?>



  <script>
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');

    hamburger.addEventListener("click", mobileMenu);

    function mobileMenu() {
      hamburger.classList.toggle("active");
      navMenu.classList.toggle("active");
    }

    const navlink = document.querySelectorAll('nav-link');
    naLink.forEach((n) = n.addEventListener("click", closeMenu));

    function closeMenu() {
      hamburger.classList.remove("active");
      navMenu.classList.remove("active");
    }
  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>