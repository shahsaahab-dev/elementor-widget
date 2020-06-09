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
		$username = $_POST['uname'];
		$name     = $_POST['fname'];
		$email    = $_POST['email'];
		$password = $_POST['password'];
		$phone    = $_POST['phone'];

		// Finally creating the user.
		return $new->register_user( $username, $name, $email, $phone, $password );
	}
}

new Ajax_Calls();
