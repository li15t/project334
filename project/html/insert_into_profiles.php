
<?php
// connect to database
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

// get all elements that have been sent by form
$fname = get_post($conn, $_REQUEST['fname']);
$lname = get_post($conn,$_REQUEST['lname']);
$dob = $_REQUEST['dob'];
$email = get_post($conn,$_REQUEST['email']);

//adding username and password
$username = get_post($conn,$_REQUEST['username']);
$pwd = get_post($conn,$_REQUEST['pwd']);


//echo $fname.",".$lname.",".$username.",".$pwd.",".$email.",1"; used to test value


if(isset($_FILES['picture'])) {
    // Make sure the file was sent without errors
    if($_FILES['picture']['error'] == 0) {


        // Connect to the database
       
 
        // Gather all required data
        $name = $conn->real_escape_string($_FILES['picture']['name']);
        $mime = $conn ->real_escape_string($_FILES['picture']['type']);
        $data = $conn ->real_escape_string(file_get_contents($_FILES  ['picture']['tmp_name']));
        $size = intval($_FILES['picture']['size']);
 //   echo $data; 
    }
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['picture']['error']);
        }
}

//STR_TO_DATE('22,3,1990', '%d,%m,%Y')
$usertype="1";
$stmt=$conn->prepare("INSERT INTO user_profile (fname,lname,username,password,email,usertype) VALUES(?,?,?,?,?,?)");
$stmt->bind_param("ssssss",$fname,$lname,$username,$pwd,$email,$usertype);
$is_success= $stmt->execute();
 
if(!$is_success){
echo "Insert failed:".$conn->error."<br>";    
exit;
}

$query  = "UPDATE user_profile SET picture= '".$data."' WHERE username='".$username."';";
$result1 = $conn->query($query);  
if(!$result1){
echo "Insert failed:".$conn->error."<br>";    
exit;
}

$query  = "UPDATE user_profile SET birth= STR_TO_DATE('".$dob."', '%Y-%m-%d')  WHERE username='".$username."';";
$result2 = $conn->query($query);  

if ($result2){   
echo "Insert record successfully! <br>";
echo "The page will be re-directed in three seconds. Please wait a moment... <br>";
echo "<script>setTimeout(\"window.location.href='client_login.php'\",3000)</script>";
$result1->close();
$result2->close();
$stmt->close();
$conn->close(); 


}
else{
echo "Insert failed:".$conn->error."<br>";
$result->close();
$stmt->close();
$conn->close();
exit;
}




function get_post($conn, $var)
{
    return $conn->real_escape_string($var);
}

?>