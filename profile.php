<html>
<title>Profile</title>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="pStyles.css">

</head>

</html>

<?php

session_start();
session_regenerate_id(true);

$username = $_SESSION['username'];
$logged = $_SESSION['logged'];

if($logged==1) {
  echo "hello";


  $conn = mysqli_connect("earth.cs.utep.edu", "cs5339team8fa16", "cs5339!cs5339team8fa16", "cs5339team8fa16");
  if(!$conn) {
    die("Connection failed: ". mysqli_connect_error());
  }

  $id = "SELECT id FROM USERS WHERE username = '$username'";
  $result = $conn -> query($id);
  $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $result = $result['id'];
  if(!$result) die ($conn->error);

  $info = "SELECT * FROM csdegrees WHERE id = '$result'";
  $result2 = $conn -> query($info);

  if(!$result2) die ($conn->error);

  if($result2) {

    while($row = $result2->fetch_assoc()){

      echo $row['AcademicYear'] . "</br>";
      echo $row['Term']. "</br>";
      echo $row['FirstName']. "</br>";
      echo $row['LastName']. "</br>";
      echo $row['Major']. "</br>";
      echo $row['LevelCode']. "</br>";
      echo $row['Degree']. "</br>";
    }
  }

  $messages = "SELECT message FROM BOARD WHERE username = '$username'";
  $retrieve = $conn -> query($messages);
  if($retrieve) {
    while($row2 = $retrieve -> fetch_assoc()){
      echo $username . " posted: " . $row2['message'] . "</br>";
    }
  }

  $conn -> close();

  echo "</br><a href = 'logout.php'>Logout</a>";
  echo "</br><a href = 'message.php'>Click here</a> to go to message board";
}

else {
  echo "You may not view this page";
}


?>
