<?php
//Check to see if this php script has run because of the user clicking the update button on the Update User form and not by typing in the url for this webpage
if (isset($_POST['updateproduct-submit'])) {
  //Now we have access to our database using the variable $conn found within the dbh.inc.php file
  require 'dbh.inc.php';
  //Assign values provided by the user attained via the $_POST method to these four variables
  //These will be used to update the values of a product's record in the database

  $productnumber = $_POST['p_number'];
  $productname = $_POST['p_name'];
  $productprice = $_POST['p_price'];
  $imagefilepath = $_POST['imgfilepath'];

  //Error handler to check if the admin has input a product number for the record they want to update
  if (empty($productnumber)) {
    header("Location: ../admin.php?error=emptyupdateproductnumberfield");
    exit();   
  }
  //Check if the product number the admin typed is valid and found in the products table
  else {
  //sql statement - select statement gets the record from the product table where productsno is equal to the products number passed in the update product form by the admin
	$query = "SELECT * FROM products WHERE productno = '$productnumber'";
  $result = mysqli_query($conn, $query);
  $resultCheck = mysqli_num_rows($result);
  	if ($resultCheck > 0){
      //Display a no update message if no fields are given values
      if(empty($productname) & empty($productprice) & empty($imagefilepath)){
        header("Location: ../admin.php?error=noupdateproducts");
        exit();
      }
      //Update product name, price and filepath for image
 	    if(!empty($productname) & !empty($productprice) & !empty($imagefilepath)){
  	    $query = "UPDATE `products` SET `name_of_product` = '$productname', `price_of_product` = '$productprice', `image` = '$imagefilepath' WHERE `productno` = '$productnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updateproductsuccess");
        exit();
  	  }
  	  //Update the product name and price
  	  else if(!empty($productname) & !empty($productprice)){
  	    $query = "UPDATE `products` SET `name_of_product`= '$productname', `price_of_product` = '$productprice' WHERE `productno` = '$productnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updateproductsuccess");
        exit();
  	  }
  	  //Update product name and image filepath
  	  else if(!empty($productname) & !empty($productprice) & !empty($imagefilepath)){
  	    $query = "UPDATE `products` SET `name_of_product`= '$productname', `image` = '$imagefilepath' WHERE `productno` = '$productnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updateproductsuccess");
        exit();
  	  }
  	  //Update price and image filepath
      else if(!empty($productprice) & !empty($imagefilepath)){
        $query = "UPDATE `products` SET `price_of_product` = '$productprice', `image` = '$imagefilepath' WHERE `productno` = '$productnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updateproductsuccess");
        exit();
      }
      //Update name of product
      else if(!empty($productname)){
        $query = "UPDATE `products` SET `name_of_product`= '$productname' WHERE `productno` = '$productnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updateproductsuccess");
        exit();
      }
      //Update price of product
      else if(!empty($productprice)){
        $query = "UPDATE `products` SET `price_of_product` = '$productprice' WHERE `productno` = '$productnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updateproductsuccess");
        exit();
      }
      //Update filepath for image
      else if(!empty($imagefilepath)){
        $query = "UPDATE `products` SET `image` = '$imagefilepath' WHERE `productno` = '$productnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updateproductsuccess");
        exit();
      }
    //Error handler for when the product number and it's associated fields are not found in the products table
    } else {
      header("Location: ../admin.php?error=nosuchproductnumber");
      exit();
    } 
  }
}
// If the user tries to run this php script by typing its url they're sent back to the admin page instead 
else{
  header("Location: ../admin.php");
  exit();
}
?>