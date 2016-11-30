<?php
session_start();


 ?>

 <html>

 <head><title>Main page</title>
   <link rel="stylesheet" type="text/css" href="pStyles.css">

 </head>
 <body>
   <form class="reg" action="register.php" method="POST">
     <div >
       <label><b>First name</b></label>
       <input type="text" placeholder="First name" name="fname" required>
       <label><b>Last name</b></label>
       <input type="text" placeholder="Last name" name="lname" required>
       <br/>
       <label><b>Username</b></label>
       <input type="text" placeholder="Enter Username" name="username" required>
       <br/>
       <label><b>Password</b></label>
       <input type="password" placeholder="Enter Password" name="password" required>
       <br/>
       <label><b>Re-type Password</b></label>
       <input type="password" placeholder="Enter Password" name="rePassword" required>
       <br/>
       <button type="submit">register</button>
     </div>
   </form>
 </body>

 </html>

 <?php
 $conn = mysqli_connect("localhost", "root", "");
 if(!$conn) {
   die("Connection failed: ". mysqli_connect_error());
 }

$_SESSION['fname'] = $_POST['fname'];
$_SESSION['lname'] = $_POST['lname'];
$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];


$username = fix_string1($conn, $_POST['username']);
$salt="qm&h";
$password = $_POST['password'];
$token=hash('ripemd160', $salt.$username.$password);


$query = "INSERT INTO USERS VALUES('$username', '$token','u')";
if(mysqli_query($conn, $query)!=0 && $password!=null) {
  echo "user created<br>"; }
else {
  echo "error creating user: " . mysqli_error($conn)."<br>";
}

mysqli_close($conn);
echo "<a href='login.php'>Click here</a> to login<br>";
echo "<a href='mainpage.php'>Click here</a> to go back to main page<br>";

function fix_string1($conn, $string) {
return htmlentities(fix_string2($conn, $string));
}
function fix_string2($conn, $string) {
if(get_magic_quotes_gpc())
  $string=stripcslashes($string);
return $conn->real_escape_string($string);
}
?>



?>
