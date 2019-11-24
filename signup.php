<?php
session_start();
?>
<!-- all pages will have access to session variables to show dynamic content -->
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
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

      <!-- signup area section of the page -->
      <!-- contains a sign up form that will show a message if you're successful signing up or you make errors signing up -->
      <!-- error events are submitting empty fields, submitting an invalid username, submitting an invalid email, submitting both 
      invalid username and email and finally the username being already taken by someone else -->
      <div class="container">
       <section id="signuparea">
        <p>To be able to view our products you must sign up and then log in as a member of Calm Coffee.</p>
        <h1 class="signupformtitle">Signup</h1>
        <?php
        //show error messages on the site using the $_GET method 
        if (isset($_GET['error'])){
          if($_GET['error'] == "emptyfields"){
            echo '<p class="errorsigningup">Fill in all fields!</p>';
          }
          else if ($_GET['error'] == "invaliduidmail"){
            echo '<p class="errorsigningup">Invalid username and e-mail!</p>';
          }
          else if ($_GET['error'] == "invaliduid"){
            echo '<p class="errorsigningup">Invalid username!</p>';
          }
          else if ($_GET['error'] == "invalidmail"){
            echo '<p class="errorsigningup">Invalid e-mail!</p>';
          }
          else if ($_GET['error'] == "usertaken"){
            echo '<p class="errorsigningup">Username is already taken!</p>';
          }
        }
        //show success message if user successfully signed up
        else if (isset($_GET["signup"])) {
          if ($_GET["signup"] == "success") {
            echo '<p class="successsigningup">Signup successful!</p>';
          }
        }
        ?>
        <form class="form-signup" action="includes/signup.inc.php" method="post">
          <input type="text" name="uid" placeholder="Username">
          <input type="text" name="mail" placeholder="E-mail">
          <input type="password" name="pwd" placeholder="Password">
          <button type="submit" name="signup-submit">Signup</button>
        </form> 
      </section>
    </div>

    <!-- footer that will be found on all pages -->
    <footer id="main-footer">
     <p>Copyright &copy; 2019 Calm Coffee</p>	
   </footer>

 </div>
</div>
</body>
</html>