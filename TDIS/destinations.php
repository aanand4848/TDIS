<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinations - Travel Destination</title>

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


<main class="destination-page">

    <section class="destination-header">

        <h1>Explore Destinations</h1>

        <p>
            Discover amazing places, beautiful landscapes and
            unforgettable experiences across Nepal.
        </p>

    </section>


    <section class="destination-search">

        <form action="destinations.php" method="GET">

            <input
                type="text"
                name="search"
                placeholder="Search destination..."
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
            >

            <button type="submit">
                Search
            </button>

        </form>

    </section>


    <section class="destination-list">

        <div class="destination-grid">


            <article class="destination-card">

                <img src="images/everest.jpg" alt="Everest Base Camp">

                <div class="card-body">

                    <h3>Everest Base Camp</h3>

                    <p>
                        Experience an unforgettable journey to the
                        base camp of Mount Everest.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


            <article class="destination-card">

                <img src="images/annapurna.jpg" alt="Annapurna Base Camp">

                <div class="card-body">

                    <h3>Annapurna Base Camp</h3>

                    <p>
                        Explore stunning mountain landscapes and
                        beautiful Himalayan villages.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


            <article class="destination-card">

                <img src="images/annapurna-circuit.jpg" alt="Annapurna Circuit">

                <div class="card-body">

                    <h3>Annapurna Circuit</h3>

                    <p>
                        Discover diverse landscapes, mountain views
                        and traditional villages.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


            <article class="destination-card">

                <img src="images/langtang.jpg" alt="Langtang Valley">

                <div class="card-body">

                    <h3>Langtang Valley</h3>

                    <p>
                        Enjoy beautiful Himalayan scenery, forests
                        and peaceful mountain villages.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


            <article class="destination-card">

                <img src="images/manaslu.jpg" alt="Manaslu Circuit">

                <div class="card-body">

                    <h3>Manaslu Circuit</h3>

                    <p>
                        Experience one of Nepal's spectacular
                        mountain trekking routes.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


            <article class="destination-card">

                <img src="images/Lake.jpg" alt="Fewa Lake">

                <div class="card-body">

                    <h3>Fewa Lake</h3>

                    <p>
                        Enjoy the peaceful lake and beautiful
                        mountain views in Pokhara.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


            <article class="destination-card">

                <img src="images/rara.jpg" alt="Rara Lake">

                <div class="card-body">

                    <h3>Rara Lake</h3>

                    <p>
                        Explore the beautiful blue waters of
                        Nepal's largest lake.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


            <article class="destination-card">

                <img src="images/begnas.jpg" alt="Begnas Lake">

                <div class="card-body">

                    <h3>Begnas Lake</h3>

                    <p>
                        Relax beside the peaceful lake surrounded
                        by green hills and nature.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


            <article class="destination-card">

                <img src="images/tilicho.jpg" alt="Tilicho Lake">

                <div class="card-body">

                    <h3>Tilicho Lake</h3>

                    <p>
                        Visit one of the world's highest lakes
                        surrounded by Himalayan peaks.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


            <article class="destination-card">

                <img src="images/Lumbini.webp" alt="Lumbini">

                <div class="card-body">

                    <h3>Lumbini</h3>

                    <p>
                        Visit the birthplace of Lord Buddha and
                        explore its peaceful surroundings.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


            <article class="destination-card">

                <img src="images/patan.jpg" alt="Patan Durbar Square">

                <div class="card-body">

                    <h3>Patan Durbar Square</h3>

                    <p>
                        Discover traditional Newari culture,
                        temples and ancient architecture.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


            <article class="destination-card">

                <img src="images/bhaktapur.jpg" alt="Bhaktapur Durbar Square">

                <div class="card-body">

                    <h3>Bhaktapur Durbar Square</h3>

                    <p>
                        Explore ancient temples and traditional
                        Newari architecture.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


            <article class="destination-card">

                <img src="images/kathmandu-durbar.jpg" alt="Kathmandu Durbar Square">

                <div class="card-body">

                    <h3>Kathmandu Durbar Square</h3>

                    <p>
                        Experience historic palaces, temples and
                        the cultural heart of Kathmandu.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


            <article class="destination-card">

                <img src="images/nagarkot.jpg" alt="Nagarkot">

                <div class="card-body">

                    <h3>Nagarkot</h3>

                    <p>
                        Enjoy beautiful sunrise, sunset and
                        panoramic Himalayan views.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


            <article class="destination-card">

                <img src="images/chitwan.jpg" alt="Chitwan National Park">

                <div class="card-body">

                    <h3>Chitwan National Park</h3>

                    <p>
                        Experience jungle safaris, wildlife and
                        natural beauty in Chitwan.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


            <article class="destination-card">

                <img src="images/pokhara.jpg" alt="Pokhara">

                <div class="card-body">

                    <h3>Pokhara</h3>

                    <p>
                        Explore lakes, mountains, adventure
                        activities and beautiful landscapes.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


            <article class="destination-card">

                <img src="images/bandipur.jpg" alt="Bandipur">

                <div class="card-body">

                    <h3>Bandipur</h3>

                    <p>
                        Experience traditional architecture,
                        mountain views and peaceful streets.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


            <article class="destination-card">

                <img src="images/gosaikunda.jpg" alt="Gosaikunda">

                <div class="card-body">

                    <h3>Gosaikunda</h3>

                    <p>
                        Visit the sacred alpine lake surrounded
                        by beautiful Himalayan landscapes.
                    </p>

                    <a href="#" class="details-btn">
                        View Details
                    </a>

                </div>

            </article>


        </div>

    </section>

</main>

</body>
</html>