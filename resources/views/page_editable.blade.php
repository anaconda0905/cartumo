<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="img/favicon.ico" type="image/x-icon">
        <title> Cartumo </title>
        
        <link href="{{ asset('public/frontend/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('public/frontend/css/simple-line-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- <link href="{{ asset('public/frontend/css/style.css') }}" rel="stylesheet"> -->
        <link href="{{ asset('public/frontend/css/fonts.css') }}" rel="stylesheet">
        <link href="{{ asset('public/frontend/css/margins-min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/frontend/css/responsive-style.css') }}" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet"> 

        <script type="text/javascript" src="{{ asset('public/frontend/js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/global/vendors/ckeditor/ckeditor_full/ckeditor.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/global/vendors/html2canvas/dist/html2canvas.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/global/js/custom.js') }}"></script>

        <style type="text/css">

            .editableText{
                border:1px solid #FFFFFF;
            }

            .editableImg{
                cursor:pointer;
            }

        </style>

    </head>

    <body>



        <!-- Edit Link Modal -->
        <div id="modalEditButton" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Button</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Button Text</label>
                        <input type="text" class="form-control" id="inputBtnText" />
                    </div>

                    <div class="form-group">
                        <label>Button URL</label>
                        <input type="text" class="form-control" id="inputBtnUrl" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnEditButton">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>

          </div>
        </div>


        <!-- Edit Link Modal -->
        <div id="modalEditFormButton" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Form Button</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Button Text</label>
                        <input type="text" class="form-control" id="inputFormBtnText" />
                    </div>

                    <div class="form-group">
                        <label>Form Action</label>
                        <input type="text" class="form-control" id="inputFrmAction" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnEditFormButton">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>

          </div>
        </div>


        <!-- Edit Btn Modal -->
        <div id="modalEditBtn" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Button</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Button Text</label>
                        <input type="text" class="form-control" id="inputBtn1Text" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnEditBtn">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>

          </div>
        </div>



        <!-- Edit image Modal -->
        <div id="modalEditImage" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Image</h4>
                </div>
                <div class="modal-body">
                    <div style="margin-bottom:20px;">
                        <label>Edit : </label>
                        <select id="selectMedia">
                            <option value="" selected="selected"></option>
                            <option value="image">Image</option>
                            <option value="video">Video</option>
                        </select>
                    </div>
                    <div id="modalEditImageBodyContent">
                        <form action="" method="post" id="frmUploadImage">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Upload Image</label>
                                <input type="file" name="image" id="inputImageUpload" />
                            </div>
                        </form>
                    </div>
                    <div id="modalEditImageBodyVideoContent">
                        <div class="form-group">
                            <label>Video URL</label>
                            <input type="text" class="form-control" id="inputVideoUrl" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnEditImage">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>

          </div>
        </div>



        <div style="padding: 10px;" class="pull-right">
        	<img src="http://www.fleetlca.com/assets/img/ajax-loader.gif" height="30" id="imgLoader" style="display:none;">&nbsp;
            <a href="{{ route('funnels.steps.show', [$page->funnelStep->funnel->id, $page->funnelStep->id]) }}" class="btn btn-primary">Close</a>
            <button type="button" class="btn btn-primary" id="btnSaveChanges">Save Changes</button>
        </div>

        <div id="contentDiv">
            @include('elements.ajax_loader')
            {!! $content !!}
        </div>
    </body>
    
    <script type="text/javascript">

        currentEditableButton = null;

        $( ".editableText" ).prop( "contenteditable", "true" );
	
        $( ".editableText" ).on( "mouseover", function(){
            $(this).css("border", "1px dotted #000000");
        });

        $( ".editableText" ).on( "mouseout", function(){
            $(this).css("border", "1px solid #FFFFFF");
        });

        // edit button
        $( ".editableButton" ).on( "click", function(){

            currentEditableButton = $( this );

        }); 

        $( "#btnEditButton" ).on( "click", function(){

            btnHref = $( "#inputBtnUrl" ).val();
            btnHref = $.trim(btnHref);
            if( btnHref!="" )
            {
                currentEditableButton.attr( "href", btnHref );
            }

            btnText = $( "#inputBtnText" ).val();
            btnText = $.trim(btnText);
            if( btnText!="" )
            {
                currentEditableButton.html( btnText );
            }

            $( "#modalEditButton" ).modal( "hide" );

        });
        // 


        // edit form submit button
        $( ".editableFormButton" ).on( "click", function(){

            currentEditableFormButton = $( this );

        }); 

        $( "#btnEditFormButton" ).on( "click", function(){

            frmAction = $( "#inputFrmAction" ).val();
            frmAction = $.trim(frmAction);
            if( frmAction!="" )
            {
                $( "#frmPayment" ).attr( "action", frmAction );
            }

            btnText = $( "#inputFormBtnText" ).val();
            btnText = $.trim(btnText);
            if( btnText!="" )
            {
                currentEditableFormButton.html( btnText );
            }

            $( "#modalEditFormButton" ).modal( "hide" );

        });
        // 


        // edit button
        $( ".editableBtn" ).on( "click", function(){

            currentEditableBtn = $( this );

        }); 

        $( "#btnEditBtn" ).on( "click", function(){

            btnText = $( "#inputBtn1Text" ).val();
            currentEditableBtn.html( btnText );

            $( "#modalEditBtn" ).modal( "hide" );

        });
        // 


        $( "#selectMedia" ).on("change", function(){

            if( $( this ).val() == "image" )
            {
                $( "#modalEditImageBodyVideoContent" ).hide();
                $( "#modalEditImageBodyContent" ).show();
            }
            else if( $( this ).val() == "video" )
            {
                $( "#modalEditImageBodyContent" ).hide();
                $( "#modalEditImageBodyVideoContent" ).show();
            }
            else
            {
                $( "#modalEditImageBodyContent" ).hide();
                $( "#modalEditImageBodyVideoContent" ).hide();
            }

        });

        // Edit Image
        $( document ).on( "click", ".editableImg", function(){

            $( "#selectMedia" ).val("image");
            $( "#modalEditImageBodyVideoContent" ).hide();
            $( "#modalEditImageBodyContent" ).show();
            currentEditableMedia = "image";
            currentEditableImage = $( this );

        });

        // Edit Video
        $( document ).on( "click", ".editableVideo", function(){
        	
            $( "#selectMedia" ).val("video");
            $( "#modalEditImageBodyContent" ).hide();
            $( "#modalEditImageBodyVideoContent" ).show();
            currentEditableMedia = "video";
            currentEditableVideo = $( this ).closest( ".div-editable-media" ).find( "iframe" );
            // $( "#inputVideoUrl" ).val();

        });

        $( "#btnEditImage" ).on( "click", function(){

            /*imageUrl = $( "#inputImageUrl" ).val();
            imageUrl = $.trim( imageUrl );

            if( imageUrl != "" )
            {
                currentEditableImage.attr( "src", imageUrl);
            }
            else
            {*/
                selectedMedia = $( "#selectMedia" ).val();
                if( selectedMedia == "image" )
                {
                    // alert("image");
                    var formData = new FormData();
                    formData.append('image', $( "#inputImageUpload" )[0].files[0]);

                    $.ajax({
                        url : "{{ route('ajax.pages.upload-image') }}",
                        type : "post",
                        data:  formData,
                        dataType : "json",
                        contentType : false,
                        cache : false,
                        processData : false,
                        beforeSend : function(){
                            ajax_showLoader({
                                options : {
                                    div : {
                                        top : '55px',
                                    }
                                }
                            });
                        },
                        success : function(response){
                            if( ('success' in response) && (response.success) )
                            {
                                if( currentEditableMedia == "image" )
                                {
                                    currentEditableImage.attr( "src", response.src);
                                }
                                else
                                {
                                    element = '<img src="' + response.src + '" class="img-responsive editableImg" data-toggle="modal" data-target="#modalEditImage" style="display:inline-block;">';

                                    currentEditableVideo.closest( ".div-editable-media" ).html( element );
                                    /*currentEditableVideo.closest( ".div-editable-media" ).find( "img" ).attr( "src", response.src);
                                    currentEditableVideo.closest( ".div-editable-media" ).find( "img" ).show();
                                    currentEditableVideo.closest( ".div-editable-media" ).find( ".div-video" ).hide();*/
                                }
                            }
                            else
                            {
                                alert("Sorry! an unexpected error occurred. Please reload the page and try again.");
                            }
                        },
                        error : function(){
                            alert("Sorry : An unexpected error occurred. Please reload the page and try again.");
                        },
                        complete : function(){
                            ajax_hideLoader();
                        }
                    });
                }
                else if( selectedMedia == "video" )
                {
                    videoUrl = $( "#inputVideoUrl" ).val();
                    videoUrl = $.trim(videoUrl);
                    videoUrl = "https://www.youtube.com/embed/" + videoUrl;

                    if ( currentEditableMedia == "video")
                    {
                        currentEditableVideo.attr( "src", videoUrl);
                    }
                    else
                    {
                    	element = '<div style="text-align:right; padding-bottom:10px;"><button class="btn btn-primary editableVideo" data-toggle="modal" data-target="#modalEditImage">Edit Video</button></div><iframe src="' + videoUrl + '" allowfullscreen="" width="100%" height="400" frameborder="0"></iframe>';

                        currentEditableImage.closest( ".div-editable-media" ).html( element );
                        /*currentEditableImage.closest( ".div-editable-media" ).find( "iframe" ).attr( "src", videoUrl);
                        currentEditableImage.closest( ".div-editable-media" ).find( ".div-video" ).show();
                        currentEditableImage.closest( ".div-editable-media" ).find( "img" ).hide();*/
                    }
                }
                else
                {
                    // alert("nothing");
                }
            // }

            $( "#modalEditImage" ).modal( "hide" );

        });

        $( "form button[type='submit']" ).on( "click", function(e){

            e.preventDefault();

        });
        // 

        /*$('body').on('body.hidden', '.modal', function () {
            $(this).removeData('modal');
        });*/

        $( "#btnSaveChanges" ).on( "click", function(){

            $.ajax({
                url : "{{ route('pages.edit', [$page->id]) }}",
                type : "post",
                dataType : 'json',
                data : {
                    '_token' : "{{ csrf_token() }}",
                    'content' : $("#contentDiv").html()
                },
                beforeSend : function(){
                	$("#imgLoader").show();
                },
                success : function(response){
                    if('success' in response && (response.success))
                    {
                        html2canvas($("#contentSection"), {
                            onrendered: function(canvas)
                            {
                                var img = canvas.toDataURL()
                                $.ajax({
                                    url : "{{ route('save-page-thumbnail') }}",
                                    type : "post",
                                    dataType : 'json',
                                    data : {
                                        '_token' : "{{ csrf_token() }}",
                                        'img' : img,
                                        'page_id' : "{{ $page->id }}"
                                    },
                                    success : function(response1){
                                        if('success' in response1 && (response1.success))
                                        {
                    	                   $("#imgLoader").hide();
                                        }
                                    }
                                });
                            }
                        });
                    }
                    else
                    {
                        alert("An unexpected error occurred. Please reload the page.");
                    }
                },
                error : function(){
                    alert("An unexpected error occurred. Please reload the page.");
                }
            });
        });

    </script>

</html>
