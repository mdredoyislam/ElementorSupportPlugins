<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Banner Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class testWidget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Banner widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Banner';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Banner widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Banner', 'elementortestplugin' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Banner widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-image';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Banner widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general','picchi-category','testcategory'];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'Banner', 'url', 'link' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

        $this->start_controls_section(
			'title_section',
			[
				'label' => esc_html__( 'Hero Title', 'elementortestplugin' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'elementortestplugin' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
                'label_block' => false,
				'placeholder' => esc_html__( 'Title', 'elementortestplugin' ),
			]
		);
        $this->add_control(
			'titleDescription',
			[
				'label' => esc_html__( 'Title Description', 'elementortestplugin' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
                'label_block' => true,
				'placeholder' => esc_html__( 'Title Description', 'elementortestplugin' ),
			]
		);
        $this->end_controls_section();
		$this->start_controls_section(
			'title_possiton',
			[
				'label' => esc_html__( 'Posstion', 'elementortestplugin' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'textdomain' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'textdomain' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'textdomain' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .welcome-content h2' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .welcome-content p' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'elementortestplugin' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'color',
			[
				'label' => esc_html__( 'Hero Title Color', 'elementortestplugin' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'dynamic' => [
					'active' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .welcome-content h2' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'descColor',
			[
				'label' => esc_html__( 'Description Color', 'elementortestplugin' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'dynamic' => [
					'active' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .welcome-content p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'image_section',
			[
				'label' => esc_html__( 'Image Section', 'elementortestplugin' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'elementortestplugin' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'large',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'select2_section',
			[
				'label' => esc_html__( 'Select2 Section', 'elementortestplugin' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Show Elements', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => [
					'title'  => esc_html__( 'Title', 'textdomain' ),
					'description' => esc_html__( 'Description', 'textdomain' ),
					'button' => esc_html__( 'Button', 'textdomain' ),
				],
				'default' => [ 'title', 'description' ],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'gallery_section',
			[
				'label' => esc_html__( 'Gallery', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'gallery',
			[
				'label' => esc_html__( 'Add Images', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'dynamic' => [
					'active' => true,
				],
				'default' => [],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'border_popover_toggle',
			[
				'label' => esc_html__( 'Fonts', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off' => esc_html__( 'Default', 'textdomain' ),
				'label_on' => esc_html__( 'Custom', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->start_popover();
		$this->add_control(
			'font_family',
			[
				'label' => esc_html__( 'Font Family', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::FONT,
				'dynamic' => [
					'active' => true,
				],
				'default' => "'Open Sans', sans-serif",
				'selectors' => [
					'{{WRAPPER}} .your-class' => 'font-family: {{VALUE}}',
				],
			]
		);
		$this->end_popover();
		$this->end_controls_section();
        
        //Widgets Style Controls
        
		

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
        //$hero_sub_title = $settings['hero_sub_title'];
        $title = $settings['title'];
		$titleDesc = $settings['titleDescription'];
		$this->add_inline_editing_attributes('title','advanced');
		$this->add_inline_editing_attributes('titleDescription','none');
        //$hero_description = $settings['hero_description'];
        //$hero_btn1_text = $settings['hero_btn1_text'];
        //$hero_btn1_url = $settings['hero_btn1_url']['url'];
        //$hero_btn2_text = $settings['hero_btn2_text'];
        //$hero_btn2_url = $settings['hero_btn2_url']['url'];
    ?>
	  <!-- Welcome Area Start -->
	  <section class="welcome-areas flex-center" id="home">
		<div class="container">
			<div class="row">
				<div class="col-xl-8 mx-auto">
					<div class="welcome-content text-center">
						<h2 <?php echo $this->get_render_attribute_string('title'); ?> ><?php echo $title; ?></h2>
						<p <?php echo $this->get_render_attribute_string('titleDescription'); ?> ><?php echo $titleDesc; ?></p>
						<?php 
							//echo wp_get_attachment_image( $settings['image']['id'], 'thumbnail' );
							echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
						?>
						<?php
							if ( $settings['list'] ) {
								echo '<ul>';
								foreach ( $settings['list'] as $item ) {
									echo '<li>' . $item . '</li>';
								}
								echo '</ul>';
							}

							foreach ( $settings['gallery'] as $image ) {
								echo '<img src="' . esc_attr( $image['url'] ) . '">';
							}
						?>
					</div>
				</div>
			</div>
		</div>
	  </section>
	  <!-- Welcome Area End -->
    <?php
	}
	protected function _content_template(){ ?> 
	<section class="welcome-areas flex-center" id="home">
		<div class="container">
			<div class="row">
				<div class="col-xl-8 mx-auto">
					<div class="welcome-content text-center">
						<#
							view.addInlineEditingAttributes('title','advanced');
							view.addInlineEditingAttributes('titleDescription','none');

							var image = {
								id: settings.image.id,
								url: settings.image.url,
								size: settings.thumbnail_size,
								dimension: settings.thumbnail_custom_dimension,
								model: view.getEditModel()
							};
							var image_url = elementor.imagesManager.getImageUrl( image );
						#>
						<h2 {{{ view.getRenderAttributeString('title') }}}
						>{{{settings.title}}}</h2>
						<p {{{ view.getRenderAttributeString('titleDescription') }}}>{{{settings.titleDescription}}}</p>
						<img src="{{{ image_url }}}" />
					</div>
					<# if ( settings.list.length ) { #>
						<ul>
						<# _.each( settings.list, function( item ) { #>
							<li>{{{ item }}}</li>
						<# } ) #>
						</ul>
					<# } #>
					<# _.each( settings.gallery, function( image ) { #>
						<img src="{{ image.url }}">
					<# }); #>
				</div>
			</div>
		</div>
	</section>
	<?php }

}