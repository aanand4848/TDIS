<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - Travel Destination</title>

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
            <a href="#">About Us</a>
            <a href="#">Contact Us</a>
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


<main class="categories-page">

    <section class="categories-header">

        <h1>Explore by Category</h1>

        <p>
            Find the perfect destination based on your interests
            and travel preferences.
        </p>

    </section>


    <section class="categories-container">

        <div class="category-grid">


            <a href="#" class="category-card">

                <img src="images/everest.jpg" alt="Trekking and Adventure">

                <div class="category-content">

                    <h2>Trekking & Adventure</h2>

                    <p>
                        Discover thrilling trekking routes,
                        mountain adventures and unforgettable
                        Himalayan experiences.
                    </p>

                    <span>Explore Destinations →</span>

                </div>

            </a>


            <a href="#" class="category-card">

                <img src="images/patan.jpg" alt="Cultural and Heritage">

                <div class="category-content">

                    <h2>Cultural & Heritage</h2>

                    <p>
                        Explore ancient temples, historic places,
                        traditional architecture and Nepalese culture.
                    </p>

                    <span>Explore Destinations →</span>

                </div>

            </a>


            <a href="#" class="category-card">

                <img src="images/rara.jpg" alt="Lakes and Nature">

                <div class="category-content">

                    <h2>Lakes & Nature</h2>

                    <p>
                        Experience peaceful lakes, beautiful
                        landscapes, forests and natural wonders.
                    </p>

                    <span>Explore Destinations →</span>

                </div>

            </a>


            <a href="#" class="category-card">

                <img src="images/Lumbini.webp" alt="Religious Destinations">

                <div class="category-content">

                    <h2>Religious</h2>

                    <p>
                        Visit sacred temples, monasteries and
                        important religious destinations across Nepal.
                    </p>

                    <span>Explore Destinations →</span>

                </div>

            </a>


            <a href="#" class="category-card">

                <img src="images/nagarkot.jpg" alt="Popular Getaways">

                <div class="category-content">

                    <h2>Popular Getaways</h2>

                    <p>
                        Find relaxing weekend trips, scenic towns
                        and popular destinations for a quick escape.
                    </p>

                    <span>Explore Destinations →</span>

                </div>

            </a>


            <a href="#" class="category-card">

                <img src="images/chitwan.jpg" alt="Wildlife and Safari">

                <div class="category-content">

                    <h2>Wildlife & Safari</h2>

                    <p>
                        Explore national parks, wildlife reserves
                        and exciting jungle safari experiences.
                    </p>

                    <span>Explore Destinations →</span>

                </div>

            </a>


        </div>

    </section>

</main>

</body>
</html>