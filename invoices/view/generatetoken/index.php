<?php
function generateRandomString($length = 50) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
 }
 
$randomstring = generateRandomString();


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
  	
	$prandomstring = mysqli_real_escape_string($conn, $randomstring);

  	$sql = "SELECT * FROM invoices WHERE uniqueid = '$prandomstring'";
  	$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
            generateNewString();
	    }
	} else {
        echo $prandomstring;
	}


	mysqli_close($conn);
}

function generateNewString(){
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
          
        $prandomstring = mysqli_real_escape_string($conn, $randomstring);
    
          $sql = "SELECT * FROM invoices WHERE uniqueid = '$prandomstring'";
          $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                generateNewString();
            }
        } else {
            echo $prandomstring;
        }
    
    
        mysqli_close($conn);
    }
}
?>
