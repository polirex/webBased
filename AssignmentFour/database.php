<?php

class database
{

    private static $host = "earth.cs.utep.edu";
    private static $user = "cs5339team8fa16";
    private static $pass = "cs5339!cs5339team8fa16";
    private static $db_name = "cs5339team8fa16";
    public $con;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $this->con = new mysqli(self::$host, self::$user, self::$pass, self::$db_name);
        //if there was a problem with the connection to the db.
        if ($this->con->connect_errno)
        {
            header('location:mainpage.php'); //redirect to homepage
            exit();
        }
    }

    //Queries the database into whatever the string the user gives.
    public function query($query)
    {
        $this->con->query($query) or die($this->con->error . "error");
        $affected_rows = mysqli_affected_rows($this->con);
        if ($affected_rows > 0)
            return true;
        else
            return false;
    }

    public function returnQuery($query)
    {
        $result = $this->con->query($query);
        return $result;
    }

    public function mysql_entities_fix_string($string)
    {
        return htmlentities($this->mysql_fix_string($string));
    }

    public function mysql_fix_string($string)
    {
        if (get_magic_quotes_gpc())
        {
            $string = stripslashes($string);
        }
        return $this->con->real_escape_string($string);
    }

    public function closeConnection()
    {
        return $this->con->close();
    }

}
