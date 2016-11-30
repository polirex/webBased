<?php
session_start();
session_regenerate_id(true);

$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];


$conn = mysqli_connect("localhost", "root", "");
if(!$conn) {
  die("Connection failed: ". mysqli_connect_error());
}
$username = mysqli_real_escape_string($conn, $_SESSION['username']);
$password = $_SESSION['password'];
$salt="qm&h";


$token=hash('ripemd160', $salt.$username.$password);

if(isset($username) && isset($password)) {
  $result = mysqli_query($conn, "SELECT username, password FROM USERS WHERE username= '$username' AND password= '$token'");

  // if($result === FALSE) {
  //   echo "aheongae";
  //   die(mysql_error());
  // }
  while($row=mysqli_fetch_array($result)) {
    echo ";j;oiaher";
    header('Location: '.'index.php');
  }

  if($username=="admin" && $password=="nimda339") {
    header('Location: ' . 'register.php');
  }
  else {
    exit('<h2> Cannot access </h2>');
  }

}
else {
  echo "fail";
}


?>
