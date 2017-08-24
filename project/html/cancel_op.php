<?php

if (isset($_POST['cancel']) && isset($_POST['record2']))
  { 
     $hint="";
     foreach($_POST['record2'] as $room_num) { 
     $query ="UPDATE room_info SET stats='Empty' ,customer='null' WHERE id='$room_num'";
     //echo $query;
    
       $result = $conn->query($query);
       if (!$result) 
          $hint.="Room Number: ".$room_num." has met an error during the transcation <br>"; 
       else 
          $hint.="You have successfully cancel the Room ".$room_num."<br>";
     //echo $query;
     
     echo $hint;
     //update table after 2sec
     echo "<script>setTimeout(\"window.location.href='room_info.php'\",2000)</script>";
   }  
  }
 
?> 