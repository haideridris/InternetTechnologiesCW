<?php
session_start();
//Now we have access to our database using the variable $conn found within the dbh.inc.php file
include 'includes/dbh.inc.php';
?>
<!-- all pages will have access to session variables to show dynamic content -->
<!DOCTYPE html>
<html>
<head>
  <title>Products</title>
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

      <!-- navbar which also contains a login form, it is found on each webpage -->
      <!-- login form is displayed when account is not logged in and logout button displayed when account is logged in -->
      <!-- Dynamic function -->
      <div class="container">
        <div class="nav">
          <a href="./index.php">Home</a>
          <a href="./aboutus.php">About Us</a>
          <a href="signup.php">Sign Up</a>
          <a href="./products.php">Products</a>
          <a href="./contactus.php">Contact Us</a>  
          <div class="login-form">
            <!-- log out button will be presented if page has session variable for uid -->
            <!-- login form will be presented if page does not have session variable for uid -->
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
      <!-- within this section if an account is logged in, a user  will be able
        to search for a specific product or have all products displayed to them -->
      <!-- an admin will also be able to do this to view changes they made to the products
        table in the database and then return to the admin page -->
      <!-- if an account is not logged in a message will be displayed saying they should sign up and
        login to view the products -->  
        <div class="container">
          <section id="main">
            <h1>Our Products and Beverages</h1>
            <p> Once logged in you may search for a single product or display all our products.</p>
            <!-- div used to allow the styling of echo'd html elements in php code below -->
            <div class="productsview">
              <?php
              //check if page has this session variable set - if so the user is logged into the website
              if(isset($_SESSION['uid'])) {
              //echo search bar and buttons to user/admin
                echo '<form action="products.php" method="post">
                <input type="text" name="searchbox" placeholder="Product name">
                <button type="submit" name="search-submit">Search</button>
                <button type="submit" name="display-submit">Display products</button>
                </form>';
                echo '</br>';
              //echo results from user search of single product if user submits a value to search
              //result is echo'd as a single row of a table
              //User clicks Search button
                if (isset($_POST['search-submit'])){
                  $searchvalue = $_POST['searchbox'];
                  //Query matches record in products table with the search value the user entered
                  $sql = "SELECT * FROM products WHERE name_of_product = '$searchvalue'";
                  $result = mysqli_query($conn, $sql);
                  $resultCheck = mysqli_num_rows($result);
                  //Record is echo'd as a single row of a table
                  if ($resultCheck > 0){
                    echo '<table><tr><th>Product</th><th>Price</th><th>Snapshot</th></tr>';
                  //insert each row of data from the database inside $row as an array
                    while ($row = mysqli_fetch_assoc($result)){
                  //save the filepath for an image per row to the variable $imagepath
                      $imagepath = $row['image'];
                  //echo a table on screen that represent all the information stored in the database
                  //note I chose to show the images using their filepath name instead of using a blob
                      echo '<tr><td>' . $row['name_of_product'] . '</td><td>' . '£'.$row['price_of_product'] .'</td><td>' . '<img src="'.$imagepath.'">' . '</td></tr>';
                    }
                    echo '</table>';
                    echo '</br>';
                    echo '</br>';
                  }
                  //If no record matches the search term the user entered, the message below is echo'd
                  else {
                    echo '<p>Sorry we do not have that product!</p>';
                    echo '</br>';
                    echo '</br>';
                  }
                }
                //If user clicks display products all records from the products table in the database are echo'd on the webpage in a table
                else if (isset($_POST['display-submit'])){
                  $sql = "SELECT * FROM products;";
                  $result = mysqli_query($conn, $sql);
                  $resultCheck = mysqli_num_rows($result);
                  echo '<p>These are the beverages we are currently serving</p>';
                  echo '<table><tr><th>Product</th><th>Price</th><th>Snapshot</th></tr>';
                  //Check to see if there are no rows in the products table in the database
                  //If there are rows in the database 
                  if ($resultCheck > 0){
                  //insert each row of data from the database inside $row as an array
                    while ($row = mysqli_fetch_assoc($result)){
                    //save the filepath for an image per row to the variable $imagepath
                      $imagepath = $row['image'];
                    //echo a table on screen that represent all the information stored in the database
                    //note I chose to show the images using their filepath name instead of using a blob
                      echo '<tr><td>' . $row['name_of_product'] . '</td><td>' . '£'.$row['price_of_product'] .'</td><td>' . '<img src="'.$imagepath.'">' . '</td></tr>';
                    }
                    echo '</table>';
                    echo '</br>';
                    echo '</br>';
                  }
                  //echo a message instead of displaying nothing when the products table in the database holds no values - the admin may decide to delete all products
                  else{
                    echo '<p>Admin has not entered our products into the database!</p>';
                  }
                }
              }
              //If the page does not have the session variable set, meaning an account is not logged present this message on screen instead
              else {
                echo '<p>Only members are allowed access to view our products. Please log in. We continually change our menu here at Calm Coffee therefore we require you to be a member to view our menu.';
                echo '</br>';
                echo '</br>';
              }
              ?>
            </div> 
          </section>

          <!-- sidebar on the left for all pages-->
          <!-- this sidebar shows the login status, if the user can or cannot view products and a link back to the admin page if admin is viewing products -->
          <aside id="sidebar"> 
            <!-- if webpage has the session variable, user is logged into the website and if not the user is logged out --> 
            <?php
            //check if page has this session variable - if so the user is logged into the website so show logged in message and vice versa 
            if(isset($_SESSION['uid'])) {
              echo '<p>Login Status: You are logged in!</p>';
              echo '<p>You may view our products</p>';
              //Check if the session variable for role is admin - if it is, the admin is viewing the products therefore provide them with a link to admin page
              if($_SESSION['role'] != 'admin'){ 
              } else {
                echo '<a style="color: white;" href="./admin.php">Admin Page</a>';
              }
            }
            else {
              echo '<p>Login Status: You are not logged in!</p>';
              echo '<p>You can not view our products<p>';
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