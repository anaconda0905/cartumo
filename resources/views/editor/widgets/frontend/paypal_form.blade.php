<html>
<body>
<form id="paypal_payment_form" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_xclick">
  <!--<input type="hidden" name="cmd" value="_notify-validate">-->
  <input type="hidden" name="business" value="{{ $data['business'] }}">
  <input type="hidden" name="item_name_1" value="{{ $data['item_name_1'] }}">
  <input type="hidden" name="item_number" value="{{ $data['item_number_1'] }}">
  <input type="hidden" name="amount" value="{{ $data['amount_1'] }}">
  <input type="hidden" name="tax" value="1">
  <input type="hidden" name="quantity" value="{{ $data['quantity_1'] }}">
  <input type="hidden" name="currency_code" value="USD">

    @if ( !empty($data['item_number_2']) ) 
        
        <input type="hidden" name="item_number_2" value="{{ $data['item_number_2'] }}">
        <input type="hidden" name="amount_2" value="{{ $data['amount_2'] }}">
        <input type="hidden" name="tax" value="1">
        <input type="hidden" name="quantity_2" value="{{ $data['quantity_2'] }}">        
    @endif

  <input type="hidden" name="notify_url" value="{{ $data['return_url'] }}">
  <input type="hidden" name="return" value="{{ $data['return_url'] }}">
  <input type="hidden" name="cancel_return" value="{{ $data['cancel_url'] }}">

  <!-- Enable override of buyers's address stored with PayPal .
  <input type="hidden" name="address_override" value="1">-->
  <!-- Set variables that override the address stored with PayPal. -->
  <input type="hidden" name="first_name" value="{{ $data['first_name'] }}">
  <input type="hidden" name="last_name" value="{{ $data['last_name'] }}">
  <input type="hidden" name="address1" value="{{ $data['address1'] }}">
  <input type="hidden" name="city" value="{{ $data['city'] }}">
  <input type="hidden" name="state" value="{{ $data['state'] }}">
  <input type="hidden" name="zip" value="{{ $data['zip'] }}">
  <input type="hidden" name="country" value="{{ $data['country'] }}">  
</form>
</body>
</html>