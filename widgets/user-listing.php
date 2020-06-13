<?php
namespace ElementorCustom\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class User_Listing extends Widget_Base {

    private function gum_id($id,$field){
		$store = get_user_meta($id,$field);
		echo $store[0];
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
        // Getting Users by Role. 
        $users = get_users(['role__in' => ['open_star','close_star']]);
        foreach($users as $user){
        ?>
        <div class="media">
        <img src="<?php $this->gum_id($user->id,"profile_picture") ?>" class="mr-3" alt="...">
        <div class="media-body">
            <h5 class="mt-0"><?php echo $user->display_name; ?></h5>
            <h5><a href="mailto:<?php echo $user->user_email; ?>"><?php echo $user->user_email; ?></a></h5>
            <ul class="meta-desc">
                <li><?php $this->gum_id($user->id,"IBAN")?></li>
                <li><?php $this->gum_id($user->id,"Revolut")?></li>
                <li><?php $this->gum_id($user->id,"Bitcoin")?></li>
                <li><?php $this->gum_id($user->id,"Desc")?></li>
                <li><?php $this->gum_id($user->id,"Address")?></li>
            </ul>
        </div>
        </div>
        <?php
        }
        wp_reset_query();
	}
}
