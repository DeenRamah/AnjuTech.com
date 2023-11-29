<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product update</title>
    <style>
          form{
            max-width: 45%;
            margin: 0 auto;
            padding: 2em;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
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
        h3{
            text-align: center;
            color: green;
        }
    </style>
</head>
<body>

<?php
require_once 'connection.php';

$pid = $_GET['edit'];
if (isset($_POST['update_product'])) {
    $pname = $_POST["pname"];
    $pdesc = $_POST["pdescription"];
    $pprice = $_POST["pprice"];

    $pdiscount = $_POST["pdiscount"];
    

    //handle file upload
    $target_directory = "images/";
    $target_file = $target_directory . basename($_FILES['pimage']['name']);

    
    //insert data into database
    $sql = "UPDATE products SET pname= '$pname', pdescription= '$pdesc', pprice='$pprice', 
    pimage='$target_file', pdiscount='$pdiscount' WHERE pid = $pid";
    
    $upload = mysqli_query($conn, $sql);  

}

$select = mysqli_query($conn, "SELECT * FROM products WHERE pid = $pid");
while ($row = mysqli_fetch_assoc($select)) {
    ?>


<form enctype="multipart/form-data" method="post" >


       <h3> Update Product</h3>

       <lable for = "pname">Product Name</lable>
       <input type="text" id="pname" name="pname" value="<?php echo $row['pname']; ?>" required>

       <lable for= "pimage">Product Image</lable>
       <input type="file" id="pimage" name="pimage" value="<?php echo $row['pimage']; ?>" required>

       <lable for ="pdescription">Product Description</lable>
       <input type="text" id="pdescription" name="pdescription" value="<?php echo $row['pdescription']; ?>" required>

       <lable for ="pprice">Product Price</lable>
       <input type="number" id="pprice" name="pprice" value="<?php echo $row['pprice']; ?>" required>

       <lable for = "pdiscount">Product Discount</lable>
       <input type="number" id="pdiscount" name="pdiscount" value="<?php echo $row['pdiscount']; ?>" required>

       <input type="submit" class="btn" value="update product" name="update_product">
       <button>
       <a href="Admin.php" class="btn">go back</a>
       </button>

      
   </form>
   <?php }; ?>
    
</body>
</html>