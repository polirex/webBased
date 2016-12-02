<div style="text-align:center;">
  <h1>Message Board</h1>
</div>
<form action="message.php" method="POST">
  <div style="position: absolute; bottom: 5px;text-align:center;">

    <!--<label>Name :</label>
    <input id="name" name="name"  type="text">
  -->
  <br>
  <br>
  <label>Message :</label>
  <input style="height:150px;font-size:12pt;width:800px;word-wrap: break-word;;" id="message" name="message"  type="text"><!--Should make the txt box for msg bigger -->
  <br>
  <br>
  <input name="submit" type="submit" value="submit">
</div>
<td style="height:50px;width:50px"align='right'>
  <div style="height:50%;width:50%; overflow-y:scroll;text-align:left;"> <!--Should make the messages scrollable -->
  </form>
  <?php
  session_start();
  /*
  * Still need to access session and table in order to display username
  * with the message
  */
  //was connected to my local host

  if($_SESSION['logged']) {

    $host='earth.cs.utep.edu';
    $user='cs5339team8fa16';
    $password='cs5339!cs5339team8fa16';

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
      $ms=$_POST['message'];
      $query="INSERT INTO BOARD (username, message) VALUES ('$username','$ms')";
      $result2 = $connection -> query($query);

      if($result2){
        echo "message submitted</br>";
        //or maybe start session and go to user
        $connection -> close();
        header('Location' . 'message.php');
      }
      else{
        echo "message rejected</br>";
        $connection -> close();
      }
    }
    echo "<a href = 'logout.php'>Click here</a> to log out";
    echo "<a href = 'profile.php'>Click here</a> to go back to profile</br>";
  }

  else {
    echo "you may not enter messages</br>";
    echo "<a href = 'login.php'>Click here</a> to log in</br>";
    echo "<a href = 'register.php'>Click here</a> to register</br>";
  }

  ?>
