<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
</body>
</html>
<?php
require_once "connection.php";
session_start();

function calculateTotalPrice($cart) {
    $totalPrice = 0;

    foreach ($cart as $item) {
        if (is_numeric($item['pquantity']) && is_numeric($item['pprice'])) {
            $subtotal = $item['pquantity'] * $item['pprice'];
            $totalPrice += $subtotal;
        }
    }

    return $totalPrice;
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Your cart is empty.";
} else {
    echo "<h2>Your Shopping Cart</h2>";

    echo "<table border='1'>";
    echo "<tr><th>Product</th><th>Name</th><th>Quantity</th><th>Price</th><th>Subtotal</th><th>Action</th></tr>";

    $totalPrice = 0;

    foreach ($_SESSION['cart'] as $index => $item) {
        $subtotal = 0;

        echo "<tr>";
        echo "<td><img src={$item['pimage']} height='100'></td>";
        echo "<td>{$item['pname']}</td>";
        echo "<td>{$item['pquantity']}</td>";
        echo "<td>Kes{$item['pprice']}</td>";

        if (is_numeric($item['pquantity']) && is_numeric($item['pprice'])) {
            $subtotal = $item['pquantity'] * $item['pprice'];
            echo "<td>Kes{$subtotal}</td>";
        } else {
            echo "<td>Invalid quantity or price</td>";
        }

        echo "<td>";
        echo "<form action='updateCart.php' method='post'>";
        echo "<input type='hidden' name='index' value='$index'>";
        echo "<label for='quantity'>Update Quantity:</label>";
        echo "<input type='number' name='quantity' value='{$item['pquantity']}' min='1'>";
        echo "<input type='submit' value='Update'>";
        echo "</form><br>";
        echo "<form action='removeFromCart.php' method='post'>";
        echo "<input type='hidden' name='index' value='$index'>";
        echo "<input type='submit' value='Remove'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";

        // Accumulate the total price
        $totalPrice += $subtotal;
    }

    echo "<tr><td colspan='3'></td><td>Total: Kes{$totalPrice}</td><td></td></tr>";
    echo "</table>";
    echo "<td><a href='home.php' class='option-btn' style='margin-top: 0;'>continue shopping</a></td>";

    echo "<div class='checkout-btn'>";
    // Check if the total price is greater than 1 before enabling the checkout button
    $checkoutBtnClass = ($totalPrice > 1) ? 'btn' : 'btn disabled';
    echo "<a href='checkout.php' class='$checkoutBtnClass'>Proceed to checkout...</a>";
    echo "</div>";
}


// Additional HTML and PHP for checkout button, additional information, etc.





 