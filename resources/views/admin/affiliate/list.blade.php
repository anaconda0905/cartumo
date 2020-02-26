@extends('layouts.admin')

@section('title', 'Affiliates')

@section('styles')
    {!! Html::style('backend/css/custom.css') !!}
@endsection

@section ('content')

    <section id="main-content">
        <section class="wrapper wrapper-area">

            @include('admin.elements.notifications')

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Affiliates
                        <small>All Affiliates</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>

                        <li class="active">
                            <i class="fa fa-file"></i> Affiliates
                        </li>
                    </ol>


                    @if (session('status'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">

                    <form class="form-inline text-right" role="form">
                        <div class="form-group">
                            <label for="search">Search:</label>
                            <input type="search" class="form-control" id="search" name="search"
                                   value="{{ (!empty($data['search'])) ? $data['search'] : '' }}">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <br/>

            <div class="row">
                <div class="table-responsive col-md-12">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID#</th>
                            <th>User</th>
                            <th>PayPal Email</th>
                            <th class="text-right">Earnings</th>
                            <th class="text-center">Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ( count($affiliateProfiles) > 0 )
                            @foreach($affiliateProfiles as $affiliateProfile)
                                <tr>
                                    <td>
                                        {{ $affiliateProfile->affiliate_id }}
                                    </td>

                                    <td>
                                        @if ( !empty($affiliateProfile->user) )
                                            <p style="margin-bottom: 0px;">
                                                <strong>#{{ $affiliateProfile->user->id }}</strong>&nbsp;
                                                {{ $affiliateProfile->user->name }}
                                            </p>
                                            <small>{{ $affiliateProfile->user->email }}</small>
                                        @endif
                                    </td>

                                    <td>
                                        @if ( !empty($affiliateProfile->payments) )
                                            {{ json_decode($affiliateProfile->payments)->paypal_email }}
                                        @endif
                                    </td>

                                    <td class="text-right">
                                        @if ( !empty($affiliateProfile->getPaidPendingAmount($affiliateProfile->user_id)[1]) )
                                            ${{ $affiliateProfile->getPaidPendingAmount($affiliateProfile->user_id)[1] }}
                                        @else
                                           $0.00
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if($affiliateProfile->status == 1)
                                            <span class="label label-success label-mini spn-status"
                                                  help-id="{{ $affiliateProfile->id }}">Approved</span>
                                        @elseif($affiliateProfile->status == 0)
                                            <span class="label label-default label-mini spn-status"
                                                  help-id="{{ $affiliateProfile->id }}">Pending</span>
                                        @else
                                            <span class="label label-danger label-mini spn-status"
                                                  help-id="{{ $affiliateProfile->id }}">Canceled</span>
                                        @endif
                                    </td>

                                    <td class="text-right">
                                        <label title="Change Status" class="switch">
                                            <div class="slider round switch-status"
                                                 help-id="{{ $affiliateProfile->id }}"></div>
                                        </label>

                                        <a title="View Details" class="btn btn-success"
                                           href="{{ route('admin.affiliate.show', [$affiliateProfile->id]) }}"><i
                                                    class="fa fa-pencil"></i></a>
                                        <button type="button" title="Cancel"
                                                data-action="{{ route('admin.affiliate.cancel', [$affiliateProfile->id]) }}"
                                                class="btn btn-danger cancel_affiliate"><i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">No pages</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

                <div class="row text-center">
                    {!! $affiliateProfiles->links() !!}
                </div>

            </div>
        </section>
    </section>





@endsection


@section('scripts')
    <script type="text/javascript">

        $(document).ready(function () {

            $(".remove_page").click(function (e) {

                e.preventDefault();
                var row = $(this).parent().parent();

                if (confirm("Are you sure to delete the page?")) {

                    $.ajax({
                        type: 'delete',
                        url: $(this).attr('data-action'),
                        data: "_token={{ csrf_token() }}",
                        beforeSend: function () {
                            $(row).css('opacity', '0.50');
                        },
                        success: function (response) {
                            var json = JSON.parse(response);
                            if (json.status == 'success') {
                                $(row).remove();
                            }
                        }
                    });
                }
            });
        });

    </script>
@endsection