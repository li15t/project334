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
?>

<html><head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
<script src="../js/validation.js">  </script>
</head>

<body>

<form class="form-horizontal" action="myprofile.php" method="post" onsubmit="validate_password()" enctype="multipart/form-data">

<div class="form-group">
<label for="fname"  class="col-sm-3 control-label">First Name</label> 
<div class="col-sm-5">
<input type="text"  class="form-control" required name="fname" maxlength="30" size=5>
</div>  
</div>   

<div class="form-group">
<label for="lname"  class="col-sm-3 control-label">Last Name</label> 
<div class="col-sm-5">
<input type="text" class="form-control" required name="lname" maxlength="30">
</div>
</div>   

<div class="form-group">
<label for="dob"  class="col-sm-3 control-label">Date of Birth</label>
<div class="col-sm-5">
<input type="date" name="dob">
</div>
</div> 

<div class="form-group">
<label for="email"  class="col-sm-3 control-label">Email</label>
<div class="col-sm-5">
<input type="email" name="email" maxlength="100">
</div>
</div> 

<div class="form-group">
<label for="pwd"  class="col-sm-3 control-label">Password</label>
<div class="col-sm-5">
<input type="password" id="uppwd" name="uppwd" maxlength="30">
</div>
</div> 

<div class="form-group">
<label for="cpwd"  class="col-sm-3 control-label">Confirm password</label>
<div class="col-sm-5">
<input type="password" id="cpwd" name="cpwd" maxlength="30">
</div>
</div> 


<div class="form-group">
<label for="picture"  class="col-sm-3 control-label">Profile picture</label>
<div class="col-sm-5">
<input type="file" required name ="picture" id="picture" accept="image/*">
</div>
</div> 

<br>
<div>
<input type="submit" value="Update" >
</div>
</form>


<form  method="post" action="myprofile.php">
<div>
  <input type="submit" value="Cancel"> 
</div>
</form>

</body>
</html>

<?php
$result->close();
$conn->close(); 
echo "<input type='hidden' name='buffer1' id='buffer1' value='".$username."'>";
echo "<input type='hidden' name='buffer2' id='buffer2' value='".$pwd."'>";
?>