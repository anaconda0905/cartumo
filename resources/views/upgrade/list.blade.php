@extends('layouts.app')

@section("title", "Feature Upgrade")

@section("styles")
<style>
.table-upgrades {

}
.table-upgrades tr {
    border: 2px solid #f1f1f1;
    margin-bottom: 15px;
}
.table-upgrades tr > td {

}
.table-upgrades tr > td:nth-child(2) {
    padding-top: 15px;
}
.table-upgrades tr > td:nth-child(3) {
    padding-top: 15px;
}
.table-upgrades tr > td:nth-child(3) li > b {
    font-size: 15px;
    font-weight: bold;
    color: #d9534f;
}
.table-upgrades tr > td:nth-child(4) {
    padding-top: 15px;
}
.table-upgrades tr > td .icon-upgrade {
    background: #45b39c;
    height: 52px;
    width: 52px;
    text-align: center;
    line-height: 59px;
    color: #fff;
    font-size: 22px;
    border-radius: 100px;
}
.table-upgrades tr > td h3 {
    color: #3E474F;
    max-width: 350px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: block;
    font-weight: bold;
    color: #3E474F;
    font-size: 17px;
    margin: 0px;
}
.table-upgrades tr > td p {

}
.table-upgrades tr > td ul {
    list-style-type: none;
    padding: 0px;
}
.table-upgrades tr > td ul > li {
    display: inline-block;
    line-height: 19px;
    padding-right: 15px;
    
}
.table-upgrades tr > td ul > li span {

}
.table-upgrades tr > td ul > li:first-child
{
    font-size: 24px;
    font-weight: bold;
}

.modal .upgrade-details-row {
    border: 2px solid #f1f1f1;
    padding: 15px
}
.upgrade-details-row > h4 {
    margin: 0px;
}
/*.table-upgrades tr > td ul > li:last-child {
    display: block;
    padding-left: 15px;
}*/
.upgrade-details-row label {
    color: #d9534f;
    font-size: 16px;
    font-weight: bold;
}
</style>
@endsection

