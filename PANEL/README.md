1. **Go to** `/var/www/pterodactyl/app/Models/Billing/PayPal.php`
2. **Line `20`** change ```https://ipnpb.paypal.com/cgi-bin/webscr``` to ```https://panel.domain.com/checkout/payment``` *(Change domain url with your domain url to panel)*
3. **Replaced at the bottom of the file**
```
  public function generateForm($amount)
  {
    echo
    '<body onload="document.redirectform.submit()">   
        <form method="POST" action="'.$this->paypal_url.'" name="redirectform" style="display:none">
        <input name="cmd" value="_xclick">
        <input name="business" value="' .  $this->merchant_email . '">
        <input name="item_name" value="Billing Balance">
        <input name="item_number" value="' . Auth::user()->id . '">
        <input name="amount" value="' . $amount. '">
        <input name="currency_code" value="' . $this->currency . '">
        <input name="cancel_return" value="' . route('billing.balance') . '">
        <input name="notify_url" value="' . route('paypal.listener') . '">
        <input name="return" value="' . route('billing.balance') . '">
        <input name="rm" value="2">
        <input name="charset" value="utf-8">
        <input name="no_note" value="1">
        </form>
    </body>';
  }
```

TO

```
  public function generateForm($amount)
  {
    $amount = $amount + 1;
    echo
    '<body onload="document.redirectform.submit()">
        <form method="POST" action="https://panel.domain.com/payment/?amount='.$amount.'&uid=' . Auth::user()->id . '" name="redirectform">
        </form>
    </body>';
  }
```
*(Change domain url with your domain url to panel)*
