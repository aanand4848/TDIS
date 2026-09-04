
<?php
session_start();
require_once __DIR__ . "/data/destinations-data.php";

$selectedCategory = isset($_GET["category"]) ? trim($_GET["category"]) : "";
$search = isset($_GET["search"]) ? trim($_GET["search"]) : "";

$filteredDestinations = [];

foreach ($destinations as $slug => $destination) {

    if ($selectedCategory !== "") {
        if ($destination["category_slug"] !== $selectedCategory) {
            continue;
        }
    }

    if ($search !== "") {

        $searchText = strtolower($search);

        $name = strtolower($destination["name"]);
        $location = strtolower($destination["location"]);
        $category = strtolower($destination["category_name"]);

        if (
            strpos($name, $searchText) === false &&
            strpos($location, $searchText) === false &&
            strpos($category, $searchText) === false
        ) {
            continue;
        }
    }

    $filteredDestinations[$slug] = $destination;
}

if ($selectedCategory !== "" && isset($categories[$selectedCategory])) {

    $pageTitle = $categories[$selectedCategory]["category_name"];
    $pageDescription = $categories[$selectedCategory]["description"];

} else {

    $pageTitle = "Discover Destinations";
    $pageDescription = "Explore beautiful destinations across Nepal.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo htmlspecialchars($pageTitle); ?> - Travel Destination</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="tdis-destinations-page">

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

    <?php if ($selectedCategory !== "") { ?>

        <a href="categories.php" class="tdis-back-link">
            ← Back to Categories
        </a>

    <?php } else { ?>

        <a href="index.php" class="tdis-back-link">
            ← Back to Home
        </a>

    <?php } ?>

    <section class="tdis-page-heading">

        <h1>
            <?php echo htmlspecialchars($pageTitle); ?>
        </h1>

        <p>
            <?php echo htmlspecialchars($pageDescription); ?>
        </p>

    </section>

    <form class="tdis-search-box" action="destinations.php" method="get">

        <?php if ($selectedCategory !== "") { ?>

            <input
                type="hidden"
                name="category"
                value="<?php echo htmlspecialchars($selectedCategory); ?>"
            >

        <?php } ?>

        <span class="tdis-search-icon">⌕</span>

        <input
            type="text"
            name="search"
            value="<?php echo htmlspecialchars($search); ?>"
            placeholder="Search Destination..."
            aria-label="Search Destination"
        >

        <button type="submit">
            Search
        </button>

    </form>

    <?php if (count($filteredDestinations) > 0) { ?>

        <section class="tdis-destination-grid">

            <?php foreach ($filteredDestinations as $slug => $destination) { ?>

                <article class="tdis-destination-card">

                    <img
                        src="<?php echo htmlspecialchars($destination["image"]); ?>"
                        alt="<?php echo htmlspecialchars($destination["name"]); ?>"
                    >

                    <div class="tdis-card-body">

                        <span class="tdis-category-label">
                            <?php echo htmlspecialchars($destination["category_name"]); ?>
                        </span>

                        <h2>
                            <?php echo htmlspecialchars($destination["name"]); ?>
                        </h2>

                        <p>
                            <?php echo htmlspecialchars($destination["short_description"]); ?>
                        </p>

                        <div class="tdis-location">
                            📍 <?php echo htmlspecialchars($destination["location"]); ?>
                        </div>

                        <a
                            href="destination-details.php?slug=<?php echo urlencode($slug); ?>"
                            class="tdis-details-btn"
                        >
                            View Details
                        </a>

                    </div>

                </article>

            <?php } ?>

        </section>

    <?php } else { ?>

        <section class="tdis-no-results">

            <h2>No destinations found</h2>

            <p>
                We could not find any destination matching your search.
            </p>

            <?php if ($selectedCategory !== "") { ?>

                <a
                    href="destinations.php?category=<?php echo urlencode($selectedCategory); ?>"
                    class="tdis-reset-btn"
                >
                    View All Destinations in This Category
                </a>

            <?php } else { ?>

                <a href="destinations.php" class="tdis-reset-btn">
                    View All Destinations
                </a>

            <?php } ?>

        </section>

    <?php } ?>

</main>

</body>
</html>

