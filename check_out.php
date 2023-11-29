<!-- checkout.php -->
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Validate email, password, and confirm_password
        // ...

        // Check if passwords match
        if ($password === $confirmPassword) {
            // Redirect to registration page
            header("Location: registration.php?email=$email&password=$password");
            exit();
        } else {
            echo "Passwords do not match.";
        }
    }
    else {
        header("Location: register.php");
    }
    ?>
   
    <?php
} else {
    // User is logged in, proceed with checkout
    echo "Proceed with checkout for logged-in user.";
    header("Location: checkout2.php");
}
?>