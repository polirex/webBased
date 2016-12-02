<?php
session_start();


?>



<html>

<head><title>Login</title>
  <link rel="stylesheet" type="text/css" href="pStyles.css">

</head>
<body>
  <div>
  <header>
  <ul class="topMenu">
    <li > <a  href="index.php">Main page</a></li>
    <li > <a  href="login.php">login</a></li>
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
  <form class="log" action="vrfy.php" method="POST">
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
