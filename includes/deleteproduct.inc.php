<?php
//Check to see if this php script has run because of the admin clicking the delete button on the delete product form and not by typing in the url for this webpage
if (isset($_POST['deleteproduct-submit'])) {
  //Now we have access to our database using the variable $conn found within the dbh.inc.php file
  require 'dbh.inc.php';
  //Assign value provided by the admin attained via the $_POST method to this local variable that holds the value for a product number

  $productnumber = $_POST['p_number'];

  //Error handler to check if admin did enter a product number in the delete products form and didn't leave it empty
  if (empty($productnumber)) {
    header("Location: ../admin.php?error=emptydeleteproductfield");
    exit();
  }
  //Check if the product number submitted by the admin is found in the products table then delete that product's record of details
  else{
    //sql statement - select statement gets the record from the product table where productsno is equal to the products number passed in the delete product form by the admin
    $query = "SELECT * FROM products WHERE productno = '$productnumber'";
    $result = mysqli_query($conn, $query);
    $resultCheck = mysqli_num_rows($result);
    //If a product with the same product number is found in the products table delete that product
    if ($resultCheck > 0){
      $sql = "DELETE FROM products WHERE productno = '$productnumber'";
      mysqli_query($conn, $sql);
      header("Location: ../admin.php?success=deleteproductsuccess");
      exit();
    }
    //If the product number is not found display an error message saying no such product found to the admin
    else {
      header("Location: ../admin.php?error=nosuchproduct");
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