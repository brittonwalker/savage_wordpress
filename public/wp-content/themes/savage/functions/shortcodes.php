<?php

/**
 *
 * text [footnote =""]
 */

function footnote_shortcode($attributes, $content) {

	$attributes['link-prefix'] = 'footnote';

	return '<span id="'.$attributes['link-prefix'].'-reference-'.esc_attr($attributes['number']).'" class="footnote__link" ><a class="post-footnote__link" href="#'.$attributes['link-prefix'].'-'.esc_attr($attributes['number']).'"><sup>'.esc_attr($attributes['number']).'</sup></a></span>';
	
}

add_shortcode('footnote', 'footnote_shortcode');

//[intro]
function intro_shortcode( $atts, $content = null ){

	return '<div class="introduction-wrapper text-highlight">' . '<p>' . $content . '</p>' . '</div>';

}
add_shortcode( 'intro', 'intro_shortcode' );