@include('builder.partials.header')
<div class="body">
    <div class="main_container">
        @include('builder.partials.inner')
        @include('builder.partials.top')

        <div id="panel-left-sidebar">
        @include('builder.partials.left')
        </div>

        <!-- page content -->
        <div class="main-container" role="main" style="<?php echo ( ! empty( $contents->pagestyle ) ) ? $contents->pagestyle : '' ?>">
        @include('builder.partials.middle')
        </div>

        <div id="panel-right-sidebar">
            @include('builder.partials.right')
        </div>

        @include('builder.partials.bottom')
    </div>
</div>

@include('builder.widgets')

@include('builder.partials.footer')
