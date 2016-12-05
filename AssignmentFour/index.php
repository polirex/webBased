
<?php
session_start()
?>



<html>
    <!-- Here we display the content of the mainpage of the webpage -->
    <head><title>Home Page</title>
        <link rel="stylesheet" type="text/css" href="pStyles.css">

    </head>

    <body>
        <header>
            <ul class="topMenu">
                <li > <a  href="mainpage.php">Home</a></li>
                <li > <a  href="login.php">Login</a></li>
                <li > <a  href="register.php">Registration</a></li>
                <li > <a  href="message.php">Message Board</a></li>
            </ul>
        </header>
    </body>

</html>

<?php
//Send the users straight into home
header('location:mainpage.php');
