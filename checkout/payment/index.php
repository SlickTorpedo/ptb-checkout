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

  <title><?php echo $c_sitename ?> - Payment</title>

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
  
  <script>
    function addCookie(name, value) {
        document.cookie = name + "=" + value + ";";
    }


	function SubmitFormData() {
		var name = $("#name").val();
      	var email = $("#email").val();
      	var phone = $("#phone").val();
      	var gender = $("input[type=radio]:checked").val();
      	var uid = getPageURL();
      	$('#codename').html(name);
      	$.post("submit.php", { name: name, uid: uid},
			function(data) {
          	$('#results').html(data);
          	$('#creatorcode')[0].reset();
        });
        
     }
    
    function getCurrentDiscountCode(){
      if (codename.textContent === "\n"){
        return "N/A";
      } else {
      	return codename.textContent;
      }
    }
      
    function redirectHome(){
      window.location.href = "<?php echo $c_homeurl; ?>/billing/balance";
    }
    
    function calculateDiscount(password, amount) {
		if (password === "387ec36b-54db-4b23-a52b-2c60c727b2eb0f96284b-be0b-4ff2-b563-8516c1ca42def3dc2082"){
            //do nothing
        } else {
          var tcouzigrshrdqwjeovwtrsffarfcnbzeikaniaccnopdpxhunby = 0;
          window.location.replace("<?php echo $c_homeurl; ?>");
        }
     }
    
    function getAmountByID(){
      if (amount.textContent === "\n"){
        return 0;
      } else {
      	return amount.textContent;
      }
    }
    
    function getPageURL(){
      var x = window.location.search.substr(1);
      var y = x.split('uid=');
      return y[1];
    }
  </script>

  <style>
    .myButton {
      box-shadow:0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
      border-color:var(--button-color);
      background-color:var(--button-color);
      border-radius:.25rem;
      display:inline-block;
      cursor:pointer;
      color:var(--text-button-color);
      font-family:Arial;
      font-size:15px;
      font-weight:bold;
      padding:6px 24px;
      text-decoration:none;
            
    }
    .myButton:hover {
      transform: translateY(-1px);
      box-shadow: 0 7px 14px rgba(50, 50, 93, .1), 0 3px 6px rgba(0, 0, 0, .08);
      color:var(--text-button-color);
    }
          
    .myButton:active {
      position:relative;
      top:1px;
    }
  </style>

</head>

<body class="sub_page">

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="">
            <span>
              Payment
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
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="javascript:history.back()">Back <span class="sr-only">(back)</span></a>
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
          Choose your payment method
        </h2>
      </div>

      <div class="service_container">
        <div class="box active">
          <?php
    		$amount = htmlspecialchars($_GET['amount']);
          	if($amount == 1){
              echo "Error! You must enter an amount to add!<br>Returning in 3 seconds!";
              echo '<script type="text/javascript">';
			        echo 'function Redirect() ';
              echo '{ window.location="'.$c_homeurl.'/billing/balance"; }';
              echo "setTimeout('Redirect()', 3000);";
              echo '</script>';
              die();
            }
          	if($amount < 2){
              echo '<script>redirectHome();</script>';
            }
    		if ($amount >=0)
    		{
      		$amount = $amount - 1;
    		} else {
      		$amount = 1;
    		}
          	$nsrandvar = $amount + 5318;
			?>
          	<input type="hidden" id="myText" value="<?php echo $amount ?>">
          	Purchasing <strong><?php echo $amount ?></strong> account credits<br><br>
    		<script src="https://www.paypal.com/sdk/js?client-id=<?php echo $c_paypaltoken ?>&currency=USD"></script>
            <!-- <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script> -->

    		<!-- Set up a container element for the button -->
    		<div id="paypal-button-container"></div>

    		<script>
      		function myFunction() {
 				var x = document.getElementById("myText").value;
              	var z = x - getAmountByID();
              	if (z < 0.1){
                  z = 1;
                } else {
                  z = z;
                }
        		return z;
	  		}
      
      		paypal.Buttons({
        		// Sets up the transaction when a payment button is clicked
        		createOrder: function(data, actions) {
          		return actions.order.create({
            		purchase_units: [{
              		amount: {
                		value: myFunction() // Can reference variables or functions. Example: `value: document.getElementById('...').value`
              		}
            		}]
          		});
        		},

        		// Finalize the transaction after payer approval
        		onApprove: function(data, actions) {
          		return actions.order.capture().then(function(orderData) {
            		var element = document.getElementById('paypal-button-container');
            		//element.innerHTML = '';
            		//element.innerHTML = '<h3>Payment successful. Redirecting now!</h3>';
                    <?php
            					function generateRandomString($length = 15) {
                					return substr(str_shuffle(str_repeat($x='123456789', ceil($length/strlen($x)) )),1,$length);
            					}

            					$myfile = fopen("protectedintfilekey.txt", "w") or die("Unable to open file!");
            					$txt = generateRandomString();
            					fwrite($myfile, $txt);
            					fclose($myfile);

                      $nsrandvar = $amount + $txt;
            				?>
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    const transaction = orderData.purchase_units[0].payments.captures[0];
                    var transactionid = `${transaction.id}`;
                    console.log(transactionid);
                    var firstname = orderData.payer.name.given_name;
                    var lastname = orderData.payer.name.surname;
                    var address = orderData.purchase_units[0].shipping.address.address_line_1;
                    var city = orderData.purchase_units[0].shipping.address.admin_area_2;
                    var state = orderData.purchase_units[0].shipping.address.admin_area_1;
                    var zip = orderData.purchase_units[0].shipping.address.postal_code;
                    var country = orderData.purchase_units[0].shipping.address.country_code;
                    var amount = orderData.purchase_units[0].amount.value;
                    var fullname = firstname + " " + lastname;
                    document.cookie = "transactionid=" + transactionid + ";";
                    document.cookie = "touser=" + fullname + ";";
                    document.cookie = "street=" + address + ";";
                    document.cookie = "state=" + city + " " + state + ";";
                    document.cookie = "zipcode=" + zip + ";";
                    document.cookie = "country=" + country + ";";
                    let amountreplace = amount.replace(".00", "");
                    document.cookie = "amount=" + amountreplace + ";";
           			actions.redirect('<?php echo $c_homeurl; ?><?php echo $c_paymentgateway; ?>/redirecting.php?id=<?php echo htmlspecialchars($_GET['uid']); ?>&varamt=<?php echo $nsrandvar ?>&privkey=<?php echo $txt ?>&discountcode=' + getCurrentDiscountCode() + '');
          		});
        		}
      		}).render('#paypal-button-container');

    		</script>
		      <a href="<?php echo $c_giftcardgateway; ?>/?amount=<?php echo $_GET["amount"]; ?>&uid=<?php echo $_GET["uid"]; ?>" class="myButton">Buy A Gift Card</a>
    		</div>
      </div>
    </div>
      <div id="amount" style="display: none;"></div>
      <div id="codename" style="display: none;"></div>
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
              <a href="<?php echo $c_homeurl; ?>"><?php echo $c_sitename ?></a>
            </p>
          </div>
        </div>
      </div>
    </section>
    <!-- footer section -->

  </div>



  <script type="text/javascript" src="../assets/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="../assets/js/bootstrap.js"></script>

</body>

</html>
