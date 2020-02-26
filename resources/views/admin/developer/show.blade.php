@extends('layouts.admin')

@section('title', 'View developer')

@section('styles')
    {!! Html::style('backend/css/custom.css') !!}
    <style>
        .btn-submit-form {
            margin-top: 15px;
        }

        .user-table {
            width: 100%;
        }
    </style>
@endsection


@section ('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                View developer
                <small>view developer details</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ route('admin.developer.index') }}">Developer</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> View Developer
                </li>
            </ol>
        </div>
    </div>
    

    <div class="row">

        <div class="col-md-9">

            <table class="user-table">
                <tr>
                    <td>
                        <span>Name: </span>
                        <strong>{{ $data['developer']->name }}</strong>
                    </td>

                    <td>
                        <span>Email Address: </span>
                        <strong>{{ $data['developer']->email }}</strong>
                    </td>
                </tr>
            </table>

        </div>


        <div class="col-md-3">
        </div>

    </div>


    <div class="row">
        <div class="col-md-12">
            <hr />

            <h4>Templates</h4>
        </div>
    </div>

@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.min.js"></script>
    <script>
        $('form').parsley();
    </script>
    });
</script>
@endsection
