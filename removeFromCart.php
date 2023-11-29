<?php
session_start();

if (isset($_POST['index'])) {
    $index = $_POST['index'];

    // Remove the item from the cart session
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index the array

    // Optional: If the cart is empty, unset the cart session
    if (empty($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
}

header("Location: viewCart.php");
exit();
?>
