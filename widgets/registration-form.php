<?php
namespace ElementorCustom\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Registration extends Widget_Base {

	public function gum($field){
		$store = get_user_meta(get_current_user_id(),$field,true);
		if(!$store == ""){
			echo "value=" . $store;
		}

	}
	public function gumt($field){
		$store = get_user_meta(get_current_user_id(),$field,true);
		if(!$store == ""){
			echo $store;
		}

	}
	public function get_name() {
		return 'registration-module';
	}
	public function get_title() {
		return __( 'Multi-Step Registration Form', 'elementor-custom' );
	}

	// Widget Icon
	public function get_icon() {
		return 'eicon-layout-settings';
	}

	public function get_categories() {
		return array( 'Custom' );
	}

	public function get_script_depends() {
		return array( 'elementor-custom' );
	}

	public function get_style_depends() {
		return array( 'elementor-custom-css' );
	}

	// Widget Controls
	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'General', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Main Title', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => __( 'Become a Donor', 'custom-elementor' ),
			]
		);

		$this->add_control(
			'step-1',
			[
				'label' => __( 'Step 1', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => __( 'Account Information', 'custom-elementor' ),
				'default' => _('Account Information','custom-elementor'),
			]
		);
		$this->add_control(
			'step-2',
			[
				'label' => __( 'Step 2', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => __( 'Email Verification', 'custom-elementor' ),
				'default' => _('Email Verification Information','custom-elementor'),
			]
		);
		$this->add_control(
			'step-3',
			[
				'label' => __( 'Step 3', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => __( 'Final Step', 'custom-elementor' ),
				'default' => _('Final Step of Registration','custom-elementor'),
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'styling_section',
			[
				'label' => __('Form Styling','custom-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
			);

			$this->add_control(
				'title_color',
				[
					'label' => __( 'Form BG', 'custom-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .title' => 'color: {{VALUE}}',
					],
				]
			);
		
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$main_title = wp_oembed_get( $settings['title'] );
		$step_1 = wp_oembed_get( $settings['step-1'] );
		$step_2 = wp_oembed_get( $settings['step-2'] );
		$step_3 = wp_oembed_get( $settings['step-3'] );


		?>
		<div class="row">
			<div class="col-xl-12">
				<h3 class="text-center text-white"><?php echo ( $main_title ) ? $main_title : $settings['title']; ?></h3>
				<form id="msform" method="post" enctype="multipart/form-data" action="javascript:void()">
					<!-- progressbar -->
					<ul id="progressbar">
						<?php $verification = get_user_meta( get_current_user_id(), 'email_verified',true ); ?>
						<li class="
						<?php
						if ( ! is_user_logged_in() ) {
							echo 'active';
						} else {
							echo 'completed';}
						?>
						"><?php echo ( $step_1 ) ? $step_1 : $settings['step-1']; ?></li>

						<li class=" 
						<?php
						if ( is_user_logged_in() && $verification == 'no' ) {
							echo 'active';
						} elseif ( ! is_user_logged_in() && $verification == 'no' ) {
							echo '';
						} else {
							echo 'completed';}
						?>
						"><?php echo ( $step_2 ) ? $step_2 : $settings['step-2']; ?></li>
						<li class="
						<?php
						
						if ( is_user_logged_in() && $verification == 'yes') {
							echo 'active';
							
						} else {
							echo '';}
						?>
						"><?php echo ( $step_3 ) ? $step_3 : $settings['step-3']; ?></li>
					</ul>
					<?php
					if ( ! is_user_logged_in() ) {
						?>
					<!-- fieldsets -->
					<fieldset class="text-center" >
						<h2 class="fs-title">Account Information</h2>
						<h3>Tell us something about yourself</h3>
						<div class="first-step-signup">
							<div class="success-message"></div>
							<div class="failure-message"></div>
							<input type="text" name="username" id="uname" placeholder="Your Username Here">
							<input type="text" name="name" id="name" placeholder="Your Name Here">
							<input type="email" name="email" id="email" placeholder="Your Email Here">
							<input type="text" name="phone" id="phone" placeholder="Your Phone Here">
							<input type="password" name="password" id="password" placeholder="Your Password Here">
						</div>
						<input type="button" name="next" class="submit-first" value="Register" />
					</fieldset>
						<?php
					}
					?>

					<?php
					if ( is_user_logged_in() && $verification == 'no' ) {
						?>
					<fieldset class="text-center">
						<h2 class="fs-title text-center">Email Verification</h2>
						<h3 class="text-center">Verify Your Email Address</h3>
						<p class="text-center">Looks like your email isnt verified Yet. Verify and Refresh this Page</p>
					</fieldset>
						<?php } ?>

					<fieldset class="text-center">
						<h2 class="fs-title">Some More information About you</h2>
						<h3 class="fs-subtitle">Your presence on the social network</h3>
						<div class="last-step-signup">
						<div class="success-message-f"></div>
							<div class="failure-message-f"></div>
							<input type="text" name="iban" id="iban" placeholder="Your IBAN Here" <?php $this->gum("IBAN") ; ?>>
							<input type="text" name="revolut" id="revolut" placeholder="Your Revolut Here" <?php $this->gum("Revolut") ; ?>>
							<input type="text" name="bitcoin" id="bitcoin" placeholder="Your Bitcoin Wallet # Here" <?php $this->gum("Bitcoin") ; ?>>
							<textarea name="description" id="desc" cols="10" rows="10" placeholder="Your Project Description" ><?php $this->gumt("description"); ?></textarea>
							<div class="upload-picture-wrapper">
								<p><button id="picture-avatar-upload">Upload</button>Upload your Profile Picture  <span><img class="profile-picture-tag" src="<?php $this->gumt("profile_picture") ?>" alt=""></span></p>
								<input type="hidden" name="profile_picture" id="profile-picture" value="">
							</div>
							
							<input type="text" name="address" id="address" placeholder="Your Address Here" <?php $this->gum("Address") ?>>
							<div class="upload-picture-wrapper">
								<p><button id="picture-proof-upload">Upload</button>Upload your Proof Picture <span><img class="proof-picture-tag" src="<?php $this->gumt("proof_picture") ?>" alt=""></span></p>
								<input type="hidden" name="profile_picture" id="proof-picture" value="">
							</div>
						</div>
						<input type="button" name="submit_register" class="last-signup" value="Submit" />
					</fieldset>
				</form>
			</div>
		</div>
<!-- /.MultiStep Form -->
		<?php
	}
}
