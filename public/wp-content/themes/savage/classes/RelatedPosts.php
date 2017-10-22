<?php

namespace Savage;

use Timber;

// utility class for querying related posts
class RelatedPosts {

	/**
	 * [getRelatedPostsBySubject description]
	 * @param  [type] $subject [description]
	 * @return [type]          [description]
	 * @todo rename and merge with the query class
	 */
	public function findRelatedPostsBySubject($limit, $subject = false) {

		$args = array(
			'posts_per_page' => $limit,
			'taxonomy' => array(
				array(
					'taxonomy' => 'subject'
				)
			)
		);

		if (!$subject) {
			$args['taxonomy']['terms'] = $subject;
		}

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