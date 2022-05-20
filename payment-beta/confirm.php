<!DOCTYPE html>
<html>

<head>
  <?php
    $nsvar = htmlspecialchars($_GET['id']);
  	include 'config.php';
  ?>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title><?php echo $c_sitename ?> - Purchase Gift Cards</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="https://nexussociety.net/css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="https://nexussociety.net/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="https://nexussociety.net/css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="<?php echo $c_homeurl ?>">
            <span>
              Gift Cards
            </span>
          </a>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="s-1"> </span>
            <span class="s-2"> </span>
            <span class="s-3"> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo $c_homeurl; ?>">Home <span class="sr-only">(current)</span></a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>


  <!-- service section -->
  <section class="service_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          PURCHASE SUCCESSFUL!<br><em>You're amazing thank you :)</em>
        </h2>
      </div>

      <div class="service_container">
        <div class="box">
          <div class="img-box">
            <img src="https://nexussociety.net/payment-test/imhg/question-mark.png" class="img1" alt="">
            <img src="https://nexussociety.net/payment-test/imhg/question-mark.png" class="img2" alt="">
          </div>
          <div class="detail-box">
            <h5>
              What did I just buy?
            </h5>
            <p>
              When you purchase account credits you are adding them to your account balance. You can now use these credits to purchase servers!
            </p>
          </div>
        </div>
        <div class="box active">
          <div class="img-box">
            <img src="https://nexussociety.net/payment-test/imhg/warn.png" class="img1" alt="">
            <img src="https://nexussociety.net/payment-test/imhg/warn.png" class="img2" alt="">
          </div>
          <div class="detail-box">
            <h5>
              Oh crap... undo that please!
            </h5>
            <p>
              If you accidentally made a purchase that you didn't mean to or changed your mind, you can always contact our support team! Just click <a href="<?php echo $c_discord ?>">this link</a> and we will take you there!
            </p>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="https://nexussociety.net/payment-test/imhg/money-bag.png" class="img1" alt="">
            <img src="https://nexussociety.net/payment-test/imhg/money-bag.png" class="img2" alt="">
          </div>
          <div class="detail-box">
            <h5>
              How much are these credits worth?
            </h5>
            <p>
              For every single credit you buy, you purchase $1 worth of USD. You can view your credits by clicking <a href="<?php echo $c_billingpage ?>">here</a>.
            </p>
          </div>
        </div>
      </div>
      <div>
      <?php
        if(isset($_COOKIE["transactionid"]) && isset($_COOKIE["touser"]) && isset($_COOKIE["street"]) && isset($_COOKIE["state"]) && isset($_COOKIE["zipcode"]) && isset($_COOKIE["country"]) && isset($_COOKIE["amount"])){
            $ch = curl_init($c_invoicesgen);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            //response = $response;
            //cookies:
            $transactionid = $_COOKIE["transactionid"];
            $touser = $_COOKIE["touser"];
            $street = $_COOKIE["street"];
            $state = $_COOKIE["state"];
            $zipcode = $_COOKIE["zipcode"];
            $country = $_COOKIE["country"];
            $amount = $_COOKIE["amount"];
            setcookie("touser", "", time() - 1);
            setcookie("transactionid", "", time() - 1);
            setcookie("street", "", time() - 1);
            setcookie("state", "", time() - 1);
            setcookie("zipcode", "", time() - 1);
            setcookie("country", "", time() - 1);
            setcookie("amount", "", time() - 1);
            // MAKE THE DATABASE CONNECTION
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
  	
	            $ptransactionid = mysqli_real_escape_string($conn, $transactionid);
                $ptouser = mysqli_real_escape_string($conn, $touser);
                $pstreet = mysqli_real_escape_string($conn, $street);
                $pstate = mysqli_real_escape_string($conn, $state);
                $pzipcode = mysqli_real_escape_string($conn, $zipcode);
                $pcountry = mysqli_real_escape_string($conn, $country);
                $pamount = mysqli_real_escape_string($conn, $amount);
                date_default_timezone_set('America/Los_Angeles');
                $time = date(DATE_RFC2822);

                $sql = "DELETE FROM invoices WHERE invoice = '$ptransactionid'";
                $result = mysqli_query($conn, $sql);

  	            $sql = "INSERT INTO invoices (touser,street,state,country,zipcode,invoice,uniqueid,quantity,timestmap) VALUES ('$ptouser','$pstreet','$pstate','$pcountry','$pzipcode','$ptransactionid','$response','$pamount','$time')";
  	            $result = mysqli_query($conn, $sql);
      
                mysqli_close($conn);
            }

            echo '<a href="'.$c_invoices.'?invoiceid='.$response.'" target="_blank"><strong>View Invoice</strong></a>';
            echo '<br>Transaction ID: '.$transactionid.'<br>';
            echo 'Please screenshot this, you may need it!';
            echo '<br>';
        } else {
            //cookies blocked... no invoice :o
        }
        ?>
      </div>
    </div>
  </section>
  <!-- end service section -->

  <div class="footer_bg">


     <!-- footer section -->
    <section class="container-fluid footer_section">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 col-md-9 mx-auto">
            <p>
              &copy; 2022 All Rights Reserved By
              <a href="<?php echo $c_homeurl ?>"><?php echo $c_sitename ?></a>
            </p>
          </div>
        </div>
      </div>
    </section>
    <!-- footer section -->

  </div>



  <script type="text/javascript" src="https://nexussociety.net/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="https://nexussociety.net/js/bootstrap.js"></script>
  <?php
  $amount = htmlspecialchars($_GET['amountpaid']);
  $uid = htmlspecialchars($_GET['userid']);
  ?>

</body>

</html>
