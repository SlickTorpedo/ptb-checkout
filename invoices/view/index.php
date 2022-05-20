<!DOCTYPE html>
<head>
  <?php
  if($_GET["invoiceid"]){
    $invoiceid = $_GET["invoiceid"];
  } else {
    $invoiceid = "NULL";
  }
  include '../config.php';
  ?>
  <title>Invoice <?php echo $invoiceid; ?></title>
</head>
<?php
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
  	
	$pinvoiceid = mysqli_real_escape_string($conn, $invoiceid);

  	$sql = "SELECT * FROM invoices WHERE uniqueid = '$pinvoiceid'";
  	$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
            $to = $row["touser"];
            $street = $row["street"];
            $state = $row["state"];
            $country = $row["country"];
            $zipcode = $row["zipcode"];
            $invoice = $row["invoice"];
            $uniqueid = $row["uniqueid"];
            $quantity = $row["quantity"];
          	$time = $row["timestamp"];
	    }
	} else {
        //do nothing
	}


	mysqli_close($conn);
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link type="text/css" rel="stylesheet" href="resources/sheet.css">
<style type="text/css">
    .ritz .waffle a {
        color: inherit;
    }

    .ritz .waffle .s16 {
        background-color: #bbdef1;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: 'Arial';
        font-size: 8pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s14 {
        background-color: #ffffff;
        text-align: right;
        font-weight: bold;
        color: #000000;
        font-family: 'Arial';
        font-size: 8pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s11 {
        background-color: #ffffff;
        text-align: right;
        color: #000000;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s1 {
        background-color: #1f65a6;
        text-align: right;
        font-weight: bold;
        color: #404040;
        font-family: 'Arial';
        font-size: 12pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s13 {
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: 'Arial';
        font-size: 8pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s2 {
        background-color: #1f65a6;
        text-align: right;
        font-weight: bold;
        color: #ffffff;
        font-family: 'Arial';
        font-size: 12pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s19 {
        background-color: #1f65a6;
        text-align: right;
        font-weight: bold;
        color: #ffffff;
        font-family: 'Arial';
        font-size: 24pt;
        vertical-align: top;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s3 {
        background-color: #1f65a6;
        text-align: right;
        color: #ffffff;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s5 {
        background-color: #1f65a6;
        text-align: right;
        color: #ffffff;
        font-family: 'Arial';
        font-size: 10pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s18 {
        background-color: #bbdef1;
        text-align: left;
        color: #404040;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: top;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s4 {
        background-color: #1f65a6;
        text-align: left;
        color: #ffffff;
        font-family: 'Arial';
        font-size: 36pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s8 {
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: 'Arial';
        font-size: 8pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s6 {
        background-color: #ffffff;
    }

    .ritz .waffle .s0 {
        background-color: #1f65a6;
        text-align: left;
        color: #000000;
        font-family: 'Arial';
        font-size: 10pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s7 {
        background-color: #ffffff;
        text-align: left;
        color: #000000;
        font-family: 'Arial';
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s9 {
        background-color: #ffffff;
        text-align: right;
        font-weight: bold;
        color: #000000;
        font-family: 'Arial';
        font-size: 8pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s12 {
        background-color: #ffffff;
        text-align: left;
        color: #000000;
        font-family: 'Arial';
        font-size: 9pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s10 {
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: 'Arial';
        font-size: 12pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s15 {
        background-color: #bbdef1;
        text-align: left;
        color: #000000;
        font-family: 'Arial';
        font-size: 10pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }

    .ritz .waffle .s17 {
        background-color: #1f65a6;
        text-align: right;
        font-weight: bold;
        color: #ffffff;
        font-family: 'Arial';
        font-size: 8pt;
        vertical-align: bottom;
        white-space: nowrap;
        direction: ltr;
        padding: 0px 3px 0px 3px;
    }
</style>
<div class="ritz grid-container" dir="ltr">
    <table class="waffle no-grid" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th style="visibility: hidden" class="row-header freezebar-origin-ltr"></th>
                <th id="203700182C0" style="width:42px;" class="column-headers-background"></th>
                <th id="203700182C1" style="width:114px;" class="column-headers-background"></th>
                <th id="203700182C2" style="width:114px;" class="column-headers-background"></th>
                <th id="203700182C3" style="width:281px;" class="column-headers-background"></th>
                <th id="203700182C4" style="width:69px;" class="column-headers-background"></th>
                <th id="203700182C5" style="width:61px;" class="column-headers-background"></th>
                <th id="203700182C6" style="width:53px;" class="column-headers-background"></th>
                <th id="203700182C7" style="width:65px;" class="column-headers-background"></th>
                <th id="203700182C8" style="width:40px;" class="column-headers-background"></th>
            </tr>
        </thead>
        <tbody>
            <tr style="height: 51px">
                <th id="203700182R0" style="visibility: hidden" style="height: 51px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 51px">1</div>
                </th>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s1"></td>
                <td class="s0"></td>
            </tr>
            <tr style="height: 20px">
                <th id="203700182R1" style="visibility: hidden" style="height: 20px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 20px">2</div>
                </th>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s2" dir="ltr" colspan="4"><?php echo $c_sitename ?></td>
                <td class="s0"></td>
            </tr>
            <tr style="height: 20px">
                <th id="203700182R2" style="visibility: hidden" style="height: 20px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 20px">3</div>
                </th>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s3" dir="ltr" colspan="4">[[Redacted]]</td>
                <td class="s0"></td>
            </tr>
            <tr style="height: 20px">
                <th id="203700182R3" style="visibility: hidden" style="height: 20px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 20px">4</div>
                </th>
                <td class="s0"></td>
                <td class="s4" dir="ltr" colspan="3" rowspan="3"><?php echo $c_sitename ?> Invoice</td>
                <td class="s5" dir="ltr" colspan="4"><?php echo $c_city; ?></td>
                <td class="s0"></td>
            </tr>
            <tr style="height: 20px">
                <th id="203700182R4" style="visibility: hidden" style="height: 20px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 20px">5</div>
                </th>
                <td class="s0"></td>
                <td class="s5" dir="ltr" colspan="4"><?php echo $c_state; ?></td>
                <td class="s0"></td>
            </tr>
            <tr style="height: 20px">
                <th id="203700182R5" style="visibility: hidden" style="height: 20px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 20px">6</div>
                </th>
                <td class="s0"></td>
                <td class="s5" dir="ltr" colspan="4"><?php echo $c_zipcode; ?></td>
                <td class="s0"></td>
            </tr>
            <tr style="height: 48px">
                <th id="203700182R6" style="visibility: hidden" style="height: 48px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 48px">7</div>
                </th>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s0"></td>
                <td class="s0"></td>
            </tr>
            <tr style="height: 20px">
                <th id="203700182R7" style="visibility: hidden" style="height: 20px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 20px">8</div>
                </th>
                <td></td>
                <td class="s6" colspan="7"></td>
                <td></td>
            </tr>
            <tr style="height: 20px">
                <th id="203700182R8" style="visibility: hidden" style="height: 20px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 20px">9</div>
                </th>
                <td class="s7"></td>
                <td class="s8" dir="ltr" colspan="4">BILL TO: <?php echo $to; ?></td>
                <td class="s9" colspan="3">Transaction ID</td>
                <td></td>
            </tr>
            <tr style="height: 29px">
                <th id="203700182R9" style="visibility: hidden" style="height: 29px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 29px">10</div>
                </th>
                <td class="s7"></td>
                <td class="s10" colspan="4"></td>
                <td class="s11" dir="ltr" colspan="3"><?php echo $invoice; ?></td>
                <td></td>
            </tr>
            <tr style="height: 29px">
                <th id="203700182R10" style="visibility: hidden" style="height: 29px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 29px">11</div>
                </th>
                <td class="s7"></td>
                <td class="s12" dir="ltr" colspan="4"><?php echo $street; ?></td>
                <td class="s9" colspan="3">DATE</td>
                <td></td>
            </tr>
            <tr style="height: 29px">
                <th id="203700182R11" style="visibility: hidden" style="height: 29px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 29px">12</div>
                </th>
                <td class="s7"></td>
                <td class="s12" dir="ltr" colspan="4"><?php echo $state; ?></td>
                <?php 
                date_default_timezone_set('America/Los_Angeles');
                $date = date(DATE_RFC2822);
                ?>
                <td class="s11" dir="ltr" colspan="3"><?php echo $time; ?></td>
                <td></td>
            </tr>
            <tr style="height: 29px">
                <th id="203700182R12" style="visibility: hidden" style="height: 29px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 29px">13</div>
                </th>
                <td class="s7"></td>
                <td class="s12" dir="ltr" colspan="4"><?php echo $country; ?></td>
                <td class="s9" colspan="3">INVOICE DUE DATE</td>
                <td></td>
            </tr>
            <tr style="height: 29px">
                <th id="203700182R13" style="visibility: hidden" style="height: 29px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 29px">14</div>
                </th>
                <td class="s7"></td>
                <td class="s12" dir="ltr" colspan="4"><?php echo $zipcode; ?></td>
                <td class="s11" dir="ltr" colspan="3"><?php echo $time; ?></td>
                <td></td>
            </tr>
            <tr style="height: 36px">
                <th id="203700182R14" style="visibility: hidden" style="height: 36px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 36px">15</div>
                </th>
                <td></td>
                <td class="s6" colspan="7"></td>
                <td></td>
            </tr>
            <tr style="height: 20px">
                <th id="203700182R15" style="visibility: hidden" style="height: 20px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 20px">16</div>
                </th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="height: 20px">
                <th id="203700182R16" style="visibility: hidden" style="height: 20px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 20px">17</div>
                </th>
                <td></td>
                <td class="s13">ITEMS</td>
                <td class="s13" colspan="2">DESCRIPTION</td>
                <td class="s14">QUANTITY</td>
                <td class="s14">PRICE</td>
                <td class="s14">TAX</td>
                <td class="s14">AMOUNT</td>
                <td></td>
            </tr>
            <tr style="height: 39px">
                <th id="203700182R17" style="visibility: hidden" style="visibility: hidden" style="height: 39px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 39px">18</div>
                </th>
                <td></td>
                <td class="s12" dir="ltr">Account Credit</td>
                <td class="s12" dir="ltr" colspan="2"><?php echo $c_sitename ?> account credit. $1.00 USD / Credit</td>
                <td class="s11" dir="ltr"><?php echo $quantity ?></td>
                <?php
                $price = $quantity * 1;
                $price = "$" . $price . ".00";
                ?>
                <td class="s11" dir="ltr">$1.00</td>
                <td class="s11">0.00%</td>
                <td class="s11"><?php echo $price; ?></td>
                <td></td>
            </tr>
            <tr style="height: 16px">
                <th id="203700182R18" style="visibility: hidden" style="height: 16px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 16px">19</div>
                </th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="height: 34px">
                <th id="203700182R19" style="visibility: hidden" style="height: 34px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 34px">20</div>
                </th>
                <td class="s15"></td>
                <td class="s16">NOTES:</td>
                <td class="s15"></td>
                <td class="s15"></td>
                <td class="s17" colspan="4">TOTAL</td>
                <td class="s0"></td>
            </tr>
            <tr style="height: 20px">
                <th id="203700182R20" style="visibility: hidden" style="height: 20px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 20px">21</div>
                </th>
                <td class="s15" rowspan="2"></td>
                <td class="s18" colspan="3" rowspan="2"></td>
                <td class="s19" colspan="4" rowspan="2"><?php echo $price ?></td>
                <td class="s0" rowspan="2"></td>
            </tr>
            <tr style="height: 57px">
                <th id="203700182R21" style="visibility: hidden" style="height: 57px;" class="row-headers-background">
                    <div class="row-header-wrapper" style="line-height: 57px">22</div>
                </th>
            </tr>
        </tbody>
    </table>
</div>
