<?php
require_once 'database.php';
session_start();
?>
<html>

    <head><title>Register</title>
        <link rel="stylesheet" type="text/css" href="pStyles.css">

    <body>
        <header>
            <ul class="topMenu">
                <li > <a  href="mainpage.php">Home</a></li>
                <li > <a  href="login.php">Login</a></li>
                <!-- <li > <a  href="register.php">Registration</a></li> -->
                <li > <a  href="message.php">Message Board</a></li>
            </ul>
        </header>
    </body>

</head>
<body>
    <h1>Registration</h1>
    <form class="reg" action="register.php" method="POST">
        <div>
            <label><b>First name</b></label>
            <input type="text" placeholder="First name" name="fname" required/>
            <label><b>Last name</b></label>
            <input type="text" placeholder="Last name" name="lname" required/>
            <br/><br/>
            <label><b>Major</label>
            <select name = "major">
                <option value = "CS">CS</option>
                <option value = "CSCI">CSCI</option>
                <option value = "MIT">MIT</option>
                <option value = "IT">IT</option>
                <option value = "SWE">SWE</option>
            </select>
            <br/><br/>
            <label><b>Degree</label>
            <select name = "degree">
                <option value = "BSCS">BSCS</option>
                <option value = "MS">MS</option>
                <option value = "MSIT">MSIT</option>
                <option value = "PHD">PHD</option>
                <option value = "MSIT">MIST</option>
            </select>
            <br/><br/>
            <label><b>Level Code</label>
            <select name = "lvlcode">
                <option value = "DR">DR</option>
                <option value = "UG">UG</option>
                <option value = "GR">GR</option>
            </select>
            <br/><br/>
            <label><b>Academic Year</label>
            <select name = "academicyr">
                <option value = "1995-96">1995-1996</option>
                <option value = "1996-97">1996-1997</option>
                <option value = "1997-98">1997-1998</option>
                <option value = "1998-99">1998-1999</option>
                <option value = "1999-00">1999-2000</option>
                <option value = "2000-01">2000-2001</option>
                <option value = "2001-02">2001-2002</option>
                <option value = "2002-03">2002-2003</option>
                <option value = "2003-04">2003-2004</option>
                <option value = "2004-05">2004-2005</option>
                <option value = "2005-06">2005-2006</option>
                <option value = "2006-07">2006-2007</option>
                <option value = "2007-08">2007-2008</option>
                <option value = "2008-09">2008-2009</option>
                <option value = "2009-10">2009-2010</option>
                <option value = "2010-11">2010-2011</option>
                <option value = "2011-12">2011-2012</option>
                <option value = "2012-13">2012-2013</option>
                <option value = "2013-14">2013-2014</option>
                <option value = "2014-15">2014-2015</option>
            </select>
            <br/><br/>
            <label><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required/>
            <br/><br/>
            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required/>
            <br/><br/>
            <label><b>Re-type Password</b></label>
            <input type="password" placeholder="Enter Password" name="rePassword" required/>
            <br/><br/>
            <button type="submit">register</button>
        </div>
    </form>
</body>

</html>

<?php
$databaseConnection = new database();

$firstName = checkIfSet('fname');
$lastName = checkIfSet('lname');
$academicYr = checkIfSet('academicyr');
$major = checkIfSet('major');
$levelCode = checkIfSet('lvlcode');
$degree = checkIfSet('degree');
$username = checkIfSet('username');
$password = checkIfSet('password');


//Add input sanitization
$firstNameTemp = ucfirst($databaseConnection->mysql_entities_fix_string($firstName));
$lastNameTemp = ucfirst($databaseConnection->mysql_entities_fix_string($lastName));
$academicYrTemp = $databaseConnection->mysql_entities_fix_string($academicYr);
$majorTemp = strtoupper($databaseConnection->mysql_entities_fix_string($major));
$levelCodeTemp = strtoupper($databaseConnection->mysql_entities_fix_string($levelCode));
$degreeTemp = strtoupper($databaseConnection->mysql_entities_fix_string($degree));
$usernameTemp = $databaseConnection->mysql_entities_fix_string($username);
$passwordTemp = $databaseConnection->mysql_entities_fix_string($password);

echo $firstNameTemp . "</br>";
echo $lastNameTemp . "</br>";
echo $academicYrTemp . "</br>";
echo $majorTemp . "</br>";
echo $levelCodeTemp . "</br>";
echo $degreeTemp . "</br>";
echo $usernameTemp . "</br>";
echo $passwordTemp . "</br>";

$query = "SELECT id FROM csdegrees WHERE AcademicYear = '$academicYrTemp' AND LastName = '$lastNameTemp' AND FirstName = '$firstNameTemp' AND Major = '$majorTemp' AND LevelCode = '$levelCodeTemp' AND Degree = '$degreeTemp'";
$result = $databaseConnection->query($query);
$row = mysqli_fetch_assoc($databaseConnection->returnQuery($query));

//Check that every piece of information matches the database with all of the graduates information
if ($result)
{
    $id = $row['id'];

    echo "THIS IS THE ID " . $row['id'];
    $duplicate = "SELECT * FROM USERS WHERE id = $id AND username = '$usernameTemp'";

    $result2 = $databaseConnection->query($duplicate);

    //If the user is already registered
    if ($result2)
    {
        die("<p> The user is already registered, please <a href='login.php'>click here to log in</a></p>");
    } else
    {
        //If all data matches and the user is not already registered, then they may register
        $salt = "qm&h";
        $token = hash('ripemd160', $salt . $usernameTemp . $passwordTemp);

        $_SESSION['username'] = $usernameTemp;
        $_SESSION['id'] = $id;

        $insertUserQuery = "INSERT INTO USERS (id, username, password) VALUES ($id, '$usernameTemp', '$token')";
        $createProfileQuery = "INSERT INTO PROFILE (id) VALUES ($id)";
        //Adds the user into the database
        $insertUser = $databaseConnection->query($insertUserQuery);
        //Create a user profile with empty information
        $createProfile = $databaseConnection->query($createProfileQuery);
        
        header("location:editprofile.php");
    }
} else
{
    if (checkForAll('fname', 'lname', 'username', 'password'))
        die("<p> The data does not match our records, please check the information</a></p>");
//        header("location:register.php");
}

function checkIfSet($string)
{
    $temp = "";
    if (isset($_POST[$string]))
        $temp = $_POST[$string];
    return $temp;
}

function checkForAll($s1, $s2, $s3, $s4)
{
    if ((isset($_POST[$s1])) && (isset($_POST[$s2])) && (isset($_POST[$s3])) && (isset($_POST[$s4])))
        return true;
    else
    {
        return false;
    }
}
?>