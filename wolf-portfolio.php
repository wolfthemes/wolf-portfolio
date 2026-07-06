<?php
/**
 * Plugin Name: Portfolio
 * Plugin URI: https://wlfthm.es/wolf-portfolio
 * Description: A portfolio post type for your theme.
 * Version: 1.2.6
 * Author: WolfThemes
 * Author URI: https://wolfthemes.com
 * Requires at least: 6.0
 * Tested up to: 6.8
 *
 * Text Domain: wolf-portfolio
 * Domain Path: /languages/
 *
 * @package WolfPortfolio
 * @category Core
 * @author WolfThemes
 *
 * Verified customers who have purchased a premium theme at https://wlfthm.es/tf/
 * will have access to support for this plugin in the forums
 * https://wlfthm.es/help/
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'WFOLIO_PLUGIN_FILE' ) ) {
	define( 'WFOLIO_PLUGIN_FILE', __FILE__ );
}

/**
 * Autoload WolfPortfolio\* classes from src/ and lazily alias
 * legacy (pre-namespace) class names for backward compatibility.
 */
spl_autoload_register( function ( $class ) {

	$legacy_aliases = array(
		'Wolf_Portfolio'               => 'WolfPortfolio\Plugin',
		'Wolf_Portfolio_Admin'         => 'WolfPortfolio\Admin\Admin',
		'Wolf_Portfolio_Options'       => 'WolfPortfolio\Admin\Options',
		'Wolf_Portfolio_Admin_Metabox' => 'WolfPortfolio\Admin\Metabox',
		'Wolf_Portfolio_Update'        => 'WolfPortfolio\Admin\Update',
		'Wolf_Portfolio_Shortcode'     => 'WolfPortfolio\Frontend\Shortcodes',
	);

	if ( isset( $legacy_aliases[ $class ] ) ) {
		class_alias( $legacy_aliases[ $class ], $class );
		return;
	}

	if ( 0 !== strpos( $class, 'WolfPortfolio\\' ) ) {
		return;
	}

	$path = __DIR__ . '/Functions/' . str_replace( '\\', '/', substr( $class, strlen( 'WolfPortfolio\\' ) ) ) . '.php';

	if ( file_exists( $path ) ) {
		require $path;
	}
} );

if ( ! function_exists( 'WFOLIO' ) ) {
	/**
	 * Returns the main instance of the plugin to prevent the need to use globals.
	 *
	 * @return \WolfPortfolio\Plugin
	 */
	function WFOLIO() {
		return \WolfPortfolio\Plugin::instance();
	}
}

WFOLIO(); // Go
