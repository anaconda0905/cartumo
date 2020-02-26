<!-- Footer -->
<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                <div class="footer-col col-md-4 subscribe-block">
                    <h3>Subscribe</h3>
                    <!--<p>12030 Citrus Leaf Dr.
                        <br>Gibsonton , FL 33534</p>-->
                        <div class="row clearfix user-subscription">
                            <form id="frm_subscription" action="" method="post">
                                <div class="col-md-9 col-sm-12"><input type="email" class="form-control" name="subscribe_email" placeholder="Enter email address here" required /></div>
                                <div class="col-md-3 col-sm-12"><button type="submit" id="btn-subcribe" class="btn btn-success btn-block btn-lg">Subscribe</button></div>
                                {{ csrf_field() }}
                            </form>
                        </div>                    
                </div>
                <div class="footer-col col-md-4">
                    <h3>Around the Web</h3>
                    <ul class="list-inline">
                        <li>
                            <a href="#" class="btn-social btn-outline"><span class="sr-only">Facebook</span><i
                                        class="fa fa-fw fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><span class="sr-only">Google Plus</span><i
                                        class="fa fa-fw fa-google-plus"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><span class="sr-only">Twitter</span><i
                                        class="fa fa-fw fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><span class="sr-only">Linked In</span><i
                                        class="fa fa-fw fa-linkedin"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><span class="sr-only">Dribble</span><i
                                        class="fa fa-fw fa-dribbble"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="footer-col col-md-4">
                    <h3>About Cartumo</h3>
                    <p>The team behind Cartumo have worked hard to bring you the concept of Cartumo, a solution which can be used to build an ecommerce online store which enables you to customize your store in many ways, ways which are only imaginable by you, our user! To bring a unique concept to your store, we offer you the best features and tools to create it!</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    Copyright &copy; Cartumo {{ date('Y') }}
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
    <a class="btn btn-primary" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>





<!-- CHAT -->
@if ( (Route::current()->getName() !== "login") && (Route::current()->getName() !== "register") && (Route::current()->getName() !== "password.request") && (Route::current()->getName() !== "password.reset") )
    <div class="user-chat">
        <div class="chat-circle-normal chat-button-shadow"><i class="fa fa-comments-o" aria-hidden="true"></i></div>
        <div class="chat-window" style="display:none">
            <div class="chat-window-header">
                <h2>
                    <i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp; Conversations
                    <ul class="messenger_controls">
                        <li class="refresh-chat"><i class="fa fa-refresh" aria-hidden="true"></i></li>
                        <!--<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>-->
                    </ul>
                </h2>
            </div>

            <div class="chat-window-body">
                <div class="chat-history">
                    <div class="blank_chat_info">
                        Here you can ask any question to admin and get replay soon.
                        So, what's your question?
                    </div>                        
                </div>
            </div>

            <div class="chat-window-footer">
                <textarea class="form-control" id="chat_message_text" placeholder="Send a message..."></textarea>
            </div>
        </div>
    </div>
@endif



<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<!-- Contact Form JavaScript -->
{!! Html::script('js/script.js') !!}

@yield('scripts')



@if ( (Route::current()->getName() !== "login") && (Route::current()->getName() !== "register") && (Route::current()->getName() !== "password.request") && (Route::current()->getName() !== "password.reset") )
    <script>
        $(document).ready(function() {

            $("#frm_subscription").submit(function(e) {

                e.preventDefault();

                var email = $(this).find("input[name='subscribe_email']");
                var button = $("#btn-subcribe");

                $.ajax({
                    type: 'post',
                    url : "{{ route('site.subscription') }}",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    },
                    success: function(response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        if ( json.status == 'success' ) {

                            $(button).html('Subscribe');
                            $(email).val('');

                            alert(json.message);
                        }
                    }, 
                    error: function(a, b) {
                        console.log(a.responseText);
                    }
                });
            });
        });
    </script>




