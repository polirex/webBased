<html>
    <!-- Here we display the content of the mainpage of the webpage -->
    <head><title>Main page</title>
        <link rel="stylesheet" type="text/css" href="pStyles.css">
        
        <!-- 
        This JavaScript file was retrieved from this website: http://www.kryogenix.org/code/browser/sorttable/
        This Java Script is in charge of ordering the list on ascending and descending order.
        -->
        <script src="sorttable.js"></script>
    </head>

    <body>
        <header>
            <ul class="topMenu">
                <li > <a  href="mainpage.php">Home</a></li>
                <li > <a  href="login.php">Login</a></li>
                <li > <a  href="register.php">Registration</a></li>
            </ul>
        </header>
        <br/><br/>

        <label><b>Academic Year</b></label>
        <form action="mainpage.php" method="GET">
            <select name = "AcademicYear">
                <option value="1995-96">1995-1996</option>
                <option value="1996-97">1996-1997</option>
                <option value="1997-98">1997-1998</option>
                <option value="1998-99">1998-1999</option>
                <option value="1999-00">1999-2000</option>
                <option value="2000-01">2000-2001</option>
                <option value="2001-02">2001-2002</option>
                <option value="2002-03">2002-2003</option>
                <option value="2003-04">2003-2004</option>
                <option value="2004-05">2004-2005</option>
                <option value="2005-06">2005-2006</option>
                <option value="2006-07">2006-2007</option>
                <option value="2007-08">2007-2008</option>
                <option value="2008-09">2008-2009</option>
                <option value="2009-10">2009-2010</option>
                <option value="2010-11">2010-2011</option>
                <option value="2011-12">2011-2012</option>
                <option value="2012-13">2012-2013</option>
                <option value="2013-14">2013-2014</option>
                <option value="2014-15">2014-2015</option>
            </select>
            <input type="submit" value='Filter'>
        </form>

        <label><b>Major</b></label>
        <form action="mainpage.php" method="GET">
            <input type="radio" name="Major" value="CS" checked>CS<br>
            <input type="radio" name="Major" value="CSCI">CSCI<br>
            <input type="radio" name="Major" value="MIT">MIT<br>
            <input type="radio" name="Major" value="IT">IT<br>
            <input type="radio" name="Major" value="SWE">SWE<br>
            <input type="submit" value='Filter'>
        </form>

        <label><b>Level Code</b></label>
        <form action="mainpage.php" method="GET">
            <select name = "Lvlcode">
                <option value = "DR">DR</option>
                <option value = "UG">UG</option>
                <option value = "GR">GR</option>
            </select>
            <input type="submit" value='Filter'>
        </form>

        <label><b>Degree</b></label>
        <form action="mainpage.php" method="GET">
            <select name = "Degree">
                <option value = "BSCS">BSCS</option>
                <option value = "MS">MS</option>
                <option value = "MSIT">MSIT</option>
                <option value = "PHD">PHD</option>
                <option value = "MSIT">MIST</option>
            </select>
            <input type="submit" value='Filter'>
        </form>

        <table width="70%" cellpadding="5" cellspace="5" class="sortable">
            <tr>
                <td><strong>Academic Year</strong></td>
                <td><strong>Term</strong></td>
                <td><strong>Last Name</strong></td>
                <td><strong>First Name</strong></td>
                <td><strong>Major</strong></td>
                <td><strong>Level Code</strong></td>
                <td><strong>Degree</strong></td>
            </tr>

            <?php
            require_once 'database.php';
            $databaseConnection = new Database();

            if (isset($_GET['AcademicYear']))
            {
                $academicYear = $_GET['AcademicYear'];
                //sanitize get value
                $academicYearTemp = $databaseConnection->mysql_entities_fix_string($academicYear);
                $query = "SELECT * FROM `csdegrees` WHERE `AcademicYear`='$academicYearTemp'";
                enterQuery($databaseConnection, $query);
            }


            if (isset($_GET['Major']))
            {
                $major = $_GET['Major'];
                //sanitize get value
                $majorTemp = $databaseConnection->mysql_entities_fix_string($major);
                $query = "SELECT * FROM `csdegrees` WHERE `Major`='$majorTemp'";
                enterQuery($databaseConnection, $query);
            }

            if (isset($_GET['Lvlcode']))
            {
                $levelCode = $_GET['Lvlcode'];
                //sanitize get value
                $levelCodeTemp = $databaseConnection->mysql_entities_fix_string($levelCode);
                $query = "SELECT * FROM `csdegrees` WHERE `LevelCode`='$levelCodeTemp'";
                enterQuery($databaseConnection, $query);
            }

            if (isset($_GET['Degree']))
            {
                $degree = $_GET['Degree'];
                //sanitize get value
                $degreeTemp = $databaseConnection->mysql_entities_fix_string($degree);
                $query = "SELECT * FROM `csdegrees` WHERE `Degree`='$degreeTemp'";
                enterQuery($databaseConnection, $query);
            }

            function enterQuery($conn, $query)
            {
                $result = $conn->returnQuery($query);

                if ($result->num_rows > 0)
                {
                    while ($row = $result->fetch_assoc())
                    {
                        ?>
                        <tr>
                            <td><?php echo $row['AcademicYear']; ?></td>
                            <td><?php echo $row['Term']; ?></td>
                            <td><?php echo $row['LastName']; ?></td>
                            <td><?php echo $row['FirstName']; ?></td>
                            <td><?php echo $row['Major']; ?></td>
                            <td><?php echo $row['LevelCode']; ?></td>
                            <td><?php echo $row['Degree']; ?></td>
                        </tr>
                        <?php
                    }
                }
            }
            ?>
        </table>

    </body>

</html>