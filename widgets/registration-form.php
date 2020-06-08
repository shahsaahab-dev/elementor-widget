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
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return array( 'Custom' );
	}

	public function get_script_depends() {
		return array( 'elementor-custom' );
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
		echo '<h1>';
		echo $settings['title'];
		echo '</h1>';
	}

	protected function _content_template() {
		?>
		<div class="title">
			{{{settings.title}}}
		</div>
		<?php
	}
}


