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
		wp_register_script( 'elementor-custom', plugins_url( '/assets/js/elementor-custom.js', __FILE__ ), array( 'jquery' ), false, true );
	}

	// Widget Files
	private function include_widget_files() {
		require_once __DIR__ . '/widgets/registration-form.php';

	}

	// register widgets
	public function register_widgets() {
		$this->include_widget_files();

		// Register widgets with elementor
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Registration() );
	}

	// Register Hooks
	public function __construct() {
		// register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'widget_scripts' ) );

		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
	}
}

// Instantiate The Plugin
Plugin::instance();
