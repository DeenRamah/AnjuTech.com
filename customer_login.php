<?php
require_once 'connection.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Retrieve user data from the database
    // (Make sure to use prepared statements in production)
  

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT customer_id, email, password, fname, lname, phone, `address` FROM customers WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, set session variables
            $_SESSION['customer_id'] = $row['customer_id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['lname'] = $row['lname'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['address'] = $row['address'];
          

            echo "Login successful. Welcome, " . $_SESSION['fname'] . "!";
            header('Location: home.php');
            
        } 
        else {
            echo "Incorrect password.";
        }
    } 
    else {
        echo "User not found.";
    }
  
    $conn->close();
  
    
}
?>