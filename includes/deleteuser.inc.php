<?php
//Check to see if this php script has run because of the user clicking the delete button on the delete user form and not by typing in the url for this webpage
if (isset($_POST['deleteuser-submit'])) {
  //Now we have access to our database using the variable $conn found within the dbh.inc.php file
  require 'dbh.inc.php';
  //Assign value provided by the user attained via the $_POST method to this local variable that holds the value for either a username or email

  $usernameoremail = $_POST['uidoremail'];

  //Error handler to check if user did enter a username or email address in the delete form and didn't leave it empty
  if (empty($usernameoremail)) {
    header("Location: ../admin.php?error=emptydeleteuserfields");
    exit();
  }
  //Check if the username or email adress submitted by the admin is found in the users table then delete that users details
  else{
    //sql statement - select statement gets the record from the user table where uidUser or emailUser is equal to the username or email the admin entered in the delete user form
    $query = "SELECT * FROM users WHERE uidUsers = '$usernameoremail' OR emailUsers = '$usernameoremail'";
    $result = mysqli_query($conn, $query);
    $resultCheck = mysqli_num_rows($result);
    //If the username or email address is found in the users table delete that user account
    if ($resultCheck > 0){
      $sql = "DELETE FROM users WHERE uidUsers = '$usernameoremail' OR emailUsers = '$usernameoremail'";
      mysqli_query($conn, $sql);
      header("Location: ../admin.php?success=deletesuccess");
      exit();
    }
    //If the username or email is not found display an error message saying no such user found 
    else {
      header("Location: ../admin.php?error=nosuchuser");
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