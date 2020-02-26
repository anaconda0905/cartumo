@extends('layouts.master')

@section('layout_content')

    @include('elements.header')

    <section class="dashboard-sec">
        <div class="container-fluid m-0 p-0">
            <div class="side-sec">
    			@yield('content')
    		</div>
        </div>
    </section>

@stop