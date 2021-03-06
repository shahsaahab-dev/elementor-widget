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

		// Save donor information from profile page. 
		add_action( 'wp_ajax_save_donor_information', array( $this, 'save_donor_information' ) );
		add_action( 'wp_ajax_nopriv_save_donor_information', array( $this, 'save_donor_information' ) );


		// Login donor
		add_action( 'wp_ajax_login_donor', array( $this, 'login_donor' ) );
		add_action( 'wp_ajax_nopriv_login_donor', array( $this, 'login_donor' ) );

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
		$bitcoin = sanitize_text_field($_POST['bitcoin']);
		$description = sanitize_text_field($_POST['desc']);
		$address = sanitize_text_field($_POST['address']);
		$picture_url = $_POST['pictureUrl'];
		$proof = $_POST['proofUrl'];
		
		
		
		/**
		 * Create an Empty User meta where we can store the picture.
		 */
		if(!empty($picture_url)){
			update_user_meta($user_id,"profile_picture",$picture_url);
		}

		/**
		 * Create an Empty User meta where we can store the picture.
		 */
		if(!empty($proof)){
			update_user_meta($user_id,"proof_picture",$proof);
		}
		

		// Finally Calling off the function
		$update_donor = $new->donor_info_form($user_id,$iban,$revolut,$bitcoin,$description,$address);

	}


	// Change Avatar Programmitcally. 
	public function donor_avatar_get(){
		$user_id = get_current_user_id();
		$links = get_user_meta($user_id,"profile_picture");
		foreach($links as $link){
			$avatar = '<img src='.$link.' width="100px" height="100px">';
			return $avatar;
		}
	}


	public function save_donor_information(){
		// save_from_profile($id,$name,$password,$email,$address,$description,$iban,$revolut,$bitcoin);
		check_ajax_referer( 'form-controller', 'security' );
			
			$id = get_current_user_id();
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$address = $_POST['address'];
			$description = $_POST['description'];
			$iban = $_POST['iban'];
			$revolut = $_POST['revolut'];
			$bitcoin = $_POST['bitcoin'];
			$profile_picture = $_POST['prof_pic_save'];

			$fields = [$id,$name,$password,$email,$address,$description,$iban,$revolut,$bitcoin];

			$new = new Form_Function();
			$run = $new->save_from_profile($id,$name,$password,$email,$address,$description,$iban,$revolut,$bitcoin,$profile_picture);

	}


	public function login_donor(){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$new = new Form_Function();
		$new->login_user($username,$password);

	}



}

new Ajax_Calls();
