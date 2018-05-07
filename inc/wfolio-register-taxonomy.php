<?php
/**
 * %NAME% register taxonomy
 *
 * @author %AUTHOR%
 * @category Core
 * @package %PACKAGENAME%/Admin
 * @version %VERSION%
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Portfolio Taxonomy */
$labels = array(
	'name' => esc_html__( 'Portfolio Categories', '%TEXTDOMAIN%' ),
	'singular_name' => esc_html__( 'Portfolio Category', '%TEXTDOMAIN%' ),
	'search_items' => esc_html__( 'Search Portfolio Categories', '%TEXTDOMAIN%' ),
	'popular_items' => esc_html__( 'Popular Portfolio Categories', '%TEXTDOMAIN%' ),
	'all_items' => esc_html__( 'All Portfolio Categories', '%TEXTDOMAIN%' ),
	'parent_item' => esc_html__( 'Parent Portfolio Category', '%TEXTDOMAIN%' ),
	'parent_item_colon' => esc_html__( 'Parent Portfolio Category:', '%TEXTDOMAIN%' ),
	'edit_item' => esc_html__( 'Edit Portfolio Category', '%TEXTDOMAIN%' ),
	'update_item' => esc_html__( 'Update Portfolio Category', '%TEXTDOMAIN%' ),
	'add_new_item' => esc_html__( 'Add New Portfolio Category', '%TEXTDOMAIN%' ),
	'new_item_name' => esc_html__( 'New Portfolio Category', '%TEXTDOMAIN%' ),
	'separate_items_with_commas' => esc_html__( 'Separate portfolio categories with commas', '%TEXTDOMAIN%' ),
	'add_or_remove_items' => esc_html__( 'Add or remove portfolio categories', '%TEXTDOMAIN%' ),
	'choose_from_most_used' => esc_html__( 'Choose from the most used portfolio categories', '%TEXTDOMAIN%' ),
	'not_found' => esc_html__( 'No categories found', '%TEXTDOMAIN%' ),
	'menu_name' => esc_html__( 'Categories', '%TEXTDOMAIN%' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => true,
	'public' => true,
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => array( 'slug' => 'work-type', 'with_front' => false ),
);

register_taxonomy( 'work_type', array( 'work' ), $args );