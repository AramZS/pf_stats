<?php

class PF_Stat_Shortcodes {

	public function init() {



	}

	private function __construct() {

		add_shortcode( 'pf_wordcount_last_thirty', array( $this, 'pf_wordcount_last_thirty' ) );

	}

	// Add Shortcode
	public function pf_wordcount_last_thirty() {
			$wc = 0;
			$c = 0;
			$the_query = new WP_Query(
				array(
					'nopaging' => true,
					'date_query' => array(
						'meta_key' => ,
						'column' => 'post_date_gmt',
						'after'  => '30 days ago',
					)

				)
			);
		if ( $the_query->have_posts() ) :

				while ( $the_query->have_posts() ) : $the_query->the_post();
					$content = get_post_field( 'post_content', get_the_ID() );
					$word_count = str_word_count( strip_tags( $content ) );
					$wc = $wc+$word_count;
					$c++;
				endwhile;

			wp_reset_postdata();

			$s = $this->the_shortcode( 'pf_wordcount_last_thirty', array( 'word_count' => $wc, 'count' => $c, 'days' => '30' ) );

		else :

			$s = $this->the_shortcode( 'read_nothing', array( 'days' => '30' ) );

		endif;

		return $s;
	}

	public function the_shortcode($code, $args){
		$s = '';
		switch ( $code ) {
			case 'pf_wordcount_last_thirty':
				$s = sprintf( __("I've read %s words across %s posts in the past %s days.", 'pf' ), $args['word_count'], $args['count'], $args['days'] );
				break;
			case 'not_30':
				$s = sprintf( __( 'I\'ve read nothing in the past %s days.', 'pf' ), $args['days'] );
				break;
		}

		return '<p>' . $s  . '</p>';

	}

}