<?php if ( ! empty( $images ) ) { ?>
@foreach ( $directories as $key=>$directory )
	<?php $dir = explode( '/', $directory ); ?>
    <ul class="gallery-container clearfix" data-open-content="{{ $dir[count($dir) - 1] }}"
        style="display: {{ (($key == 1) ? 'block' : 'none') }}">

        @if ( strtolower($dir[count($dir) - 1]) != 'library' )
			<?php foreach ( $images as $key=>$image ) { ?>
            @if ( $dir[count($dir) - 1] == $image->getRelativepath() )
                <li class="gallery-item">
                    <img src="{{ asset(env('DEVELOPER_IMAGE_GALLERY_PATH') . $image->getRelativepath() . '/' . $image->getFilename()) }}"/>
                </li>
            @endif
			<?php } ?>
        @else

        <!-- AWS S3 -->
            @foreach ( array_reverse($libraryFiles) as $libraryFile )
                <li class="gallery-item">
                    <img data-image-id="{{ basename($libraryFile) }}" src="{{ $libraryFile }}"/>
                </li>
            @endforeach
            @foreach ( $userImages as $image )
				<?php $path = public_path( env( 'DEVELOPER_IMAGE_LIBRARY_PATH' ) . $image->path ); ?>

                @if ( File::exists($path) )
                    <li class="gallery-item">
                        <img data-image-id="{{ $image->id }}"
                             src="{{ asset(env('DEVELOPER_IMAGE_LIBRARY_PATH') . $image->path) }}"/>
                    </li>
                @endif
            @endforeach
        @endif
    </ul>
@endforeach
<?php } ?>
