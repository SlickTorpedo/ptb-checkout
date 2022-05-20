<!DOCTYPE html>
<head>
</head>
<body>
</body>
<script>
  	
      const request = new XMLHttpRequest();
      request.open("POST", "https://discord.com/api/webhooks/0000000000000000/ABC123"); //You can change this to urs if you want notifications

      request.setRequestHeader('Content-type', 'application/json');

      const params = {
        username: "NS Discounts",
        avatar_url: "https://nexussociety.net/favicon.ico",
        content: "Discount Code Used!\n Code: <?php echo $_POST["discountcode"]; ?>"
      }

      request.send(JSON.stringify(params));
  </script>
