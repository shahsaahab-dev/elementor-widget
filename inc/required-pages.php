<?php 

require_once __DIR__ . '/db_query.php';
class Make_Required {

	public function __construct(){
		add_action('init',array($this,'run_on_activation'));
		add_action('init',array($this,'after_activation'));
	}

	public function run_on_activation() {
		// Check if verification page exists already or no. 
		$new_query = new DB_Query();
		$check = $new_query->get_a_record("wp_posts","post_name","verify-donor");
		
		// Creating Verify Page if it already doesnt exist.
		$content = '
		<!-- wp:shortcode -->
		[verify-donor]
		<!-- /wp:shortcode -->';
		$post_args = array(
			'post_type' => 'page',
			'post_name' => 'verify-donor',
			'post_title' => 'Verification Page',
			'post_content' => $content,
			'post_status' => 'publish',
		);
		if(!$check){
			wp_insert_post($post_args);
		}
	}
	public function after_activation() {
		// Check if verification page exists already or no. 
		$new_query = new DB_Query();
		$check = $new_query->get_a_record("wp_posts","post_name","donor-profile");
		$content = '
		<!-- wp:shortcode -->
		[donor-profile]
		<!-- /wp:shortcode -->';
		$post_args = array(
			'post_type' => 'page',
			'post_name' => 'donor-profile',
			'post_title' => 'Donor Profile Page',
			'post_content' => $content,
			'post_status' => 'publish',
		);
		if(!$check){
			wp_insert_post($post_args);
		}
	}
}
new Make_Required();
