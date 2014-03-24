<form name="_xclick" action="https://www.paypal.com/us/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="payments@wiselaws.com">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="item_name" value="<?php echo $firstname." ",$lastname; ?>">
<input type="hidden" name="amount" value="<?php echo $quote; ?>">
<input type="image" src="http://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>