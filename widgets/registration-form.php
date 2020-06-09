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
		<form id="msform" method="post" action="#">
			<!-- progressbar -->
			<ul id="progressbar">
				<li class="active">General Information</li>
				<li>Email Verification</li>
				<li>Final Step of Registration</li>
			</ul>
			<!-- fieldsets -->
			<fieldset class="text-center">
				<h2 class="fs-title">Account Information</h2>
				<h3>Tell us something about yourself</h3>
				<div class="first-step-signup">
					<input type="text" name="username" id="fname" placeholder="Your Username Here">
					<input type="text" name="name" placeholder="Your Name Here">
					<input type="email" name="email" placeholder="Your Email Here">
					<input type="text" name="phone" placeholder="Your Phone Here">
					<input type="password" name="password" placeholder="Your Password Here">
				</div>
				<input type="button" name="next" class="submit-first" value="Register" />
			</fieldset>

			<fieldset class="text-center">
				<h2 class="fs-title text-center">Email Verification</h2>
				<h3 class="text-center">Verify Your Email Address</h3>
				<p class="text-center">Looks like your email isnt verified Yet. Verify and Refresh this Page</p>
				<input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
				<input type="button" name="next" class="next action-button" value="Next"/>
			</fieldset>

			<fieldset class="text-center">
				<h2 class="fs-title">Some More information About you</h2>
				<h3 class="fs-subtitle">Your presence on the social network</h3>
				<div class="last-step-signup">
					<input type="text" name="iban" placeholder="Your IBAN Here">
					<input type="text" name="revolut" placeholder="Your Revolut Here">
					<input type="email" name="bitcoin" placeholder="Your Bitcoin Wallet # Here">
					<textarea name="description" id="desc" cols="10" rows="10" placeholder="Your Project Description">
					</textarea>

					<input type="password" name="password" placeholder="Your Password Here">
					<label for="pprofile">Choose Profile Picture<input type="file" name="pprofile" id="profile-picture"></label>
					<input type="text" name="address" placeholder="Your Address Here">
					<label for="proof">Passport/ID Card<input type="file" name="proof" id="proof"></label>
				</div>
				<input type="submit" name="submit_register" class="submit action-button" value="Submit" />
			</fieldset>
		</form>
	</div>
</div>
<!-- /.MultiStep Form -->
		<?php
	}
}
