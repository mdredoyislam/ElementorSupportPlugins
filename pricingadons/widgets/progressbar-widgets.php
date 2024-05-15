<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( __("Direct Access is Not allowed", "pricingadons") );
}
class progressbargWidget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'progress Bar';
	}

	public function get_title() {
		return esc_html__( 'progress Bar', 'pricingadons' );
	}

	public function get_icon() {
		return 'eicon-spinner';
	}

	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	public function get_categories() {
		return [ 'pricing-category'];
	}

	public function get_keywords() {
		return [ 'Progress Bar', 'url', 'link' ];
	}

	protected function register_controls() {

        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'pricingadons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>
        <div class="progress"></div>
        <?php
        
	}
	protected function _content_template(){ 

    }

}