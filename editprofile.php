


<?php

session_start();

if($_SESSION['logged']) {
  $username = $_SESSION['username'];

  echo $username;


  echo "<html>";
  echo "<form action = 'editprofile.php' method = 'POST'>";
    echo "<input type = 'text' name = 'email' placeholder = 'Enter email'/></br>";
    echo "<input type = 'text' name = 'phone' placeholder = 'Enter phone number'/></br>";
    echo "<input type = 'text' name = 'city' placeholder = 'Enter city'/></br>";
    echo "<input type = 'text' name = 'state' placeholder = 'Enter state'/></br>";
    echo "<input type = 'text' name = 'country' placeholder = 'Enter country'/></br>";
    echo "<input type = 'text' name = 'bio' placeholder = 'Enter small bio'/></br>";

  echo "</form>";


  echo "</html>";





}



?>
