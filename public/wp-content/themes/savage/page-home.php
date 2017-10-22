<?php

namespace Savage;

/**
 * Template Name: Home
 */

use Timber;

$context = Timber::get_context();
$context['query'] = new Query();
$context['post'] = new UrbanOmnibusPost();
$context['posts'] = Timber::get_posts(array(
	'posts_per_page' => 10,
	'meta_query' => array(
		array(
			'key' => 'featured_post',
			'value' => true
		)
	)
));

$context['taxonomies']['subject'] = Timber::get_terms('subject');
$context['taxonomies']['medium'] = Timber::get_terms('medium');

Timber::render( 'pages/page-home.twig', $context );