<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Destination</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header class="site-header">
        <div class="header-inner">
            <a class="brand" href="index.php" aria-label="Travel Destination home">
               <img src="images/logo.png" alt="Travel Destination Logo" class="brand-logo">

                <span class="brand-text">
                    <strong>Travel</strong>
                    <small>Destination</small>
                </span>
            </a>

            <nav class="main-nav" aria-label="Main navigation">
                <a href="index.php">Home</a>
                <a href="destinations.php">Destinations</a>
                <a href="categories.php">Categories</a>
                <a href="about.php">About Us</a>
                <a href="contact.php">Contact Us</a>
            </nav>

            <div class="header-actions">

               <?php if (isset($_SESSION["user_id"])) { ?>

                 <span class="user-name">
                 Welcome, <?php echo $_SESSION["name"]; ?>
                 </span>

               <a class="nav-btn nav-btn-light" href="logout.php">
                Logout
               </a>

               <?php } else { ?>

               <a class="nav-btn nav-btn-light" href="login.php">
                Login
               </a>

               <a class="nav-btn nav-btn-accent" href="register.php">
               Register
               </a>

              <?php } ?>

            </div>
        </div>
    </header>

    <main class="page-shell">
        <section class="hero-section">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1>DISCOVER AMAZING<br>DESTINATION IN NEPAL</h1>
                <p>Find detailed travel information, explore popular attractions and plan your next adventure.</p>

                <form class="search-box" action="#" method="get">
                    <span class="search-icon">⌕</span>
                    <input type="text" name="search" placeholder="Search Destination..." aria-label="Search Destination">
                    <button type="submit">Search</button>
                </form>
            </div>
        </section>

        <section class="popular-section">
            <h2>Popular Destinations</h2>

            <div class="destination-grid">
                <?php { ?>
                    
                    <article class="destination-card">
                        <img src="images/Lake.jpg" alt="Fewa Lake">
                        <div class="card-body">
                            <h3>Fewa Lake</h3>
                            <p>Beautiful lakeside city surrounded by mountains.</p>
                            <a href="#" class="details-btn">View Details</a>
                        </div>
                    </article>
                    <article class="destination-card">
                        <img src="images/chitwan.jpg" alt="Chitwan Park">
                        <div class="card-body">
                            <h3>Chitwan Park</h3>
                            <p>Explore wildlife and jungle safari adventures.</p>
                            <a href="#" class="details-btn">View Details</a>
                        </div>
                    </article>
                    <article class="destination-card">
                        <img src="images/Lumbini.jpg" alt="Lumbini">
                        <div class="card-body">
                            <h3>Lumbini</h3>
                            <p>The birthplace of lord Buddha.</p>
                            <a href="#" class="details-btn">View Details</a>
                        </div>
                    </article>
                    <article class="destination-card">
                        <img src="images/everest.jpg" alt="Everest Base Camp">
                        <div class="card-body">
                            <h3>Everest Base Camp</h3>
                            <p>Trek to base camp of the world's highest peak.</p>
                            <a href="#" class="details-btn">View Details</a>
                        </div>
                    </article>
                    <article class="destination-card">
                        <img src="images/rara-lake.jpg" alt="Rara Lake">
                        <div class="card-body">
                            <h3>Rara Lake</h3>
                            <p>The biggest and most beautiful lake in Nepal.</p>
                            <a href="#" class="details-btn">View Details</a>
                        </div>
                    </article>
                    <article class="destination-card">
                        <img src="images/patan.jpg" alt="Patan Durbar">
                        <div class="card-body">
                            <h3>Patan Durbar</h3>
                            <p>Experience rich culture and ancient architecture.</p>
                            <a href="#" class="details-btn">View Details</a>
                        </div>
                    </article>
                <?php } ?>
            </div>
        </section>
    </main>
</body>
</html>

