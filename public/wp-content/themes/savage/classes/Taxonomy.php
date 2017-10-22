<?php

namespace Savage;

use Timber;

class Taxonomy {

	public $thumbnailIndex = 0;

	public function __construct(array $options) {
		$this->series = \Timber::get_terms($options['taxonomy']);
		$this->filteredSeries = array();


		foreach ($this->series as $key => $value) {
			if ($value->meta('parent') == 0) {
				$this->filteredSeries[$key]['term'] = $value;
				$posts = Timber::get_posts(array($options['taxonomy'] => $value->name));
				if ($thumbnail = $posts[0]->_thumbnail_id) {
					$this->filteredSeries[$key]['thumbnail'] = $thumbnail;
				}
			}		
		}
	}

	public function filterSeries() {

	}

	public function getFilteredSeries() {
		return $this->filteredSeries;
	}

	// public function mapThumbnails() {

	// 	return array_map(function($value) {
	// 		if ($series = $this->filteredSeries[$this->thumbnailIndex]) {
	// 			print_r($series->name);
	// 		}

	// 		$post = Timber::get_posts(array('series' => $this->filteredSeries[0]->name));
	// 		$this->thumbnailIndex = $this->thumbnailIndex + 1;

	// 		print_r($this->thumbnailIndex);
	// 		return new \Timber\Image($post[0]->_thumbnail_id);	
	// 	}, $this->filteredSeries);
	// }

}