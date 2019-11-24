<?php

//php script that runs when a user/admin clicks the log out button
//it signs them out
session_start();
session_unset();
//deletes all the session variables
session_destroy();
//sends the user back to the index page after clicking log out
header("Location: ../index.php");

?>