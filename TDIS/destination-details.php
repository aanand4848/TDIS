<?php
session_start();
require_once __DIR__ . "/data/destinations-data.php";

$slug = isset($_GET["slug"]) ? trim($_GET["slug"]) : "";

if (!isset($destinations[$slug])) {
    http_response_code(404);
    $destination = null;
} else {
    $destination = $destinations[$slug];
}

$saved = false;
$reviewSuccess = false;

if ($destination !== null) {

    if (!isset($_SESSION["saved_destinations"])) {
        $_SESSION["saved_destinations"] = [];
    }

    if (in_array($slug, $_SESSION["saved_destinations"], true)) {
        $saved = true;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (isset($_POST["save_destination"])) {

            if (!isset($_SESSION["user_id"])) {
                header("Location: login.php");
                exit;
            }

            if (!in_array($slug, $_SESSION["saved_destinations"], true)) {
                $_SESSION["saved_destinations"][] = $slug;
            }

            $saved = true;
        }

        if (isset($_POST["submit_review"])) {

            if (!isset($_SESSION["user_id"])) {
                header("Location: login.php");
                exit;
            }

            $rating = isset($_POST["rating"]) ? (int)$_POST["rating"] : 0;
            $reviewText = isset($_POST["review"]) ? trim($_POST["review"]) : "";

            if ($rating >= 1 && $rating <= 5 && $reviewText !== "") {

                if (!isset($_SESSION["reviews"])) {
                    $_SESSION["reviews"] = [];
                }

                if (!isset($_SESSION["reviews"][$slug])) {
                    $_SESSION["reviews"][$slug] = [];
                }

                $_SESSION["reviews"][$slug][] = [
                    "name" => $_SESSION["name"] ?? "User",
                    "rating" => $rating,
                    "review" => $reviewText
                ];

                $reviewSuccess = true;
            }
        }
    }
}

$reviews = [];

if (
    $destination !== null &&
    isset($_SESSION["reviews"][$slug])
) {
    $reviews = $_SESSION["reviews"][$slug];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php
        echo $destination
            ? htmlspecialchars($destination["name"]) . " - Travel Destination"
            : "Destination Not Found";
        ?>
    </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="tdis-detail-page">

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

    <?php if ($destination !== null) { ?>

        <a
            href="destinations.php?category=<?php echo urlencode($destination["category_slug"]); ?>"
            class="tdis-back-link"
        >
            ← Back to <?php echo htmlspecialchars($destination["category_name"]); ?>
        </a>

        <section class="tdis-detail-card">

            <div class="tdis-detail-image">

                <img
                    src="<?php echo htmlspecialchars($destination["image"]); ?>"
                    alt="<?php echo htmlspecialchars($destination["name"]); ?>"
                >

            </div>

            <div class="tdis-detail-content">

                <span class="tdis-category-label">
                    <?php echo htmlspecialchars($destination["category_name"]); ?>
                </span>

                <h1>
                    <?php echo htmlspecialchars($destination["name"]); ?>
                </h1>

                <div class="tdis-detail-location">
                    📍 <?php echo htmlspecialchars($destination["location"]); ?>
                </div>

                <p class="tdis-detail-description">
                    <?php echo htmlspecialchars($destination["description"]); ?>
                </p>

                <div class="tdis-info-grid">

                    <div class="tdis-info-item">
                        <strong>Best Time</strong>
                        <span><?php echo htmlspecialchars($destination["best_time"]); ?></span>
                    </div>

                    <div class="tdis-info-item">
                        <strong>Difficulty</strong>
                        <span><?php echo htmlspecialchars($destination["difficulty"]); ?></span>
                    </div>

                    <div class="tdis-info-item">
                        <strong>Duration</strong>
                        <span><?php echo htmlspecialchars($destination["duration"]); ?></span>
                    </div>

                    <div class="tdis-info-item">
                        <strong>Location</strong>
                        <span><?php echo htmlspecialchars($destination["location"]); ?></span>
                    </div>

                </div>

                <div class="tdis-action-row">

                    <form method="post">

                        <button
                            type="submit"
                            name="save_destination"
                            class="tdis-save-btn"
                        >
                            <?php echo $saved ? "✓ Saved" : "♡ Save Destination"; ?>
                        </button>

                    </form>

                    <a href="#reviews" class="tdis-review-btn">
                        ★ Review
                    </a>

                </div>

                <?php if ($saved) { ?>

                    <p class="tdis-success-message">
                        This destination has been saved to your account.
                    </p>

                <?php } ?>

            </div>

        </section>

        <section class="tdis-review-section" id="reviews">

            <div class="tdis-section-heading">

                <h2>Reviews</h2>

                <p>
                    Share your experience or tell other travelers what you think.
                </p>

            </div>

            <?php if (isset($_SESSION["user_id"])) { ?>

                <form method="post" class="tdis-review-form">

                    <label for="rating">Rating</label>

                    <select name="rating" id="rating" required>

                        <option value="">Select Rating</option>
                        <option value="5">★★★★★ - Excellent</option>
                        <option value="4">★★★★☆ - Very Good</option>
                        <option value="3">★★★☆☆ - Good</option>
                        <option value="2">★★☆☆☆ - Fair</option>
                        <option value="1">★☆☆☆☆ - Poor</option>

                    </select>

                    <label for="review">Your Review</label>

                    <textarea
                        name="review"
                        id="review"
                        rows="5"
                        placeholder="Write your review..."
                        required
                    ></textarea>

                    <button
                        type="submit"
                        name="submit_review"
                        class="tdis-submit-review"
                    >
                        Submit Review
                    </button>

                </form>

                <?php if ($reviewSuccess) { ?>

                    <p class="tdis-success-message">
                        Your review has been submitted successfully.
                    </p>

                <?php } ?>

            <?php } else { ?>

                <div class="tdis-login-review">

                    <p>
                        Please login to save this destination and write a review.
                    </p>

                    <a href="login.php" class="tdis-login-review-btn">
                        Login to Review
                    </a>

                </div>

            <?php } ?>

            <?php if (count($reviews) > 0) { ?>

                <div class="tdis-existing-reviews">

                    <?php foreach ($reviews as $review) { ?>

                        <article class="tdis-review-card">

                            <div class="tdis-review-top">

                                <strong>
                                    <?php echo htmlspecialchars($review["name"]); ?>
                                </strong>

                                <span>
                                    <?php
                                    echo str_repeat("★", (int)$review["rating"]);
                                    echo str_repeat("☆", 5 - (int)$review["rating"]);
                                    ?>
                                </span>

                            </div>

                            <p>
                                <?php echo htmlspecialchars($review["review"]); ?>
                            </p>

                        </article>

                    <?php } ?>

                </div>

            <?php } ?>

        </section>

    <?php } else { ?>

        <section class="tdis-no-results">

            <h1>Destination Not Found</h1>

            <p>
                The destination you are looking for does not exist.
            </p>

            <a href="destinations.php" class="tdis-reset-btn">
                View Destinations
            </a>

        </section>

    <?php } ?>

</main>

</body>
</html>