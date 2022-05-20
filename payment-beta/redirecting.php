<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="https://nexussociety.net/css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="https://nexussociety.net/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="https://nexussociety.net/css/responsive.css" rel="stylesheet" />

  <script src="http://code.jquery.com/jquery-latest.js"></script>


  <script>
  // we don't use this function anymore but it's here for good measure
	function sendAlert() {
      var x = window.location.search.substr(1);
      var y = x.split('discountcode=');
      var discountcode = y[1];
      $.post("https://nexussociety.net/payment-beta/paymenthook.php", { discountcode: discountcode },
      );
      console.log("Discount code sent to server");
}
</script>
  </head>
  
  <body>
    
  </body>

<?php
//The url you wish to send the POST request to (for alerts)
$url = 'paymenthook.php';

//The data you want to send via POST
$fields = [
    'discountcode' => $_GET["discountcode"],
];

//url-ify the data for the POST
$fields_string = http_build_query($fields);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//So that curl_exec returns the contents of the cURL; rather than echoing it
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

//execute post
$result = curl_exec($ch);
echo $result;
?>
  
<?php
$fpcff = file_get_contents('./protectedintfilekey.txt', FILE_USE_INCLUDE_PATH);
if ($fpcff == $_GET['privkey']) {
  	 $file = './protectedintfilekey.txt';
     $remove = $_GET['privkey'];
  	 remove_line($file, $remove);
	 $servername = $c_servernamep;
	 $username = $c_usernamep;
	 $password = $c_passwordp;
	 $dbname = $c_dbnamep;
  
	 $conn = mysqli_connect($servername, $username, $password, $dbname);
  
	 if (!$conn) {
  	 	die("Connection failed: " . mysqli_connect_error());
	 }

	 $amount = mysqli_real_escape_string($conn, $_GET["varamt"]);
	 $amount = $amount - 5318;
	 $uid = mysqli_real_escape_string($conn, $_GET["id"]);
	 $sql = "UPDATE billing_users SET balance = balance + $amount where user_id = '$uid';";
	 $result = mysqli_query($conn, $sql);

   mysqli_close($conn);

   $servername = $c_servername;
	  $username = $c_username;
	  $password = $c_password;
	  $dbname = $c_dbname;
  
	 $conn = mysqli_connect($servername, $username, $password, $dbname);
  
	 if (!$conn) {
  	 	die("Connection failed: " . mysqli_connect_error());
	 }
  	
  	 $usedcode = $_GET["discountcode"];
  	 $ip = $_SERVER['REMOTE_ADDR'];
  	 $time = time();
  	 
  	 $sql = "INSERT INTO creatoruses (codename,valid,userid,timestamp,ip) VALUES ('$usedcode',1,'$uid','$time','$ip');";
     $result = mysqli_query($conn, $sql); 
  	 if (!mysqli_query($conm,"INSERT INTO creatoruses (codename,valid,userid,timestamp,ip) VALUES ('$usedcode',1,'$uid','$time','$ip');")) {
      echo("Error description: " . mysqli_error($conn));
      }

	 mysqli_close($conn);
    echo '<script>sendAlert();</script>';
  	 echo 'Token Validated! Redirecting you now!';
	 } else {
     echo 'Invalid Token!';
   }

function remove_line($file, $remove) {
    $lines = file($file, FILE_IGNORE_NEW_LINES);
    foreach($lines as $key => $line) {
        if($line === $remove) unset($lines[$key]);
    }
    $data = implode(PHP_EOL, $lines);
    file_put_contents($file, $data);
}
?>
  
  
<?php
header("Location: $c_paymentgateway/confirm.php?amountpaid=$amount&userid=$uid&cardcode=$response");
?>
