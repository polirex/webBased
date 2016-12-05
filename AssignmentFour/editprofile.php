<?php
require_once 'database.php';
require_once 'vrfy.php';
?>
<html>
    <link rel="stylesheet" type="text/css" href="pStyles.css">

    <header>
        <ul class="topMenu">
            <li > <a  href="mainpage.php">Home</a></li>
            <li > <a  href="message.php">Message Board</a></li> 
        </ul>
    </header>
    <h1>Edit Profile</h1>
</html>


<?php
//Check if the user is logged in
if (isset($_SESSION['username']))
{
    $databaseConnection = new database();

//    $username = $_SESSION['username'];
//    echo $username;
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

    $email = checkIfSet('email');
    $phoneNumber = checkIfSet('phone');
    $city = checkIfSet('city');
    $state = checkIfSet('state');
    $country = checkIfSet('country');
    $bio = checkIfSet('bio');

    //Add input sanitization
    $emailTemp = $databaseConnection->mysql_entities_fix_string($email);
    $phoneTemp = $databaseConnection->mysql_entities_fix_string($phoneNumber);
    $cityTemp = strtoupper($databaseConnection->mysql_entities_fix_string($city));
    $countryTemp = strtoupper($databaseConnection->mysql_entities_fix_string($country));
    $stateTemp = strtoupper($databaseConnection->mysql_entities_fix_string($state));
    $bioTemp = $databaseConnection->mysql_entities_fix_string($bio);

    //Check if the users 
    $id = $_SESSION['id'];
    echo "<br><br>Id is: " . $id . "</br></br>";
    $query = "UPDATE PROFILE SET email = '$emailTemp', phone = '$phoneTemp', city = '$cityTemp', state = '$stateTemp', country = '$countryTemp',
            bio = '$bioTemp' WHERE id = $id";

    $result = $databaseConnection->query($query);
}

function checkIfSet($string)
{
    $temp = "";
    if (isset($_POST[$string]))
        $temp = $_POST[$string];
    return $temp;
}
?>