<!-- registration.php -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['email']) && isset($_GET['password'])) {
    $email = $_GET['email'];
    $password = $_GET['password'];
    ?>
    <!-- Display registration form -->
    <h2>Complete Your Registration</h2>
    <form action="process_registration.php" method="post">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <input type="hidden" name="password" value="<?php echo $password; ?>">

        <!-- Add more fields for personal information -->
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" required>

        <label for="address">Address:</label>
        <input type="text" name="address" required>

        <!-- Add more fields as needed -->

        <input type="submit" value="Complete Registration">
    </form>
    <?php
} else {
    echo "Invalid request.";
}
?>