<!-- SCRIPT FOR CHAT -->
<script>
    $(document).ready(function() {

        $(".chat-circle-normal").click(function(e) {

            var chat_button = $(this);

            e.preventDefault();

            if ( $(".chat-window").is(":visible") ) {
                $(".chat-window").hide();
                $(chat_button).html('<i class="fa fa-comments-o" aria-hidden="true"></i>');                   
                $(chat_button).addClass('chat-button-shadow');
            } else {
                $(".chat-window").show();
                $(chat_button).html('<i class="fa fa-times" aria-hidden="true"></i>'); 
                $(chat_button).removeClass('chat-button-shadow');

                //load user's previous messages
                $.ajax({
                    type: 'GET',
                    url: "{{ route('messenger.show', $ip_address) }}",
                    data: "_token={{ csrf_token() }}&user={{ $ip_address }}",
                    beforeSend: function() {
                        //$(".user-chat .chat-window .chat-window-body .chat-history > .chat-history-message.message-from-user ul > li:first-child").css('background-color', '#a6e2d5');                        
                        $(".user-chat .chat-window .chat-window-header .messenger_controls > li:first-child").html('<i class="fa fa-refresh fa-spin"></i>');
                    },
                    success: function(response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        if ( json.status == 'success' ) {
                            $(".user-chat .chat-window .chat-window-header .messenger_controls > li:first-child").html('<i class="fa fa-refresh" aria-hidden="true"></i>');

                            if ( json.html.length > 0 ) {
                            
                                if ( $(".user-chat .chat-window .chat-window-body .chat-history").find('.blank_chat_info').length > 0 ) {
                                    $(".user-chat .chat-window .chat-window-body .chat-history").html(json.html);
                                } /*else {
                                    $(".user-chat .chat-window .chat-window-body .chat-history").append(json.html);
                                }*/

                                var $target = $(".user-chat .chat-window .chat-window-body .chat-history").parent(); 
                                //alert($target.prop("scrollHeight"));
                                $target.animate({scrollTop: $target.prop("scrollHeight")}, 200);
                            }
                        }                                           
                        
                    },
                    error: function(a, b) {
                        console.log(a.responseText);
                    }
                });  
                

                $("#chat_message_text").focus();
            }
        });

        $(document).on("keyup", "#chat_message_text", function(e) {

            //e.preventDefault();

            var code = e.keyCode || e.which;
            var chat_body_container = $(".user-chat .chat-window .chat-window-body .chat-history");

            //if enter key has hit
            if(code == 13) { 
                //alert("submit");  

                $.ajax({
                    type: 'POST',
                    url: "{{ route('messenger.store') }}",
                    data: 'message=' + $(this).val() + "&from={{ $ip_address }}&to=1&is_user=false&_token={{ csrf_token() }}",
                    beforeSend: function() {
                        //$(".user-chat .chat-window .chat-window-body .chat-history > .chat-history-message.message-from-user ul > li:first-child").css('background-color', '#a6e2d5');
                    },
                    success: function(response) {
                        console.log(response);
                        $(".user-chat .chat-window .chat-window-body .chat-history > .chat-history-message.message-from-user ul > li:first-child").css('background-color', '#68afa0');
                    },
                    error: function(a, b) {
                        console.log(a.responseText);
                    }
                });   

                var html = '<div class="chat-history-message message-from-user">';
                html += '<ul>';
                html += '<li><p>' + $(this).val() + '</p></li>';
                html += '<li><img src={{ asset("images/chat/man.png") }} /></li>';
                html += '</ul></div>';

                if ( $(chat_body_container).find('.blank_chat_info').length > 0 ) {
                    $(chat_body_container).html(html);
                } else {
                    $(chat_body_container).append(html);
                }

                var $target = $(chat_body_container).parent(); 
                $target.animate({scrollTop: $target.prop("scrollHeight")}, 200);

                $(this).val('');              
            }
        });


        $(document).on("click", "#chat_message_text", function(e) {

            $.ajax({
                    type: 'POST',
                    url: "{{ route('messenger.message.mark.read', $ip_address) }}",
                    data: "_token={{ csrf_token() }}",
                    beforeSend: function() {
                        //$(".user-chat .chat-window .chat-window-body .chat-history > .chat-history-message.message-from-user ul > li:first-child").css('background-color', '#a6e2d5');
                    },
                    success: function(response) {
                        console.log(response);                        
                    },
                    error: function(a, b) {
                        console.log(a.responseText);
                    }
            });   

        });


        $(document).on('click', '.user-chat .chat-window .chat-window-header .messenger_controls > .refresh-chat', function(e) {

            e.preventDefault();

            //load user's previous messages
                $.ajax({
                    type: 'GET',
                    url: "{{ route('messenger.show', $ip_address) }}",
                    data: "_token={{ csrf_token() }}&user={{ $ip_address }}",
                    beforeSend: function() {
                        //$(".user-chat .chat-window .chat-window-body .chat-history > .chat-history-message.message-from-user ul > li:first-child").css('background-color', '#a6e2d5');                        
                        $(".user-chat .chat-window .chat-window-header .messenger_controls > li:first-child").html('<i class="fa fa-refresh fa-spin"></i>');
                    },
                    success: function(response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        if ( json.status == 'success' ) {
                            $(".user-chat .chat-window .chat-window-header .messenger_controls > li:first-child").html('<i class="fa fa-refresh" aria-hidden="true"></i>');

                            if ( json.html.length > 0 ) {
                                //$(".user-chat .chat-window .chat-window-body .chat-history").html('');
                                if ( $(".user-chat .chat-window .chat-window-body .chat-history").find('.blank_chat_info').length > 0 ) {
                                    $(".user-chat .chat-window .chat-window-body .chat-history").html(json.html);
                                } /*else {
                                    $(".user-chat .chat-window .chat-window-body .chat-history").append(json.html);
                                }*/

                                var $target = $(".user-chat .chat-window .chat-window-body .chat-history").parent(); 
                                $target.animate({scrollTop: $target.prop("scrollHeight")}, 200);
                            }
                        }                                           
                        
                    },
                    error: function(a, b) {
                        console.log(a.responseText);
                    }
                });
        });



        //auto check message
        setInterval(function() { 
            //load user's previous messages
                $.ajax({
                    type: 'GET',
                    url: "{{ route('messenger.message.unread', $ip_address) }}",
                    data: "_token={{ csrf_token() }}&user={{ $ip_address }}",
                    beforeSend: function() {
                        //$(".user-chat .chat-window .chat-window-body .chat-history > .chat-history-message.message-from-user ul > li:first-child").css('background-color', '#a6e2d5');                        
                        //$(".user-chat .chat-window .chat-window-header .messenger_controls > li:first-child").html('<i class="fa fa-refresh fa-spin"></i>');
                    },
                    success: function(response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        if ( json.status == 'success' ) {
                            //$(".user-chat .chat-window .chat-window-header .messenger_controls > li:first-child").html('<i class="fa fa-refresh" aria-hidden="true"></i>');

                            if ( json.html.length > 0 ) {
                            
                                if ( $(".user-chat .chat-window .chat-window-body .chat-history").find('.blank_chat_info').length > 0 ) {
                                    $(".user-chat .chat-window .chat-window-body .chat-history").html(json.html);
                                } else {
                                    $(".user-chat .chat-window .chat-window-body .chat-history").append(json.html);
                                }                               
                            }
                        }                                           
                        
                    },
                    error: function(a, b) {
                        console.log(a.responseText);
                    }
                });  
        }, 1000);//time in milliseconds 
    });








