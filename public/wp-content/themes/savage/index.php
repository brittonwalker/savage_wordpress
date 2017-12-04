<?php

namespace Savage;

use Timber;

$context = Timber::get_context();

$args = array(
    'post_type' => 'painting',
    'posts_per_page' => -1,
);

$context['paintings'] = Timber::get_posts( $args );

$args = array(
    'post_type' => 'drawing',
    'posts_per_page' => -1,
);

$context['drawings'] = Timber::get_posts( $args );

$args = array(
    'post_type' => 'album_art',
    'posts_per_page' => -1,
);

$context['album_art'] = Timber::get_posts( $args );

$args = array(
    'post_type' => 'other',
    'posts_per_page' => -1,
);

$context['other'] = Timber::get_posts( $args );



Timber::render( 'index.twig', $context );