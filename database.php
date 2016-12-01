<?php
class database
{
    private static $host = "earth.cs.utep.edu";
    private static $user = "cs5339team8fa16";
    private static $pass = "cs5339!cs5339team8fa16";
    private static $db_name = "wb_longpre";

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
            header('location:index.php'); //redirect to homepage
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


}