//contact us
$(function() {

    $("#contactForm input,#contactForm textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            // Prevent spam click and default submit behaviour
            $("#btnSubmit").attr("disabled", true);
            event.preventDefault();
            
            // get values from FORM
            var name = $("input#name").val();
            var email = $("input#email").val();
            var phone = $("input#phone").val();
            var message = $("textarea#message").val();
            var firstName = name; // For Success/Failure Message
            // Check for white space in name for Success/Fail message
            if (firstName.indexOf(' ') >= 0) {
                firstName = name.split(' ').slice(0, -1).join(' ');
            }
            $.ajax({
                url: "{{ route('site.contactus') }}",
                type: "POST",
                data: {
                    name: name,
                    phone: phone,
                    email: email,
                    message: message,
                    _token: "{{ csrf_token() }}"
                },
                cache: false,
                success: function() {
                    // Enable button & show success message
                    $("#btnSubmit").attr("disabled", false);
                    $('#success').html("<div class='alert alert-success'>");
                    $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-success')
                        .append("<strong>Your message has been sent. </strong>");
                    $('#success > .alert-success')
                        .append('</div>');

                    //clear all fields
                    $('#contactForm').trigger("reset");
                },
                error: function(a, b) {
                    console.log(a.responseText);
                    // Fail message
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!");
                    $('#success > .alert-danger').append('</div>');
                    //clear all fields
                    $('#contactForm').trigger("reset");
                },
            });
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});


</script>
@endif


</body>

</html>
