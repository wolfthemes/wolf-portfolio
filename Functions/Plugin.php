<?php
/**
 * Main Wolf Portfolio class.
 *
 * @package WolfPortfolio
 * @author WolfThemes
 */

namespace WolfPortfolio;

defined( 'ABSPATH' ) || exit;

/**
 * Main Plugin Class
 *
 * Contains the main functions for Wolf Portfolio
 *
 * @since 1.0.0
 */
class Plugin {

	/**
	 * @var string
	 */
	private $required_php_version = '5.4.0';

	/**
	 * @var string
	 */
	public $version = '1.2.6';

	/**
	 * @var Plugin The single instance of the class
	 */
	protected static $_instance = null;

	/**
	 * @var string the support forum URL
	 */
	private $support_url = 'https://wlfthm.es/help';

	/**
	 * @var string
	 */
	public $template_url;

	/**
	 * Main Plugin Instance
	 *
	 * Ensures only one instance of the plugin is loaded or can be loaded.
	 *
	 * @static
	 * @see WFOLIO()
	 * @return Plugin - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Plugin Constructor.
	 */
	public function __construct() {

		if ( phpversion() < $this->required_php_version ) {
			add_action( 'admin_notices', array( $this, 'warning_php_version' ) );
			return;
		}

		$this->define_constants();
		$this->init_hooks();

		do_action( 'wolf_portfolio_loaded' );
	}

	/**
	 * Display error notice if PHP version is too low
	 */
	public function warning_php_version() {
		?>
		<div class="notice notice-error">
			<p><?php

			printf(
				esc_html__( '%1$s needs at least PHP %2$s installed on your server. You have version %3$s currently installed. Please contact your hosting service provider if you\'re not able to update PHP by yourself.', 'wolf-portfolio' ),
				'Portfolio',
				$this->required_php_version,
				phpversion()
			);
			?></p>
		</div>
		<?php
	}

	/**
	 * Hook into actions and filters
	 */
	private function init_hooks() {
		add_action( 'after_setup_theme', array( $this, 'include_template_functions' ), 11 );
		add_action( 'init', array( $this, 'includes' ), 0 );
		add_action( 'init', array( $this, 'init' ), 0 );
		add_action( 'init', array( $this, 'register_block' ) );
		register_activation_hook( WFOLIO_PLUGIN_FILE, array( $this, 'activate' ) );

		add_action( 'admin_init', array( $this, 'plugin_update' ) );
	}

	/**
	 * Activation function
	 */
	public function activate() {

		add_option( '_wolf_portfolio_needs_page', true );

		if ( ! get_option( '_wolf_portfolio_flush_rewrite_rules_flag' ) ) {
			add_option( '_wolf_portfolio_flush_rewrite_rules_flag', true );
		}
	}

	/**
	 * Flush rewrite rules on plugin activation to avoid 404 error
	 */
	public function flush_rewrite_rules() {

		if ( get_option( '_wolf_portfolio_flush_rewrite_rules_flag' ) ) {
			flush_rewrite_rules();
			delete_option( '_wolf_portfolio_flush_rewrite_rules_flag' );
		}
	}

	/**
	 * Define WE Constants
	 */
	private function define_constants() {

		$constants = array(
			'WFOLIO_DEV' => false,
			'WFOLIO_DIR' => $this->plugin_path(),
			'WFOLIO_URI' => $this->plugin_url(),
			'WFOLIO_CSS' => $this->plugin_url() . '/assets/css',
			'WFOLIO_JS' => $this->plugin_url() . '/assets/js',
			'WFOLIO_SLUG' => plugin_basename( dirname( WFOLIO_PLUGIN_FILE ) ),
			'WFOLIO_PATH' => plugin_basename( WFOLIO_PLUGIN_FILE ),
			'WFOLIO_VERSION' => $this->version,
			'WFOLIO_SUPPORT_URL' => $this->support_url,
			'WFOLIO_DOC_URI' => 'https://docs.wolfthemes.com/documentation/plugins/' . plugin_basename( dirname( WFOLIO_PLUGIN_FILE ) ),
			'WFOLIO_WOLF_DOMAIN' => 'wolfthemes.com',
		);

		foreach ( $constants as $name => $value ) {
			$this->define( $name, $value );
		}
	}

	/**
	 * Define constant if not already set
	 * @param  string $name
	 * @param  string|bool $value
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * What type of request is this?
	 * string $type ajax, frontend or admin
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin' :
				return is_admin();
			case 'ajax' :
				return defined( 'DOING_AJAX' );
			case 'cron' :
				return defined( 'DOING_CRON' );
			case 'frontend' :
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	public function includes() {

		/**
		 * Functions used in frontend and admin
		 */
		include_once WFOLIO_DIR . '/inc/wfolio-core-functions.php';

		if ( $this->is_request( 'admin' ) ) {
			new Admin\Admin();
		}

