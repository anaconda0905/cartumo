<!DOCTYPE html>
<html lang="en" style="{{ (!empty($contents->pagebackground)) ? $contents->pagebackground : '' }}">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <meta name="viewport" content="width=600,initial-scale = 2.3,user-scalable=no">
<!-- Bootstrap -->

    <!-- Custom Theme Style -->
    <style>
        body {
            background: #aaa;
        }
    </style>

    @if ( !empty($contents->external_fonts) )
		<?php $fonts = ""; ?>
        @foreach ( explode(",", $contents->external_fonts) as $key=>$font )
			<?php $fonts .= $font . "|"; ?>
        @endforeach

		<?php echo "<link href='https://fonts.googleapis.com/css?family=" . trim( $fonts, '|' ) . "' rel='stylesheet'>"; ?>
    @endif

</head>

<body class="nav-sm landing-page-editor">
<div class="body">
    <div class="main_container">
        <div class="right_col" role="main"
             style="<?php echo ( ! empty( $contents->pagestyle ) ) ? $contents->pagestyle : '' ?>">
            <div id="editor_panel">
                <div id="htmleditor"><?php echo ( ! empty( $contents->htmlbody ) ) ? $contents->htmlbody : ''; ?></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
