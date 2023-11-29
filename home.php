<?php
  require_once 'connection.php';
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlnjuTech.com</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

    <div id="page" class="site">
    <header>
        <div class="logo">
            <h1>AlnjuTech</h1>
        </div>
        <div class="search-container">
            <input type="text" id="search-bar" placeholder="You are looking for...">
            <button id="search-btn">Search</button>
        </div>
        
        <ul id="navbar">
            <li>
                <div class="account-dropdown">
                    <button class="account-icon">Account</button>
                    <div class="dropdown-content">
                       <a href="customer_login.html">Login</a>
                       <a href="register.php">Register</a>
                       <a href="logout.php">Logout</a>
                    </div>
                    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const loginLink = document.querySelector('.dropdown-content a[href="customer_login.php"]');
        const registerLink = document.querySelector('.dropdown-content a[href="register.php"]');

        loginLink.addEventListener('click', function () {
            window.location.href = 'customer_login.php';
        });

        registerLink.addEventListener('click', function () {
            window.location.href = 'register.php';
        });
    });
</script>

                </div>

            </li>
            <li><a href="#">Contacts</a></li>
            <li><a href="#">Help?</a></li>
            <li><a href="viewCart.php">Cart</a></li>
        </ul>
        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>                 
            
            
        
       
    </header>
    <section class="products">
      <main>
    
    
         <?php 

            $sql = "SELECT pid, pname, pimage, pprice, pdescription, pdiscount FROM products";

            $all_products = $conn->query($sql);
           // if (mysqli_num_rows($all_products) >0) {

                while ($row = mysqli_fetch_assoc($all_products)) {

                  ?>
            
                        <form action="addToCart.php" method="post">
                           <div class="card">
                                <div class="image">
                                   <img src="<?php echo $row["pimage"];?> " alt="">
                                </div>
                                <p class="product_name"><?php echo $row["pname"];?></p>
                                <p class="product_description"><?php echo $row["pdescription"];?></p>
                                <p class="product_price">Ksh<b><?php echo $row["pprice"];?></b></p>
                                <p class="discount"><b>Ksh<del><?php echo $row["pdiscount"];?></del></b></p>
                                <input type="hidden" name="pid" value="<?php echo $row['pid']; ?> ">
                                <input type="hidden" name="pname" value="<?php echo $row['pname']; ?>">
                                <input type="hidden" name="pprice" value="<?php echo $row['pprice']; ?>">
                                <input type="hidden" name="pimage" value="<?php echo $row['pimage']; ?>">
                                <input type="submit" class="btn" value="add to cart" name="add_to_cart">

                            </div>
                        </form> 

            
             
                   <?php
                };            
           
        ?>     
    </main>        
    



    </section>
<?php
  


 
 



?>    

    
<!-- custom js file link  -->
<script src="js/script.js"></script>

   
  
</body>
</html>