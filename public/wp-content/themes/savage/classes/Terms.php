<?php

namespace Savage;

use Timber;

class Terms {
	/**
	 * [findTermChildren description]
	 * @return [type] [description]
	 */
	public function findTermBySlug($slug) {
		return new \TimberTerm($slug);
	}

	public function findTerm() {
		return new \TimberTerm();
	}

}