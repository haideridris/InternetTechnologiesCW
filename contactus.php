<?php
session_start();
?>
<!-- all pages will have access to session variables to show dynamic content -->
<!DOCTYPE html>
<html>
<head>
  <title>Contact Us</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- jquery used for the fade toggle animation of the feedback form if the user presses Provide Feedback button -->
  <script src="js/fadetogglefeedbackform.js"></script>
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
          <a href="./signup.php">Sign Up</a>
          <a href="./products.php">Products</a>
          <a href="./contactus.php">Contact Us</a>  
          <div class="login-form">
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
      <div class="container">
        <section id="main"> 
          <h1>Contact Us</h1>
          <h3>Find Our Shop</h3>
          <p>We are located within The Broadway Shopping Center complex and open at these times.</p>
            <!-- use of div and css to position address to the left of opening times -->
            <div id="address">
              <!-- use of unordered list to display the address -->
              <ul>
                <li>The Broadway</li>
                <li>Center Management Suite</li>
                <li>Hall Ings</li>
                <li>Bradford West Yorkshire</li>
                <li>BD1 1JR</li>
              </ul>
            </div>
            <!-- use of div and css to position opening times to the right of the address -->
            <div id="openingtimes">
              <!-- use of unordered list to display openining times -->
              <ul>
                <li>Monday <b>7am - 5pm</b></li>
                <li>Tuesday <b>7am - 5pm</b></li>
                <li>Wednesday <b>7am - 5pm</b></li>
                <li>Thursday <b>7am - 5pm</b></li>
                <li>Friday <b>7am - 5pm</b></li>
                <li>Saturday <b>7am - 5pm</b></li>
                <li>Sunday <b>7am - 5pm</b></li>
              </ul> 
            </div>
            <!-- Use of div as a clear fix so that next element does not flow around the floating div for opening time -->
            <div id="clear"></div>
          <h3>Getting Here</h3>
          <h4>By Car</h4>
          <p>For driving directions, put The Broadway Shopping Center postcode BD1 1JR into your Satellite Navigation or into a route planner on the web at RAC Route Planner or the AA Route Finder websites. We are located within the shopping center. The Broadway Shopping Center Complex provides onsite parking for those who wish to reach us by car.</p>
          <h4>By Bus or Train</h4>
          <!-- use of ordered list when providing the user directions to the calm coffee store via bus or train -->
          <ol>
            <li>Arrive at the Bradford Interchange Station.</li>
            <li>Exit the Bradford Interchange Station.</li>
            <li>Walk along Bridge Street. </li>
            <li>Turn right and walk along Drake Street.</li>
            <li>At the end of Drake Street you will have met The Broadway Shopping Center.</li>
            <li>Enter the center.</li>
          </ol>          
          <h3>Our Location</h3>
          <center>
            <p>Location of our store via Google Maps</p>
          </center>
          <!-- Use of iframe to show the location of the store via google maps - the source of this iframe has been referenced below -->
          <div class="mapouter">
            <div class="gmap_canvas">
              <iframe width="100%" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=The%20Broadway%20Centre%20Management%20Suite%20Hall%20Ings%2C%20Bradford%20West%20Yorkshire%2C%20BD1%201JR&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
              </iframe>Google Maps Generator by <a href="https://www.embedgooglemap.net">embedgooglemap.net</a>
            </div>
            <style>
            .mapouter{position:relative;text-align:right;height:400px;width:100%;}
            .gmap_canvas {overflow:hidden;background:none!important;height:400px;width:100%;}
            </style>
          </div>
          <h3>Contact Us</h3>
          <p>From fresh enquiries or to make bulk orders contact us, here are our details:</p>
          <!-- used an order list to show all the ways to get in contact with Calm Coffee -->
          <ul id="contactus">
            <li>Tel: 0113 211 8662</li>
            <!-- Used a mailto link here that will open the native email client and then write Enquiry in it's subject field when composing an email -->
            <li>Email: <a href="mailto:hraoof@bradford.ac.uk?Subject=Enquiry">hraoof@bradford.ac.uk</a></li>
            <li>Write To Us: Calm Coffee House, Meadow Lane, Nottingham, NG2 3HE</li>
          </ul>
          <h3>Feedback</h3>  
          <p>At Calm Coffee we appreciate we value your thoughts and opinions therefore we're willing to hear
          feedback about our service from you. We take any feedback whether good or constructive seriously.</p>
          <center>
            <!-- Button that says provide feedback, once clicked the Feedback from will fade in-->
            <!-- if clicked again the feedback form will fade out -->
            <!-- done using jquery in the togglefadefeedbackform.js file -->
            <button id="feedbackform">PROVIDE FEEDBACK</button>
          </center>
          </br>
          <!-- feedback form used for feedback, will post values used to construct an email that is sent to my university email address --> 
          <form class="feedback-form" action="includes/contactform.php" method="post">
            <input type="text" name="name" placeholder="Full Name">
            <input type="text" name="mail" placeholder="Your e-mail">
            <input type="text" name="subject" placeholder="Subject">
            <textarea name="message" rows="8" columns="80" placeholder="Message"></textarea> 
            <button type="submit" name="submit">SEND FEEDBACK</button>
          </form>
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