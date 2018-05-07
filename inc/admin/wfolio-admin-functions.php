<?php
/**
 * %NAME% admin functions
 *
 * Functions available on admin
 *
 * @author %AUTHOR%
 * @category Core
 * @package %PACKAGENAME%/Core
 * @version %VERSION%
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Display archive page state
 *
 * @param array $states
 * @param object $post
 * @return array $states
 */
function wfolio_custom_post_states( $states, $post ) { 

	if ( 'page' == get_post_type( $post->ID ) && absint( $post->ID ) === wolf_portfolio_get_page_id() ) {

		$states[] = esc_html__( 'Portfolio Page' );
	} 

	return $states;
}
add_filter( 'display_post_states', 'wfolio_custom_post_states', 10, 2 );