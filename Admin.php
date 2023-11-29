<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adminpannel</title>
    <style>
        form{
            max-width: 55%;
            margin: 0 auto;
            padding: 2em;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: skyblue;
        }
        lable{
            display: flex;
            flex-direction: row;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        textarea{
            display: flex;
            flex-direction: row;
            width: 100%;
            padding: 1em;
            margin-bottom: 15px;
            border-radius: 3px;
        }
        input[type="submit"]{
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        h1{
            position: sticky;
        }
        #sidebar{
            height: 100%;
            width: 7em;
            position: fixed;
            top: 0;
            left: 0;
            background-color: lightblue;
            color: #fff;
            overflow-y: auto;
            transition: width;
            padding: 2em;

        }
        #sidebar a{
            text-decoration: none;
            color: black;
            display: block;
            margin-bottom: 1em;

        }
        .content{
            margin-left: 270px;
            padding: 1em;
        }
        .header{
            background-color: lightblue;
            color: white;
            padding: 0.5em;
            text-align: center;
            margin-left: 2em;
            position: sticky;
        }
        .dropdown{
            position: relative;
            display: inline-block;

        }
        .dropdown-content{
            display: none;
            position: absolute;
            min-width: 8em;
            z-index: 6;
        }
        .dropdown-content a{
            padding: 1em 1em;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover{
             background-color: blue;
        }
        .dropdown:hover .dropdown-content{
            display: block;
        }
        .message{
            display: block;
            background-color: red;
            padding: 1.5rem 1rem;
            font-size: 2rem;
            text-align: center;
        }
        .container{
            margin: 80px;
        }
        .products-display{
            align-items: center;
            
           

        
        }
        .products-display table th{
         
           display: block;
           
        }
       

        .products-display table td{
            padding: 1rem;
            font-size: 1em;
            background-color: whitesmoke; 
            width: 10em;

        
            

        }
        table{
            padding: 3em;
            justify-content: space-between;
            align-self: center;
            padding-right: 50px;
            margin-left: 10rem;
            max-width: 75%;
            background-color: skyblue;
          

        }
        .products-display table .btn:first-child{
            margin-top: 0;
        }
        .products-display table .btn:last-child{
            background: crimson;
        }
        h3{
            text-align: center;
            color: green;
        }
    </style>
</head>
<body>
    <?php 
      include ('connection.php');

      if ($_SERVER['REQUEST_METHOD'] === 'POST')
      {
           //handle file upload
           $target_directory = "images/";
           $target_file = $target_directory . basename($_FILES['pimage']['name']);
           if ( move_uploaded_file($_FILES['pimage']['tmp_name'], $target_file)) {
               
                $pname = $_POST['pname'];
                $pdesc = $_POST["pdescription"];
                $pprice = $_POST["pprice"];
                $pimage = $target_file;
                $pdiscount = $_POST["pdiscount"];

            
                //insert data into database
                $sql = "INSERT INTO products(pname, pdescription, pprice, pimage, pdiscount)
                VALUES ('$pname', '$pdesc', '$pprice', '$pimage', '$pdiscount')";

            
                if ($conn->query($sql)===true) {
                   echo "connection successful!!";

                }        
                else{
                    echo "Error:" .$sql . "<br>" .$conn->error; 
                }
           };   


        }       
    
    

    
       if (isset($_GET['delete'])) {
          $pid = $_GET['delete'];
          mysqli_query($conn, "DELETE FROM products WHERE pid = $pid");
        };

    ?>
    <div id="sidebar">
        <div class="dropdown">
            <a href="#">Products</a>
            <div class="dropdown-content">
                <a href="#">Add Product</a>
                <a href="#">Add Category</a>
                <a href="#">View Products</a>
            </div>
        </div>
       <a href="#">Orders</a>
       <a href="#">Customers</a>
       <a href="#">Sellers</a>
       
    </div>


    <div class="content">
        <div class="header">
            <h1>Welcome to your Dashboard</h1>
        </div>
    </div>

    <div class="container">
    <form enctype="multipart/form-data" method="post" >
       <h3>Add New Product</h3>

       <lable for = "pname">Product Name</lable>
       <input type="text" id="pname" name="pname" required>

       <lable for= "pimage">Product Image</lable>
       <input type="file" id="pimage" name="pimage" required>

       <lable for ="pdescription">Product Description</lable>
       <input type="text" id="pdescription" name="pdescription" required>

       <lable for ="pprice">Product Price</lable>
       <input type="number" id="pprice" name="pprice"required>

       <lable for = "pdiscount">Product Discount</lable>
       <input type="number" id="pdiscount" name="pdiscount" required>

       <input type="submit" value="Add Product">

      
    </form>
   <?php
   
$sql = "SELECT * FROM products";
$all_products = $conn->query($sql);
   ?>
   <div class="products-display">

       <table>
            <th>
                <tr>
                  <td>Product Image</td>
                  <td>Product Name</td>
                  <td>Product Price</td>
                  <td colspan="2"> Actions</td>
                
                </tr>
            </th>
           

         <?php
         while ($row = mysqli_fetch_assoc($all_products)) {
            ?>
            <tr>
               <td><img src = <?php echo $row['pimage'];?> height="80" alt=""></td>
               <td><?php echo $row['pname'];?></td>
               <td>Ksh.<?php echo $row['pprice'];?></td>
               <th>
                  <a href="Admin_update.php?edit=<?php echo $row['pid'];?>" class="btn"> <i class="fas fa-edit"></i>edit</a>
                   <a href="Admin.php?delete=<?php echo $row['pid'];?>" class="btn"> <i class="fas fa-trash"></i>delete</a>
                </th>
            </tr> 
         <?php } ?>   
        

        

        </table>
   </div>

    </div>
   
   
    
</body>
</html>

<?php
// admin_dashboard.php


include "connection.php";

// Check if the user is an admin (you can replace this with your authentication logic)
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    
    exit();
}

// Fetch and display orders
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Admin Dashboard - Orders</h2>

    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Order ID</th><th>Customer ID</th><th>Total Price</th><th>Order Date</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['order_id']}</td>";
            echo "<td>{$row['customer_id']}</td>";
            echo "<td>{$row['total_price']}</td>";
            echo "<td>{$row['order_date']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No orders found.";
    }
    ?>

    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
