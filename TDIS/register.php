
<?php
include "config/database.php";

$message = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm_password"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Enter a valid email address.";

    } elseif ($password != $confirm) {
        $message = "Passwords do not match.";

    } elseif (strlen($password) < 8 ||
              !preg_match("/[A-Z]/", $password) ||
              !preg_match("/[a-z]/", $password) ||
              !preg_match("/[0-9]/", $password)) {
        $message = "Password must have 8 characters, uppercase, lowercase and a number.";

    } else {

        $check = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $message = "This email is already registered.";
        } else {

            $password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare(
                "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
            );

            $stmt->bind_param("sss", $name, $email, $password);

            if ($stmt->execute()) {
                $success = true;
            } else {
                $message = "Registration failed.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Travel Destination</title>

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


<main class="register-page">

    <div class="register-container">

        <div class="register-header">
            <h1>Create Account</h1>
            <p>Join Travel Destination</p>
        </div>


        <?php if ($success) { ?>

            <div class="success-message">
                Registered successfully!
                <a href="index.php">Back to Home</a>
            </div>

        <?php } else { ?>

            <?php if ($message) { ?>
                <div class="error-message">
                    <?php echo $message; ?>
                </div>
            <?php } ?>


            <form class="register-form" method="post">

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text"
                           name="fullname"
                           placeholder="Enter full name"
                           required>
                </div>


                <div class="form-group">
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           placeholder="example@gmail.com"
                           required>
                </div>


                <div class="form-group">
                    <label>Password</label>

                    <div class="password-box">
                        <input type="password"
                               id="password"
                               name="password"
                               placeholder="Enter password"
                               minlength="8"
                               required>

                        <button type="button"
                                onclick="showPassword('password', this)">
                            👁
                        </button>
                    </div>

                    <small>
                        Minimum 8 characters, uppercase, lowercase and number.
                    </small>
                </div>


                <div class="form-group">
                    <label>Confirm Password</label>

                    <div class="password-box">
                        <input type="password"
                               id="confirm_password"
                               name="confirm_password"
                               placeholder="Confirm password"
                               required>

                        <button type="button"
                                onclick="showPassword('confirm_password', this)">
                            👁
                        </button>
                    </div>
                </div>


                <button class="register-submit" type="submit">
                    Create Account
                </button>

            </form>


            <div class="register-login">
                Already have an account?
                <a href="login.php">Login here</a>
            </div>

        <?php } ?>

    </div>

</main>


<script>
function showPassword(id, button) {

    let password = document.getElementById(id);

    if (password.type === "password") {
        password.type = "text";
        button.innerHTML = "🙈";
    } else {
        password.type = "password";
        button.innerHTML = "👁";
    }
}
</script>

</body>
</html>

