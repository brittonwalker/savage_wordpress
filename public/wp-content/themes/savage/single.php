<?php

namespace Savage;

use Timber;

$template = array( 'single.twig' );

$context = Timber::get_context();
$context['post'] = new UrbanOmnibusPost();
$context['related_posts'] = new RelatedPosts();
// $context['terms'] = new Terms();
$context['postTaxonomy'] = new PostTaxonomy();

// Get Post Terms
$nyc_and_elsewhere = wp_get_post_terms( $context['post']->ID, array( 'elsewhere', 'new-york-city') );
$topic_and_medium = wp_get_post_terms( $context['post']->ID, array( 'topic', 'medium') );
$subjects = wp_get_post_terms( $context['post']->ID, 'subject' );

$terms_array = array( $subjects, $topic_and_medium, $nyc_and_elsewhere );
$filtered_array = array_filter($terms_array);

$context['post_terms'] = $filtered_array;

// Get Series
$series = wp_get_post_terms( $context['post']->ID, 'series' );

	// Create new array to loop series and prepend parent term to array
	$series_array = array();

	foreach ($series as &$term) {

		($term->parent == 0) ? array_unshift($series_array, $term) : $series_array[] = $term;

	}

$context['series'] = $series_array;

Timber::render($template, $context);