@section('content')



    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3 class="dashboard-page-title"><i class="fa fa-bolt"></i> Feature Upgrades</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title" style="border-bottom: 0px;">
                            <h2>All Upgrades</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">


                            <div class="table-responsive table-upgrades">
                                @if ( $data['userUpgrades']->count() > 0 )
                                    @foreach ( $data['userUpgrades'] as $userUpgrade )
                                        <table class="table">
                                            <tr>
                                                <td style="width: 8%;">
                                                    <div class="icon-upgrade"><i class="fa fa-bolt" aria-hidden="true"></i></div>
                                                </td>

                                                <td style="width: 60%;">
                                                    <h3>{{ $userUpgrade->upgrade->name }}</h3>
                                                    <p>{{ $userUpgrade->upgrade->description }}</p>
                                                </td>

                                                <td style="width: 8%;">
                                                    @if ( $userUpgrade->type == 'paid' )
                                                        @if ( ($userUpgrade->payment_status==0) && ($userUpgrade->status==0) )
                                                            <ul>        
                                                                <?php $details = json_decode($userUpgrade->upgrade->details)->payment; ?>                                                
                                                                <li><i class="fa fa-usd" aria-hidden="true"></i></li>
                                                                <li><b>{{ number_format($details->monthly, 2) }}</b> (MONTHLY)</li>
                                                                <li><b>{{ number_format($details->yearly, 2) }}</b> (YEARLY)</li>
                                                            </ul>
                                                        @else
                                                            <span class="label label-success">PAID</span>
                                                        @endif
                                                    @else
                                                        <span class="label label-success">FREE</span>
                                                    @endif
                                                </td>

                                                <td class="text-right">
                                                    @if ( ($userUpgrade->payment_status==0) && ($userUpgrade->status==0) )
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPurchase{{ $userUpgrade->id }}">Purchase</button>
                                                    @elseif ( ($userUpgrade->payment_status==1) && ($userUpgrade->status==0) )
                                                        <button type="button" class="btn btn-success button-upgrade-activate" data-upgrade-id="{{ $userUpgrade->id }}">Activate</button>
                                                        <button type="button" class="btn btn-danger button-cancel-upgrade" data-upgrade-id="{{ $userUpgrade->id }}">Cancel</button>
                                                    @elseif ( ($userUpgrade->payment_status==1) && ($userUpgrade->status==1) )
                                                        <button type="button" class="btn btn-warning button-upgrade-activate" data-upgrade-id="{{ $userUpgrade->id }}">Deactivate</button>
                                                        <button type="button" class="btn btn-danger button-cancel-upgrade" data-upgrade-id="{{ $userUpgrade->id }}">Cancel</button>
                                                    @endif
                                                </td>
                                            </tr>

                                            
                                        </table>


                                        @if ( $userUpgrade->type == "paid" )
                                            <!-- PURCHASE MODAL -->
                                            <div id="modalPurchase{{ $userUpgrade->id }}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                    <form class="frm-upgrade-submit" action="" method="post">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Payment For The Upgrade</h4>
                                                            </div>

                                                            <div class="modal-body">
                                                                

                                                                <!-- ======================== -->
                                                                <div class="rows">
                                                                    <div class="form-group upgrade-details-row">
                                                                        <h4>Choose Plan</h4> <hr />
                                                                        <div class="rows radio-row">
                                                                            <div class="radio">
                                                                                <label clas="control-label">
                                                                                    <input type="radio" name="purchase_plan" value="{{ number_format(json_decode($userUpgrade->upgrade->details)->payment->monthly, 2) }}" checked required /> Monthly plan ({{ number_format(json_decode($userUpgrade->upgrade->details)->payment->monthly, 2) }})
                                                                                </label>
                                                                            </div>

                                                                            <div class="radio">
                                                                                <label clas="control-label">
                                                                                    <input type="radio" name="purchase_plan" value="{{ number_format(json_decode($userUpgrade->upgrade->details)->payment->yearly, 2) }}" required /> Yearly plan ({{ number_format(json_decode($userUpgrade->upgrade->details)->payment->yearly, 2) }})
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div> 

                                                                    <div class="text-center"><img src="{{ asset('images/credit-cards.png') }}" style="width: 50%;" /></div><br />

                                                                    <div class="form-group">
                                                                        <div class="rows clearfix">
                                                                            <div class="col-md-8 col-sm-8 col-xs-12 div-grid">
                                                                                <label for="number">Credit Card Number:</label>
                                                                                <input type="text" class="form-control" name="number" id="number"
                                                                                    placeholder="card Number"  required />
                                                                            </div>

                                                                            <div class="col-md-4 col-sm-4 col-xs-12 div-grid">
                                                                                <label for="ccv">CVC:</label>
                                                                                <input type="text" class="form-control" name="cvc" id="cvc" placeholder="CVC"
                                                                                    required />
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="rows clearfix">
                                                                            <div class="col-md-6 col-sm-6 col-xs-12 div-grid">
                                                                                <label for="exp-month">Expiry Month:</label>
                                                                                <select class="form-control" id="exp-month" name="exp-month"
                                                                                        required>
                                                                                    @foreach (range(1, 12) as $key => $month)
                                                                                        <option value="{{ $month }}">{{ $month }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>

                                                                            <div class="col-md-6 col-sm-6 col-xs-12 div-grid">
                                                                                <label for="exp-year">Expiry Year:</label>
                                                                                <select class="form-control" name="exp-year" id="exp-year"
                                                                                        required>
                                                                                    @foreach (range(date('Y'), intval(date('Y') + 20)) as $key => $year)
                                                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                            
                                                                </div>
                                                                
                                                                <input type="hidden" name="hid_upgrade_id" value="{{ $userUpgrade->id }}" />
                                                                {{ csrf_field() }}


                                                            </div>
                                                            
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success button-purchase-upgrade">Purchase Upgrade</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                            <div class="row text-center">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->




@endsection
<!-- js placed at the end of the document so the pages load faster -->

@section('scripts')
    <script src="{{-- asset('js/custom.js') --}}"></script>
    <script>
        $(document).on('submit', '.frm-upgrade-submit', function(e) {

            e.preventDefault();

            //alert($(this).serialize());
            var button = $(this).find('.button-purchase-upgrade');
            //$(button).html('<i class="fa fa-circle-o-notch fa-spin"></i>');

            //$(button).html('<i class="fa fa-circle-o-notch fa-spin"></i> precessing');

            //return false;

            $.ajax({
                type: 'POST',
                url: "{{ route('feature-upgrade.store') }}",
                data: $(this).serialize(),
                beforeSend: function() {
                    $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i> precessing');
                },
                success: function(response) {
                    console.log(response);

                    //location.hre                    
                },
                error: function(a, b) {
                    console.log(a.responseText);
                }
            });

            return false;
        });


        $(document).on('click', '.button-upgrade-activate', function(e) {

            e.preventDefault();

            var upgrade_id = $(this).attr('data-upgrade-id');
            var button = $(this);

            $.ajax({
                type: 'POST',
                url: "{{ route('feature-upgrade.update.status') }}",
                data: 'upgrade_id=' + upgrade_id + "&_token={{ csrf_token() }}",
                beforeSend: function() {
                    $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i> precessing');
                },
                success: function(response) {
                    console.log(response);

                    var json = JSON.parse(response);                    

                    if ( json.status == "success" ) {
                        location.href = location.href;
                    }
                },
                error: function(a, b) {
                    console.log(a.responseText);
                }
            });
        });



        $(document).on('click', '.button-cancel-upgrade', function(e) {

            e.preventDefault();

            if ( confirm("Are you sure to cancel the upgrade?") ) {
                var upgrade_id = $(this).attr('data-upgrade-id');
                var button = $(this);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('feature-upgrade.cancel') }}",
                    data: 'upgrade_id=' + upgrade_id + "&_token={{ csrf_token() }}",
                    beforeSend: function() {
                        $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i> precessing');
                    },
                    success: function(response) {
                        console.log(response);

                        var json = JSON.parse(response);                    

                        if ( json.status == "success" ) {
                            location.href = location.href;
                        }
                    },
                    error: function(a, b) {
                        console.log(a.responseText);
                    }
                });
            }
            
        });
    </script>
@endsection
