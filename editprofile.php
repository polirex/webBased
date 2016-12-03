
<?php

session_start();



if($_SESSION['logged']) {

  $conn = mysqli_connect("earth.cs.utep.edu", "cs5339team8fa16", "cs5339!cs5339team8fa16", "cs5339team8fa16");
  if(!$conn) {
    die("Connection failed: ". mysqli_connect_error());
  }

  $username = $_SESSION['username'];

  echo $username;


  echo "<html>";
  echo "<form action = 'editprofile.php' method = 'POST'>";
  echo "<input type = 'text' name = 'email' placeholder = 'Enter email'/></br></br>";
  echo "<input type = 'text' name = 'phone' placeholder = 'Enter phone number'/></br></br>";
  echo "<input type = 'text' name = 'city' placeholder = 'Enter city'/></br></br>";
  echo "<input type = 'text' name = 'state' placeholder = 'Enter state'/></br></br>";
  echo "<input type = 'text' name = 'country' placeholder = 'Enter country'/></br></br>";
  echo "<input style='height:150px;font-size:12pt;width:800px;word-wrap: break-word;;' name='bio'  type='text' placeholder = 'Enter small bio'/></br></br>";
  echo "<input type = 'submit' name = 'submit'/></br></br>";


  echo "</form>";


  echo "</html>";

  $email = fix_string1($conn, $_POST['email']);
  if(!preg_match("/^.+@.+$/", $email)
  $phone = fix_string1($conn, $_POST['phone']);
  $city = fix_string1($conn, $_POST['city']);
  $state = fix_string1($conn, $_POST['state']);
  $country = fix_string1($conn, $_POST['country']);
  $bio = fix_string1($conn, $_POST['bio']);

  $id = "SELECT id FROM USERS WHERE username = '$username'";
  $result = $conn -> query($id);
  if(!$result) {
    die($conn -> error);
  }

  $result = $result -> fetch_array(MYSQLI_ASSOC);
  $result = $result['id'];
  if($result) {

    $query = "UPDATE PROFILE SET email = '$email', phone = '$phone', city = '$city', state = '$state', country = '$country',
      bio = '$bio' WHERE id = '$result'";
    $res = $conn -> query($query);

    if($res) {
      echo "insert successful";
    }

    if(!$res) {
      die($conn -> error);
    }
  }

  $conn -> close();


  function fix_string1($conn, $string) {
    return htmlentities(fix_string2($conn, $string));
  }
  function fix_string2($conn, $string) {
    if(get_magic_quotes_gpc())
    $string=stripcslashes($string);
    return $conn->real_escape_string($string);
  }



}



?>
