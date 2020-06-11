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

	public function send_email_verify( $username, $email ) {
		$create_nonce = wp_create_nonce( $username . $email );
		$subject      = __( 'Verify Your Email Address', 'custom-elementor' );
		$message      = __( 'Click Here to Verify your Email Address', 'custom-elementor' );
		$message     .= '<a href="' . site_url( '/verify_account?' ) . $create_nonce . '">Click Here</a>';
		wp_mail( $email, $subject, $message );
	}
}
