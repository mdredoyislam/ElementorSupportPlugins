<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( __("Direct Access is Not allowed", "pricingadons") );
}
class pricingWidget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'Pricing Widgets';
	}

	public function get_title() {
		return esc_html__( 'Pricing Widgets', 'pricingadons' );
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	public function get_categories() {
		return [ 'pricing-category'];
	}

	public function get_keywords() {
		return [ 'Banner', 'url', 'link' ];
	}

	protected function register_controls() {

        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'pricingadons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control('style', [
            'label' => esc_html__( 'Style', 'pricingadons' ),
            'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'Default', 'pricingadons' ),
                    'blue' => esc_html__( 'Blue Style', 'pricingadons' ),
                ],
                    
            ]
        );
        $this->add_control('style_select_hidden', [
                'label' => esc_html__( 'Hidden', 'pricingadons' ),
                'type' => \Elementor\Controls_Manager::HIDDEN,
                'default' => 'style_select_hidden',
            ]
        );
		$this->add_control('title', [
				'label' => esc_html__( 'Title', 'pricingadons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
                'label_block' => true,
				'placeholder' => esc_html__( 'Title Here', 'pricingadons' ),
			]
		);

        $repeter = new \Elementor\Repeater();

        $repeter->add_control('featured',[
            'label' => __('Featured', 'pricingadons'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => false,
        ]);
        $repeter->add_control('title',[
            'label' => __('Title', 'pricingadons'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'dynamic' => [
                'active' => true,
            ],
            'label_block' => true,
        ]);
        $repeter->add_control('description',[
            'label' => __('Description', 'pricingadons'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'dynamic' => [
                'active' => true,
            ],
        ]);
        $repeter->add_control('items',[
            'label' => __('Items', 'pricingadons'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'dynamic' => [
                'active' => true,
            ],
        ]);
        $repeter->add_control('items_hidden_selector', [
                'label' => esc_html__( 'Hidden', 'pricingadons' ),
                'type' => \Elementor\Controls_Manager::HIDDEN,
                'default' => 'items_hidden_selector',
            ]
        );
        $repeter->add_control('pricing',[
            'label' => __('Pricing', 'pricingadons'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'dynamic' => [
                'active' => true,
            ],
        ]);
        $repeter->add_control('button_title',[
            'label' => __('Button Title', 'pricingadons'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'dynamic' => [
                'active' => true,
            ],
        ]);
        $repeter->add_control('button_url',[
            'label' => __('Button URL', 'pricingadons'),
            'type' => \Elementor\Controls_Manager::URL,
            'dynamic' => [
                'active' => true,
            ],
        ]);
        $this->add_control('pricings', [
				'label' => esc_html__( 'Pricing Columns', 'pricingadons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeter->get_controls(),
				'default' => [
					[
						'text' => esc_html__( 'List Item #1', 'pricingadons' ),
						'link' => 'https://elementor.com/',
					],
					[
						'text' => esc_html__( 'List Item #2', 'pricingadons' ),
						'link' => 'https://elementor.com/',
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        $heading = $settings['title'];
        $pricings = $settings['pricings'];
        ?>
        <section class="fdb-block" style="background-image: url(<?php echo plugins_url( '../assets/img/red.svg', __FILE__ ) ?>);">
            <div class="container">
                <div class="row text-center">
                <div class="col">
                    <h1 class="text-white"><?php echo esc_html($heading); ?></h1>
                </div>
                </div>
            
                <div class="row mt-5 align-items-center">
                    <?php
                        if($pricings){
                            foreach($pricings as $pricing_data){
                                $button_class = $pricing_data['featured']?'secondary':'dark';
                                ?>
                                <div class="col-12 col-sm-10 col-md-8 m-auto col-lg-4 text-center">
                                    <div class="fdb-box p-4">
                                    <h2><?php echo esc_html($pricing_data['title']); ?></h2>
                                    <p class="lead"><?php echo esc_html($pricing_data['description']); ?></p>
                            
                                    <p class="h1 mt-5 mb-5">$ <?php echo esc_html($pricing_data['pricing']); ?></p>
                            
                                    <p><a href="<?php echo apply_filters('pricing_prefix','$') ?><?php echo esc_url($pricing_data['button_url']['url']); ?>" class="btn btn-<?php echo esc_attr($button_class); ?>"><?php echo esc_html($pricing_data['button_title']); ?></a></p>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </section>
        <?php

	}
	protected function _content_template(){ 

    }

}