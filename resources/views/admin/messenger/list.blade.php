@extends('layouts.admin')

@section('title', 'Messages')

@section('styles')
    {!! Html::style('backend/css/custom.css') !!}
    <style>
        .messenger {
            border: 1px solid #eee;
        }

        .messenger .col-md-4, .col-md-8 {
            padding: 0px;
        }

        .messenger-users {
            border: 1px solid #eee;
        }

        .messenger-users h3 {
            text-align: center;
            border-bottom: 2px solid #eee;
            margin: 0px;
            padding: 15px 0px;
        }

        .messenger-users .all-messenger-users {
            padding: 15px;
        }

        .messenger-users .all-messenger-users > .items {

            padding: 15px 15px 10px;
            border: 1px solid #eee;
            cursor: pointer;
            margin-bottom: 15px;
        }

        .messenger-users .all-messenger-users ul {
            list-style-type: none;
            padding: 0px;
            margin-bottom: 0px;
        }

        .messenger-users .all-messenger-users ul > li {
            display: inline-block;
            padding: 0px;
            border: 1px solid $ eee;
        }

        .messenger-users .all-messenger-users ul > li img {
            width: 32px;
        }

        .messenger-messages {
            border: 1px solid #eee;
        }

        .messenger-messages h3 {
            text-align: center;
            border-bottom: 2px solid #eee;
            margin: 0px;
            padding: 15px 0px;
        }

        .messenger-messages .all-messenger-messages {
            max-height: 500px;
            overflow: auto;
        }

        .messenger-messages .all-messenger-messages > .items {
            padding: 20px;
        }

        .messenger-messages .all-messenger-messages > .items .chat-history-message ul {
            list-style-type: none;
            padding: 0px;
        }

        .messenger-messages .all-messenger-messages > .items .chat-history-message ul > li {
            display: inline-block;
        }

        .messenger-messages .all-messenger-messages > .items .chat-history-message.message-from-user ul > li:first-child > img {
            width: 32px;
            border-radius: 100px;
            /* padding: 2px; */
            margin: 15px;
        }

        .messenger-messages .all-messenger-messages > .items .chat-history-message.message-from-admin ul > li:last-child > img {
            width: 32px;
            border-radius: 100px;
            /* padding: 2px; */
            margin: 15px;
        }

        .messenger-messages .all-messenger-messages > .items .chat-history-message.message-from-user ul > li:last-child {
            width: 80%;
            background: #eee;
            padding: 15px;
            border-radius: 5px;
        }

        .messenger-messages .all-messenger-messages > .items .chat-history-message.message-from-admin {

        }

        .messenger-messages .all-messenger-messages > .items .chat-history-message.message-from-admin ul > li:first-child {
            width: 80%;
            background-color: #68afa0;
            padding: 15px;
            border-radius: 5px;
        }

        .messenger-messages .chat-history-message.message-from-user ul > li:last-child p {
            color: #555;
            margin-bottom: 0px;
        }

        .messenger-messages .chat-history-message.message-from-admin ul > li:first-child p {
            color: #ffffff;
            margin-bottom: 0px;
        }

        .messenger-messages .chat-history-message.message-from-admin ul > li.successful {
            background-color: #68afa0;
            color: #ffffff;
        }

        .messenger-messages-footer {
            padding: 15px;
            border: 2px solid #eee;
        }

        .loader {
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 48px;
            height: 48px;
            animation: spin 2s linear infinite;
            margin: auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection

@section ('content')




    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Messages
                <small>All User's Messages</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>

                <li class="active">
                    <i class="fa fa-file"></i> Messages
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
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <!-- -->
            </div>

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

            <div calss="row">
                <div class="messenger clearfix">
                    <div class="col-md-4">
                        <div class="messenger-users">
                            <h3>Users</h3>
                            <div class="all-messenger-users">
                                @if ( count($chatUsers) > 0 )
                                    @foreach ( $chatUsers as $chatUser )

                                        <div class="items" data-message-id="{{ $chatUser['id'] }}"
                                             data-user-id="{{ $chatUser['user_id'] }}">
                                            <ul>
                                                <li>
                                                    @if ( $chatUser['is_ip'] )
                                                        <img src="{{ asset('images/chat/unknown_user.png') }}"/>
                                                    @else
                                                        <img src="{{ asset('images/chat/man.png') }}"/>
                                                    @endif
                                                </li>
                                                <li>
                                                    @if ( $chatUser['is_ip'] )
                                                        {{ $chatUser['user_id'] }}
                                                    @else
                                                        {{-- App\User::getUserName($chatUser['user_id'])->name --}}
                                                        @if ( !empty(App\User::getUserName($chatUser['user_id'])) )
                                                            {{ App\User::getUserName($chatUser['user_id'])->name }}
                                                        @endif
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="messenger-messages">
                            <h3>Messages</h3>
                            <div class="all-messenger-messages">
                                <div class="items"><p class="blank_chat_info">Select a user from left to view the
                                        conversations</p></div>
                            </div>

                            <div class="messenger-messages-footer">
                                <textarea class="form-control" placeholder="Type message here..."
                                          id="messenger_message_text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>


@endsection


@section('scripts')
    <script>
        var selected_chat_user = 0;
        $(document).ready(function () {


            $(document).on('click', '.messenger-users .all-messenger-users > .items', function (e) {

                e.preventDefault();

                selected_chat_user = $(this).attr('data-user-id');
                callAutoMessage();
                //alert($("#hid_base_url").val() + "/admin/user/" + $(this).attr('data-user-id') + "/messages/" + $(this).attr('data-message-id'));

                $.ajax({
                    type: 'POST',
                    url: $("#hid_base_url").val() + "/admin/user/" + $(this).attr('data-user-id') + "/messages/" + $(this).attr('data-message-id'),
                    data: "_token={{ csrf_token() }}",
                    beforeSend: function () {
                        $(".messenger-messages .all-messenger-messages > .items").html('<div class="loader"></div>');
                    },
                    success: function (response) {

                        console.log(response);

                        $(".messenger-messages .all-messenger-messages > .items > .loader").remove();

                        var json = JSON.parse(response);

                        if (json.status == 'success') {
                            if ($(".messenger-messages .all-messenger-messages > .items > p").length > 0) {
                                $(".messenger-messages .all-messenger-messages > .items").html(json.html);
                            } else {
                                $(".messenger-messages .all-messenger-messages > .items").append(json.html);
                            }
                        }

                    },
                    error: function (a, b) {

                        console.log(a.responseText);
                    }
                });
            });


            $(document).on("keyup", "#messenger_message_text", function (e) {

                //e.preventDefault();

                var code = e.keyCode || e.which;
                var chat_body_container = $(".messenger-messages .all-messenger-messages > .items");

                //if enter key has hit
                if (code == 13) {
                    //alert("submit");

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('admin.messenger.store') }}",
                        data: 'message=' + $(this).val() + "&from={{ Auth::user()->id }}&to=" + selected_chat_user + "&is_user=true&_token={{ csrf_token() }}",
                        beforeSend: function () {
                            //$(".user-chat .chat-window .chat-window-body .chat-history > .chat-history-message.message-from-user ul > li:first-child").css('background-color', '#a6e2d5');
                        },
                        success: function (response) {
                            console.log(response);
                            $(".messenger-messages .all-messenger-messages > .items .chat-history-message.message-from-admin ul > li:first-child").css('background-color', '#68afa0');
                        },
                        error: function (a, b) {
                            console.log(a.responseText);
                        }
                    });

                    var html = '<div class="chat-history-message message-from-admin">';
                    html += '<ul>';
                    html += '<li><p>' + $(this).val() + '</p></li>';
                    html += '<li><img src={{ asset("images/chat/admin.png") }} /></li>';
                    html += '</ul></div>';

                    if ($(chat_body_container).find('.blank_chat_info').length > 0) {
                        $(chat_body_container).html(html);
                    } else {
                        $(chat_body_container).append(html);
                    }

                    var $target = $(chat_body_container).parent();
                    $target.animate({scrollTop: $target.height()}, 300);

                    $(this).val('');
                }
            });


            $(document).on("click", "#messenger_message_text", function (e) {

                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.messenger.message.mark.read', Auth::user()->id) }}",
                    data: "_token={{ csrf_token() }}&user=" + selected_chat_user,
                    beforeSend: function () {
                        //$(".user-chat .chat-window .chat-window-body .chat-history > .chat-history-message.message-from-user ul > li:first-child").css('background-color', '#a6e2d5');
                    },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });

            });


        });

        function callAutoMessage() {

            //alert(this);

            if (selected_chat_user > 0) {

                //auto check message
                setInterval(function () {
                    //load user's previous messages
                    $.ajax({
                        type: 'GET',
                        url: "{{ route('admin.messenger.message.unread', Auth::user()->id) }}",
                        data: "_token={{ csrf_token() }}&user=" + selected_chat_user,
                        beforeSend: function () {
                            //$(".user-chat .chat-window .chat-window-body .chat-history > .chat-history-message.message-from-user ul > li:first-child").css('background-color', '#a6e2d5');
                            //$(".user-chat .chat-window .chat-window-header .messenger_controls > li:first-child").html('<i class="fa fa-refresh fa-spin"></i>');
                        },
                        success: function (response) {
                            console.log(response);

                            var json = JSON.parse(response);

                            if (json.status == 'success') {
                                if ($(".messenger-messages .all-messenger-messages > .items > p").length > 0) {
                                    $(".messenger-messages .all-messenger-messages > .items").html(json.html);
                                } else {
                                    $(".messenger-messages .all-messenger-messages > .items").append(json.html);
                                }
                            }

                        },
                        error: function (a, b) {
                            console.log(a.responseText);
                        }
                    });
                }, 1000);//time in milliseconds
            }

        }
    </script>
@endsection