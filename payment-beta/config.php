<?php
$c_sitename = "Nexus";
//Your Site Name
//This will appear around the page such as the header, asking for discount codes, etc etc.

$c_billingpage = "https://panel.nexussociety.net/billing/balance";
//This is your billing page. If someones thing fails or an outside source sends a request (aka someone trying brute force a code) it will redirect there.

$c_panelpage = "https://panel.nexussociety.net";
//Your panel page. For redirects and stuff.

$c_homeurl = "https://nexussociety.net";
//This is your homepage. If you installed this module on pterodactyl, it will be panel.yoursite.com or whatever you have. If it's on another web server, just put the address here!

$c_paypaltoken = "test";
//You need a buisness account for this, here's how to get it:
//https://youtu.be/MxYnR4qzUQI

$c_paymentgateway = "https://nexussociety.net/giftcard-gateway";
//Just change it to "https://yoursite.com/giftcard-gateway
//Don't change the /giftcard-gateway part unless you really know what you're doing.

$c_invoices = "https://nexussociety.net/invoices/view";
//Where your invoices are stored.

$c_invoicesgen = "https://nexussociety.net/invoices/view/generatetoken";
//Where your invoice tokens are created

$c_discord = "https://discord.gg/BXgjaFSsEe";
//Your discord

/* ------------------------

 DATABASE CONNECTION STUFF

 ------------------------*/

$c_servername = "localhost";
//your ip for sql

$c_username = "root";
//your username for sql

$c_password = "password";
//your password for sql

$c_dbname = "Nexus";
//your database name

/* ------------------------

 PANEL DATABASE

 ------------------------*/

$c_servernamep = "localhost";
//your ip for sql (PANEL DATABASE)

$c_usernamep = "root";
//your username for sql (PANEL DATABASE)

$c_passwordp = "password";
//your password for sql (PANEL DATABASE)

$c_dbnamep = "Nexus";
//your database name (PANEL DATABASE)
?>