<?php
session_start();
 ?>



 <html>

 <head><title>Main page</title>
   <link rel="stylesheet" type="text/css" href="pStyles.css">

 </head>
 <body>
   <form class="reg">
     <div >
       <label><b>First name</b></label>
       <input type="text" placeholder="First name" name="fname" required>
       <label><b>Last name</b></label>
       <input type="text" placeholder="Last name" name="lname" required>
       <br/>
       <label><b>Username</b></label>
       <input type="text" placeholder="Enter Username" name="uname" required>
       <br/>
       <label><b>Password</b></label>
       <input type="password" placeholder="Enter Password" name="psw" required>
       <br/>
       <label><b>Re-type Password</b></label>
       <input type="password" placeholder="Enter Password" name="rePsw" required>
       <br/>
       <button type="submit" >register</button>
     </div>
   </form>
 </body>

 </html>
