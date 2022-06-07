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
        $privkey = mysqli_real_escape_string($conn, $_GET["privkey"]);
        $amount = $amount - $privkey;
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

        $usedcode = mysqli_real_escape_string($conn, $_GET["discountcode"]);
        $ip = mysqli_real_escape_string($conn, $_SERVER['REMOTE_ADDR']);
        $time = time();

        $sql = "INSERT INTO creatoruses (codename,valid,userid,timestamp,ip) VALUES ('$usedcode',1,'$uid','$time','$ip');";
        $result = mysqli_query($conn, $sql); 
        if (!mysqli_query($conm,"INSERT INTO creatoruses (codename,valid,userid,timestamp,ip) VALUES ('$usedcode',1,'$uid','$time','$ip');")) {
            echo("Error description: " . mysqli_error($conn));
        }

        mysqli_close($conn);
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
    $creatorcode = $_GET["discountcode"];
    if ($creatorcode === ""){
        $creatorcode = "N/A";
    } else {
        $creatorcode = $creatorcode;
    }
    $userid = $_GET["id"];
    $price = $_GET["varamt"] - $_GET['privkey'];
    $transactionid = $_COOKIE["transactionid"];
    $date = date_format(date_timestamp_set(new DateTime(), $time)->setTimezone(new DateTimeZone($c_timezone)), 'c');

    $servername = $c_servernamep;
    $username = $c_usernamep;
    $password = $c_passwordp;
    $dbname = $c_dbnamep;

    $conn = mysqli_connect($servername, $username, $password, $dbname);
  
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $userid = mysqli_real_escape_string($conn, $userid);

    $sql = "SELECT * FROM users WHERE id = $userid";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $user = $row['username'];
            $user = strtoupper($user);
            $email = $row['email'];
            $email = md5($email);
        }
    } else {
        $user = 'NO USER';
    }
    mysqli_close($conn);

    $hookObject = json_encode([
        /*
         * An array of Embeds
         */
        "embeds" => [
            /*
             * Our first embed
             */
            [
                // Set the title for your embed
                "title" => 'CHECKOUT',

                // The type of your embed, will ALWAYS be "rich"
                "type" => "rich",

                // A description for your embed
                "description" => "",

                // The URL of where your title will be a link to
                "url" => $c_homeurl . $c_invoicegateway . '?transactionid=' . $_COOKIE["transactionid"] . '&output=HTML',

                /* A timestamp to be displayed below the embed, IE for when an an article was posted
                 * This must be formatted as ISO8601
                 */
                "timestamp" => $date,

                // The integer color to be used on the left side of the embed
                "color" => hexdec($c_embedcolor),

                // Footer object
                "footer" => [
                    "text" => $c_sitename,
                    "icon_url" => $c_homeurl . $c_favicon
                ],

                // Thumbnail object
                "thumbnail" => [
                    "url" => 'https://www.gravatar.com/avatar/' . $email
                ],

                // Author object
                "author" => [
                    "name" => $user,
                    "url" => $c_homeurl . '/billing/admin/user/' . $userid . '/payments'
                ],

                // Field array of objects
                "fields" => [
                    // Field 1
                    [
                        "name" => 'Amount',
                        "value" => $amount,
                        "inline" => true
                    ],
                    // Field 2
                    [
                        "name" => "Creator Code",
                        "value" => $creatorcode,
                        "inline" => true
                    ],
                    // Field 3
                    [
                        "name" => "Discount Code",
                        "value" => $creatorcode,
                        "inline" => true
                    ],
                    // Field 4
                    [
                        "name" => "User ID",
                        "value" => $userid,
                        "inline" => true
                    ],
                    // Field 5
                    [
                        "name" => "Transaction ID",
                        "value" => $transactionid,
                        "inline" => true
                    ]
                ]
            ]
        ]

    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

    $ch = curl_init();

    curl_setopt_array( $ch, [
        CURLOPT_URL => $c_webhook,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $hookObject,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json"
        ]
    ]);

    $response = curl_exec( $ch );
    curl_close( $ch );

?>

<?php
    header("Location: $c_paymentgateway/confirm.php?amountpaid=$amount&userid=$uid");
?>
