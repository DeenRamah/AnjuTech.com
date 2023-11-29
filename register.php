<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

   
    <form id="register"  action="register.php" method="post">
    <h2>Create Account</h2>
        <label for="fname">First Name:</label>
        <input type="text" name="fname" required>

        <label for="lname">Last Name:</label>
        <input type="text" name="lname" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="gender">Gender:</label>
        <input type="text" name="gender" required>

        <label for="DOB">Date of Birth:</label>
        <input type="date" name="DOB" required>

        <label for="country">Country:</label>
        <input type="text" name="country" required>

        <label for="city">City:</label>
        <input type="text" name="city" required>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" placeholder="phone" required>

        <label for="address">Address:</label>
        <input type="text" name="address" required>

        <input type="submit" value="Register">
        <p>Already have an account?<a href="customer_login.html">Login</a></p> 
       
    </form>




<?php
    require_once 'connection.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $DOB = $_POST['DOB'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        // Validate and sanitize input (implement proper validation)
       // Hash the password (use a strong hashing algorithm in production)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Store user data in the database    
       

       if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO customers (fname, lname, email, password, gender, DOB, country, city, phone, address)
        VALUES ('$fname', '$lname', '$email', '$hashedPassword', '$gender', '$DOB', '$country', '$city', '$phone', '$address')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration <b>successful.";
        } 
        else
        {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
   

?>

</body>
</html>