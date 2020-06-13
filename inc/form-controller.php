<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once __DIR__ . '/functions.php';

class Ajax_Calls {

	public function __construct() {
		add_action( 'wp_ajax_create_account', array( $this, 'create_account' ) );
		add_action( 'wp_ajax_nopriv_create_account', array( $this, 'create_account' ) );

		// Donor Information Ajax 
		add_action( 'wp_ajax_donor_information', array( $this, 'donor_information' ) );
		add_action( 'wp_ajax_nopriv_donor_information', array( $this, 'donor_information' ) );

		// Grab the avatar that got uploaded 
		add_filter( 'get_avatar', array($this,'donor_avatar_get'), 10, 5 );
	}

	public function create_account() {
		check_ajax_referer( 'form-controller', 'security' );
		$new = new Form_Function();

		// Assigning all the useful variables
		$username = sanitize_text_field( $_POST['uname'] );
		$name     = sanitize_text_field( $_POST['fname'] );
		$email    = sanitize_text_field( $_POST['email'] );
		$password = sanitize_text_field( $_POST['password'] );
		$phone    = sanitize_text_field( $_POST['phone'] );
		$fields   = array( $username, $name, $email, $password );

		$register = $new->register_user( $username, $name, $email, $phone, $password );
	}


	public function donor_information(){
		$user_id = get_current_user_id();
		$new = new Form_Function();
		// Sanitizing and Assigning variables 
		$iban = sanitize_text_field($_POST['iban']);
		$revolut = sanitize_text_field($_POST['revolut']);
		$bitcoin = sanitize_text_field($_POST['bitcoint']);
		$description = sanitize_text_field($_POST['description']);
		$address = sanitize_text_field($_POST['address']);
		$picture_url = $_POST['pictureUrl'];
		// Handling th Profile Picture 
		/**
		 * Create an Empty User meta where we can store the picture.
		 */
		update_user_meta($user_id,"profile_picture",$picture_url);


		// Finally Calling off the function
		$update_donor = $new->donor_info_form($user_id,$iban,$revolut,$bitcoin,$description,$address);

	}


	public function donor_avatar_get(){
		$user_id = get_current_user_id();
		$link = get_user_meta($user_id,"profile_picture");
		if($link[0] != ""){
			$avatar = '<img src='.$link[0].' width="100px" height="100px">';
		return $avatar;
		}
	}




}

new Ajax_Calls();
