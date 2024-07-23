<?php

// Additional image sizes
function img_sizes_setup() {
  // add_image_size( 'example', 999, 999, true );
  // add_image_size( 'example-2x', 999*2, 999*2, true );
}
add_action( 'after_setup_theme', 'img_sizes_setup' );
