<?php

require_once __DIR__ . '/db_query.php';
class Make_Required {

	public function __construct(){
		add_action('init',array($this,'run_on_activation'));
	}

	public function run_on_activation() {
		// Check if verification page exists already or no. 
		$new_query = new DB_Query();
		$check = $new_query->get_a_record("wp_posts","post_name","verify-donor");
		
		// Creating Verify Page if it already doesnt exist.
		$post_args = array(
			'post_type' => 'page',
			'post_name' => 'verify-donor',
			'post_title' => 'Verification Page',
			'post_status' => 'publish',
		);
		if(!$check){
			wp_insert_post($post_args);
		}
	}
}
new Make_Required();
