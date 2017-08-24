<?php
session_start();
?>

<!DOCTYPE html>
<html>
<body>

<?php

// remove all session variables
session_unset(); 

// destroy the session 
session_destroy();

echo "You have successfully logged out. Thanks for your support!";
echo "<script>setTimeout(\"window.location.href='index.php'\",3000)</script>";

?>

</body>
</html>
