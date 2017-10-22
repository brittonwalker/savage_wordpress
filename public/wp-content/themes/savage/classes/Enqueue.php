<?php

namespace Savage;

class Enqueue {

	/**
	 * @var string $version
	 */
	public $version = '';

	/**
	 * @var string $url
	 */
	public $url = '';

	/**
	 * @var string $css
	 */
	public $css = 'min.css';

	/**
	 * @var string $namespace
	 */
	public $namespace = null;

	/**
	 * Public constructor
	 */
	public function __construct( $namespace ) {

		$this->namespace = $namespace;

		$this->url = get_stylesheet_directory_uri();

		if ( $this->is_development() ) {
			$this->version = time();
			$this->css = 'css';
		} else {
			$theme = wp_get_theme();
			$this->version = $theme->get( 'Version' );
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
		// add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'site_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'site_scripts' ) );

	}

	/**
	 * Is development environment?
	 *
	 * @return boolean
	 */
	public function is_development() {

		if ( defined( 'MNFST_TM_STMP' ) && MNFST_TM_STMP ) {
			return true;
		}

		return false;

	}

	/**
	 * Admin Styles
	 */
	public function admin_styles() {

		wp_enqueue_style(
			"{$this->namespace}-admin",
			"{$this->url}/assets/css/admin.{$this->css}",
			false,
			$this->version,
			'screen'
		);

	}

	/**
	 * Admin Scripts
	 */
	public function admin_scripts() {

	}

	/**
	 * Site Styles
	 */
	public function site_styles() {

		wp_enqueue_style(
			"{$this->namespace}-css",
			"{$this->url}/assets/css/site.{$this->css}",
			false,
			$this->version,
			'screen, print'
		);

	}

	/**
	 * Site Scripts
	 */
	public function site_scripts() {

		wp_enqueue_script(
			"{$this->namespace}-site",
			"{$this->url}/assets/js/site.js",
			array(
				'jquery',
			),
			$this->version,
			true
		);

	}

}
new Enqueue( 'uo' );
