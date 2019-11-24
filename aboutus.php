<?php
session_start();
?>
<!-- all pages will have access to session variables to show dynamic content -->
<!DOCTYPE html>
<html>
<head>
  <title>About Us</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <script src="js/imageslideshow.js"></script>
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

      <!-- main section of the page on the right - content is different for each webpage -->
      <!-- this main section provides further information about Calm Coffee and utilises, images, gifs and anchor tags -->
      <div class="container">
        <section id="main">
          <h1>About Us</h1>
          <h3>History</h3>
          <p>Calm Coffee was founded by Alfred Turner in 1954. Since then Calm Coffee has been serving coffee and other 
            hot beverages to the people of Bradford. The company initially began by selling coffees from a small stall found
            in the center of <a href="https://www.thetelegraphandargus.co.uk/tahistory/14741288.bradfordians-fond-memories-of-citys-shopping-centre-with-rich-heritage-of-retail/" target="_blank" title="Article on Kirkgate Market">Kirkgate Market</a>. Lead by the children of the late Alfred Turner, the compnany has developed continously and 
            in 2015 the company opened it's newest store in the <a href="https://broadwaybradford.com/" target="_blank" title="The Broadway Shopping Center site">Broadway</a> Shopping Center.
          </p>
          <!-- An image slideshow using javascript, the imageslideshow.js file -->
          <center>
            <img id="slideshow" name="slide" width="50%" height="250">
          </center>
          <h3>Committed to Fairtrade</h3>
          <!-- div used to place image on the left -->
          <div id="leftimage">
            <a href="http://www.fairtrade.org.uk/" target="_blank" title="Fairtrade site"><img src="./images/fairtradelogowhite.jpg" alt="Fair trade logo"></a>
          </div>
          <!-- div used to place image on the right -->
          <div id="rightimage">
            <img src="./images/coffeelove.jpg" alt="Coffee and love">
          </div>
          <p>At Calm Coffee we believe that hard work deserve to be rewarded and that's why since 2000, we
              have pledged and committed to only buying <a href="http://www.fairtrade.org.uk/" target="_blank" title="Fairtrade site">Fairtrade</a> coffee beans to make our coffees.
              We believe in a ethical business model that assures our suppliers are paid fairly.
              Therefore we have been strongly committed to this pledge as we believe fairtrade's policy match with our 
            company values.
          </p>
          <h3>Come Instore</h3>
          <p>We want you to come instore and enjoy some of our excellent beverages today!</p>
          <center>
            <img src="./images/funnycoffee.gif" alt="Drinking coffee gif">
          </center>  
          </br>
        </section>

        <!-- sidebar on the left for all pages -->
        <!-- shows login status -->
        <aside id="sidebar">
          <!-- if webpage has the session variable, user is logged into the website and if not the user is logged out --> 
          <?php
          //check if page has this session variable - if so the user is logged into the website so login message displayed and vice versa
          if(isset($_SESSION['uid'])) {
            echo '<p>Login Status: You are logged in!</p>';
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