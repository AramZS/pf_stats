<?php 

// A scrap file to store some functions

add_action( 'init', 'handle_preflight' );

function handle_preflight() {
    header("Access-Control-Allow-Origin: " . get_http_origin());
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Credentials: true");

    if ( 'OPTIONS' == $_SERVER['REQUEST_METHOD'] ) {
        status_header(200);
        exit();
    }
}


// Add Shortcode
function pf_total_wordcount_shortcode() {
		$wc = 0;
		$c = 0;
		$the_query = new WP_Query(
			array(
				'nopaging' => true,
				'date_query' => array(
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

		?><p><?php echo 'I\'ve read '.$wc.' words across '.$c.' posts in the past 30 days.'; ?></p><?php

	else :
		?><p><?php _e( 'I\'ve read nothing in the past 30 days.' ); ?></p><?php
	endif;
}
add_shortcode( 'pf_total_wordcount', 'pf_total_wordcount_shortcode' );