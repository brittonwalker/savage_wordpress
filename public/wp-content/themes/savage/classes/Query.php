<?php

namespace Savage;

use Timber;

// utility class for querying related posts
class Query {

	/**
	 * [getRelatedPostsBySubject description]
	 * @param  [type] $subject [description]
	 * @return [type]          [description]
	 */
	public function findMostRecentPostByTaxonomy($taxonomy, $termId) {

		$args = array(
			'posts_per_page' => 1,
			'taxonomy' => array(
				array(
					'taxonomy' => $taxonomy,
					'fields' => 'term_id',
					'terms' => array($termId)
				)
			)
		);

		return \Timber::get_posts($args);
	}

	/**
	 * [findAllPosts description]
	 * @return [type] [description]
	 */
	public function findAllPosts() {
		return \Timber::get_posts();
	}

}