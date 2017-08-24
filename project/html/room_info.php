<?php
// check login information
session_start();
if (isset($_POST["username"]) && isset($_POST["pwd"]) ){
 $_SESSION["username"]=$_POST["username"];
 $_SESSION["pwd"]=$_POST["pwd"];
}
else if(isset($_SESSION["username"]) && isset($_SESSION["pwd"])){

}
else {
echo "<script>setTimeout(\"window.location.href='index.php'\",3000)</script>";
die("Please login first! Wait a moment... <br>");
}

?>

<?php
 $username=$_SESSION["username"];
 $pwd=$_SESSION["pwd"];
// connect to database
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

//read user info and check if the username and password are legal to avoid illegal access.
 $query  = "SELECT * FROM user_profile where username='".$_SESSION["username"]."'and password='".$_SESSION["pwd"]."';";
 $result = $conn->query($query);
 if($result->num_rows==0)
  die("illegal access!");
 $query  = "SELECT id,stats,type,price,intro FROM room_info NATURAL JOIN room_cata;";
 $result2 = $conn->query($query);
 if(!$result2)
  die($conn->error);
?>

<html><head>
<title>Welcome to Hotel Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" type="text/css" href="../css/product.css">
<link rel="stylesheet" type="text/css" href="../css/table.css"> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
<script src="../js/checkboxes.js"></script>
<script>
// use Jquery and AJAX implement dynamic content.
$(document).ready(function(){
 var username=$("#buffer1").val();
 var pwd=$("#buffer2").val();

// tool bar button
 $("#opt1").click(function(){ // feature for My profile button
       
        $("#dynamic_topic").text("Your book order");  
        $("#utable").html(""); 
        $.post("book_order.php?username="+username+"&pwd="+pwd,function(data, status){
          $("#dynamic_content").html(data); 
       });
   });

   $("#opt2").click(function(){ // defualt feature.
      setTimeout("window.location.href='room_info.php'",1);
   });


  });
</script> 




</head>
<body>
<div id="wrapper">
<header>
<?php
$result->data_seek(0); 
echo '<img height="80" width="80" style=" float:left; margin-left: 20px; margin-top: 8px;" class="user_icon" alt="user_icon" src="data:image/jpeg;base64,'.base64_encode($result->fetch_assoc()["picture"]).'"/>';
?>
<h1 class="toptext">Hotel Management System</h1> 
<div align="right" id="welcomeinfo"> 
<?php
 if (!$result)
  echo "Database access failed: " . $conn->error;
 else{
    $result->data_seek(0);  
    $userfullname = $result->fetch_assoc()['fname'];
    $result->data_seek(0);
    $userfullname .=" ";   
    $userfullname .= $result->fetch_assoc()['lname'];
   if ($userfullname != "") echo 'Hello! '.$userfullname;
 }
?>
</div>
</header>

<?php
$result->data_seek(0);  
$usertype = $result->fetch_assoc()['usertype'];

echo <<<_END
<div class="grouping">
<nav><h2>Tools</h2>
_END;

// different user here would have different tools in the system.
if($usertype == '1'){ //tools for client user
echo <<<_END
<a href="myprofile.php"><div class="bigbox">My profile</div></a>
<a href="room_info.php"><div class="bigbox">Hotel info</div></a>
_END;
}
else if($usertype == '2'){ //tools for admin
echo <<<_END
<a href="myprofile.php"><div class="bigbox">My profile</div></a>
<a href="room_manage.php"><div class="bigbox">Room management</div></a>
<a href="visualized.php"><div class="bigbox">Visualized Data</div></a>
_END;
}


echo <<<_END
<p><a href="logoff.php"><div class="bigbox">log out</div></a></p>
</nav>
</div>
_END;
?>

<article>
<h2 class="title" id="dynamic_topic">Room Information</h2>

<p class="copy" id="dynamic_content">
<?php
$rows = $result2->num_rows;
for ($j = 0 ; $j < $rows ; ++$j){
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);
}
echo <<<_END
<form action="room_info.php" method="post" id="utable">
<input type="submit" name="book" value="book it"/>
  <table> 
    <thead>
    <tr>      
    <th>Room number</th>     
    <th>Status</th>     
    <th>Category</th>     
    <th>Price</th>     
    <th>Description</th>  
    <td><input type="checkbox" name="all" value="all" onclick="check_all()"></td> 
    </tr>
</thead>
_END;
for($j=0;$j<$rows;++$j){
   $result2->data_seek($j);
   $row = $result2->fetch_array(MYSQLI_NUM);
echo <<<_END
  <tr> 
  <td>$row[0]</td>
  <td>$row[1]</td>
  <td>$row[2]</td>
  <td>$row[3]</td>
  <td>$row[4]</td>
  <td><input type="checkbox" name="record[]" value="$row[0]"></td>
  </tr> 
_END;
}

echo "</table></form>"; 
?>


</p>
</article>

<aside><h2 class="title">Options</h2> 
<div id="option_bar">
<a><div class="bigbox bigbox2" id="opt2">Book Room</div></a>
<a><div class="bigbox bigbox2" id="opt1">My order</div></a>
</div>
 </aside>

<footer><p class="title">
<?php
//operation

/*book a room from the table classics*/
require("book_op.php");

/*delete a record from the table classics*/
require("cancel_op.php");
?>
</p></footer>
</div>

<?php
$result->close();
$result2->close();
$conn->close(); 
echo "<input type='hidden' name='buffer1' id='buffer1' value='".$username."'>";
echo "<input type='hidden' name='buffer2' id='buffer2' value='".$pwd."'>";
?>

</body></html>