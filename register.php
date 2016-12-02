<!--// <?php
//session_start();


//?> -->

<html>

<head><title>Register</title>
  <link rel="stylesheet" type="text/css" href="pStyles.css">

</head>
<body>
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
              <br/>
              <label><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="password" required/>
              <br/>
              <label><b>Re-type Password</b></label>
              <input type="password" placeholder="Enter Password" name="rePassword" required/>
              <br/>
              <button type="submit">register</button>
            </div>
          </form>
        </body>

        </html>

        <?php
        $conn = mysqli_connect("earth.cs.utep.edu", "cs5339team8fa16", "cs5339!cs5339team8fa16", "cs5339team8fa16");
        if(!$conn) {
          die("Connection failed: ". mysqli_connect_error());
        }

        $FirstName = $_POST['fname'];
        $LastName = $_POST['lname'];
        $AcademicYr = $_POST['academicyr'];
        $major = $_POST['major'];
        $LevelCode = $_POST['lvlcode'];
        $degree = $_POST['degree'];

        $username = fix_string1($conn, $_POST['username']);
        $salt="qm&h";
        $password = $_POST['password'];
        $token=hash('ripemd160', $salt.$username.$password);


        $id = "SELECT id FROM csdegrees WHERE AcademicYear = '$AcademicYr' AND LastName = '$LastName' AND FirstName = '$FirstName'
        AND Major = '$major' AND LevelCode = '$LevelCode' AND Degree = '$degree'";
        $result = $conn->query($id);

        $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $result = $result['id'];
        //  if() {
        print_r($result);
        echo "user exists<br>";

        //  $id = "SELECT id FROM csdegrees WHERE AcademicYear = '$AcademicYr' AND LastName = '$LastName' AND FirstName = '$FirstName' AND
        //  Major = '$major' AND LevelCode = '$LevelCode' AND Degree = '$degree'";

        $duplicate = "SELECT * FROM USERS WHERE id = $result, username = '$username'";
      //  $dup = mysqli_query($conn, $duplicate);
        $dup = $conn -> query($duplicate);
        //if(!$dup) die("duplicate");


        if(!$dup) {
          $insert = "INSERT INTO USERS VALUE ($result, '$username', '$token')";
          $res2 = mysqli_query($conn, $insert);
      }
      else {
        echo "duplicate";
      }
        print_r($res2);
        //if(mysqli_query($conn, $insert))
        //echo "user created successfully";

        //    }
        //if(!$result || !$res2) {
          //echo "user not found or not created";
      //  }
        //echo "error with user: " . mysqli_error($conn)."<br>";
        //  exit();
        //
        //   //echo "<a href='login.php'>Click here</a> to login<br>";
        //   //echo "<a href='mainpage.php'>Click here</a> to go back to main page<br>";

        function fix_string1($conn, $string) {
          return htmlentities(fix_string2($conn, $string));
        }
        function fix_string2($conn, $string) {
          if(get_magic_quotes_gpc())
          $string=stripcslashes($string);
          return $conn->real_escape_string($string);
        }

        mysqli_close($conn);
        ?>
