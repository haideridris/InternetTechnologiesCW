<?php
session_start();
?>
<!-- all pages will have access to session variables to show dynamic content -->
<!DOCTYPE html>
<html>
<head>
	<title>Calm Coffee</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
  <div id="wrapper">
    <div id="mainbody">

      <!-- header of the page found on all pages -->
      <header id="main-header">
      <!-- this div assures that content spans 80% width of the page and not from end to end --> 
        <div class="container">
          <!-- Company logo that also is a hyper link back to the index page -->
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
          <a href="./signup.php">Sign Up</a>
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
          <!-- contains the slogan for this company -->
          <h1>Serving the finest hot beverages to all</h1>
        </div>
      </section>

      <!-- main section of the page on the right - content is different for each webpage -->
      <!-- this main section introduces Calm Coffee -->
      <div class="container">
       <section id="main"> 
         <h1>Welcome to Calm Coffee</h1>
         <p>Calm Coffee is a family owned coffee shop which has been serving superb coffees
          and hot beverages in Bradford since 1959. Our 60 years of experience has built us a
        nationwide reputation. To see our products, sign up and log in as member!</p>
        <h3>Our Store</h3>
        <p>Our store, <a href="./contactus.php" title="Store location found on Contact Us page.">located</a> within the Bradford city centre, provides the perfect relaxing atmosphere and environment to enjoy your
          beverage. Whether you're studying, reading a book or simplying enjoying a beverage,
        you can be assured the Calm Coffee store will provide the perfect environment to do so.</p>
        <center><p>Here's what we get upto instore</p></center>
        <!-- displays a video with control that shows what happens instore -->
        <div id=video-container>
          <center>
            <video src="video/coffeevideov3.mp4" controls>Video not supported</video>
          </center>
        </div>
        <h3>Our Mission Statement</h3>
        <p>To provide perfect, delicious coffee products and excellent, reliable services to our customers.</p>
        <h3>Our Values</h3>
        <ul>
          <li>Demonstrate Reliability, Passion and Excellence</li>
          <li>To be eco-friendly and sustainable</li>
          <li>To be open minded, to listen and to care for our customers </li>
          <li>To invest into Bradford by employing baristas locally</li>
        </ul>
        <h3>Our Vision</h3>
        <ul>
          <li>To open branches of Calm Coffee nationwide</li>
          <li>To be established and trusted as the perfect coffee business partner</li>
          <li>To be among the most admired and respected companies in our industry</li>
          <li>To be the leader in our markets</li>
        </ul>
        </br>
      </section>

      <!-- sidebar on the left for all pages-->
      <!-- this sidebar shows the login status and current offers at Calm Coffee -->
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
        <p>Current special offers instore</p>
        <ul>
          <li>Cappuccino's are 25% off</li>
          <li>Americano's are 35% off</li>
          <li>We now serve Chai Lattes!</li>
        </ul>
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