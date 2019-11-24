<?php
////Check to see if the user got to this page by clicking the add button on the admin page and not by typing in the url for this webpage
if (isset($_POST['addproduct-submit'])) {
  //Now we have access to our database using the variable $conn found within the dbh.inc.php file
  require 'dbh.inc.php';
  //Assign values provided by the user attained via the $_POST method to these four local variables
  
  $productnumber = $_POST['p_number'];
  $productname = $_POST['p_name'];
  $productprice = $_POST['p_price'];
  $imagefilepath = $_POST['imgfilepath'];


  //Error handler to check if user entered all the fields in the add user form
  if (empty($productnumber) || empty($productname) || empty($productprice) || empty($imagefilepath)) {
    header("Location: ../admin.php?error=emptyaddproductfields");
    exit();
  }
  // Check for an invalid product number or invalid price - must be an integer for $productnumber and two point decimal number for $productprice 
  else if (!preg_match("/^[0-9]*$/", $productnumber) || !preg_match("/^[0-9]+[.][0-9]{2}$/", $productprice)) {
    header("Location: ../admin.php?error=invalidaddproductnumberorprice");
    exit();
  }
  //Error handler to check if the admin is trying to add a product which has a product number already found in the products' table
  //Each product should have a unique product number
  else {
    $query = "SELECT * FROM products WHERE productno = '$productnumber'";
    $result = mysqli_query($conn, $query);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0){
      //If product number entered appears in database already send admin back to admin page with this error displayed in the url
      header("Location: ../admin.php?error=productnumbertaken");
      exit();
    }
    else {
      //Insert the values the admin entered in the add product form into the products table within the database
      //Added a product
      $sql = "INSERT INTO products (productno, name_of_product, price_of_product, image) VALUES ('$productnumber', '$productname', '$productprice', '$imagefilepath')";
      mysqli_query($conn, $sql);
      header("Location: ../admin.php?success=addproductsuccess");
      exit();
    }
  } 
}
// If the user tries to run this php script by typing its url they're sent back to the admin page instead  
else {
 header("Location: ../admin.php");
 exit();
}
?>