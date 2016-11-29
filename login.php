<?php
session_start();


 ?>



<html>

<head><title>Main page</title>
  <link rel="stylesheet" type="text/css" href="pStyles.css">

</head>
<body>
  <div>
  <header>
  <ul class="topMenu">
    <li > <a  href="index.php">Main page</a></li>
    <li > <a  href="login.php">login</a></li>
    <li > <a  href="registar.php">Registration</a></li>
  </ul>
</header>
</div>
<br/>
<br/>
<br/>
<br/>
<br/>
<div align="center">
  <form class="log" action="loginlogic">
    <div >
      <label><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>
      <br/>
      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
      <br/>
      <button type="submit" >Login</button>
    </div>
  </form>
</div>
</body>

</html>
