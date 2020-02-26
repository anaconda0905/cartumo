@extends('admin.layouts.master')

@section("title", "Steller Winds")

@section('content') 

<style type="text/css">

    .btn-row{
        margin-bottom:10px;
    }

    .panel-body a.btn-blue {
        background-color: #0099ff;
        color: #fff;
    } 

</style>

<?php
    $resourceName = "Faq";
?>

@include('admin.elements.modal-delete')

<section id="main-content">
    <section class="wrapper wrapper-area">

        @include('admin.elements.notifications')

        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3>Faqs Listing</h3>
                    </header>
                    <div class="panel-body">
                        <div class="btn-row">
                            <a href="{{ route('admin.faqs.create') }}" id="editable-sample_new" class="btn btn-blue">
                                Add New <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Actions</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($faqs as $faq)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $faq->question }}
                                            </td>
                                            <td>
                                                <?php

                                                    $srtlen = strlen($faq->answer);

                                                    if($srtlen > 30)
                                                    {
                                                        echo strip_tags($srtlen = substr($faq->answer,0,30).'...');
                                                    } 
                                                    else
                                                    {
                                                        echo strip_tags($srtlen = $faq->answer); 
                                                    } 
                                                ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-success btn-xs" href="{{ route('admin.faqs.edit', [$faq->id]) }}"><i class="fa fa-pencil"></i></a>

                                                <a href="{{ route('admin.faqs.destroy', [$faq->id]) }}" class="btn btn-danger btn-xs btn-confirm-delete"><i class="fa fa-trash-o"></i></a> 
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>


<script type="text/javascript">

    $(".btn-confirm-delete").on('click', function(e){

        e.preventDefault();
        href = $(this).attr('href');
        $("#frmDelete").attr('action', href);
        $("#modalDelete").modal("show");

    });

</script>

@endsection      
