<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />
    <link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />

    <script src="http://code.jquery.com/jquery-latest.js"></script>
  </head>
  
  <body>
    
  </body>

<?php
  include '../config.php';

  function generateRandomString($length = 10) {
      return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
   }
   
  $randomstring = generateRandomString();

  $verify = "true";
  if (isset($verify)) {
    $servername = $c_servernamep;
    $username = $c_usernamep;
    $password = $c_passwordp;
    $dbname = $c_dbnamep;
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
      //vars with a p infront are protected with mysqli_real_escape_string();
      
    $prandomstring = mysqli_real_escape_string($conn, $randomstring);

      $sql = "SELECT * FROM billing_giftcards WHERE code = '$prandomstring'";
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
      $servername = $c_servernamep;
      $username = $c_usernamep;
      $password = $c_passwordp;
      $dbname = $c_dbnamep;
        
          $conn = mysqli_connect($servername, $username, $password, $dbname);
        
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }
            //vars with a p infront are protected with mysqli_real_escape_string();
            
          $prandomstring = mysqli_real_escape_string($conn, $randomstring);
      
          $sql = "SELECT * FROM billing_giftcards WHERE code = '$prandomstring'";
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
      $sql = "INSERT INTO billing_giftcards (`id`, `name`, `value`, `code`, `limit`) VALUES ('$idnummax', 'Store Purchase', '$amount', '$prandomstring', '1');";
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
    	
    	 $usedcode = mysqli_real_escape_string($conn, $_GET["discountcode"]);
    	 $ip = mysqli_real_escape_string($conn, $_SERVER['REMOTE_ADDR']);
    	 $time = time();
    	 
    	 $sql = "INSERT INTO creatoruses (codename,valid,userid,timestamp,ip) VALUES ('$usedcode',1,'$uid','$time','$ip');";
       $result = mysqli_query($conn, $sql); 
    	 if (!mysqli_query($conm,"INSERT INTO creatoruses (codename,valid,userid,timestamp,ip) VALUES ('$usedcode',1,'$uid','$time','$ip');")) {
        echo("Error description: " . mysqli_error($conn));
        }

  	 mysqli_close($conn);
    	 echo '<br> Token Validated! Redirecting you now!';
  	 } else {
       echo '<br> Invalid Token!';
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
    $discountcode = $_GET["discountcode"];
    $userid = $_GET["id"];
    $price = $_GET["varamt"] - 5318;

    $servername = $c_servernamep;
    $username = $c_usernamep;
    $password = $c_passwordp;
    $dbname = $c_dbnamep;

    $conn = mysqli_connect($servername, $username, $password, $dbname);
  
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $userid = mysqli_real_escape_string($conn, $userid);

    $sql = "SELECT username FROM users WHERE id = $userid";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $user = $row['username'];
            $user = strtoupper($user);
        }
    } else {
        $user = 'NO USER';
    }
    mysqli_close($conn);

    $url = $c_webhook;
    $headers = [ 'Content-Type: application/json; charset=utf-8' ];
    $POST = [
        'username' => 'HG Discount',
        'content' => '**__GIFTCARD ' . $user . '__**

**User ID :** ' . $userid . '
**Amount :** ' . $price . '$
**GiftCard :** ' . $prandomstring . '
**Code : **' . $discountcode . '
ㅤ'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
    $response   = curl_exec($ch);
?>

<?php
  header("Location: $c_giftcardgateway/confirm.php?amountpaid=$amount&userid=$uid&cardcode=$prandomstring");
?>