<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}




class Ajax_Calls {
	public function __construct() {
		add_action( 'wp_ajax_create_account', array( $this, 'create_account' ) );
		add_action( 'wp_ajax_nopriv_create_account', array( $this, 'create_account' ) );
	}

	public function create_account() {
		$name = $_POST['firstname'];
		wp_send_json( $name );
	}
}

new Ajax_Calls();
