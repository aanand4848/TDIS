
<?php
session_start();
require_once __DIR__ . "/data/destinations-data.php";
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

<body class="tdis-categories-page">

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
                    Welcome, <?php echo htmlspecialchars($_SESSION["name"]); ?>
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

<main class="tdis-page-shell">

    <a href="index.php" class="tdis-back-link">
        ← Back to Home
    </a>

    <section class="tdis-page-heading">
        <h1>Explore Categories</h1>
        <p>Choose a category and discover amazing destinations across Nepal.</p>
    </section>

    <section class="tdis-category-grid">

        <?php foreach ($categories as $slug => $category) { ?>

            <a
                href="destinations.php?category=<?php echo urlencode($slug); ?>"
                class="tdis-category-card"
            >

                <div class="tdis-category-image">
                    <img
                        src="<?php echo htmlspecialchars($category["image"]); ?>"
                        alt="<?php echo htmlspecialchars($category["category_name"]); ?>"
                    >
                </div>

                <div class="tdis-category-content">

                    <h2>
                        <?php echo htmlspecialchars($category["category_name"]); ?>
                    </h2>

                    <p>
                        <?php echo htmlspecialchars($category["description"]); ?>
                    </p>

                    <span class="tdis-explore-link">
                        Explore Destinations →
                    </span>

                </div>

            </a>

        <?php } ?>

    </section>

</main>

</body>
</html>