		if ( $this->is_request( 'frontend' ) ) {
			include_once WFOLIO_DIR . '/inc/frontend/wfolio-functions.php';
			include_once WFOLIO_DIR . '/inc/frontend/wfolio-template-hooks.php';
			new Frontend\Shortcodes();
		}
	}

	/**
	 * Function used to Init Portfolio Template Functions - This makes them pluggable by plugins and themes.
	 */
	public function include_template_functions() {
		include_once WFOLIO_DIR . '/inc/frontend/wfolio-template-functions.php';
	}

	/**
	 * register_widget function.
	 *
	 * @access public
	 * @return void
	 */
	public function register_widget() {

		// Include
		include_once WFOLIO_DIR . '/inc/widgets/class-wfolio-last-works.php';
	}

	/**
	 * Register the Last Works block (server-rendered via the existing shortcode).
	 */
	public function register_block() {

		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		wp_register_script(
			'wolf-portfolio-last-works-editor',
			$this->plugin_url() . '/blocks/last-works/edit.js',
			array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-server-side-render', 'wp-i18n' ),
			$this->version,
			true
		);

		register_block_type(
			$this->plugin_path() . '/blocks/last-works',
			array(
				'render_callback' => array( $this, 'render_last_works_block' ),
			)
		);
	}

	/**
	 * Render callback for the Last Works block.
	 *
	 * @param array $attributes Block attributes.
	 * @return string
	 */
	public function render_last_works_block( $attributes ) {

		$shortcode = sprintf(
			'[wolf_last_works count="%d" category="%s" col="%d" padding="%s"]',
			absint( $attributes['count'] ),
			esc_attr( $attributes['category'] ),
			absint( $attributes['col'] ),
			esc_attr( $attributes['padding'] )
		);

		return do_shortcode( $shortcode );
	}

	/**
	 * Init Portfolio when WordPress Initialises.
	 */
	public function init() {

		// Before init action
		do_action( 'before_wolf_portfolio_init' );

		// Set up localisation
		$this->load_plugin_textdomain();

		// Variables
		$this->template_url = apply_filters( 'wolf_portfolio_template_url', 'wolf-portfolio/' );

		// Classes/actions loaded for the frontend and for ajax requests
		if ( ! is_admin() || defined( 'DOING_AJAX' ) ) {

			// Hooks
			add_filter( 'template_include', array( $this, 'template_loader' ) );

		}

		// Hooks
		add_action( 'widgets_init', array( $this, 'register_widget' ) );

		$this->register_post_type();
		$this->register_taxonomy();
		$this->flush_rewrite_rules();

		// Init action
		do_action( 'wolf_portfolio_init' );
	}

	/**
	 * Register post type
	 */
	public function register_post_type() {
		include_once WFOLIO_DIR . '/inc/wfolio-register-post-type.php';
	}

	/**
	 * Register taxonomy
	 */
	public function register_taxonomy() {
		include_once WFOLIO_DIR . '/inc/wfolio-register-taxonomy.php';
	}

	/**
	 * Load a template.
	 *
	 * Handles template usage so that we can use our own templates instead of the themes.
	 *
	 * @param mixed $template
	 * @return string
	 */
	public function template_loader( $template ) {

		$find = array( 'portfolio.php' );
		$file = '';

		if ( is_singular( 'work' ) ) {

			$file    = 'single-work.php';
			$find[] = $file;
			$find[] = $this->template_url . $file;

		}

		// Get all taxonomies for 'work' post type
		$work_taxonomies = get_object_taxonomies( 'work' );
		$current_taxonomy = get_query_var( 'taxonomy' );

		if ( is_tax() && in_array( $current_taxonomy, $work_taxonomies ) ) {

			$term = get_queried_object();
			$file = 'taxonomy-' . $term->taxonomy . '.php';

			// Try specific taxonomy-term templates first
			$find[] = 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';
			$find[] = $this->template_url . 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';

			// Try specific taxonomy templates
			$find[] = $file;
			$find[] = $this->template_url . $file;

			// Fallback to general work taxonomy template
			$find[] = 'taxonomy-work_default.php';
			$find[] = $this->template_url . 'taxonomy-work_default.php';

		} elseif ( is_post_type_archive( 'work' ) ) {

			$file = 'archive-work.php';
			$find[] = $file;
			$find[] = $this->template_url . $file;
		}

		if ( $file ) {
			$template = locate_template( $find );
			if ( ! $template ) $template = $this->plugin_path() . '/templates/' . $file;
		}

		return $template;
	}

	/**
	 * Loads the plugin text domain for translation
	 */
	public function load_plugin_textdomain() {

		$domain = 'wolf-portfolio';
		$locale = apply_filters( 'wolf-portfolio', get_locale(), $domain );
		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( WFOLIO_PLUGIN_FILE ) ) . '/languages/' );
	}

	/**
	 * Get the plugin url.
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', WFOLIO_PLUGIN_FILE ) );
	}

	/**
	 * Get the plugin path.
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( WFOLIO_PLUGIN_FILE ) );
	}

	/**
	 * Get the template path.
	 * @return string
	 */
	public function template_path() {
		return apply_filters( 'wolf_portfolio_template_path', 'wolf-portfolio/' );
	}

	/**
	 * Plugin update
	 */
	public function plugin_update() {

		if ( ! class_exists( 'WP_GitHub_Updater' ) ) {
			include_once WFOLIO_DIR . '/inc/admin/updater.php';
		}

		$repo = 'wolfthemes/wolf-portfolio';

		$config = array(
			'slug' => plugin_basename( WFOLIO_PLUGIN_FILE ),
			'proper_folder_name' => 'wolf-portfolio',
			'api_url' => 'https://api.github.com/repos/' . $repo . '',
			'raw_url' => 'https://raw.github.com/' . $repo . '/master/',
			'github_url' => 'https://github.com/' . $repo . '',
			'zip_url' => 'https://github.com/' . $repo . '/archive/master.zip',
			'sslverify' => true,
			'requires' => '6.0',
			'tested' => '6.5',
			'readme' => 'README.md',
			'access_token' => '',
		);

		new \WP_GitHub_Updater( $config );
	}
}
