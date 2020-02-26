<?php $details = json_decode($order->orderDetails->details); ?>

@if ( !empty($details->order->stripe) )
    <?php $details = $details->order->stripe; ?>
    <?php $billing_address = (!empty($details->billing->address1)) ? $details->billing->address1 : $details->billing->line1; ?>
    <?php $shipping_address = (!empty($details->shipping->address1)) ? $details->shipping->address1 : $details->shipping->line1; ?>
@else
    <?php $details = $details->order->paypal; ?>
    <?php $billing_address = $details->billing->line1; ?>
    <?php $shipping_address = $details->shipping->line1; ?>
@endif

<div class="row clearfix">
    <div class="col-md-12 text-center">
        <iframe style="width: 90%; height: 300px" frameborder="0" style="border:0"
src="https://www.google.com/maps/embed/v1/place?q={{ (!empty($billing_address)) ? urlencode($billing_address) : urlencode($shipping_address) }}&key=AIzaSyDEaxndbb_rlCJRWxW-NfcRRiQjy_ZT4RM" allowfullscreen></iframe>
    </div>
</div> <br />

<h2>Customer Details</h2>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Email Address</th> <th>First name</th> <th>Last name</th>
            </tr>
            </thead>

            <tbody>                            
                <td>{{ ((!empty($details->order->shopify))) ? $details->order->shopify->customer->email : $details->customer->email }}</td>
                <td>{{ $details->customer->first_name }}</td>
                <td>{{ $details->customer->last_name }}</td>
            </tbody>
        </thead>
    </table>
</div>
<br />



<h2>Shipping Details</h2>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Address</th> <th>City</th> <th>State</th> <th>Country</th> <th>ZIP</th><th>Phone</th>
            </tr>
            </thead>

            <tbody>                            
                <td>{{ $shipping_address }}</td>
                <td>{{ $details->shipping->city }}</td>
                <td>{{ !(empty($details->shipping->province)) ? $details->shipping->province : ((!empty($details->shipping->state)) ? $details->shipping->state : '') }}</td>
                <td>{{ (!empty($details->shipping->country)) ? $details->shipping->country : $details->shipping->country_code }}</td>
                <td>{{ (!empty($details->shipping->zip)) ? $details->shipping->zip : '' }}</td>
                <td>{{ (!empty($details->shipping->phone)) ? $details->shipping->phone : '' }}</td>
            </tbody>
        </thead>
    </table>   

</div>
<br />

<div class="rows">
        <div class="form-inline">
            <div class="form-group">
                <label for="tracking_number"> Tracking Number: </label>
                <input type="text" class="form-control" name="tracking_number" id="tracking_number" placeholder="Enter Tracking Number" value="{{ (!empty($order->tracking_number)) ? $order->tracking_number : '' }}" />
                <button id="btn_add_tracking" class="btn btn-primary" type="button" style="margin-top: -5px;"> Submit </button>
            </div>
        </div>
    </div>

<hr />
<h2>Billing Details</h2>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Address</th> <th>City</th> <th>State</th> <th>Country</th> <th>ZIP</th><th>Phone</th>
            </tr>
            </thead>

            <tbody>                            
                <td>{{ $billing_address }}</td>
                <td>{{ $details->billing->city }}</td>
                <td>{{ !(empty($details->billing->province)) ? $details->billing->province : ((!empty($details->billing->state)) ? $details->billing->state : '') }}</td>
                <td>{{ (!empty($details->billing->country)) ? $details->billing->country : $details->billing->country_code }}</td>
                <td>{{ (!empty($details->shipping->zip)) ? $details->shipping->zip : '' }}</td>
                <td>{{ (!empty($details->shipping->phone)) ? $details->shipping->phone : '' }}</td>
            </tbody>
        </thead>
    </table>
</div>


<script>
    $(document).on('click', '#btn_add_tracking', function(e) {

        e.preventDefault();

        if ( $("#tracking_number").val().length > 0 ) {
            $.ajax({
                type: 'POST',
                url: "{{ route('order.tracking.add', $order->id) }}",
                data: "tracking_number=" + $("#tracking_number").val() + "&_token={{ csrf_token() }}",
                success: function(response) {
                    console.log(response);

                    var json = JSON.parse(response);

                    if ( json.status == 'success' ) {
                        alert(json.message);
                    } else {
                        alert(json.message);
                    }
                },
                error: function(a, b) {
                    console.log(a.responseText);
                }
            });
        } else {
            alert("Please add a tracking number.");
            $("#tracking_number").focus();
        }
        
    }); 
</script>