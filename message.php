<div style="text-align:center;">
<h1>Message Board</h1>
</div>
<form action="" method="post"/>
<div style="position: absolute; bottom: 5px;text-align:center;">
    
<!--<label>Name :</label>
<input id="name" name="name"  type="text">
-->
<br>
<br>
<label>Message :</label>
<input style="height:150px;font-size:12pt;width:800px;word-wrap: break-word;;" id="message" name="message"  type="text"><!--Should make the txt box for msg bigger -->
<br>
<br>
<input  name="submit" type="submit" value=" submit ">
 </div>
<td style="height:50px;width:50px"align='right'>
    <div style="height:50%;width:50%; overflow-y:scroll;text-align:left;"> <!--Should make the messages scrollable -->
<?php
/*
 * Still need to access session and table in order to display username  
 * with the message
 */
//was connected to my local host
$host='localhost';
$user='root';
$password='password';
$database='db';
$connection = mysql_connect($host, $user, $password);
if(!$connection){
die('Could not connect: '. mysql_error());
}
mysql_select_db($database, $connection);
$name;
$ms;
///////////////////displays all messages
$qry="SELECT * FROM sample";
$res=mysql_query($qry,$connection);
//I still might add to this message to display the max msg length that can be stored in the table
echo "Welcome to the alumni message board, please be courteous and respectful";
echo "<br>";
echo "<br>";
echo "<br>";
while($row=mysql_fetch_array($res)){
    echo $row['name']." posted :";
    echo "<br>";
    echo $row['msg'];
    echo "<br>";
}
?>
</div>
</td>
<?php
//////////////////
if(isset($_POST['submit'])){//if a message has been submitted
     $name="user"; // I had just hardcoded for testing but need to obtain user from table
     $ms=$_POST['message'];
    $query="INSERT INTO sample (name,msg) VALUES ('$name','$ms')";
    $result=mysql_query($query,$connection);
    
    if($result){
        echo "message submitted to db";
        //or maybe start session and go to user
        mysql_close($connection);
        header('Location:../../p4/message.php');
    }else{
        echo "messaage rejected";
         mysql_close($connection);
    }
}
?>
