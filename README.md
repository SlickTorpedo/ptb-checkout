# There is a security vulnerability with this, please do not use this software right now.

**YOU WILL NEED A PAYPAL BUISNESS ACCOUNT FOR THIS**

**YOU WILL NEED THE MUBEEN BILLING MODULE FOR THIS**

# **UPDATE SINCE V1:**

- Creator code removed *(because it doesn't work perfectly but will be there for V3 with the addition of discount code)*<br>
- Improved notification system to send discord messages to each order<br>
- Improvement of the configuration file<br>
- Improvement of some parts of the code<br>
- Added the possibility to easily customize the design of the pages<br>
- New design for the generation of invoices with 6 templates<br>
- A lot of little things here and there<br>

There's also some other security upgrades, stuff to make it run faster, and a lot of other things like that. Enjoy!

# **SETUP**

1. **Download** the code as a zip
2. **Unzip** the file
3. **Place** `checkout` into your /var/www/pterodactyl/public directory!
4. **Set Permissions** for web server :
	- If using NGINX or Apache (not on CentOS) - ```chown -R www-data:www-data /var/www/pterodactyl/public/checkout/*```
	- If using NGINX on CentOS - ```chown -R nginx:nginx /var/www/pterodactyl/public/checkout/*```
	- If using Apache on CentOS - ```chown -R apache:apache /var/www/pterodactyl/public/checkout/*```

5. **Connection to MySql** - ```mysql -u root -p```
6. **Create Database** `checkout` - ```CREATE DATABASE checkout;```
7. **Create User** `checkout` - ```CREATE USER 'checkout'@'localhost' IDENTIFIED BY 'password';```
8. **Give the privilege** to the user `checkout` for the database `checkout` - ```GRANT ALL PRIVILEGES ON checkout.* TO 'checkout'@'localhost'  WITH GRANT OPTION;```
9. **Give the privilege** to the user `checkout` for the database `panel` *(pterodactyl panel)* - ```GRANT ALL PRIVILEGES ON panel.* TO 'checkout'@'localhost'  WITH GRANT OPTION;```
10. **create the tables** in the database `checkout` :
	- ```USE checkout;``` *(Enter in `checkout` database)*
	- ```CREATE TABLE creatorcodes (codename LONGTEXT, type LONGTEXT, amount BIGINT);``` *(For the creator code but will not be used in this version, __but you must create the table for the proper functioning!__)*<br>
	- ```CREATE TABLE creatoruses (codename LONGTEXT, valid BIGINT, userid BIGINT, timestamp BIGINT, ip LONGTEXT);``` *(To have a trace of the codes used but will not be used in this version, __but you must create the table for the proper functioning!__)*<br>
	- ```CREATE TABLE invoices (touser LONGTEXT, street LONGTEXT, state LONGTEXT, country LONGTEXT, zipcode BIGINT, quantity BIGINT, invoice LONGTEXT, timestamp LONGTEXT);``` *(For the invoice generation system)* <br>
11. **Completed the configuration file** in `/checkout/config.php`
12. **Go to the `PANEL` folder** and **follow the instructions** for modifications on the pterodactyl panel
13. **Edit CSS** in the file `/checkout/assets/css/style.css` - Edit only the information in the `root` section *(optional)*

14. If you are **not using PHP 7.4** by default you must install it and configure Nginx to use the version for our files. Follow the instructions below : 
	- Run `sudo add-apt-repository ppa:ondrej/php` for add PHP repository
	- Run `sudo apt-get update` for update repository
	- Run `sudo apt-get install php7.4 php7.4-fpm php7.4-xml php7.4-mysql php7.4-gd php7.4-curl php7.4-mbstring` for install PHP 7.4 and extension
	- Config web server :
		- APACHE : *If you have an apache server please contact us as we have not done any testing yet. This will allow us to complete the documentation while solving your problem.*
		- NGINX : In `/etc/nginx/site-available/pterodactyl.conf` add before `location ~ \.php$ {` this
	```
	location ~ "^\/checkout\/.*\.php$" {
		fastcgi_pass unix:/run/php/php7.4-fpm.sock;
		fastcgi_index index.php;
		include fastcgi_params;
		fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
	}
	```

# DEMO

<img width="900" style="inline-block" src="https://github.com/SlickTorpedo/ptb-checkout/blob/V2/DEMO.gif?raw=true">

# INVOICE TEMPLATE
<p float="left">
  <img width="300" style="inline-block" src="https://code-boxx.com/wp-content/uploads/2021/11/illus-invoicr-1.png">
  <img width="300" style="inline-block" src="https://code-boxx.com/wp-content/uploads/2021/11/illus-invoicr-2.png">
  <img width="300" style="inline-block" src="https://code-boxx.com/wp-content/uploads/2021/11/illus-invoicr-3.png">
  <img width="300" style="inline-block" src="https://code-boxx.com/wp-content/uploads/2021/11/illus-invoicr-4.png">
  <img width="300" style="inline-block" src="https://code-boxx.com/wp-content/uploads/2021/11/illus-invoicr-5.png">
  <img width="300" style="inline-block" src="https://code-boxx.com/wp-content/uploads/2021/11/illus-invoicr-6.png">
</p><br>

#

If you have a concern, a misunderstanding, ideas for improvement, or just want to support us, feel free to join the Discord server: https://discord.gg/nH4H97cYVA

#

Create by <a href="https://nexussociety.net">`Slick`</a> and <a href="https://www.buymeacoffee.com/ikiae">`Ikiae`</a>

Made with Love ❤️
