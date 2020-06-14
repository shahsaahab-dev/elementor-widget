<?php
namespace ELementorCustom;

class Plugin {
	private static $_instance = null;
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	// Widgets stylesheets and scripts
	public function widget_scripts() {
		wp_register_script( 'elementor-custom', plugins_url( '/assets/elementor-custom.js', __FILE__ ), array( 'jquery' ), '1.0', true );

	}

	public function widget_styles() {
		wp_register_style( 'elementor-custom-css', plugins_url( '/assets/elementor-custom.css', __FILE__ ), array(), '1.0', 'all' );
	}

	public function custom_scripts() {

		wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css', array(), '1.0', 'all' );
		wp_enqueue_script( 'jquery-easing', plugins_url( '/assets/jquery-easing.min.js', __FILE__ ), array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js', array( 'jquery' ), '1.0', true );

		// Ajax Scripts
		wp_enqueue_script( 'file-uploader', plugins_url( '/assets/file-uploader.js', __FILE__ ), array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'form-controller', plugins_url( '/assets/form-controller.js', __FILE__ ), array( 'jquery' ), '1.0', true );
		wp_localize_script(
			'form-controller',
			'control_form',
			array(
				'ajaxurl'  => admin_url( 'admin-ajax.php' ),
				'site_url' => home_url(),
				'security' => wp_create_nonce( 'form-controller' ),
			)
		);
	}

	// Widget Files
	private function include_widget_files() {
		require_once __DIR__ . '/widgets/registration-form.php';
		require_once __DIR__ . '/widgets/user-listing.php';

	}


	public function enqueue_media_uploader(){
		wp_enqueue_media();
	}

	// register widgets
	public function register_widgets() {
		$this->include_widget_files();

		// Register widgets with elementor
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Registration() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\User_Listing() );
	}

	// Register Hooks
	public function __construct() {
		// enable media uploader on the front-end 
		add_action('wp_enqueue_scripts',array($this,'enqueue_media_uploader'));
		// register widget scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'custom_scripts' ) );
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'widget_scripts' ) );
		// Stylesheets
		add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'widget_styles' ) );
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
		
		// API Calls
		require_once __DIR__ . '/inc/form-controller.php';

		// Custom Edit Profile Fields
		require_once __DIR__ . '/inc/profile-settings.php';

		// Required Pages 
		require_once __DIR__ . '/inc/required-pages.php';

		// Required Shortcodes 
		require_once __DIR__ . '/inc/shortcodes.php';

		// Required User Roles 
		require_once __DIR__ . '/inc/roles.php';


		// Modify Permission 
		require_once __DIR__ . '/inc/permissions.php';

	}

}

// Instantiate The Plugin
Plugin::instance();
