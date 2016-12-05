<?php
require_once 'database.php';

session_start();
$databaseSession = new database();

$checkUsername = "";
$checkID = "";

if (isset($_SESSION['username']))
    $checkUsername = $_SESSION['username'];


$usernameTemp = $databaseSession->mysql_entities_fix_string($checkUsername);

$query = "SELECT `username`, `password` FROM `USERS` WHERE `username`= '$usernameTemp'";

//$row = mysqli_fetch_assoc($databaseSession->returnQuery($query));

if ((!isset($_SESSION['username'])))
{
    $databaseSession->closeConnection();
    session_destroy();
    echo "<br>You are not logged in.</br></br>";
//    die("<p>You need to be logged in to access this page <a href='login.php'>click here</a> to log in.</p>");
} else
{
    
//    $logged = $_SESSION['logged'] = true;
    echo "<br>Hello " . $_SESSION['username'] . ". You are currently logged in.";
    echo "</br><a href = 'logout.php'>Log out</a></br></br>";
        
}

?>