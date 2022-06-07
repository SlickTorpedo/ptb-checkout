<!DOCTYPE html>
<html>

<head>
  <?php
    $nsvar = htmlspecialchars($_GET['id']);
  	include '../config.php';
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
  <link rel="icon" type="image/png" href="<?php echo $c_favicon; ?>" />

  <title><?php echo $c_sitename ?> - Purchase Gift Cards</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="../assets/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../assets/css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="">
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
                  <a class="nav-link" href="<?php echo $c_homeurl; ?>/billing/balance">Balance <span class="sr-only">(balance)</span></a>
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
        <?php if($_GET["cardcode"]){
          echo 'Your Gift Card Code:<br><FONT COLOR="#381c74">'.$_GET["cardcode"].'</FONT><br>Write that down! We won\'t show it again!';
        } else {
            echo '<FONT COLOR="RED">Error!</FONT><br>Something went very wrong. <br>We know you payed but your code couldn\'t generate.<br>Contact our support team!';
        }
        ?>
        </h2>
      </div>

      <div class="service_container">
        <div class="box">
          <div class="img-box">
            <img src="../assets/img/question-mark.png" class="img1" alt="">
            <img src="../assets/img/question-mark.png" class="img2" alt="">
          </div>
          <div class="detail-box">
            <h5>
              What did I just buy?
            </h5>
            <p>
              You've bought a gift card for <?php echo $c_sitename ?>. You can use this for adding account balance or be a good friend and give it to someone. Either way, currency is bound to that code and anyone can use it until it's empty!
            </p>
          </div>
        </div>
        <div class="box active">
          <div class="img-box">
            <img src="../assets/img/warn.png" class="img1" alt="">
            <img src="../assets/img/warn.png" class="img2" alt="">
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
            <img src="../assets/img/money-bag.png" class="img1" alt="">
            <img src="../assets/img/money-bag.png" class="img2" alt="">
          </div>
          <div class="detail-box">
            <h5>
              How do I use these?
            </h5>
            <p>
              You can redeem your gift cards <a href="<?php echo $c_homeurl ?>/balance" target="_blank"> here</a>! Just enter your gift card code there, and press "Confirm" and we will add the credits to your account!
            </p>
          </div>
        </div>
      </div>
      <div>
      <?php
        if(isset($_COOKIE["transactionid"]) && isset($_COOKIE["touser"]) && isset($_COOKIE["street"]) && isset($_COOKIE["state"]) && isset($_COOKIE["zipcode"]) && isset($_COOKIE["country"]) && isset($_COOKIE["amount"])){
            
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
	            $servername = $c_servername;
	            $username = $c_username;
	            $password = $c_password;
	            $dbname = $c_dbname;
  
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
                date_default_timezone_set($c_timezone); //this is where paypal headquarters are so it makes it easier to file for stuff if paypal comes after you
                $time = date(DATE_RFC2822);

                $sql = "SELECT invoice FROM invoices WHERE invoice = '$ptransactionid'";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) == 0) {
                  $sql = "INSERT INTO invoices (`touser`, `street`, `state`, `country`, `zipcode`, `invoice`, `quantity`, `timestamp`) VALUES ('$ptouser','$pstreet','$pstate','$pcountry','$pzipcode','$ptransactionid','$pamount','$time')";
                  $result = mysqli_query($conn, $sql);
                } else {
                    //invoice already exist
                }
      
                mysqli_close($conn);
            }


            echo '<a href="'.$c_invoicegateway.'?transactionid='.$transactionid.'&output=HTML" target="_blank"><strong>View Invoice</strong></a>';
            echo '<br><a href="'.$c_invoicegateway.'?transactionid='.$transactionid.'&output=PDF" target="_blank"><strong>Download PDF</strong></a>';
            echo '<br><br>Transaction ID: '.$transactionid;
        } else {
            echo "You have cookies blocked so the invoice can't be generated!";
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
              &copy; <?= date("Y"); ?> All Rights Reserved By
              <a href="<?php echo $c_homeurl ?>"><?php echo $c_sitename ?></a>
            </p>
          </div>
        </div>
      </div>
    </section>
    <!-- footer section -->

  </div>



  <script type="text/javascript" src="../assets/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="../assets/js/bootstrap.js"></script>
  <?php
  $amount = htmlspecialchars($_GET['amountpaid']);
  $uid = htmlspecialchars($_GET['userid']);
  ?>

</body>

</html>
