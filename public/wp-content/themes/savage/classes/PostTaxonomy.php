<?php 
namespace Savage;

use Timber;

class PostTaxonomy {

	/**
	 * [init description]
	 * @param  array  $options [description]
	 * @return [type]          [description]
	 */
	public function init(array $options) {
		$this->post_terms = $options['post_terms'];
		$this->groups = array(
			array(
				'new-york-city',
				'elsewhere'
			),
			array(
				'media'
			),
			array(
				'subject',
				'topic'
			)
		);

		$this->group_matches = array();

		return $this;
	}

	/**
	 * [sortTerms description]
	 * @return [type] [description]
	 */
	public function sortTerms() {
		// @todo refactor
		foreach($this->post_terms as $term) {
			foreach($this->groups as $group) {
				if (in_array($term->taxonomy, $group)) {
					// @todo refactor
					if (!in_array($term->taxonomy, $this->group_matches)) {
						array_push($this->group_matches, $term->taxonomy);
					}
				}
			}
		}
	
		return $this;
	
	}

	/**
	 * [translateToColumnLength description]
	 * @param  [type] $count [description]
	 * @return [type]        [description]
	 */
	private function translateToColumnLength($count) {
		$columnWidthTranslator = array(
			0 => 12,
			1 => 12,
			2 => 6,
			3 => 4
		);

		return $columnWidthTranslator[$count];
	}

	/**
	 * [findColumnWidth description]
	 * @return [type] [description]
	 */
	public function findColumnWidth(array $options) {
		$this->init($options)->sortTerms();
		return $this->translateToColumnLength(count($this->group_matches));
	}

}