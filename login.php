
<?php
include "config/database.php";
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {

            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["name"] = $user["name"];
            $_SESSION["email"] = $user["email"];

            header("Location: index.php");
            exit;

        } else {
            $message = "Invalid email or password.";
        }

    } else {
        $message = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Travel Destination</title>

    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

<header class="site-header">

    <div class="header-inner">

        <a class="brand" href="index.php">
            <img src="images/logo.png" class="brand-logo">

            <span class="brand-text">
                <strong>Travel</strong>
                <small>Destination</small>
            </span>
        </a>

        <nav class="main-nav">
            <a href="index.php">Home</a>
            <a href="#">Destinations</a>
            <a href="#">Categories</a>
            <a href="#">About Us</a>
            <a href="#">Contact Us</a>
        </nav>

        <div class="header-actions">
            <a class="nav-btn nav-btn-light" href="login.php">Login</a>
            <a class="nav-btn nav-btn-accent" href="register.php">Register</a>
        </div>

    </div>

</header>


<main class="login-page">

    <div class="login-container">

        <div class="login-header">
            <h1>Login</h1>
            <p>Welcome back to Travel Destination</p>
        </div>


        <?php if ($message) { ?>

            <p class="login-error">
                <?php echo $message; ?>
            </p>

        <?php } ?>


        <form class="login-form" method="post">

            <div class="login-group">

                <label>Email</label>

                <input type="email"
                       name="email"
                       placeholder="example@gmail.com"
                       required>

            </div>


            <div class="login-group">

                <label>Password</label>

                <div class="login-password">

                    <input type="password"
                           id="password"
                           name="password"
                           placeholder="Enter password"
                           required>

                    <button type="button"
                            onclick="showPassword()">
                        👁
                    </button>

                </div>

            </div>


            <button class="login-submit" type="submit">
                Login
            </button>

        </form>


        <div class="login-register">

            Don't have an account?

            <a href="register.php">
                Register here
            </a>

        </div>

    </div>

</main>


<script>

function showPassword() {

    let password = document.getElementById("password");

    if (password.type === "password") {
        password.type = "text";
    } else {
        password.type = "password";
    }

}

</script>

</body>
</html>

