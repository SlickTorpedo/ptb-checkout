<!DOCTYPE html>
<html>
<body>
<?php
session_start();
$code = $_POST['name'];
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
  
  	if (mysqli_num_rows($result) > 0) {
  	// output data of each row
  	while($row = mysqli_fetch_assoc($result)) {
      	echo $row["amount"];
  	}
	} else {
      	echo "Invalid Code!";
	}

	mysqli_close($conn);
}
?>
  
</body>
</html>
