
<?php
    session_start();


    if(isset($_POST['add_to_cart'])){
      $pid = $_POST['pid'];  
      $pimage = $_POST['pimage'];
      $pname = $_POST['pname'];
      $pprice = $_POST['pprice'];
     // 
     $pquantity = 1;

     //create a cart array in the session if it doesn't exist
 
     if (!isset($_SESSION['cart'])) 
     {
        $_SESSION['cart'] = [];
     }

     //add product to the cart

     $_SESSION['cart'][] = [
        'pid' => $pid,
        'pimage' => $pimage,
        'pname' => $pname,
        'pprice' => $pprice,
        'pquantity' => $pquantity
     ];

     echo "product added to the cart successifully";
    }
    else {
        echo "form not submitted";
    } 
?>  