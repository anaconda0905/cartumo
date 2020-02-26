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

    </head>

    <body>

        <!-- Edit Link Modal -->
        <div id="modalOptinPop-up" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sign Up</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>

          </div>
        </div>

        <div id="contentDiv">
            {!! $content !!}
        </div>

        <script type="text/javascript">

            $ (".btn-optin-pop_up").attr( "data-toggle", "modal");
            $ (".btn-optin-pop_up").attr( "data-target", "#modalOptinPop-up");

        </script>

    </body>
</html>
