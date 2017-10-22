<?php

namespace Savage;

use Timber;

$context = Timber::get_context();

$args = array(
    'post_type' => 'painting',
);

$context['paintings'] = Timber::get_posts( $args );

$args = array(
    'post_type' => 'drawing',
);

$context['drawings'] = Timber::get_posts( $args );

$args = array(
    'post_type' => 'album_art',
);

$context['album_art'] = Timber::get_posts( $args );

$args = array(
    'post_type' => 'other',
);

$context['other'] = Timber::get_posts( $args );



Timber::render( 'index.twig', $context );