<?php

class PF_Stats {

	var $slug;
	var $title;
	var $root;
	var $file_path;
	var $url;
	var $ver;
	var $feed_post_type;
	var $meta_key;
	
	var $base;
	var $access;
	var $shortcodes;

	public static function init() {
		static $instance;
		if ( ! is_a( $instance, 'PF_Stats' ) ) {
			$instance = new self();
		}
		return $instance;
	}

	private function __construct() {
		
		$this->define_constants();

		$this->base();

		$this->access();

		$this->shortcodes();
	}

	private function define_constants(){

		$this->slug = 'pf_stats';
		$this->title = 'PressForward Stats';
		$this->root = dirname(__FILE__);
		$this->file_path = $this->root . '/' . basename(__FILE__);
		$this->url = plugins_url( '/', __FILE__ );
		$this->ver = 1.0;
		$this->feed_post_type = 'pf_feed_item';
		$this->meta_key = 'item_id';

	}

	private function includes(){

		require_once( $this->root . '/lib/gender-checker/src/GenderEngine.php' );
		require_once( $this->root . '/lib/text-stats/text-stats/src/DaveChild/TextStatistics/TextStatistics.php' )
		require_once( $this->root . '/includes/shortcodes.php' );

	}

	public function base(){



	}

	public function access(){



	}

	public function shortcodes(){

		if ( empty( $this->shortcodes ) ) {

			$this->shortcodes = new PF_Stat_Shortcodes;

		}

	}
}