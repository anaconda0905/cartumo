@extends('layouts.app')

@section("title", "SMTP List")

@section('styles')
    <style>
        .page-title > .title_left h3, .page-title > .title_left a {
            display: inline-block;
        }
        .page-title > .title_left {
            width: 100%;
        }
        .page-title > .title_left a {
            float: right;
        }
    </style>
@endsection

@section('content')


    <!-- page content -->
    <div class="right_col" role="main">

        <div class="row clearfix">

            <div class="clearfix">

                <div class="col-md-9">

                    <div class="page-title">
                        <div class="title_left" style="margin-bottom: 15px;">
                            <h3>Setup Email SMTP Settings</h3>
                            <a class="btn btn-primary btn-lg" href="{{ route('smtp.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp; Add New</a>
                        </div>
                    </div>

                    <div class="x_panel">
                        <div class="x_content">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>User</th>
                                        <th>Domain</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ( !empty($data['userSmtpSettings']) )
                                        @foreach ( $data['userSmtpSettings'] as $smtpSetting )
                                            <tr>
                                                <td>{{ $smtpSetting->id }}</td>
                                                <td>{{ $smtpSetting->title }}</td>
                                                <td>{{ $smtpSetting->smtp_user }}</td>
                                                <td>{{ $smtpSetting->smtp_domain }}</td>
                                                <td>{{ $smtpSetting->status }}</td>
                                                <td class="text-right">
                                                    <a href="{{ route('smtp.edit', $smtpSetting->id) }}" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <button class="btn btn-danger remove-smtp" type="button" data-smtp-action="{{ route('smtp.destroy', $smtpSetting->id) }}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="5">No SMTP settings</td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    Hello
                </div>

            </div>

        </div>

    </div>

@endsection
@section('scripts')
    <script>

        $(document).ready(function () {

            $(".remove-smtp").click(function (e) {

                if ( confirm("Are you sure to delete this setting") ) {
                    var element = $(this);

                    $.ajax({
                        type: 'delete',
                        url: $(this).attr('data-smtp-action'),
                        data: "_token={{ csrf_token() }}",
                        beforeSend: function () {
                            $(element).html('<i class="fa-li fa fa-spinner fa-spin"></i>');
                            $(element).prop('disabled', 'disabled');
                        },
                        success: function (response) {
                            console.log(response);

                            var json = JSON.parse(response);

                            if (json.status == 'success') {
                                location.href = json.url;
                            } else {
                                alert(json.message)
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
