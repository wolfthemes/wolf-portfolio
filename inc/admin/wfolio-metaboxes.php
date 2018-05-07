<?php
/**
 * %NAME% register metaboxes
 *
 * @author %AUTHOR%
 * @category Core
 * @package %PACKAGENAME%/Admin
 * @version %VERSION%
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$metaboxes = array(
	'Work Details' => array(
		'title' => esc_html__( 'Work Details', '%TEXTDOMAIN%' ),
		'page' => array( 'work' ),
		'metafields' => array(
			array(
				'label'	=> esc_html__( 'Client', '%TEXTDOMAIN%' ),
				'id'	=> '_work_client',
				'type'	=> 'text',
			),

			array(
				'label'	=> esc_html__( 'Link', '%TEXTDOMAIN%' ),
				'id'	=> '_work_link',
				'type'	=> 'text',
			),
		),
	),
);

new Wolf_Portfolio_Admin_Metabox( $metaboxes );