<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" >
<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css" >
<link rel="stylesheet" type="text/css" href="../css/form.css" >
<link rel="stylesheet" type="text/css" href="../css/color.css"> 
<script>
function showHint(){
var username = document.getElementById("username").value;
var pwd = document.getElementById("pwd").value; 
if (pwd != "") {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
               var msg = this.responseText;
               document.getElementById("signal").value = "red";
            if (msg=="ok"){
                document.getElementById("signal").value = "green";
                //window.location.href="products.php";
            } 
 
         }
        };

        xmlhttp.open("POST", "getinfo.php?username=" + username+"&pwd="+pwd, true);
        xmlhttp.send();
  
}         
}

function showHint1(){ //user may change username when username and password are matched
showHint();
}

function validate_matching(){
if (document.getElementById("signal").value == "green")
{
return true;
}
else
{
 //event.preventDefault() in onsubmit event very important to turn on "return false;" for some browsers
event.preventDefault();
document.getElementById("txtHint").innerHTML ="username and password do not match our records or do not exists!";
return false;
}
}
</script>

</head>
<body>
<h2 class="topic">
<img class="img-thumbnail" src="../pictures/myuwindsor.jpg"  alt="uwindsor symbol" width="217">
<br>Hotel Management system: <div class="t2">Client Access</div>
</h2>


<div>
<form class="form-horizontal" action="products.php" method="post" onsubmit="validate_matching()">
<div class="form-group">
<label for="username" class="col-sm-3 control-label">User Name</label>
<div class="col-sm-40">
<input class="form-control" type="text" name="username" id="username" onkeyup="showHint1()">
</div>
</div>

<div class="form-group">
<label for="pwd" class="col-sm-3 control-label">Password</label>
<div class="col-sm-40">
<input class="form-control" type="password" id="pwd" name="pwd" onkeyup="showHint()">
</div>
</div>

<p><span id="txtHint" style="color:#FF0000"></span></p>
<input type="hidden" name="signal" id="signal" value="red">
<div>
  <input type="submit" value="login"> 
</div>
</form>
</div>


<form method="post" action="profiles_form.php">
<div>
  <input type="submit" value="Signup"> 
</div>
</form>

<form method="post" action="index.php">
<div>
  <input type="submit" value="cancel"> 
</div>
</form>

</body>
</html>