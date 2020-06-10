<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once __DIR__ . '/functions.php';

class Ajax_Calls {

	public function __construct() {
		add_action( 'wp_ajax_create_account', array( $this, 'create_account' ) );
		add_action( 'wp_ajax_nopriv_create_account', array( $this, 'create_account' ) );
	}

	public function create_account() {
		check_ajax_referer( 'form-controller', 'security' );
		$new = new Form_Function();

		// Assigning all the useful variables
		$username = sanitize_text_field($_POST['uname']);
		$name     = sanitize_text_field($_POST['fname']);
		$email    = sanitize_text_field($_POST['email']);
		$password = sanitize_text_field($_POST['password']);
		$phone    = sanitize_text_field($_POST['phone']);
		$fields = array($username,$name,$email,$password);

		$new->register_user( $username, $name, $email, $phone, $password );
	}


}

new Ajax_Calls();
