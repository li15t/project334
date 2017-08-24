<?php

if (isset($_POST['book']) && isset($_POST['record']))
  {  $hint="";
     foreach($_POST['record'] as $room_num) { 
     $query ="UPDATE room_info SET stats='Full' ,customer='$username' WHERE id='$room_num'";
     $query2 ="SELECT stats FROM room_info WHERE id='$room_num'"; 
     $result2 = $conn->query($query2);
     $result2->data_seek(0);  
     $status = $result2->fetch_assoc()['stats'];
     //echo $status;
     if($status=="Empty"){
       $result = $conn->query($query);
       if (!$result) $hint.="Room Number: ".$room_num." has met an error during the transcation <br>"; 
       else $hint.="Room Number: ".$room_num." has succesfully booked!<br>";
     //echo $query;
     }
     else{
       $hint.="Sorry, Room Number: ".$room_num." is unavailable now <br>"; 
     }
  } 
     echo $hint;
     //update table after 2sec
     echo "<script>setTimeout(\"window.location.href='room_info.php'\",2000)</script>";
   
  }
 
?> 