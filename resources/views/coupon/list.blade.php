@extends('layouts.app')

@section("title", "Coupon List")

@section("styles")
<style>
.page-nav > li > a:hover {
    background-color: #2e6da4 !important;
}
</style>
@endsection

@section('content')



    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3 class="dashboard-page-title"><i class="fa fa-life-ring" aria-hidden="true"></i> Manage Coupon</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Recent Coupons</h2>
                            <ul class="nav navbar-right page-nav">
                                <li><a href="{{ route('coupon.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true" alt="Create New Coupon" title="Create New Coupon"></i> &nbsp; Create New Coupon</a> </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">


                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Coupon Name</th> <th>Code</th> <th>Discount</th> <th>Date Start</th> <th>Date End</th> <th>Status</th> <th class="text-right"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if ( $data['coupons']->count() > 0 )
                                        @foreach ($data['coupons'] as $key => $coupon)
                                            <tr>
                                                <td>{{ $coupon->coupon_name }}</td>
                                                <td>{{ $coupon->coupon_code }}</td>
                                                <td>{{ $coupon->discount }}</td>
                                                <td>{{ $coupon->date_start }}</td>
                                                <td>{{ $coupon->date_end }}</td>
                                                <td><span class="badge">{{ ($coupon->status) ? 'Enabled' : 'Disabled' }}</span></td>

                                                <td class="text-right">
                                                    <a href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <button class="btn btn-danger coupon-remove" data-coupon-id="{{ $coupon->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="7">No Coupons Added Yet</td></tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="row text-center">
                                {!! $data['coupons']->links() !!}
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
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <script>
        $(".coupon-remove").click(function(e) {

            e.preventDefault();

            const element = $(this);

            if ( confirm("Are you sure to delete this coupon?") ) {

                $.ajax({
                    type: 'DELETE',
                    url: $("#hid_base_url").val() + '/coupon/' + $(this).attr('data-coupon-id'),
                    data: "_token={{ csrf_token() }}",
                    beforeSend: function() {
                        $(element).parent().parent().css('opacity', '0.25');
                    },
                    success: function(response) {
                        console.log(response);

                        $(element).parent().parent().css('opacity', '1');
                        var json = JSON.parse(response);

                        if ( json.status == 'success' ) {
                            location.href = location.href;
                        }
                    }
                });
            }
        });
    </script>
@endsection
