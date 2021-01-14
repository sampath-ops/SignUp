<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Sign Up Form with live validation</title>
  <link rel="stylesheet" href="./loginstyle.css">

</head>
<body>

<?php 

$userName='root';
$pass='root'; 
$server='localhost';
$DBname='signUp';
$connection = new mysqli($server, $userName, $pass,$DBname,"3307");
if($connection->connect_error){
  die("Unable to connect :(");
}
else{
 // echo "Connected Successfully ";
}
?>

<?php
/* dummytext */
session_start();
$emailErr=$email=$password="";
if($_SERVER['REQUEST_METHOD']==='POST'){

   if(empty($_POST['Email'])){
     $emailErr="* Valid Email is Required";
   }
   else{
	$email=result($_POST['Email']);
    //check email is valid or not
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email="";
    }
   }
// get password from input feild
   $password=$_POST['password'];


//if email is empty show hint and don't add data to DB
   if($email==""){
    	$emailErr="* Valid Email is Required";
	   }
// if email is valid insert into DB
   else{
	   //check if user is already exist or not
	$query = "SELECT * FROM signup WHERE Email = '$email' AND Pass='$password'" ;
	$result = $connection->query($query); 
	if ($result) {
	  if (mysqli_num_rows($result) > 0) {
            $_SESSION["email"] = $email;
            header('location:/PHPfiles/sign-up-form-with-live-validation/dist/loggedpage.php');
            exit;
          }
          else{
            $emailErr= "Invalid email or password";
            }
		}
      }
}
function result($data){
	$data=trim($data);
	$data=stripslashes($data);
	htmlspecialchars($data);
	return $data;
  }

?>
 

<!-- partial:index.partial.html -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
  <h2>Log In</h2>
		<p>
			<label for="Email" class="floatLabel">Email</label>
			<input id="Email"  name="Email" type="text">
			<em class="error"> <?php echo $emailErr; ?></em>
		</p>
		<p>
			<label for="password" class="floatLabel">Password</label>
			<input id="password" name="password" type="password">
		<!--	<span class="unique">Enter a password longer than 8 characters</span> -->
		</p>
	<!--	<p>
			<label for="confirm_password" class="floatLabel">Confirm Password</label>
			<input id="confirm_password" name="confirm_password" type="password">
			<span class="unique">Your passwords do not match</span>
		</p> -->
		<p style="margin:0em;">
			<input type="submit" value="Let Me In" id="submit">
			<p 
		     style="font-style: normal;font-size: 14px;font-weight:bold;text-align: center; padding-top: 24px;
             margin: 0;"> Don't have an Account? <a href="/PHPfiles/sign-up-form-with-live-validation/dist/index.php" style="text-decoration:none;">SignUp</a></p>
	   </p>
	</form>
<!-- partial -->
  <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="./script.js"></script> -->

</body>
</html>
