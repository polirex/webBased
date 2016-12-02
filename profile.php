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


if($_SESSION['logged']) {
  $username = $_SESSION['username'];
  echo "<h1>Welcome " . $username . "</h1></br>";


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

      echo "Name: " . $row['FirstName'] . " " . $row['LastName'] . "</br>";
      echo "Your academic year: " . $row['AcademicYear'] . "</br>";
      echo "Your Term: " . $row['Term']. "</br>";
      echo "Major: " . $row['Major']. "</br>";
      echo "Level Code: " . $row['LevelCode']. "</br>";
      echo "Degree: " . $row['Degree']. "</br>";
    }
  }

  $messages = "SELECT message, msgnum FROM BOARD WHERE username = '$username'";
  $retrieve = $conn -> query($messages);
  echo "<h3> Your posted messages are: </h3>";
  //echo ""
  if($retrieve) {
    while($row2 = $retrieve -> fetch_assoc()){
      echo "<form action = 'profile.php' method = 'POST'>";
      $msgnum = $row2['msgnum'];
      echo $username . " posted: " . $row2['message'] . " " . "<input type = 'checkbox' name = 'delete'
      value = $msgnum/></br>";
    }
    echo "<input type = 'submit' name = 'submit' value = 'Delete'></input>";
    echo "</form>";




    if(isset($_POST['submit'])) {
      // echo "test";
      // echo $_POST['delete'];
      // echo "test2";
      if(!empty($_POST['delete'])) {
        $delete = $_POST['delete'];
        //foreach($_POST['delete'] as $value) {
          //print_r($delete);
          $deletequery = "DELETE FROM BOARD WHERE msgnum = '$delete'";
          $del = $conn -> query($deletequery);
          if($del) {
            echo "</br>success</br>";
          }
          else {
            echo $del = $conn -> error;
          }
        //}
      }
      header('Location' . 'profile.php');
    }




  }






  $conn -> close();

  echo "</br><a href = 'logout.php'>Logout</a>";
  echo "</br><a href = 'index.php'> Home </a>";
  echo "</br><a href = 'message.php'>Click here</a> to go to message board";
}

else {
  echo "You may not view this page";
}


?>
