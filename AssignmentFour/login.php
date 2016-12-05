
<html>

    <head><title>Login</title>
        <link rel="stylesheet" type="text/css" href="pStyles.css">

    </head>
    <body>
        <div>
            <header>
                <ul class="topMenu">
                    <li > <a  href="index.php">Home</a></li>
                    <li > <a  href="register.php">Registration</a></li>
                </ul>
            </header>
        </div>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>

        <div align="center">
            <form class="log" action="login.php" method="POST">
                <div >
                    <label><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="username" required></input>
                    <br/>
                    <label><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" required></input>
                    <br/>
                    <input type="submit"></input>
                </div>
            </form>
        </div>
    </body>
</html>
<?php
require_once 'database.php';
require_once 'vrfy.php';

session_start();
$databaseLogin = new Database();


$username = false;
$password = false;
$passwordHash = "";

if (isset($_POST['username']))
    $username = $_POST['username'];

if (isset($_POST['password']))
    $password = $_POST['password'];


if (isset($_POST['username']) && isset($_POST['password']))
{
    $usernameTemp = $databaseLogin->mysql_entities_fix_string($username);
    $passwordTemp = $databaseLogin->mysql_entities_fix_string($password);

    $query = "SELECT * FROM USERS WHERE username ='$usernameTemp'";

    $result = $databaseLogin->returnQuery($query);

    //A result was found for the query, meaning the user is already registered.
    if ($result->num_rows > 0)
    {
        $salt = "qm&h";
        $token = hash('ripemd160', $salt . $usernameTemp . $passwordTemp);

        $row = mysqli_fetch_assoc($databaseLogin->returnQuery($query));

        $result->close();

        if ($token == $row['password'])
        {

            $_SESSION['username'] = $usernameTemp;
            $_SESSION['password'] = $passwordTemp;
            $_SESSION['id'] = $row['id'];
            header("location:editprofile.php");
        }
    } else
    {
        die("<p> Invalid username or password click <a href='login.php'> here</a> to log in again</p>");
    }
}

$databaseLogin->closeConnection();
