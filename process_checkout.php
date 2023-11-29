<?php
include "connection.php";
include "viewCart.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $phone = $_POST['phone'];
    $county = $_POST['county'];
    $pickupStation = $_POST['pickup_station'];
    $paymentMethod = $_POST['payment_method'];
    $postal_code = $_POST['postal_code'];

    // Start a database transaction for data consistency
    mysqli_autocommit($conn, false);
    $success = true;

    // Insert order into orders table
    $totalPrice = calculateTotalPrice($_SESSION['cart']);
    $customer_Id = $_SESSION['customer_id'];

    $insertOrderQuery = "INSERT INTO orders (customer_id, total_price) VALUES ('$customer_Id', '$totalPrice')";

    if (mysqli_query($conn, $insertOrderQuery)) {
        // Retrieve the generated order ID
        $orderId = mysqli_insert_id($conn);

        // Insert order items
        foreach ($_SESSION['cart'] as $item) {
            $productId = $item['pid'];
            $quantity = $item['pquantity'];
            $price = $item['pprice'];

            $sqlOrderItems = "INSERT INTO order_items(order_id, pid, pquantity, price) VALUES('$orderId', '$productId', '$quantity', '$price')";

            if (!$conn->query($sqlOrderItems)) {
                $success = false;
                break;  // Break the loop if one order item fails
            }
        }

        // Insert shipment details with the obtained order ID
        $sqlShipment = "INSERT INTO shipments(fname, lname, phone, county, pickup_station, payment_method, postal_code, order_id) VALUES('$firstName', '$lastName', '$phone', '$county', '$pickupStation', '$paymentMethod', '$postal_code', '$orderId')";

        if (!$conn->query($sqlShipment)) {
            $success = false;
        }

        // Check if the transaction was successful
        if ($success) {
            // Commit the transaction
            mysqli_commit($conn);
            echo "Order Placed Successfully.";
            // Clear the cart session after order placement
            unset($_SESSION['cart']);
        } else {
            // Rollback the transaction
            mysqli_rollback($conn);
            echo "Failed to place order. Please try again.";
        }
    } else {
        // Handle error for order insertion
        echo "Error: " . $insertOrderQuery . "<br>" . $conn->error;
    }
} else {
    // Handle case when the form is not submitted
    echo "Form not submitted.";
}
?>
