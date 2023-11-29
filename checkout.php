<?php 
     session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout process</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form id="checkout" action="process_checkout.php" method="post">
         <!-- Billing Information -->
         <h2>Shipment Details</h2>
         <div class="inputBox">
            <span>First Name</span>
            <input type="text" placeholder="First Name name" name="fname" value="<?php echo isset($_SESSION['fname']) ? $_SESSION['fname']: '';?>" required>
         </div>
         <div class="inputBox">
            <span>Last Name</span>
            <input type="text" placeholder="Last Name" name="lname" value="<?php echo isset($_SESSION['lname']) ? $_SESSION['lname']: '';?>" required>
         </div>


         <div class="inputBox">
            <span>Phone Number</span>
            <input type="text" placeholder="enter your number" name="phone" value="<?php echo isset($_SESSION['phone']) ? $_SESSION['phone']: '';?>" required>
         </div>

         <div class="inputBox">
            <span>County</span>
            <input type="text" placeholder="your county" name="county" required>
         </div>

        
         <div class="inputBox">
            <span>Pickup Station</span>
            <input type="text" placeholder="enter your pickup station" name="pickup_station" required>
         </div>

        <div class="inputBox">
            <span>payment method</span>
            <select name="payment_method">
               <option value="cash on delivery" selected>cash on devlivery</option>
               <option value="credit cart">credit cart</option>
               <option value="paypal">M-Pesa</option>
            </select>
         </div>

         <div class="inputBox">
            <span>Postal Code</span>
            <input type="text" placeholder="enter your postal-code" name="postal_code" required>
         </div>

        
         <!-- Other Checkout Fields -->

        <input type="submit" value="Place Order">
</form>


    
</body>
</html>

