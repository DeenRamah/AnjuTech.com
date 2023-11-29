<?php
session_start();

var_dump($_POST); // Debugging output
var_dump($_SESSION['cart']); // Debugging output

if (isset($_POST['index']) && isset($_POST['pquantity']) && isset($_SESSION['cart'])) {
    $index = $_POST['index'];
    $pquantity = $_POST['pquantity']; // Ensure quantity is at least 1

    // Update the quantity in the cart session
    if (array_key_exists($index, $_SESSION['cart'])){
        $_SESSION['cart'][$index]['pquantity'] = $pquantity;
    }
   
}

header("Location: viewCart.php");
exit();
?>