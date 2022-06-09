<?php

/* ------------------------

 WEBSITE

 ------------------------*/

$c_sitename = "Name";
// Your Site Name
// This will appear around the page such as the header, asking for discount codes, etc etc.

$c_homeurl = "https://domain.com";
// This is your homepage. If you installed this module on pterodactyl, it will be panel.yoursite.com or whatever you have. If it's on another web server, just put the address here!

$c_favicon = "/favicons/favicon.ico";
// url favicon
// default: /favicons/favicon.ico

$c_paypaltoken = "test";
// You need a buisness account for this, here's how to get it:
// video: https://youtu.be/MxYnR4qzUQI
// default: test

$c_currency = "USD"
// currency
// check code here: https://developer.paypal.com/api/rest/reference/currency-codes
// default: USD

$c_paymentgateway = "/checkout/payment";
// If you don't know what you are doing leave it as default
// default: /checkout/payment

$c_giftcardgateway = "/checkout/giftcard";
// If you don't know what you are doing leave it as default
// default: /checkout/giftcard

$c_invoicegateway = "/checkout/invoices";
// If you don't know what you are doing leave it as default
// default: /checkout/invoices

/* ------------------------

 DISCORD

 ------------------------*/

$c_discord = "https://discord.gg/nH4H97cYVA";
// Your discord link
// default: https://discord.gg/nH4H97cYVA (Discord Helper)

$c_webhook = "https://discordapp.com/api/webhooks/xxxxxxxxxxxxxxxxxx/xxxxxxxxxxxxxxxxxx";
// Your discord webhook
// default: https://discordapp.com/api/webhooks/xxxxxxxxxxxxxxxxxx/xxxxxxxxxxxxxxxxxx

$c_embedcolor = "FFFFFF";
// Your discord embed color
// default: FFFFFF

$c_timezone = "America/New_York";
// Time Zone
// http://www.healthstream.com/hlchelp/Administrator/Classes/HLC_Time_Zone_Abbreviations.htm (LiveMeeting column)
// default: America/New_York

/* ------------------------

 DATABASE CONNECTION STUFF

 ------------------------*/

$c_servername = "localhost";
// your ip for sql
// defaut: localhost

$c_username = "checkout";
// your username for sql

$c_password = "xxxxxxxxxxxxxxxxxx";
// your password for sql

$c_dbname = "checkout";
// your database name

/* ------------------------

 PANEL DATABASE

 ------------------------*/

$c_servernamep = "localhost";
// your ip for sql (PANEL DATABASE)
// default: localhost

$c_usernamep = "checkout";
// your username for sql (PANEL DATABASE)
// default: checkout

$c_passwordp = "xxxxxxxxxxxxxxxxxx";
// your password for sql (PANEL DATABASE)

$c_dbnamep = "panel";
// your database name (PANEL DATABASE)
// default: panel

/* ------------------------

 INVOICE

 ------------------------*/

$c_invoicetemplate = "simple";
// chose your templates : simple, apple, banana, blueberry, lime, strawberry
// default: simple

$c_invoicelogo = "/favicons/favicon.ico";
// url to company logo
// default: /favicons/favicon.ico
// preview HTML: /checkout/invoices/?output=HTML
// preview PDF: /checkout/invoices/?output=PDF

$c_invoiceaddress = "Street Address, City, State, Zip";
// address company
// default: Street Address, City, State, Zip

$c_invoicephone = "Phone: xxx-xxx-xxx";
// phone company
// default: Phone: xxx-xxx-xxx

$c_invoiceemail = "contact@domain.com";
// contact email company
// default: contact@domain.com

?>

<!-- Don't touch this -->
<script>
    if(document.location.href.indexOf('config') > -1) {
        document.location.href = '/billing/balance';
    }
</script>
