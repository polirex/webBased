<html>
<!-- Here we display the content of the mainpage of the webpage -->
	<head><title>Main page</title>
		<link rel="stylesheet" type="text/css" href="pStyles.css">
	</head>

	<body>
		<header>
		<ul class="topMenu">
			<li > <a  href="mainpage.php">Home</a></li>
			<li > <a  href="login.php">Login</a></li>
			<li > <a  href="register.php">Registration</a></li>
		</ul>
                </header>
            
            <table width="70%" cellpadding="5" cellspace="5">
    
        <tr>
            <td><strong>Academic Year</strong></td>
            <td><strong>Term</strong></td>
            <td><strong>Last Name</strong></td>
            <td><strong>First Name</strong></td>
            <td><strong>Major</strong></td>
            <td><strong>Level Code</strong></td>
            <td><strong>Degree</strong></td>
        </tr>
	</body>

</html>

<?php
     //        echo "<br> <ul>Last name: " . $row['LastName'] . "</ul>";

require_once 'database.php';

$databaseConnection = new Database();

$query = "SELECT * FROM `csdegrees` WHERE `AcademicYear` = '2014-15'";

//$query = "SELECT * FROM `csdegrees` WHERE `FirstName`='$username' AND `LastName`='$lastname'";

//$result = $databaseConnection->query($query);
$result = $databaseConnection->returnQuery($query);


//I am currently testing this
if ($result->num_rows > 0)           
{
    while($row = $result->fetch_assoc())
    {?>
        <tr>
                <td><?php echo $row['AcademicYear'];?></td>
                <td><?php echo $row['Term'];?></td>
                <td><?php echo $row['LastName'];?></td>
                <td><?php echo $row['FirstName'];?></td>
                <td><?php echo $row['Major'];?></td>
                <td><?php echo $row['LevelCode'];?></td>
                <td><?php echo $row['Degree'];?></td>
        </tr>
        <?php 
     } 
}?>
</table>
