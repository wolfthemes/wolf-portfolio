<?php
/**
 * %NAME% register post type
 *
 * @author %AUTHOR%
 * @category Core
 * @package %PACKAGENAME%/Admin
 * @version %VERSION%
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Register Work post type */
$labels = array(
	'name' => esc_html__( 'Works', '%TEXTDOMAIN%' ),
	'singular_name' => esc_html__( 'Work', '%TEXTDOMAIN%' ),
	'add_new' => esc_html__( 'Add New', '%TEXTDOMAIN%' ),
	'add_new_item' => esc_html__( 'Add New Work', '%TEXTDOMAIN%' ),
	'all_items'  => esc_html__( 'All Works', '%TEXTDOMAIN%' ),
	'edit_item' => esc_html__( 'Edit Work', '%TEXTDOMAIN%' ),
	'new_item' => esc_html__( 'New Work', '%TEXTDOMAIN%' ),
	'view_item' => esc_html__( 'View Work', '%TEXTDOMAIN%' ),
	'search_items' => esc_html__( 'Search Works', '%TEXTDOMAIN%' ),
	'not_found' => esc_html__( 'No Works found', '%TEXTDOMAIN%' ),
	'not_found_in_trash' => esc_html__( 'No Works found in Trash', '%TEXTDOMAIN%' ),
	'parent_item_colon' => '',
	'menu_name' => esc_html__( 'Portfolio', '%TEXTDOMAIN%' ),
);

$args = array(
	'labels' => $labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	'query_var' => false,
	'rewrite' => array( 'slug' => 'work' ),
	'capability_type' => 'post',
	'has_archive' => false,
	'hierarchical' => false,
	'menu_position' => 5,
	'taxonomies' => array(),
	'supports' => array( 'title', 'editor', 'author', 'post-formats', 'thumbnail', 'custom-fields', 'excerpt' ),
	'exclude_from_search' => false,
	'description' => esc_html__( 'Present your work', '%TEXTDOMAIN%' ),
	'menu_icon' => 'dashicons-admin-customizer',
);

register_post_type( 'work', $args );