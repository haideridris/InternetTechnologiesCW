<?php

//If the user has pressed the submit button on the feedback form on contactus.php the code inside if block will run
if(isset($_POST['submit'])){

  //Store the users inputs as local variables
  $name = $_POST['name'];
  $subject = $_POST['subject'];
  $mailFrom = $_POST['mail'];
  $message = $_POST['message'];

  //The email address the user feedback email will be sent to
  $mailTo = "hraoof@bradford.ac.uk";
  //Who the mail is from
  $headers = "From: ".$mailFrom;
  //Custom message in the email
  $txt = "You have recieved an email from ".$name.".\n\n".$message;

  //php method that sends an email
  mail($mailTo, $subject, $txt, $headers);
  //display a message in url to show feedback has been sent as an email
  header("Location: ../contactus.php?mailsent");
}

?>