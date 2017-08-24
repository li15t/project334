<?php

//receiving username and password from the form
$username = $_REQUEST['username'];
$pwd = $_REQUEST['pwd'];
//echo $username;
//echo $pwd;

$hint = "username and password do not match our records or do not exists";

// connect to database
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

//check whether the login combo (username and password ) exists or not.
$stmt=$conn->prepare("SELECT username,password FROM `user_profile` WHERE username = ? and password = ? and usertype='2';");
$stmt->bind_param("ss",$username,$pwd);
$is_success= $stmt->execute();

if (!$is_success){ 
echo "Database is unable to read now: ".$conn->error;
exit;
}

if ($rows = $stmt->fetch()){
echo "ok";
}
else
{echo "no";
}


function get_post($conn, $var)
{
    return $conn->real_escape_string($var);
}

?>