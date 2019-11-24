<?php
// php code that will run when you click the sign up button, it will have error handlers to check if the user has entered their details correctly and if they did enter their details correctly in the form it will sign them up to the website by storing their details in the database

//Now we have access to the variable $conn
require 'dbh.inc.php';

if (isset($_POST['signup-submit'])) { //Check to see the user got to this page by clicking submit button sign up page and not by typing in the url for this webpage

  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];

 //Error handler to check if user entered all the fields in the sign up form
  if (empty($username) || empty($email) || empty($password)) {
    header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
    exit();
  }
  // Check for an invalid username AND invalid e-mail.
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invaliduidmail");
    exit();
  }
  // Check for only an invalid username. In this case ONLY letters and numbers.
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../signup.php?error=invaliduid&mail=".$email);
    exit();
  }
  // Check for only an invalid e-mail.
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invalidmail&uid=".$username);
    exit();
  }
  //Error handler to check if the username a user is trying to sign up with is already stored and found within the database
  //Prevents the table of users having two records with the same username
  else {
    $query = "SELECT * FROM users WHERE uidUsers = '$username'";
    $result = mysqli_query($conn, $query);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0){
      header("Location: ../signup.php?error=usertaken&mail=".$email);
      exit();
    }
    //If all the details the user signed up with are valid input them into the users table of the database
    //This user is now registered
    else {
      $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES ('$username', '$email', '$password')";
      mysqli_query($conn, $sql);
      header("Location: ../signup.php?signup=success");
      exit();
    }
  }
}
else {
// If the user tries to run this page by typing the url of this php script, they're sent back to the sign up page
  header("Location: ../signup.php");
  exit();
}
?>
