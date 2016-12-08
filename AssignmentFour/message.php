<div style="text-align:center;">
  <title>Message Board</title>
  <h1>Message Board</h1>
</div>

<body>
  <header>
  <ul class="topMenu">
    <li > <a  href="mainpage.php">Home</a></li>
    <li > <a  href="login.php">Login</a></li>
    <li > <a  href="register.php">Registration</a></li>
    <!-- <li > <a  href="message.php">Message Board</a></li> -->
  </ul>
</header>
</body>

<form action="message.php" method="POST">
  <div style="position: absolute; bottom: 5px;text-align:center;">
    <link rel="stylesheet" type="text/css" href="pStyles.css">

    <!--<label>Name :</label>
    <input id="name" name="name"  type="text">
  -->
  <br>
  <br>
  <label>Message :</label>
  <input style="height:45px;font-size:12pt;width:800px;word-wrap: break-word;;" id="message" name="message"  type="text"><!--Should make the txt box for msg bigger -->
  <br>
  <br>
  <input name="submit" type="submit" value="submit">
</div>
<td style="height:50px;width:50px"align='right'>
  <div style="height:40%;width:50%; overflow-y:scroll;text-align:left;"</br></br> <!--Should make the messages scrollable -->
  </form>
  <?php
  require_once 'vrfy.php';
  //session_start();
  /*
  * Still need to access session and table in order to display username
  * with the message
  */
  //was connected to my local host
  if($_SESSION['username']) {
    $host='earth.cs.utep.edu';
    $user='cs5339team8fa16';
    $password='cs5339!cs5339team8fa16';
    //leep(3);
    $connection = mysqli_connect($host, $user, $password, "cs5339team8fa16");
    if(!$connection){
      die('Could not connect: '. mysql_error());
    }
    
    //mysql_select_db($database, $connection);
    $username = $_SESSION['username'];
    $ms;
    ///////////////////displays all messages
    $qry="SELECT * FROM BOARD";
    $result = $connection -> query($qry);
    //I still might add to this message to display the max msg length that can be stored in the table
    echo "Welcome to the alumni message board, please be courteous and respectful";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    if($result){
      while($row = $result -> fetch_assoc()) {
        echo $row['username'] . " posted: " . $row['message'];
        echo "<br>";
      }
    }
    echo "</div>";
    echo "</td>";
    if(isset($_POST['submit'])){//if a message has been submitted
      //$name="user"; // I had just hardcoded for testing but need to obtain user from table
      $ms=fix_string2($connection, $_POST['message']);
      $query="INSERT INTO BOARD (username, message) VALUES ('$username','$ms')";
      $result2 = $connection -> query($query);
      if(!$result2){
        echo "</br></br>message submitted</br>";
        mysqli_close($connection);
       
        header('Location' . 'message.php');//header('Location' . 'message.php');
      }
      elseif(!$result2){
        echo "</br></br>message rejected</br>";
        echo $connection -> error;
      }



    }
   echo "<a href = 'message.php'>Refresh Messages</a>";//</br>";
   // echo "<a href = 'profile.php'>Click here</a> to go back to profile</br>";//</br></br>

  }
  else {
    echo "you may not enter messages</br>";
    echo "<a href = 'login.php'>Click here</a> to log in</br>";
    echo "<a href = 'register.php'>Click here</a> to register</br>";
  }



  function fix_string1($conn, $string) {
    return htmlentities(fix_string2($conn, $string));
  }
  function fix_string2($conn, $string) {
    if(get_magic_quotes_gpc())
    $string=stripcslashes($string);
    return $conn->real_escape_string($string);
  }


  ?>
