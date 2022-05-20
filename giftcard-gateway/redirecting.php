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
      $.post("https://nexussociety.net/giftcard-gateway/paymenthook.php", { discountcode: discountcode },
      );
      console.log("Discount code sent to server");
}
</script>
  </head>
  
  <body>
    
  </body>

<?php
//The url you wish to send the POST request to
$url = 'https://nexussociety.net/giftcard-gateway/paymenthook.php';

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
	 $servername = "127.0.0.1";
	 $username = "pterodactyl";
	 $password = "root";
	 $dbname = "panel";

    $ch = curl_init('https://nexussociety.net/invoices/view/generatetoken/giftcards.php/');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
  
	$conn = mysqli_connect($servername, $username, $password, $dbname);
  
	if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
	}

    $sql = "SELECT * FROM billing_giftcards ORDER BY id DESC LIMIT 1;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
            $idnummax = $row["id"];
        }
    }
     $idnummax = $idnummax + 1;
	 $amount = mysqli_real_escape_string($conn, $_GET["varamt"]);
	 $amount = $amount - 5318;
	 $uid = mysqli_real_escape_string($conn, $_GET["id"]);
	 $sql = "INSERT INTO billing_giftcards (`id`, `name`, `value`, `code`, `limit`) VALUES ('$idnummax', 'Store Purchase', '$amount', '$response', '1');";
	 $result = mysqli_query($conn, $sql);

    mysqli_close($conn);

      $servername = "localhost";
	  $username = "root";
	  $password = "password";
	  $dbname = "nexus";
  
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

header("Location: https://nexussociety.net/giftcard-gateway/confirm.php?amountpaid=$amount&userid=$uid&cardcode=$response");
?>
