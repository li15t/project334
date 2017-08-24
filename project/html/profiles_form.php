<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" >
<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="../css/color.css"> 
<link rel="stylesheet" type="text/css" href="../css/form.css" >
<script src="../js/validation.js">  </script>
</head>
<body>
<h2 class="topic">
Register System
<br>
<img class="img-thumbnail" src="../pictures/myuwindsor.jpg"  alt="uwindsor symbol" width="217">
<div class="t2">Join us now</div>
</h2>

<?php
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
?>

<form class="form-horizontal" action="insert_into_profiles.php" onsubmit="return validate_password()" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="username"  class="col-sm-3 control-label">User Name</label> 
<input type="text"  class="form-control" required name="username" maxlength="30">
</div>   

<div class="form-group">
<label for="fname"  class="col-sm-3 control-label">First Name</label> 
<input type="text"  class="form-control" required name="fname" maxlength="30">
</div>   

<div class="form-group">
<label for="lname"  class="col-sm-3 control-label">Last Name</label> 
<input type="text" class="form-control" required name="lname" maxlength="30">
</div>  

<div class="form-group">
<label for="dob"  class="col-sm-3 control-label">Date of Birth</label>
<input type="date" name="dob">
</div>

<div class="form-group">
<label for="email"  class="col-sm-3 control-label">Email</label>
<input type="email" name="email" maxlength="100">
</div>

<div class="form-group">
<label for="pwd"  class="col-sm-3 control-label">Password</label>
<input type="password" id="pwd" name="pwd" maxlength="30">
</div>

<div class="form-group">
<label for="cpwd"  class="col-sm-3 control-label">Confirm password</label>
<input type="password" id="cpwd" name="cpwd" maxlength="30">
</div>


<div class="form-group">
<label for="picture"  class="col-sm-3 control-label">Profile picture</label>
<input type="file" required name ="picture" id="picture" accept="image/*">
</div>
<div>
<input type="submit" value="Submit" >
</div>
</form>


<form  method="post" action="client_login.php">
<div>
  <input type="submit" value="Cancel"> 
</div>
</form>


</body>
</html>
