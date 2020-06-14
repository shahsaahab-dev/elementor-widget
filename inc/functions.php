<?php

class Form_Function {

	// Registration Function
	public function register_user( $username, $name, $email, $phone, $password ) {
		// Lets create the user here
		$userdata = array(
			'user_pass'     => $password,
			'user_login'    => $username,
			'user_nicename' => $name,
			'user_email'    => $email,
			'role' => 'open_star',

		);
		if ( ! empty( $password ) && ! empty( $username ) && ! empty( $name ) && ! empty( $email ) ) {
			if ( ! strlen( $password ) < 8 && ! strlen( $username ) < 4 && ! strlen( $name ) < 2 && ! strlen( $email ) < 5 ) {
				$user_id = wp_insert_user( $userdata );
				update_user_meta( $user_id, 'phone', $phone );
				update_user_meta( $user_id, 'email_verified', 'no' );
				wp_set_current_user( $user_id );
				wp_set_auth_cookie( $user_id );
				$this->send_email_verify( $username, $email );
			}
		} else {
			wp_send_json(
				array(
					'code'    => 2,
					'message' => __( 'One or More fields were left empty', 'custom-elementor' ),
				)
			);

		}

		// Sending the Suceess or Error Message
		if ( $user_id ) {
			wp_send_json(
				array(
					'code'    => 1,
					'message' => __( 'Your account has been created', 'custom-elementor' ),
				)
			);
		} else {
			wp_send_json(
				array(
					'code'    => 0,
					'message' => __( 'Your account could not be created. Try Again', 'custom-elementor' ),
				)
			);

		}
		wp_die();
	}

	// Sending Email Function
	public function send_email_verify($username,$email) {
		$create_nonce = wp_create_nonce( $username . $email );
		$subject      = __( 'Verify Your Email Address', 'custom-elementor' );
		$message      = __( 'Click Here to Verify your Email Address', 'custom-elementor' );
		$message     .= '<a href="' . site_url( '/verify-donor?verify_user_account' ) .'">Click Here</a>';
		wp_mail( $email, $subject, $message );
	}


	public function verify_email($id){
		$verified = get_user_meta($id,'email_verified');
		if($verified[0] == 'no'){
			update_user_meta($id,'email_verified','yes');
		}
		else{
			echo '<script>window.location.href = "'.home_url().'"</script>';
		}

	}

	public function donor_info_form($user_id,$iban,$revolut,$bitocoin,$description,$address){
		update_user_meta($user_id,"IBAN",$iban);
		update_user_meta($user_id,"Revolut",$revolut);
		update_user_meta($user_id,"Bitcoin",$bitocoin);
		update_user_meta($user_id,"description",$description);
		update_user_meta($user_id,"Address",$address);
		
		wp_send_json(array(
			"code" => 1,
			"message" => _("Information Updated"),
		));

		wp_die();
	}
}
