@extends('layouts.admin')

@section('title', 'Add New Topic')

@section('styles')
    {!! Html::style('backend/css/custom.css') !!}
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <style>
        .btn-submit-form {
            margin-top: 15px;
        }
    </style>
@endsection


@section ('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                New Topic
                <small>Add new Topic</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ route('admin.help-center.index') }}">Help Center</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Add Topic
                </li>
            </ol>
        </div>
    </div>

    @if(!empty($errors))
        @foreach($errors->all() as $error)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Error!</strong> {{ $error }}
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <div class="row">

            {!! Form::open(array('route' => 'admin.help-center.store')) !!}
                {{ csrf_field() }}
                <div class="col-md-12 form-user">

                            
                                
                                <fieldset>
                                    <div class="form-group">
                                        {{ Form::label('title', 'Title:') }}
                                        {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => 255, 'autofocus' => '')) }}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('slug', 'Slug:') }}
                                        {{ Form::text('slug', null, array('class'=>'form-control', 'required' => '' ) ) }}
                                    </div>

                                    <div class="form-group">
                                            {{ Form::label('category_id', 'Category:') }}
                                            {{ Form::select('category_id', $categories, null, array('class' => 'form-control')) }}
                                    </div>                                                    

                                    <div class="form-group">
                                            {{ Form::label('details', 'Content:') }}
                                            {{ Form::textarea('details', null, array('class'=>'form-control editorarea', 'required' => '', 'style' => 'height: 300px' ) ) }}
                                        </div>

                                    <div class="form-group">
                                        {{ Form::Label('status', 'Status:') }}
                                        {{ Form::select('status', ['Disabled', 'Enabled'], null, ['class' => 'form-control', 'required' => '']) }}
                                    </div>                            

                                    <!-- Change this to a button or input when using this as a form -->
                                    {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-lg btn-block btn-submit-form')) }}
                                </fieldset>
                                <hr>

                </div>                

            {!! Form::close() !!}

    </div>

@endsection


@section('scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.min.js"></script>
    <script>
        $('form').parsley();

        function slugify(text)
        {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '');            // Trim - from end of text
        }

        $("#title").on("change, keyup", function(e) {

            $("#slug").val(slugify($("#title").val()));
        });

        $(document).ready(function() {
            $('#details').summernote({
                callbacks: {
                    onImageUpload: function(files, editor, welEditable) {
                        // upload image to server and create imgNode...
                        //$summernote.summernote('insertNode', imgNode);
                        sendFile(files[0], editor, welEditable);
                    }
                }
                /*onImageUpload: function(files, editor, welEditable) {
                    sendFile(files[0], editor, welEditable);
                }*/
            });

            function sendFile(file, editor, welEditable) {
                data = new FormData();
                data.append("file", file);
                data.append("action", 'image_upload');
                data.append("_token", "{{ csrf_token() }}");
                $.ajax({
                    data: data,
                    type: "POST",
                    url: "{{ route('admin.help-center.store') }}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(url) {
                        //editor.insertImage(welEditable, url);
                        //editor.summernote('insertNode', imgNode)
                        //$summernote.summernote('insertNode', imgNode);

                        var image = $('<img>').attr('src', url);
                        $('#details').summernote("insertNode", image[0]);
                    },
                    error: function(a, b) {
                        console.log(a.responseText);
                    }
                });
                //alert(data);
            }
        });
    </script>
@endsection
