@extends('layouts.app')

@section("title", "Edit Coupon")

@section('styles')
<style>
.daterangepicker {

}
.daterangepicker.picker_4 .calendar-table thead tr:first-child {
    background: #45b39c;
}
</style>
@endsection

@section('content')


    <!-- page content -->
    <div class="right_col" role="main">

        <div class="page-title">
            <div class="title_left">
                <h3>User Coupon</h3>
            </div>
        </div>

        <div class="row clearfix">

            <div class="col-md-9">
                <div class="x_panel">
                    <div class="x_content">
                        {!! Form::model($data['coupon'], array('route' => ['coupon.update', $data['coupon']->id], 'method' => 'PUT', 'data-parsley-required' => '')) !!}

                        <div class="form-group">
                            {{ Form::label('coupon_name', 'Coupon Name:') }}
                            {{ Form::text('coupon_name', NULL, array('class' => 'form-control', 'required' => '', 'maxlength' => 255, 'autofocus' => '', 'placeholder' => 'Coupon Name')) }}
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                {{ Form::label('coupon_code', 'Coupon Code:') }}
                                {{ Form::text('coupon_code', NULL, array('class' => 'form-control has-feedback-left', 'required' => '', 'maxlength' => 255, 'autofocus' => '', 'placeholder' => 'Coupon Code')) }}
                                <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                            </div>


                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                {{ Form::label('discount', 'Discount:') }}
                                {{ Form::number('discount', NULL, array('class' => 'form-control has-feedback-right', 'required' => '', 'maxlength' => 255, 'placeholder' => 'Enter Percentage Amount')) }}
                                <span class="fa fa-percent form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                {{ Form::label('date_start', 'Date Start:') }}
                                {{ Form::text('date_start', NULL, array('class' => 'form-control has-feedback-left', 'required' => '', 'maxlength' => 255, 'placeholder' => 'Date Start')) }}
                                <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                {{ Form::label('date_end', 'Date End:') }}
                                {{ Form::text('date_end', NULL, array('class' => 'form-control has-feedback-right', 'required' => '', 'maxlength' => 255, 'placeholder' => 'Date End')) }}
                                <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-xs-12 form-group has-feedback">
                                {{ Form::label('status', 'Status:') }}
                                {{ Form::select('status', ['Disabled', 'Enabled'], NULL, array('class' => 'form-control', 'required' => '', 'placeholder' => 'Status')) }}
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group text-right">

                            <a href="{{ route('coupon.index') }}" class="btn btn-danger">Cancel</a>
                            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>


            <div class="col-md-2 col-md-offset-1">

            </div>

        </div>

    </div>

@endsection
<!-- js placed at the end of the document so the pages load faster -->

@section('scripts')
<script>
    $("#date_start").daterangepicker(
        {
            singleDatePicker: !0,
            singleClasses: "picker_4",
            locale: {format: "DD/MM/YYYY"}
        },
        function (a, b, c) {
            console.log(a.toISOString(), b.toISOString(), c)
        }
    );

    $("#date_end").daterangepicker(
        {
            singleDatePicker: !0,
            singleClasses: "picker_4",
            locale: {format: "DD/MM/YYYY"}
        },
        function (a, b, c) {
            console.log(a.toISOString(), b.toISOString(), c)
        }
    );
</script>
@endsection
