**YOU WILL NEED A PAYPAL BUISNESS ACCOUNT FOR THIS**

#

The updated version of 

https://github.com/SlickTorpedo/wayzee-gateway

#

This was promised a long time ago and then the configuration file was holding me back but finally, it's ready!

#

What comes in the updated one:

Automatic Invoices<br>
Giftcard Purchases<br>
Search Invoices with Discord Bot<br>
Creator Codes and Discount Codes<br>
*Note, the panel for checking creator uses dosen't work yet. You have to use the database*<br>
A lot of little things here and there<br>

#

There's also some other security upgrades, stuff to make it run faster, and a lot of other things like that. Enjoy!

#

In order for it to work you will need to run the following SQL commands: **Make sure this is the database that is NOT the panel database in the config**

```CREATE TABLE creatorcodes (codename LONGTEXT, type LONGTEXT, amount BIGINT);``` <br>
```CREATE TABLE creatoruses (codename LONGTEXT, valid BIGINT, userid BIGINT, timestamp BIGINT, ip LONGTEXT);``` <br>
```CREATE TABLE invoices (touser LONGTEXT, street LONGTEXT, state LONGTEXT, country LONGTEXT, zipcode BIGINT, quantity BIGINT, invoice LONGTEXT, uniqueid LONGTEXT, timestamp LONGTEXT);``` <br>

Also there is a config file in all /payment-beta in /giftcard-gateway and /invoices that you will need to configure.


You can run these on your pterodactyl database if you want but it's not recommended. It may break something with billing module.

#

If at any point you are confused feel free to go here: https://discord.gg/DbfA6NfP

#

Thanks!


