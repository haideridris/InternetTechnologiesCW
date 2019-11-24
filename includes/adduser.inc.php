<?php
////Check to see if the user got to this page by clicking the add button on the admin page and not by typing in the url for this webpage
if (isset($_POST['adduser-submit'])) {
  //Now we have access to our database using the variable $conn found within the dbh.inc.php file
  require 'dbh.inc.php';
  //Assign values provided by the user attained via the $_POST method to these four local variables
  //Using these local variables in an sql statement we will add a user to the users table in the database

  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $adminlevel = $_POST['userlevel'];

  //Error handler to check if user entered all the fields in the add user form
  if (empty($username) || empty($email) || empty($password) || empty($adminlevel)) {
    header("Location: ../admin.php?error=emptyadduserfields");
    exit();
  }
  // Check for an invalid username AND invalid e-mail.
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../admin.php?error=invalidaddusernameandemail");
    exit();
  }
  // Check for only an invalid username. The username should consist of ONLY letters and numbers.
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../admin.php?error=invalidaddusername");
    exit();
  }
  // Check for only an invalid e-mail.
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../admin.php?error=invalidaddemail");
    exit();
  }
  //Error handler to check if the admin is trying to add a user which has a username or email already found in the database users' table
  else {
    $query = "SELECT * FROM users WHERE uidUsers = '$username' OR emailUsers = '$email'";
    $result = mysqli_query($conn, $query);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0){
      //If username or email admin entered appears in database already send admin back to admin page with this error displayed in the url
      header("Location: ../admin.php?error=usertaken");
      exit();
    }
    else {
      //Insert the values the admin entered in the add user form into the user table within the database
      //Added a user
      $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, userLevel) VALUES ('$username', '$email', '$password', '$adminlevel')";
      mysqli_query($conn, $sql);
      header("Location: ../admin.php?success=addsuccess");
      exit();
    }
  } 
} 
// If the user tries to run this php script by typing it's url, they're sent back to the admin page 
else {
 header("Location: ../admin.php");
 exit();
}
?>