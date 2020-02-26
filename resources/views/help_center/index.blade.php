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
            min-height: 250px;
            max-height: 250px;
            padding-top: 70px;
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

        .help-topics > .item {
            padding: 0 0 60px;
            margin: 0 0 40px;
            border-bottom: 1px solid #e5e5e5;
        }
        .help-topics > .item:last-child {
            border-bottom: 0px;
        }

        .help-topics > .item > .help-topics-header {
            margin: 0 0 40px;
        }

        .help-topics > .item > .help-topics-body {

        }

        .help-topics > .item > .help-topics-body ul {
            padding-left: 0;
            list-style: none;
            margin-bottom: 10px;
            font-size: 16px;
            -moz-column-width: 50%;
            -moz-column-count: 2;
            -moz-column-gap: 15px;
            -moz-column-rule-color: transparent;
            -moz-column-rule-style: solid;
            -moz-column-rule-width: 0;
            -webkit-column-width: 50%;
            -webkit-column-count: 2;
            -webkit-column-gap: 15px;
            -webkit-column-rule-color: transparent;
            -webkit-column-rule-style: solid;
            -webkit-column-rule-width: 0;
            column-width: 50%;
            column-count: 2;
            column-gap: 15px;
            column-rule-color: transparent;
            column-rule-style: solid;
            column-rule-width: 0;
        }

        .help-topics > .item > .help-topics-body ul > li {
            margin-bottom: 20px;
        }

        .help-topics > .item > .help-topics-body ul > li > a {
            font-size: 16px;
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
                    @if ( $helpCategories->count() > 0 )
                        @foreach ( $helpCategories as $helpCategory )
                            @if ( $helpCategory->topics->count() > 0 )
                                <div class="item">
                                <div class="help-topics-header">
                                    <h3>{{ $helpCategory->title }}</h3>
                                </div>
                                <div class="help-topics-body">
                                    @foreach ( $helpCategory->topics as $topic )
                                        <ul class="lists">
                                            <li>
                                                <a href="{{ route('site.help.topic', $topic->slug) }}">{{ $topic->title }}</a>
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @endif
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
