<?php
 $username=$_REQUEST["username"];
 $pwd=$_REQUEST["pwd"];
// connect to database
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

//read user info and check if the username and password are legal to avoid illegal access.
 $query  = "SELECT * FROM user_profile where username='".$_REQUEST["username"]."'and password='".$_REQUEST["pwd"]."';";
 $result = $conn->query($query);
 if($result->num_rows==0)
  die("illegal access!");
// read client order 
 $query  = "SELECT id,type,price,intro FROM room_info NATURAL JOIN room_cata Where customer='".$_REQUEST["username"]."';";
 $result2 = $conn->query($query);
 if(!$result2)
  die($conn->error);
 
 $query  = "SELECT SUM(price) FROM room_info NATURAL JOIN room_cata Where customer='".$_REQUEST["username"]."' GROUP BY customer;";
 $result3 = $conn->query($query);
 if(!$result3)
  die($conn->error);
?>

<html><head>
<link rel="stylesheet" type="text/css" href="../css/table.css"> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
<script src="../js/checkboxes.js"></script>
</head>

<body>

<?php
 //output order for current user
$rows = $result2->num_rows;
echo <<<_END
<form action="room_info.php" method="post">
<input type="submit" name="cancel" value="Cancel the record"/>
  <table> 
    <thead>
    <tr>      
    <th>Room number</th>         
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
  <td><input type="checkbox" name="record2[]" value="$row[0]"></td>
  </tr> 
_END;
}
echo "</table></form><br>"; 
$result3->data_seek(0);
$row = $result3->fetch_array(MYSQLI_NUM);
echo "TOTAL AMOUNT: $".$row[0];
?>


</body>
</html>

<?php
$result->close();
$conn->close(); 
echo "<input type='hidden' name='buffer1' id='buffer1' value='".$username."'>";
echo "<input type='hidden' name='buffer2' id='buffer2' value='".$pwd."'>";
?>