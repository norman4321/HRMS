<header class="header" id="navigation-menu">
    <div class="div-container">
        <nav>
            <a href="../views/home_page.php" class="logo"> <img src="../public/images/home_logo.png" alt=""></a>
            <ul class="nav-menu">
                <li><a href="../views/home_page.php" class="nav-link">Home</a></li>
                <li><a href="../views/accomodation_page.php" class="nav-link">Accomodation</a></li>
                <li><a href="../views/about_page.php" class="nav-link">About Us</a></li>
                <li><a href="../views/contact_page.php" class="nav-link">Contact Us</a></li>
                <li>
                    <a href="../views/cart_page.php" class="nav-link" id="cart">
                        <i class="far fa-shopping-cart "></i>
                        <span class='badge badge-warning'>1</span>
                    </a>
                </li>
                <?php session_start(); ?>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <!---WITH LOGGED IN ACCOUNT--->
                    <li><a href="#" class="nav-link" id="user-access"><i class="fas fa-user"></i></a></li>
                    <ul class="user-log">
                        <li><a href="../views/profile_page.php">Profile</a></li>
                        <li><a href="../views/reservation_page.php">Reservations</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                <?php else : ?>
                    <!--- WITHOUT LOGGED IN ACCOUNT --->
                    <li><a href="../views/signin_page.php" class="nav-link" id="signin-txt">Sign in</a></li>
                <?php endif; ?>

            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>

            </div>
        </nav>
    </div>
</header>