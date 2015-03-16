<?php
/*
Plugin Name: PressForward Stats
Plugin URI: http://pressforward.org/
Description: A plugin that generates shortcodes to calculate stats about use of the PressForward plugin.
Version: 0.0.1
GitHub Plugin URI: https://github.com/PressForward/pressforward
Author: Aram Zucker-Scharff, Boone B Gorges, Jeremy Boggs
Author URI: http://pressforward.org/about/team/
License: GPL2
*/
/*  Developed for the Roy Rosenzweig Center for History and New Media
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

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

		$this->includes();

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
		$this->meta_author_key = 'item_author';

	}

	private function includes(){

		require_once( $this->root . '/lib/gender-checker/src/GenderEngine/GenderEngine.php' );
		require_once( $this->root . '/lib/text-stats/src/DaveChild/TextStatistics/TextStatistics.php' );
		require_once( $this->root . '/includes/shortcodes.php' );

	}

	public function base(){



	}

	public function access(){



	}

	public function shortcodes(){

		if ( empty( $this->shortcodes ) ) {

			$this->shortcodes = PF_Stats_Shortcodes::init();

		}

	}
}

function pressforward_stats(){

	return PF_Stats::init();

}
add_action( 'pressforward_init', 'pressforward_stats' );