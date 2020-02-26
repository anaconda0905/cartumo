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

   .wrapper-area {
       min-height: 708px;
    }

</style>

<style>
    .switch {
      display: inline-block;
      height: 25px;
      position: relative;
      vertical-align: middle;
      width: 31px;
    }

    .switch input {display:none;}

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider::before {
      background-color: white;
      bottom: 3px;
      content: "";
      height: 17px;
      left: 3px;
      position: absolute;
      transition: all 0.4s ease 0s;
      width: 13px;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(12px);
      -ms-transform: translateX(12px);
      transform: translateX(12px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
</style>

<?php
    $resourceName = "Blog";
?>

@include('admin.elements.modal-delete')
@include('elements.modal-show-image')

<section id="main-content">
    <section class="wrapper wrapper-area">

        @include('admin.elements.notifications')

        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3>Archived</h3>
                    </header>
                    <div class="panel-body">
                        <div class="btn-row">
                            <!-- <a href="{{ route('admin.blogs.create') }}" id="editable-sample_new" class="btn btn-blue">
                                Add New <i class="fa fa-plus"></i>
                            </a> -->
                        </div>
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogs as $blog)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $blog->title }}
                                            </td>
                                            <td>
                                                <?php

                                                    $srtlen = strlen($blog->description);

                                                    if($srtlen > 30)
                                                    {
                                                        echo strip_tags($srtlen = substr($blog->description,0,30).'...');
                                                    } 
                                                    else
                                                    {
                                                        echo strip_tags($srtlen = $blog->description); 
                                                    } 
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $img_path = App\BaseUrl::getBlogListingThumbnailUrl(); 
                                                ?>
                                                @if( empty($blog->image ) || !file_exists($img_path . '/' . $blog->image ))
                                                    <!-- <a href="{{ asset('/public/global/img/abc.png') }}"   data-toggle="modal" data-target="#modalImage"> -->
                                                        <img class="img-responsive" src="{{ asset('public/global/img/default_blog_listing.png') }}" height="50px;" width="100px;">
                                                    <!-- </a>     -->
                                                @else
                                                    <!-- <a href="{{ asset($img_path . '/' . $blog->image) }}" data-toggle="modal" data-target="#modalImage"> -->
                                                        <img class="img-responsive" src="{{ asset($img_path . '/' . $blog->image) }}" height="50px;" width="100px;">
                                                    <!-- </a> -->
                                                        
                                                @endif
                                            </td>
                                            <td>
                                                @if($blog->status == '1')
                                                    <span class="label label-success label-mini spn-status" blog-id="{{ $blog->id }}">Active</span>
                                                @else
                                                    <span class="label label-danger label-mini spn-status" blog-id="{{ $blog->id }}">Inactive</span>
                                                @endif    
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.blogs.restore', [$blog->id]) }}" class="btn btn-primary">Restore</a>

                                                
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
    
    $('.switch-status').on('click', function(){

        blogId = $(this).attr('blog-id');

        $.ajax({
            type : 'post',
            url  : '{{ route("admin.ajax-switch") }}',
            data : {
                '_token' : '{{ csrf_token() }}',
                'id'     : blogId
            },
            dataType : 'json',

            success : function(response){
                
                if(response.success)
                {
                    span   = $(".spn-status[blog-id=" + blogId + "]");
                    status = span.html();
                    status = status.toLowerCase();

                    if( status == 'active' )
                    {
                        span.html("Inactive");
                        span.removeClass('label-success')
                        span.addClass('label-danger');
                    }
                    else if(status == 'inactive')
                    {
                        span.html("Active");
                        span.removeClass('label-danger')
                        span.addClass('label-success');
                    }
                }
            }
        });


    });


    $(".btn-confirm-delete").on('click', function(e){

        e.preventDefault();
        href = $(this).attr('href');
        $("#frmDelete").attr('action', href);
        $("#modalDelete").modal("show");

    });

</script>

@endsection      
