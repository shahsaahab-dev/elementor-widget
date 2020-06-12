<?php
namespace ElementorCustom\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Registration extends Widget_Base {
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
			'section_content',
			array(
				'label' => __( 'Content', 'elementor-hello-world' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label' => __( 'Title', 'elementor-hello-world' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Style', 'elementor-hello-world' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'text_transform',
			array(
				'label'     => __( 'Text Transform', 'elementor-hello-world' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''           => __( 'None', 'elementor-hello-world' ),
					'uppercase'  => __( 'UPPERCASE', 'elementor-hello-world' ),
					'lowercase'  => __( 'lowercase', 'elementor-hello-world' ),
					'capitalize' => __( 'Capitalize', 'elementor-hello-world' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();?>
<div class="row">
	<div class="col-xl-12">
		<h3 class="text-center text-white">Become A Donor</h3>
		<form id="msform" method="post" action="javascript:void(0)">
			<!-- progressbar -->
			<ul id="progressbar">
				<?php $verification = get_user_meta( get_current_user_id(), 'email_verified' ); ?>
				<li class="
				<?php
				if ( ! is_user_logged_in() ) {
					echo 'active';
				} else {
					echo 'completed';}
				?>
				">Account Information</li>

				<li class=" 
				<?php
				if ( is_user_logged_in() && $verification[0] == 'no' ) {
					echo 'active';
				} elseif ( ! is_user_logged_in() && $verification[0] == 'no' ) {
					echo '';
				} else {
					echo 'completed';}
				?>
				">Email Verification</li>
				<li class="
				<?php
				if ( is_user_logged_in() && $verification[0] == 'yes' ) {
					echo 'active';
				} else {
					echo '';}
				?>
				">Final Step of Registration</li>
			</ul>
			<?php
			if ( ! is_user_logged_in() ) {
				?>
			<!-- fieldsets -->
			<fieldset class="text-center">
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
			if ( is_user_logged_in() && $verification[0] == 'no' ) {
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
					<input type="text" name="iban" id="iban" placeholder="Your IBAN Here">
					<input type="text" name="revolut" id="revolut" placeholder="Your Revolut Here">
					<input type="email" name="bitcoin" id="bitcoin" placeholder="Your Bitcoin Wallet # Here">
					<textarea name="description" id="desc" cols="10" rows="10" placeholder="Your Project Description">
					</textarea>
					<label for="pprofile">Choose Profile Picture<input type="file" name="pprofile"
							id="profile-picture"></label>
					<input type="text" name="address" id="address" placeholder="Your Address Here">
					<label for="proof">Passport/ID Card<input type="file" name="proof" id="proof"></label>
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
