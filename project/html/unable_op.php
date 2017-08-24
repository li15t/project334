<?php

if (isset($_POST['unable']) && isset($_POST['record']))
  {  
     foreach($_POST['record'] as $room_num) { 
       $query ="UPDATE room_info SET stats='Unable' ,customer='null' WHERE id='$room_num'";
       $result = $conn->query($query);
       if (!$result) $hint="Operature failed: ".$conn->error."for Room Number: ".$room_num." <br>"; 
       else $hint="Operature successes: ".$conn->error."for Room Number: ".$room_num." <br>";
     //echo $query;
     }
     echo $hint;
     //update table after 2sec
     echo "<script>setTimeout(\"window.location.href='room_manage.php'\",2000)</script>";

  }
 
?> 