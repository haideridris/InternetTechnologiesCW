<?php
//Check to see if the user got to this page by clicking the log in button on the page and not by typing in the url for this webpage
if (isset($_POST['login-submit'])) {
  //Now we have access to our database using the variable $conn found within the dbh.inc.php file
  require 'dbh.inc.php';

  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];

  //Error handler to check if the user has not entered a email or password or both in the log in form
  if (empty($mailuid) || empty($password)) {
    //Error message seen in the URL
    //Send the user to the index page
    header("Location: ../index.php?error=emptyfields&mailuid=".$mailuid);
    exit();
  }
  //User has entered a username/email and a password
  //Check if the login details match a user who has this email/username and password in the users table of the database
  else {
    //sql statement - select statement gets the record from the user table where uidUser or emailUser is equal to the username or email passed in the log in form by the user
    $query = "SELECT * FROM users WHERE uidUsers = '$mailuid' OR emailUsers = '$mailuid';";
    $result = mysqli_query($conn, $query);
    $resultCheck = mysqli_num_rows($result);
    //If the user is found in the database
    if ($resultCheck > 0){
      while ($row = mysqli_fetch_assoc($result)){
        if($row['pwdUsers'] == $password){
          //Log the user into the website
          //Start a session
          session_start();
          //Set session variables equal to information we have about the user in the database
          //Grab information from the database and assign to session variables
          $_SESSION['id'] = $row['idUsers'];
          $_SESSION['uid'] = $row['uidUsers'];
          $_SESSION['email'] = $row['emailUsers'];
          $_SESSION['role'] = $row['userLevel'];
          //Show a successful login message
          //Send the user to the admin.php page if they're an admin or if they're a user to the products.php to show them products
          if ($_SESSION['role'] == 'admin'){
          //if the userLevel for this record is admin send them to the admin page
            header("Location: ../admin.php?login=success");
            exit();  
          }
          else {
          //the only other userlevel is user so it will send the user to the products page
            header("Location: ../products.php?login=success");
            exit();
          }
        }
        else {
        //the user with this email adress or user was found but they entered an incorrect password
          header("Location: ../index.php?error=passwordincorrect");
          exit();
        }  
      }
    } else {
        //no user found in the database with the email or username the user tried to log in with
      header("Location: ../index.php?error=notvaliduser");
      exit();
    }     
  }
}  
// If the user tries to run this php script by typing the url of this php page instead of clicking the login button of the log in form , they're sent back to the index page
else {
  header("Location: ../index.php");
  exit();
}
?>