<!DOCTYPE html>
<head>
    <?php
    	include '../config.php';

        if($_GET["transactionid"]){
            $transactionid = $_GET["transactionid"];
        } else {
            $transactionid = "NULL";
        }
    ?>
    <title><?php echo $c_sitename; ?> - Invoice <?php echo $transactionid; ?></title>
    <link rel="icon" type="image/png" href="<?php echo $c_favicon; ?>" />
</head>
<?php

if($_GET["output"]){
    $ouptut = 'output' . $_GET["output"];
} else {
    $ouptut = "outputHTML";
}

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
  	
	$invoiceid = mysqli_real_escape_string($conn, $transactionid);

  	$sql = "SELECT * FROM invoices WHERE invoice = '$invoiceid'";
  	$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
            $to = $row["touser"];
            $street = $row["street"];
            $state = $row["state"];
            $country = $row["country"];
            $zipcode = $row["zipcode"];
            $invoice = $row["invoice"];
            $quantity = $row["quantity"];
          	$time = $row["timestamp"];
	    }
	} else {
        //do nothing
	}


	mysqli_close($conn);
}

$price = $quantity * 1;

// (A) LOAD INVOICR
require "lib/invoicr.php";

// (B) SET INVOICE DATA
// (B1) COMPANY INFORMATION
// RECOMMENDED TO JUST PERMANENTLY CODE INTO INVLIB/INVOICR.PHP > (C1)
$invoicr->set("company", [
	$c_invoicelogo, // URL TO COMPANY LOGO, FOR HTML INVOICES
    $c_invoicelogo, // FILE PATH TO COMPANY LOGO, FOR PDF/DOCX INVOICES
    $c_sitename,
    $c_invoiceaddress,
    $c_invoicephone,
    $c_invoiceemail,
    $c_homeurl
]);

// (B2) INVOICE HEADER
$invoicr->set("head", [
	["Invoice #", $invoice],
	["DOP", $time],
//	["P.O. #", "CB-789-123"],
	["Due Date", $time]
]);

// (B3) BILL TO
$invoicr->set("billto", [
	$to,
	$street,
	$country, $state, $zipcode
]);

// (B4) SHIP TO
$invoicr->set("shipto", [
	$to,
	$street,
	$country, $state, $zipcode
]);

// (B5) ITEMS - ADD ONE-BY-ONE
$items = [
	["Account Credit", $c_sitename . " account credit. $1.00 USD / Credit", $quantity, "$1.00", "$" . $price . ".00"]
];
// foreach ($items as $i) { $invoicr->add("items", $i); }

// (B6) ITEMS - OR SET ALL AT ONCE
$invoicr->set("items", $items);

// (B7) TOTALS
$invoicr->set("totals", [
	["SUB-TOTAL", "$" . $price . ".00"],
	["DISCOUNT 0%", "-$0.00"],
	["GRAND TOTAL", "$" . $price . ".00"]
]);

// (B8) NOTES, IF ANY
$invoicr->set("notes", [
	"Notes:"
]);

// (C) OUTPUT

$invoicr->template($c_invoicetemplate);

$invoicr->$ouptut();

// (C1) CHOOSE A TEMPLATE
// $invoicr->template("apple");
// $invoicr->template("banana");
// $invoicr->template("blueberry");
// $invoicr->template("lime");
// $invoicr->template("simple");
// $invoicr->template("strawberry");

// (C2) OUTPUT IN HTML
// DEFAULT : DISPLAY IN BROWSER
// 1 : DISPLAY IN BROWSER
// 2 : FORCE DOWNLOAD
// 3 : SAVE ON SERVER
// $invoicr->outputHTML();
// $invoicr->outputHTML(1);
// $invoicr->outputHTML(2, "invoice.html");
// $invoicr->outputHTML(3, __DIR__ . DIRECTORY_SEPARATOR . "invoice.html");

// (C3) OUTPUT IN PDF
// DEFAULT : DISPLAY IN BROWSER
// 1 : DISPLAY IN BROWSER
// 2 : FORCE DOWNLOAD
// 3 : SAVE ON SERVER
// $invoicr->outputPDF();
// $invoicr->outputPDF(1);
// $invoicr->outputPDF(2, "invoice.pdf");
// $invoicr->outputPDF(3, __DIR__ . DIRECTORY_SEPARATOR . "invoice.pdf");

// (C4) OUTPUT IN DOCX
// DEFAULT : FORCE DOWNLOAD
// 1 : FORCE DOWNLOAD
// 2 : SAVE ON SERVER
// $invoicr->outputDOCX();
// $invoicr->outputDOCX(1, "invoice.docx");
// $invoicr->outputDOCX(2, __DIR__ . DIRECTORY_SEPARATOR . "invoice.docx");

// (D) USE RESET() IF YOU WANT TO CREATE ANOTHER ONE AFFTER THIS
// $invoicr->reset();
