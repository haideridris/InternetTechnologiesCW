<?php
session_start();
//If session variable is not admin redirect the user back to the index page
//Only allows admin onto this page
//Therefore it's not possible for a user to type in the admin.php address and access this admin page and it's admin features
if($_SESSION['role'] != 'admin'){
  header('Location: ./index.php');
  exit();
}
//Now we have access to our database using the variable $conn found within the dbh.inc.php file
include 'includes/dbh.inc.php';
?>
<!-- all pages will have access to session variables to show dynamic content -->
<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
  <div id="wrapper">
    <div id="mainbody"> 

      <!-- header of the page found on all pages --> 
      <header id="main-header"> 
        <div class="container">
          <a href="./index.php"><img src="./images/logov3.jpg" alt="Website Logo" width="150" height="150"></a>
        </div>
      </header>

      <!-- navbar which also contains a login form for each webpage -->
      <div class="container">
        <div class="nav">
          <a href="./index.php">Home</a>
          <a href="./aboutus.php">About Us</a>
          <a href="./signup.php">Sign Up</a>
          <a href="./products.php">Products</a>
          <a href="./contactus.php">Contact Us</a>  
          <div class="login-form">
            <!-- log out button will be presented if web page a session variable for uid -->
            <!-- php code that shows the login form when the user is logged out and shows the logout button when the user is logged in depending on if the session variable is present -->
            <?php 
            if(isset($_SESSION['uid'])) {
              echo '<form action="includes/logout.inc.php" method="post">
              <button type="submit" name="logout-submit">Logout</button>
              </form>';
            }
            else {
              echo '<form action="includes/login.inc.php" method="post">
              <input type="text" name="mailuid" placeholder="Username/E-mail">
              <input type="password" name="pwd" placeholder="Password">
              <button type="submit" name="login-submit">Login</button>
              </form>';
            }
            ?>
          </div>
        </div>
      </div> 
      
      <!-- showcase which contains the companies slogan -->
      <section id="showcase">  
        <div class="container">
          <h1>Serving the finest hot beverages to all</h1>
        </div>
      </section>

      <!-- main section of the page - content is different for each webpage -->
      <!-- this main section contains a table showing every account which is registered to the website
      and three forms, one to add users, delete user and update a users details -->
      <!-- this main section also contains a table showing all the details of each product and three form,
        one to add a product, one to delete a product and a form to update product details -->
      <div class="container">
        <section id="main">
          <h1>Welcome Admin</h1>
          <p>You can view users, add users, delete users and change their administration level here.</p> 
          <h3>Registered users</h3>
          <!-- div used to style the users table echo'd in this php code -->
          <div class="admintable">
            <?php
            //check if page has this session variable - if so the admin is logged into the website therefore we will display a table of users
            if(isset($_SESSION['uid'])) {
              $sql = "SELECT * FROM users;";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);
              echo '<table><tr><th>User ID Number</th><th>Username</th><th>Email Address</th><th>Password</th><th>Administration Level</th</tr>';
              //Check if there are no rows in the users table
              //If no rows, displays a text message, if there are rows, displays a table of users 
              if ($resultCheck > 0){
                //insert each row of data from the database inside $row as an array
                while ($row = mysqli_fetch_assoc($result)){
                  //echo a table on screen that represent all the information stored in the users table of the database
                  echo '<tr><td>' . $row['idUsers'] . '</td><td>' .$row['uidUsers'] .'</td><td>' .$row['emailUsers'] .'</td><td>' .$row['pwdUsers']. '</td><td>' .$row['userLevel'] .'</td></tr>';
                }
                echo '</table>';
              }
              else{
                //Message displayed when there are no users registered
                //Code should not run, admin needs be registed for this page to be accessed
                echo '<p>There are no users registered to the database!</p>';
              }
            }
            ?>
          </div>

          <!-- this div has been used to position the add, delete and update user forms side by side -->
          <div class="formblock">
            <h3>Add user</h3>
            <!-- Show error messages using the $_GET method if admin makes an error trying to add a user -->
            <?php
            if (isset($_GET['error'])){
              if($_GET['error'] == "emptyadduserfields"){
                echo '<p class="erroradminforms">Fill in all fields!</p>';
              }
              else if ($_GET['error'] == "invalidaddusernameandemail"){
                echo '<p class="erroradminforms">Invalid username and e-mail!</p>';
              }
              else if ($_GET['error'] == "invalidaddusername"){
                echo '<p class="erroradminforms">Invalid username!</p>';
              }
              else if ($_GET['error'] == "invalidaddemail"){
                echo '<p class="erroradminforms">Invalid e-mail!</p>';
              }
              else if ($_GET['error'] == "usertaken"){
                echo '<p class="erroradminforms">Username is already taken!</p>';
              }
            }
            // Show success message if user successfully signed up
            else if (isset($_GET["success"])) {
              if ($_GET["success"] == "addsuccess") {
                echo '<p class="successadminforms">User added successfully!</p>';
              }
            }
            ?>
            <!-- Add user form -->
            <form class="form-admin" action="includes/adduser.inc.php" method="post">
              <fieldset>
                <legend>Add User</legend>
                <lable>Username: </lable>
                <input type="text" name="uid" placeholder="Username">
                <lable>Email: </lable>
                <input type="text" name="mail" placeholder="E-mail">
                <lable>Password: </lable>
                <input type="password" name="pwd" placeholder="Password">
                <br>
                <lable>Admin Level: </lable>
                <select name="userlevel">
                  <option value="user">User</option>
                  <option value="admin">Admin</option>
                </select>
                <button type="submit" name="adduser-submit">Add</button>
              </fieldset>
            </form>
          </div>
          <!-- this div has been used to position the add, delete and update user forms side by side -->
          <div class="formblock">
            <h3>Delete user</h3>
            <!-- Show error messages using $_GET method if admin makes a mistake trying to delete a user -->
            <?php
            if (isset($_GET['error'])){
              if($_GET['error'] == "emptydeleteuserfields"){
                echo '<p class="erroradminforms">Fill in field with registered account!</p>';
              }
              else if($_GET['error'] == "nosuchuser"){
                echo '<p class="erroradminforms">User not found!</p>';
              }
            }
            // Show success message if user successfully deleted by admin
            else if (isset($_GET["success"])) {
              if ($_GET["success"] == "deletesuccess") {
                echo '<p class="successadminforms">Account deleted successfully!</p>';
              }
            }
            ?>
            <!-- delete user form -->
            <form class="form-admin" action="includes/deleteuser.inc.php" method="post">
              <fieldset>
                <legend>Delete User</legend>
                <label>Choose user:</label>
                <input type="text" name="uidoremail" placeholder="Username or E-mail">
                <button type="submit" name="deleteuser-submit">Delete</button>
              </fieldset>
            </form>
          </div>
          <!-- this div has been used to position the add, delete and update user forms side by side -->
          <div class="formblock">
            <h3>Update user details</h3>
            <!-- show error messages using the $_GET method -->
            <?php
            if (isset($_GET['error'])){
              if($_GET['error'] == "emptyupdateuseridnumberfield"){
                echo '<p class="erroradminforms">Specify user id to update!</p>';
              } 
              else if ($_GET['error'] == "nosuchuserid"){
                echo '<p class="erroradminforms">No such user id!</p>';
              }
            }
              // Show success message if user field updated successfully 
            else if (isset($_GET["success"])) {
              if ($_GET["success"] == "updatesuccess") {
                echo '<p class="successadminforms">Update occurred successfully!</p>';
              }
            }
            ?>
            <!-- update user form -->
            <form class="form-admin" action="includes/updateuser.inc.php" method="post">
              <fieldset>
                <legend>Update User details</legend>
                <lable>Specify user id to update: </lable>
                <input type="text" name="uidnumber" placeholder="User ID Number">
                <lable>Update username: </lable>
                <input type="text" name="uid" placeholder="Username">
                <lable>Update email: </lable>
                <input type="text" name="mail" placeholder="E-mail">
                <lable>Update password: </lable>
                <input type="password" name="pwd" placeholder="Password">
                <br>
                <lable>Update admin level: </lable>
                <select name="userlevel">
                  <option value="user">User</option>
                  <option value="admin">Admin</option>
                </select>
                <button type="submit" name="updateuser-submit">Update</button>
              </fieldset>
            </form>
          </div> 

          <h3>Products</h3>
          <p>You can view products, add products, delete products and update product details here.</p>
          <!-- div used to style the users table echo'd in this php code -->
          <div class="admintable">
            <?php
            //check if page has this session variable - if so the admin is logged into the website therefore we will display a table of products
            if(isset($_SESSION['uid'])) {
              $sql = "SELECT * FROM products;";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);
              echo '<table><tr><th>Product number</th><th>Product name</th><th>Price</th><th>Filepath for image</th></tr>';
              //good to check if you have no rows in table to prevent error message being shown on webpage
              //before displaying table of data from database
              if ($resultCheck > 0){
                //insert each row of data from the database inside $row as an array
                while ($row = mysqli_fetch_assoc($result)){
                  //echo a table on screen that represent all the product information stored in the products table of the database
                  echo '<tr><td>' . $row['productno'] . '</td><td>' .$row['name_of_product'] .'</td><td>' .'£' .$row['price_of_product'] .'</td><td>' .$row['image']. '</td><tr>';
                }
                echo '</table>';
              }
              else{
                echo '<p>Admin has not entered our products into the database!</p>';
              }
            }
            ?>
          </div>
          <!-- this div has been used to position the add, delete and update product forms side by side -->
          <div class="formblock">
            <h3>Add Product</h3> 
            <!-- show error messages using the $_GET method id admin makes a mistake trying to add a product -->
            <?php
            if (isset($_GET['error'])){
              if($_GET['error'] == "emptyaddproductfields"){
                echo '<p class="erroradminforms">Fill in all fields!</p>';
              }
              else if ($_GET['error'] == "invalidaddproductnumberorprice"){
                echo '<p class="erroradminforms">Invalid value for product number and/or price!</p>';
              }
              else if($_GET['error'] == "productnumbertaken"){
                echo '<p class="erroradminforms">Product number is already assigned to a different product!</p>';
              }
            }
            // Show success message if product is successfully added by admin
            else if (isset($_GET["success"])) {
              if ($_GET["success"] == "addproductsuccess") {
                echo '<p class="successadminforms">Product added successfully!</p>';
              }
            }
            ?>
            <!-- Add products form -->
            <form class="form-admin" action="includes/addproduct.inc.php" method="post">
              <fieldset>
                <legend>Add Product</legend>
                <lable>Product number: </lable>
                <input type="text" name="p_number" placeholder="Product number">
                <lable>Product name: </lable>
                <input type="text" name="p_name" placeholder="Product name">
                <lable>Price: </lable>
                <input type="text" name="p_price" placeholder="Price">
                <lable>Image filepath: </lable>
                <input type="text" name="imgfilepath" placeholder="Image filepath">
                <button type="submit" name="addproduct-submit">Add</button>
              </fieldset>
            </form>
          </div>
          <!-- this div has been used to position the add, delete and update product forms side by side -->
          <div class="formblock">
            <h3>Delete Product</h3>
            <!-- show error messages on the site using the $_GET method if the admin makes a mistake trying to delete a product -->
            <?php
            if (isset($_GET['error'])){
              if($_GET['error'] == "emptydeleteproductfield"){
                echo '<p class="erroradminforms">Fill in field with a registered product number!</p>';
              }
              else if($_GET['error'] == "nosuchproduct"){
                echo '<p class="erroradminforms">No such product !</p>';
              }
            }
            // Show success message if product is successfully deleted by the admin
            else if (isset($_GET["success"])) {
              if ($_GET["success"] == "deleteproductsuccess") {
                echo '<p class="successadminforms">Product deleted successfully!</p>';
              }
            }
            ?>
            <form class="form-admin" action="includes/deleteproduct.inc.php" method="post">
              <fieldset>
                <legend>Delete Product</legend>
                <label>Choose by product number:</label>
                <input type="text" name="p_number" placeholder="Product number">
                <button type="submit" name="deleteproduct-submit">Delete</button>
              </fieldset>
            </form>
          </div>
          <!-- this div has been used to position the add, delete and update product forms side by side -->
          <div class="formblock">
            <h3>Update Product</h3>
            <!-- show error messages using the $_GET method if the admin makes a mistake trying to update a products details -->
            <?php
            if (isset($_GET['error'])){
              if($_GET['error'] == "emptyupdateproductnumberfield"){
                echo '<p class="erroradminforms">Specify product number to update a product!</p>';
              } 
              else if ($_GET['error'] == "nosuchproductnumber"){
                echo '<p class="erroradminforms">No such product!</p>';
              }
              else if ($_GET['error'] == "noupdateproducts"){
                echo '<p class="erroradminforms">No update occurred!</p>';
              } 
            }
              // Show success message if a product's details are updated successfully by the admin
            else if (isset($_GET["success"])) {
              if ($_GET["success"] == "updateproductsuccess") {
                echo '<p class="successadminforms">Update occurred successfully!</p>';
              }
            }
            ?>
            <!-- update product form -->
            <form class="form-admin" action="includes/updateproduct.inc.php" method="post">
              <fieldset>
                <legend>Update Product</legend>
                <lable>Specify product number to update: </lable>
                <input type="text" name="p_number" placeholder="Product number">
                <lable>Update product name: </lable>
                <input type="text" name="p_name" placeholder="Product name">
                <lable>Update price: </lable>
                <input type="text" name="p_price" placeholder="Price">
                <lable>Update filepath for image: </lable>
                <input type="text" name="imgfilepath" placeholder="Image filepath">
                <button type="submit" name="updateproduct-submit">Update</button>
              </fieldset>
            </form>
          </div> 
        </section>

        <!-- sidebar on the left for all pages - shows login status -->
        <aside id="sidebar"> 
          <!-- if webpage has the session variables, user is logged into the website and if not the user is logged out -->
          <!-- this is the same mechanism websites like facebook use to change webpage content depending on if a user is logged in or not -->
          <?php
            //check if page has this session variable - if so the user is logged into the website
          if(isset($_SESSION['uid'])) {
            echo '<p>Login Status: Admin, you are logged in!</p>';
          }
          else {
            echo '<p>Login Status: You are not logged in!</p>';
          }
          ?>
        </aside>
      </div>

      <!-- footer that will be found on all pages -->
      <footer id="main-footer">
        <p>Copyright &copy; 2019 Calm Coffee</p>  
      </footer>
      
    </div>
  </div>
</body>
</html>