<?php

namespace Savage;

add_theme_support( 'post-formats', array( 'video', 'gallery' ) );

add_action( 'init', function() {

    register_taxonomy( 'category', array() );

} );
