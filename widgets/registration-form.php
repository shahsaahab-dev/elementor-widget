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

		// Form General Styles 
		$this->start_controls_section(
			'form-styling',
			[
				'label' => __("Form Styles","custom-elementor"),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		// Form Background Color
		$this->add_control(
			'form-background',
			[
				'label' => __("Form Background Color"), 
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fefefe',
			]
			);
		$this->add_control(
			'form-title-color',
			[
				'label' => __("Form Title Color"), 
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#222222',
			]
		);
		$this->add_control(
			'form-subtitle-color',
			[
				'label' => __("Form SubHeading Color"), 
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#222222',
			]
		);
		$this->add_control(
			'steps-text-color',
			[
				'label' => __("Steps Text Color"), 
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#222222',
			]
		);
		$this->add_control(
			'steps-color-complete',
			[
				'label' => __("Step Completed Color"), 
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#222222',
			]
		);
		$this->add_control(
			'steps-color-incomplete',
			[
				'label' => __("Step In Process Color Color"), 
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#222222',
			]
		);
		$this->add_control(
			'Button-background-Color',
			[
				'label' => __("Buttons Background Color"), 
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#222222',
			]
		);
		$this->add_control(
			'Button-text-Color',
			[
				'label' => __("Buttons Text Color"), 
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#222222',
			]
		);
		$this->end_controls_section();
		
		// Form Texts 
		$this->start_controls_section(
			'form-texts',
			[
				'label' => __("Form Text","custom-elementor"),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'main-title',
			[
				'label' => __("Main Title Text","custom-elementor"),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholer' => __("Enter Main Title Here"),
				'default' => ("Become A Donor"),

			]
			);
		$this->add_control(
			'form-heading',
			[
				'label' => __("Form Heading Text","custom-elementor"),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholer' => __("Enter Form Heading Here"),
				'default' => ("SOME MORE INFORMATION ABOUT YOU"),

			]
			);
		$this->add_control(
			'form-sub-heading',
			[
				'label' => __("Form Sub Heading Text","custom-elementor"),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholer' => __("Enter Form Sub Heading Here"),
				'default' => ("Fill Out the details below"),

			]
			);
		$this->end_controls_section();


		$this->start_controls_section(
			'Text Alignment',
			[
				'label' => __("Text Alignment","custom-elementor"),
				'tab' => Controls_Manager::TAB_CONTENT,

			]
		);
		$this->add_control(
			'top-heading-alignment',
			[
				'label' => __( 'Top Heading Alignment', 'custom-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'custom-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'custom-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'custom-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
			]
		);
		$this->add_control(
			'form-heading-alignment',
			[
				'label' => __( 'Form Heading Alignment', 'custom-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'custom-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'custom-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'custom-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
			]
		);
		$this->add_control(
			'form-sub-heading-alignment',
			[
				'label' => __( 'Form Sub-Heading Alignment', 'custom-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'custom-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'custom-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'custom-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style', 'custom-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .wrapper',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		?>
	
<div class="row">
	<div class="col-xl-12">
		<h3 class="text-center text-white">Become A Donor</h3>
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
						">Account Information</li>

				<li class=" 
						<?php
						if ( is_user_logged_in() && $verification == 'no' ) {
							echo 'active';
						} elseif ( ! is_user_logged_in() && $verification == 'no' ) {
							echo '';
						} else {
							echo 'completed';}
						?>
						">Email Verification</li>
				<li class="
						<?php
						
						if ( is_user_logged_in() && $verification == 'yes') {
							echo 'active';
							
						} else {
							echo '';}
						?>
						">Final Step of Verification</li>
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
					<input type="text" name="revolut" id="revolut" placeholder="Your Revolut Here"
						<?php $this->gum("Revolut") ; ?>>
					<input type="text" name="bitcoin" id="bitcoin" placeholder="Your Bitcoin Wallet # Here"
						<?php $this->gum("Bitcoin") ; ?>>
					<textarea name="description" id="desc" cols="10" rows="10"
						placeholder="Your Project Description"><?php $this->gumt("description"); ?></textarea>
					<div class="upload-picture-wrapper">
						<p><button id="picture-avatar-upload">Upload</button>Upload your Profile Picture <span><img
									class="profile-picture-tag" src="<?php $this->gumt("profile_picture") ?>"
									alt=""></span></p>
						<input type="hidden" name="profile_picture" id="profile-picture" value="">
					</div>

					<input type="text" name="address" id="address" placeholder="Your Address Here"
						<?php $this->gum("Address") ?>>
					<div class="upload-picture-wrapper">
						<p><button id="picture-proof-upload">Upload</button>Upload your Proof Picture <span><img
									class="proof-picture-tag" src="<?php $this->gumt("proof_picture") ?>" alt=""></span>
						</p>
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