@extends('layouts.help')

@section('styles')
    <style>
        <
        style >
        * {
            box-sizing: border-box;
        }

        #help_center {

        }

        #help_center .jumbotron {
            min-height: 150px;
            max-height: 150px;
            padding-top: 24px;
        }

        #help_center .jumbotron h2 {
            font-size: 26px;
        }

        #search {
            position: relative;
            font-size: 18px;
            padding-top: 40px;
            margin: -20px auto 0;
        }

        #search label {
            position: absolute;
            left: 17px;
            top: 51px;
        }

        #search #search-input, #search .hint {
            padding-left: 43px;
            padding-right: 43px;
            border-radius: 23px;
        }

        #search #search-clear {
            text-decoration: none;
            position: absolute;
            right: 18px;
            top: 54px;
            color: #b3b3b3;
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }

        .help-topics {

        }
        .help-topics .topic-header {

        }
        .topic-details {
            max-width: 100%;
        }
        .topic-details img {
            max-width: 100%;
        }

        .search-results {
            background: #fff;
            border: 1px solid #f1f1f1;
            text-align: left;
            position: absolute;
            width: 100%;
            z-index: 999;
            padding-top: 15px;
            display: none;
        }
        .search-results ul {
            list-style-type: none;
            padding: 0px;
        }
        .search-results ul > li {

        }
        .search-results ul > li > a {
            line-height: 35px;
            display: block;
            padding: 0px 15px;
            font-size: 16px;
        }

        @media only screen and (max-width: 600px) {
            .columns {
                width: 100%;
            }
        }
    </style>
@endsection

@section('content')

    <section id="help_center">
        <div class="jumbotron text-center">
            <div class="container">
                <h2>Need help? Here are some common questions and answers..</h2>
                <div class="col-md-10 col-md-offset-1">
                    <form>
                        <section id="search">
                            <label for="search-input"><i class="fa fa-search" aria-hidden="true"></i><span
                                        class="sr-only">Search</span></label>
                            <input id="search-input" class="form-control input-lg" placeholder="Search"
                                   autocomplete="off" spellcheck="false" autocorrect="off" tabindex="1">
                            <a id="search-clear" href="#" class="fa fa-times-circle hide" aria-hidden="true"><span
                                        class="sr-only">Clear search</span></a>

                            <div class="search-results"></div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
        <div class="help-center container clearfix">
            <div class="container">
                <div class="help-topics">
                    <div class="topic-header">
                        <h3>{{ $helpCenterTopic->title }}</h3>
                    </div>
                    <hr>
                    <div class="topic-details">
                        {!! $helpCenterTopic->details !!}
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $("#search-input").on('keyup change', function(e) {

                if ( (e.keyCode != 13) && (e.keyCode != 9) ) {

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('site.help.search') }}",
                        data: 'keyword=' + $(this).val() + "&_token={{ csrf_token() }}",
                        success: function (response) {
                            console.log(response);
                            var json = JSON.parse(response);

                            if ( json.status == 'success' ) {

                                if ( json.html.length > 0 ) {
                                    $(".search-results").html(json.html);
                                    $(".search-results").show();
                                } else {
                                    $(".search-results").hide();
                                }
                            }
                        },
                        error: function (a, b) {
                            document.write(a.responseText);
                            $(".search-results").hide();
                        }
                    });
                }
            });
        });
    </script>
@endsection

