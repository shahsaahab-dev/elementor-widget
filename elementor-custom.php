<?php

/**
 * Plugin Name: Donor Custom Plugin
 * Description: Adding Custom Registration, Email Verification, Multi Step Form, Elementor Shortcode,
 * 				Profile Picture Upload Functionality.
 * Plugin URI:  https://devsyed.com
 * Version:     1.0
 * Author:      Syed Naqi
 * Author URI:  https://devsyed.com/
 * Text Domain: custom-elementor
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class Elementor_Custom_Plugin {
	const VERSION                   = '1.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION       = '7.0';

	public function __construct() {
		add_action( 'init', array( $this, 'i18n' ) );
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}
	public function i18n() {
		load_plugin_textdomain( 'custom-elementor' );
	}

	// Initialize the Plugin Here
	public function init() {

		// Check if elementor is installed
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'elementor_missing_message' ) );
			return;
		}

		// Check for required elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'elementor_wrong_version' ) );
			return;
		}

		// Check PHP version now
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notice', array( $this, 'php_version_message' ) );
			return;
		}

		// All checks complete now include plugin.
		require_once 'plugin.php';
	}

	public function elementor_missing_message() {
		// Dont activate the plugin no matter what.
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'custom-elementor' ),
			'<strong>' . esc_html__( 'Donor Custom Plugin', 'custom-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'custom-elementor' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	// Admin Notice
	public function elementor_wrong_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'custom-plugin' ),
			'<strong>' . esc_html__( 'Elementor Custom Plugin', 'custom-plugin' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'custom-plugin' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function php_version_message() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'custom-plugin' ),
			'<strong>' . esc_html__( 'Elementor Hello World', 'custom-plugin' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'custom-plugin' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}
// Instantiate the Plugin
new ELementor_Custom_Plugin();


