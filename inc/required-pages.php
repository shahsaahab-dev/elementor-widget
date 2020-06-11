<?php

class Make_Required {

	public function __construct() {
	}
	public function run_on_activation() {
		register_activation_hook( __FILE__, array( $this, 'run_on_activation' ) );
	}
}

new Make_Required();
