<?php
namespace ElementorCustom\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class User_Listing extends Widget_Base {

    private function gum_id($id,$field){
		$store = get_user_meta($id,$field,true);
		echo $store;
    }
    
	public function get_name() {
		return 'User Listing';
	}
	public function get_title() {
		return __( 'User Listing', 'elementor-custom' );
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
		$settings = $this->get_settings_for_display();
		
		$role = "";
		if(isset($_POST['submit'])){
			$role = $_POST['star'];
		}
		// Getting Users by Role.
        $users = get_users(array(
			'role' => $role,
		));?>

<style>
	/* To Remove Styles */
	.media {
		background: #fff !important;
		padding: 15px;
	}

	ul.meta-desc {
		list-style: none;
		padding: 0px;
		margin: 0px;
	}

	ul.meta-desc li {
		display: inline-block;
	}

	.media h5 {
		margin: 0px;
	}

	.user-filtering-area ul {
		padding: 0px;
		margin: 0px;
		list-style: none;
	}

	.user-filtering-area ul li {
		display: inline-block;
	}

	h3.text-center.text-white {
		color: #222 !important;
	}

	#progressbar li {
		color: #222 !important;
		font-weight: 600;
	}

	.upload-picture-wrapper p {
		text-align: left;
		line-height: 65px;
	}

	button#picture-avatar-upload,
	button#picture-proof-upload {
		padding: 10px 25px;
		font-size: 12px;
		margin-right: 10px;
	}

	.upload-picture-wrapper span {
		float: right;
		max-width: 100px;
		border: 1px solid #222;
		padding: 10px;
		border-radius: 5px;
	}

	.media img {
		width: 100px;
	}

	.media {
		border: 1px solid #d9d9d9;
		box-shadow: 5px 5px 10px #2222;
		margin-bottom: 10px;
	}

	button.btn.btn-success.view-profile {
    float: right;
}

ul.meta-desc {
    width: 75%;
    display: inline-block;
}
</style>
<form method="post">
	<select name="star" id="star">
		<option value="open_star">Open Star</option>
		<option value="close_star">Close Star</option>
	</select>
	<input type="submit" value="submit" name="submit">
</form>
<?php
        foreach($users as $user){
        ?>
<div class="media">
	<img src="<?php $query = $this->gum_id($user->ID,"profile_picture"); ?>" class="mr-3" alt="...">
	<div class="media-body">
		<h5 class="mt-0"><a
				href="<?php echo site_url('/donor-profile?id=') . $user->ID; ?>"><?php echo $user->display_name; ?></a>
		</h5>
		<h5><a href="mailto:<?php echo $user->user_email; ?>"><?php echo $user->user_email; ?></a></h5>
		<p><?php $this->gum_id($user->ID,"description") ?></p>
		<ul class="meta-desc">
			<li><strong>IBAN:</strong><?php $this->gum_id($user->ID,"IBAN")?></li>
			<li> <strong>Revolut:</strong> <?php $this->gum_id($user->ID,"Revolut")?></li>
			<li><strong>Bitcoin:</strong><?php $this->gum_id($user->ID,"Bitcoin")?></li>
			<li><strong>Address:</strong><?php $this->gum_id($user->ID,"Address")?></li>
		</ul>
		<a href="<?php echo site_url('/donor-profile?id=') . $user->ID; ?>" class="btn btn-success view-profile">View Profile</a>
	</div>
</div>
<?php
        }
        wp_reset_query();
	}
}