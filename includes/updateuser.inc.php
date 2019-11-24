<?php
//Check to see if this php script has run because of the user clicking the update button on the Update User form and not by typing in the url for this webpage
if (isset($_POST['updateuser-submit'])) {
  //Now we have access to our database using the variable $conn found within the dbh.inc.php file
  require 'dbh.inc.php';

  //Assign values provided by the user attained via the $_POST method to these five variables
  $useridnumber = $_POST['uidnumber'];
  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $adminlevel = $_POST['userlevel'];

  //Error handler to check if the user has input a user id number for the user record they want to update
  if (empty($useridnumber)) {
    header("Location: ../admin.php?error=emptyupdateuseridnumberfield");
    exit();   
  }
  else {
  //Check if the user id number the admin typed is valid and found in the users table
	$query = "SELECT * FROM users WHERE idUsers = '$useridnumber'";
  $result = mysqli_query($conn, $query);
  $resultCheck = mysqli_num_rows($result);
  	if ($resultCheck > 0){
    //Update username, email, password and admin level
 	    if(!empty($username) & !empty($email) & !empty($password) & !empty($adminlevel)){
  	    $query = "UPDATE `users` SET `uidUsers`= '$username', `emailUsers` = '$email', `pwdUsers` = '$password', `userLevel` = '$adminlevel' WHERE `idUsers` = '$useridnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updatesuccess");
        exit();
  	  }
  	  //Update the username, email and password only
  	  else if(!empty($username) & !empty($email) & !empty($password)){
  	    $query = "UPDATE `users` SET `uidUsers`= '$username', `emailUsers` = '$email', `pwdUsers` = '$password' WHERE `idUsers` = '$useridnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updatesuccess");
        exit();
  	  }
  	  //Update the username, email and admin only
  	  else if(!empty($username) & !empty($email) & !empty($adminlevel)){
  	    $query = "UPDATE `users` SET `uidUsers`= '$username', `emailUsers` = '$email', `userLevel` = '$adminlevel' WHERE `idUsers` = '$useridnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updatesuccess");
        exit();
  	  }
  	  //update username, password and admin only
  	  else if(!empty($username) & !empty($password) & !empty($adminlevel)){
  	    $query = "UPDATE `users` SET `uidUsers`= '$username', `pwdUsers` = '$password', `userLevel` = '$adminlevel' WHERE `idUsers` = '$useridnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updatesuccess");
        exit();
  	  }
  	  //Update the email, password and admin only
 	    else if(!empty($email) & !empty($password) & !empty($adminlevel)){
  	    $query = "UPDATE `users` SET `emailUsers` = '$email', `pwdUsers` = '$password', `userLevel` = '$adminlevel' WHERE `idUsers` = '$useridnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updatesuccess");
        exit();
  	  }
  	  //Update username and email
  	  else if(!empty($username) & !empty($email)){
  	    $query = "UPDATE `users` SET `uidUsers`= '$username', `emailUsers` = '$email' WHERE `idUsers` = '$useridnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updatesuccess");
        exit();
  	  }
  	  //Update username and password
  	  else if(!empty($username) & !empty($password)){
  	    $query = "UPDATE `users` SET `uidUsers`= '$username', `pwdUsers` = '$password' WHERE `idUsers` = '$useridnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updatesuccess");
        exit();
  	  }
  	  //Update username and admin level
  	  else if(!empty($username) & !empty($adminlevel)){
  	    $query = "UPDATE `users` SET `uidUsers`= '$username', `userLevel` = '$adminlevel' WHERE `idUsers` = '$useridnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updatesuccess");
        exit();
  	  }	
  	  //Update email and password
  	  else if(!empty($email) & !empty($password)){
  	    $query = "UPDATE `users` SET `emailUsers` = '$email', `pwdUsers` = '$password' WHERE `idUsers` = '$useridnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updatesuccess");
        exit();
  	  }  
  	  //Update email and admin
  	  else if(!empty($email) & !empty($adminlevel)){
  	    $query = "UPDATE `users` SET `emailUsers` = '$email', `userLevel` = '$adminlevel' WHERE `idUsers` = '$useridnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updatesuccess");
        exit();
  	  }	
  	  //Update pass and email
  	  else if(!empty($password) & !empty($adminlevel)){
  	    $query = "UPDATE `users` SET `pwdUsers` = '$password', `userLevel` = '$adminlevel' WHERE `idUsers` = '$useridnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updatesuccess");
        exit();
  	  }
  	  //Update the username only
  	  else if(!empty($username)){
  	    $query = "UPDATE `users` SET `uidUsers`= '$username' WHERE `idUsers` = '$useridnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updatesuccess");
        exit();
  	  }
  	  //Update the email only
  	  else if(!empty($email)){
  	  $query = "UPDATE `users` SET `emailUsers`= '$email' WHERE `idUsers` = '$useridnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updatesuccess");
        exit();
  	  }
  	  //update password only
  	  else if(!empty($password)){
  	    $query = "UPDATE `users` SET `pwdUsers`= '$password' WHERE `idUsers` = '$useridnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updatesuccess");
        exit();
  	  }
  	  //update admin level
      else if(!empty($adminlevel)){
  	    $query = "UPDATE `users` SET `userLevel`= '$adminlevel' WHERE `idUsers` = '$useridnumber'";
        $result = mysqli_query($conn, $query);
        header("Location: ../admin.php?success=updatesuccess");
        exit();
      }
    //Error handler for when the user id and it's associated fields are not found in the users table
    } else {
      header("Location: ../admin.php?error=nosuchuserid");
      exit();
    } 
  }
}
// If the user tries to run this php script by typing its url they're sent back to the admin page instead
else{
  header("Location: ../admin.php");
  exit();
}
?>