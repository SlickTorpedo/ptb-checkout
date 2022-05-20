<!DOCTYPE html>
<html>
<body>
<?php
session_start();
$code = $_POST['name'];
$uid = $_POST["uid"];
$verify = "true";
if (isset($verify)) {
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "nexus";
  
	$conn = mysqli_connect($servername, $username, $password, $dbname);
  
	if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
	}
  	//vars with a p infront are protected with mysqli_real_escape_string();
  	$pcode = mysqli_real_escape_string($conn, $code);
	$sql = "select * from creatorcodes where codename = ".'"'.$pcode.'"';
	$result = mysqli_query($conn, $sql);

	$puid = mysqli_real_escape_string($conn, $uid);
	$sql = "select * from creatoruses where userid = ".'"'.$puid.'"'.' && codename = '.'"'.$pcode.'"';
	$resulta = mysqli_query($conn, $sql);
  
  	if (mysqli_num_rows($resulta) > 0) {
     	while($row = mysqli_fetch_assoc($resulta)) {
          echo '<br><FONT size="+1" COLOR="RED">Code has already been used!</FONT>';
          die();
        }
	}
  
  	if (mysqli_num_rows($result) > 0) {
  	// output data of each row
  	while($row = mysqli_fetch_assoc($result)) {
      	$_SESSION["code"] = "Valid";
		echo '<br><FONT size="+1" COLOR="LIME"><strong>Code Validated!</strong></FONT>';
      	//echo '<br><FONT size="+1" COLOR="ORANGE">Warning!</FONT><br>';
      	echo '<br><br><FONT size="+1" COLOR="RED"><em>Your payments will have a 1$ minimum when using discounts!</em></FONT>';
      	echo '<br><FONT size="+1" COLOR="GRAY"><em>Please contact support if you have any questions!</em></FONT>';
      	echo '<script>calculateDiscount("387ec36b-54db-4b23-a52b-2c60c727b2eb0f96284b-be0b-4ff2-b563-8516c1ca42def3dc2082","'.$row["amount"].'");</script>';
  	}
	} else {
      	$_SESSION["code"] = "Invalid";
  		echo '<br><FONT size="+1" COLOR="RED">Invalid Code!</FONT>';
	}

	mysqli_close($conn);
}
?>
  
</body>
</html>
