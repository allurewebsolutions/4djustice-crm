<!-- Connect to DB -->
<?php
//database connection info
$host = "localhost"; //server
$db = "justice_crm"; //database name
$user = "justiceroot"; //dabases user name
$pwd = "justice2010!!"; //password

//connecting to server and creating link to database
$link = mysqli_connect($host, $user, $pwd, $db);
?>