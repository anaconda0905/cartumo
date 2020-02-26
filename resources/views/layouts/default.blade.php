@extends('layouts.master')

@section('layout_content')

	@include('elements.header')

    @yield('content')

    @include('elements.footer')

@stop