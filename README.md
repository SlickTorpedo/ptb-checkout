**YOU WILL NEED A PAYPAL BUISNESS ACCOUNT FOR THIS**

**YOU WILL NEED THE MUBEEN BILLING MODULE FOR THIS**

#

**UPDATE SINCE V1:**

- Creator code removed *(because it doesn't work perfectly but will be there for V3 with the addition of discount code)*<br>
- Improved notification system to send discord messages to each order<br>
- Improvement of the configuration file<br>
- Improvement of some parts of the code<br>
- Added the possibility to easily customize the design of the pages<br>
- New design for the generation of invoices with 6 templates<br>
- A lot of little things here and there<br>

#

There's also some other security upgrades, stuff to make it run faster, and a lot of other things like that. Enjoy!

#

**SETUP**

1. **Download** the code as a zip
2. **Unzip** the file
3. **Place** `checkout` into your /var/www/pterodactyl/public directory!

4. **Connection to MySql** - ```mysql -u root -p```
5. **Create Database** `checkout` - ```CREATE DATABASE checkout;```
6. **Create User** `checkout` - ```CREATE USER 'checkout'@'localhost' IDENTIFIED BY 'password';```
7. **Give the privilege** to the user `checkout` for the database `checkout` - ```GRANT ALL PRIVILEGES ON checkout.* TO 'checkout'@'localhost'  WITH GRANT OPTION;```
8. **Give the privilege** to the user `checkout` for the database `panel` *(pterodactyl panel)* - ```GRANT ALL PRIVILEGES ON panel.* TO 'checkout'@'localhost'  WITH GRANT OPTION;```
9. **create the tables** in the database `checkout` :
	- ```CREATE TABLE creatorcodes (codename LONGTEXT, type LONGTEXT, amount BIGINT);``` *(For the creator code but will not be used in this version, __but you must create the table for the proper functioning!__)*<br>
	- ```CREATE TABLE creatoruses (codename LONGTEXT, valid BIGINT, userid BIGINT, timestamp BIGINT, ip LONGTEXT);``` *(To have a trace of the codes used but will not be used in this version, __but you must create the table for the proper functioning!__)*<br>
	- ```CREATE TABLE invoices (touser LONGTEXT, street LONGTEXT, state LONGTEXT, country LONGTEXT, zipcode BIGINT, quantity BIGINT, invoice LONGTEXT, timestamp LONGTEXT);``` *(For the invoice generation system)* <br>
10. Completed the configuration file in `/checkout/config.php`
11. Go to the `PANEL` folder and follow the instructions for modifications on the pterodactyl panel

#

If you have a concern, a misunderstanding, ideas for improvement, or just want to support us, feel free to join the Discord server: https://discord.gg/nH4H97cYVA

#

Create by `Slick` and <a href="https://www.buymeacoffee.com/ikiae">`Ikiae`</a>

Made with Love ❤️
