<?php



namespace Fbth_Addons\Widgets;



if (!defined('ABSPATH')) exit;



use \Elementor\Controls_Manager;

use \Elementor\Repeater;

use \Elementor\Group_Control_Border;

use \Elementor\Group_Control_Image_Size;

use \Elementor\Group_Control_Typography;

use \Elementor\Group_Control_Background;

use \Elementor\Icons_Manager;

use \Elementor\Utils;

use \Elementor\Widget_Base;



class Fbth_Modal_Popup extends Widget_Base

{



	public function get_name()

	{

		return 'fbth-modal-popup';

	}



	public function get_title()

	{

		return esc_html__('Modal Popup', 'fbth');

	}



	public function get_icon()

	{

		return 'eicon-video-playlist';

	}



	public function get_categories()

	{

		return ['fbth'];

	}



	public function get_keywords()

	{

		return ['fbth', 'lightbox', 'popup', 'quickview', 'video'];

	}



	protected function register_controls()

	{

		$this->fbth_modal_content_section();

		$this->fbth_modal_setting_section();

		$this->fbth_modal_display_settings();

		$this->fbth_modal_icon_section();

		$this->fbth_modal_container_section();

		$this->fbth_modal_animation_tab();

		$this->fbth_modal_overlay_tab();

		$this->fbth_modal_close_btn_style();

	}

	/**

	 * fbth_modal_content_section

	 *

	 * @return void

	 */

	protected function fbth_modal_content_section()

	{

		$this->start_controls_section(

			'fbth_modal_content_section',

			[

				'label' => __('Contents', 'fbth')

			]

		);



		$this->add_control(

			'fbth_modal_content',

			[

				'label'   => __('Type of Modal', 'fbth'),

				'type'    => Controls_Manager::SELECT,

				'default' => 'image',

				'options' => [

					'image'          => __('Image', 'fbth'),

					'image-gallery'  => __('Image Gallery', 'fbth'),

					'html_content'   => __('HTML Content', 'fbth'),

					'youtube'        => __('Youtube Video', 'fbth'),

					'vimeo'          => __('Vimeo Video', 'fbth'),

					'external-video' => __('Self Hosted Video', 'fbth'),

					'external_page'  => __('External Page', 'fbth'),

					'shortcode'      => __('ShortCode', 'fbth')

				]

			]

		);



		/**

		 * Modal Popup image section

		 */

		$this->add_control(

			'fbth_modal_image',

			[

				'label'      => __('Image', 'fbth'),

				'type'       => Controls_Manager::MEDIA,

				'default'    => [

					'url' 	 => Utils::get_placeholder_image_src()

				],

				'dynamic'    => [

					'active' => true

				],

				'condition'  => [

					'fbth_modal_content' => 'image'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Image_Size::get_type(),

			[

				'name'      => 'thumbnail',

				'default'   => 'full',

				'condition' => [

					'fbth_modal_content' => 'image'

				]

			]

		);



		/**

		 * Modal Popup image gallery

		 */



		$this->add_control(

			'fbth_modal_image_gallery_column',

			[

				'label'   => __('Column', 'fbth'),

				'type'    => Controls_Manager::SELECT,

				'default' => 'column-three',

				'options' => [

					'column-one'   => __('Column 1', 'fbth'),

					'column-two'   => __('Column 2', 'fbth'),

					'column-three' => __('Column 3', 'fbth'),

					'column-four'  => __('Column 4', 'fbth'),

					'column-five'  => __('Column 5', 'fbth'),

					'column-six'   => __('Column 6', 'fbth')

				],

				'condition' => [

					'fbth_modal_content' => 'image-gallery'

				]

			]

		);



		$image_repeater = new Repeater();



		$image_repeater->add_control(

			'fbth_modal_image_gallery',

			[

				'label'   => __('Image', 'fbth'),

				'type'    => Controls_Manager::MEDIA,

				'default' => [

					'url' => Utils::get_placeholder_image_src()

				],

				'dynamic' => [

					'active' => true,

				]

			]

		);



		$image_repeater->add_group_control(

			Group_Control_Image_Size::get_type(),

			[

				'name'      => 'thumbnail',

				'default'   => 'full',

			]

		);



		$image_repeater->add_control(

			'fbth_modal_image_gallery_text',

			[

				'label' => __('Description', 'fbth'),

				'type'  => Controls_Manager::TEXTAREA,

				'dynamic' => [

					'active' => true,

				]

			]

		);



		$this->add_control(

			'fbth_modal_image_gallery_repeater',

			[

				'label'   => esc_html__('Image Gallery', 'fbth'),

				'type'    => Controls_Manager::REPEATER,

				'fields'  => $image_repeater->get_controls(),

				'default' => [

					['fbth_modal_image_gallery' => Utils::get_placeholder_image_src()],

					['fbth_modal_image_gallery' => Utils::get_placeholder_image_src()],

					['fbth_modal_image_gallery' => Utils::get_placeholder_image_src()]

				],

				'condition' => [

					'fbth_modal_content' => 'image-gallery'

				]

			]

		);

		/**

		 * Modal Popup html content section

		 */

		$this->add_control(

			'fbth_modal_html_content',

			[

				'label'     => __('Add your content here (HTML/Shortcode)', 'fbth'),

				'type'      => Controls_Manager::WYSIWYG,

				'default'   => __('Add your popup content here', 'fbth'),

				'dynamic'   => ['active' => true],

				'condition' => [

					'fbth_modal_content' => 'html_content'

				]

			]

		);



		/**

		 * Modal Popup video section

		 */



		$this->add_control(

			'fbth_modal_youtube_video_url',

			[

				'label'       => __('Provide Youtube Video URL', 'fbth'),

				'type'        => Controls_Manager::TEXT,

				'label_block' => true,

				'default'     => 'https://www.youtube.com/watch?v=b1lyIT1FvDo',

				'placeholder' => __('Place Youtube Video URL', 'fbth'),

				'title'       => __('Place Youtube Video URL', 'fbth'),

				'condition'   => [

					'fbth_modal_content' => 'youtube'

				],

				'dynamic' => [

					'active' => true,

				]

			]

		);


		$this->add_control(

			'fbth_modal_vimeo_video_url',

			[

				'label'       => __('Provide Vimeo Video URL', 'fbth'),

				'type'        => Controls_Manager::TEXT,

				'label_block' => true,

				'default'     => 'https://vimeo.com/347565673',

				'placeholder' => __('Place Vimeo Video URL', 'fbth'),

				'title'       => __('Place Vimeo Video URL', 'fbth'),

				'condition'   => [

					'fbth_modal_content' => 'vimeo'

				],

				'dynamic' => [

					'active' => true,

				]

			]

		);



		/**

		 * Modal Popup external video section

		 */

		$this->add_control(

			'fbth_modal_external_video',

			[

				'label'      => __('External Video', 'fbth'),

				'type'       => Controls_Manager::MEDIA,

				'media_type' => 'video',

				'dynamic' => [

					'active' => true,

				],

				'condition'  => [

					'fbth_modal_content' => 'external-video'

				]

			]

		);



		$this->add_control(

			'fbth_modal_external_page_url',

			[

				'label'       => __('Provide External URL', 'fbth'),

				'type'        => Controls_Manager::TEXT,

				'label_block' => true,

				'default'     => 'https://fbthdevs.com',

				'placeholder' => __('Place External Page URL', 'fbth'),

				'condition'   => [

					'fbth_modal_content' => 'external_page'

				],

				'dynamic' => [

					'active' => true,

				]

			]

		);



		$this->add_responsive_control(

			'fbth_modal_video_width',

			[

				'label'        => __('Content Width', 'fbth'),

				'type'         => Controls_Manager::SLIDER,

				'size_units'   => ['px', '%'],

				'range'        => [

					'px'       => [

						'min'  => 0,

						'max'  => 1000,

						'step' => 5

					],

					'%'        => [

						'min'  => 0,

						'max'  => 100

					]

				],

				'default'      => [

					'unit'     => 'px',

					'size'     => 720

				],

				'selectors'    => [

					'{{WRAPPER}} .fbth-modal-item .fbth-modal-content .fbth-modal-element iframe,

					{{WRAPPER}} .fbth-modal-item .fbth-modal-content .fbth-video-hosted' => 'width: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}} .fbth-modal-item' => 'width: {{SIZE}}{{UNIT}};'

				],

				'condition'    => [

					'fbth_modal_content' => ['youtube', 'vimeo', 'external_page', 'external-video']

				]

			]

		);



		$this->add_responsive_control(

			'fbth_modal_video_height',

			[

				'label'        => __('Content Height', 'fbth'),

				'type'         => Controls_Manager::SLIDER,

				'size_units'   => ['px', '%'],

				'range'        => [

					'px'       => [

						'min'  => 0,

						'max'  => 1000,

						'step' => 5

					],

					'%'        => [

						'min'  => 0,

						'max'  => 100

					]

				],

				'default'      => [

					'unit'     => 'px',

					'size'     => 400

				],

				'selectors'    => [

					'{{WRAPPER}} .fbth-modal-item .fbth-modal-content .fbth-modal-element iframe' => 'height: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}} .fbth-modal-item' => 'height: {{SIZE}}{{UNIT}};'

				],

				'condition'    => [

					'fbth_modal_content' => ['youtube', 'vimeo', 'external_page']

				]

			]

		);



		$this->add_control(

			'fbth_modal_shortcode',

			[

				'label'       => __('Enter your shortcode', 'fbth'),

				'type'        => Controls_Manager::TEXT,

				'label_block' => true,

				'placeholder' => __('[gallery]', 'fbth'),

				'condition'   => [

					'fbth_modal_content' => 'shortcode'

				]

			]

		);



		$this->add_responsive_control(

			'fbth_modal_content_width',

			[

				'label' => __('Content Width', 'fbth'),

				'type' => Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'range' => [

					'px' => [

						'min' => 0,

						'max' => 2000,

					],

					'%' => [

						'min' => 0,

						'max' => 100,

					],

				],

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-item' => 'width: {{SIZE}}{{UNIT}};',

				],

				'condition'    => [

					'fbth_modal_content' => ['image', 'image-gallery', 'html_content', 'shortcode']

				]

			]

		);



		$this->add_control(

			'fbth_modal_btn_text',

			[

				'label'       => __('Button Text', 'fbth'),

				'type'        => Controls_Manager::TEXT,

				'default'     => __('Watch video', 'fbth'),

				'dynamic'     => [

					'active'  => true

				]

			]

		);



		$this->add_control(

			'fbth_modal_btn_icon',

			[

				'label'       => __('Button Icon', 'fbth'),

				'label_block' => true,

				'type'        => Controls_Manager::ICONS,

				'default'     => [

					'value'   => 'fas fa-play',

					'library' => 'fa-brands'

				]

			]

		);

		$this->add_control(

			'text_icon_align',

			[

				'label' => esc_html__('Icon Alignment', 'plugin-name'),

				'type' => \Elementor\Controls_Manager::CHOOSE,

				'options' => [

					'left' => [

						'title' => esc_html__('Left', 'plugin-name'),

						'icon' => 'eicon-text-align-left',

					],

					'right' => [

						'title' => esc_html__('Right', 'plugin-name'),

						'icon' => 'eicon-text-align-right',

					],

				],

				'condition' => [

					'fbth_modal_btn_icon[value]!' => ''

				],

				'default' => 'left',

				'toggle' => true,



			]

		);



		$this->end_controls_section();

	}

	/**

	 * fbth_modal_setting_section

	 *

	 * @return void

	 */

	protected function fbth_modal_setting_section()

	{



		$this->start_controls_section(
			'fbth_modal_setting_section',
			[
				'label' => __('Settings', 'fbth')
			]
		);

		$this->add_control(
			'fbth_modal_overlay',
			[
				'label'        => __('Overlay', 'fbth'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'fbth'),
				'label_off'    => __('Hide', 'fbth'),
				'return_value' => 'yes',
				'default'      => 'yes'
			]

		);

		$this->add_control(
			'fbth_modal_overlay_click_close',
			[

				'label'     => __('Close While Clicked Outside', 'fbth'),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __('ON', 'fbth'),
				'label_off' => __('OFF', 'fbth'),
				'default'   => 'yes',
				'condition' => [
					'fbth_modal_overlay' => 'yes'
				]

			]

		);
		$this->end_controls_section();

	}

	/**

	 * fbth_modal_display_settings

	 *

	 * @return void

	 */

	protected function fbth_modal_display_settings()

	{

		$this->start_controls_section(

			'fbth_modal_display_settings',

			[

				'label' => __('Button', 'fbth'),

				'tab'   => Controls_Manager::TAB_STYLE

			]

		);



		$this->add_responsive_control(

			'modal_button_align',

			[

				'label' => esc_html__('Alignment', 'plugin-name'),

				'type' => \Elementor\Controls_Manager::CHOOSE,

				'options' => [

					'left' => [

						'title' => esc_html__('Left', 'plugin-name'),

						'icon' => 'eicon-text-align-left',

					],

					'center' => [

						'title' => esc_html__('Center', 'plugin-name'),

						'icon' => 'eicon-text-align-center',

					],

					'right' => [

						'title' => esc_html__('Right', 'plugin-name'),

						'icon' => 'eicon-text-align-right',

					],

				],

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-button' => 'text-align: {{VALUE}};'

				],

				'default' => 'left',

				'toggle' => true,

			]

		);



		$this->start_controls_tabs('fbth_modal_btn_typhography_color', ['separator' => 'before']);



		$this->start_controls_tab('fbth_modal_btn_typhography_color_normal_tab', ['label' => esc_html__('Normal', 'fbth')]);



		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name'      => 'fbth_modal_btn_typhography',

				'label'     => __('Button Typography', 'fbth'),

				'selector'  => '{{WRAPPER}} .fbth-modal-button .fbth-modal-image-action'

			]

		);



		$this->add_control(

			'fbth_modal_btn_typhography_color_normal',

			[

				'label'     => __('Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#fff',

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-button .fbth-modal-image-action' => 'color: {{VALUE}};'

				]

			]

		);





		$this->add_control(

			'fbth_modal_btn_background_normal',

			[

				'label'     => __('Background Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#4243DC',

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-button .fbth-modal-image-action' => 'background-color: {{VALUE}};'

				]

			]

		);



		$this->add_responsive_control(

			'fbth_modal_btn_fixed_width',

			[

				'label'      => esc_html__('Width', 'fbth'),

				'type'       => Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'range'      => [

					'px'     => [

						'min'  => 0,

						'max'  => 500,

						'step' => 1

					],

					'%'        => [

						'min'  => 0,

						'max'  => 100

					]

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-modal-button .fbth-modal-image-action' => 'width: {{SIZE}}{{UNIT}};'



				],



			]

		);



		$this->add_responsive_control(

			'fbth_modal_btn_fixed_height',

			[

				'label'      => esc_html__('Height', 'fbth'),

				'type'       => Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'range'      => [

					'px'     => [

						'min'  => 0,

						'max'  => 500,

						'step' => 1

					],

					'%'        => [

						'min'  => 0,

						'max'  => 100

					]

				],



				'selectors'  => [

					'{{WRAPPER}} .fbth-modal-button .fbth-modal-image-action' => 'height: {{SIZE}}{{UNIT}};'

				],



			]

		);



		$this->add_responsive_control(

			'fbth_modal_btn_padding',

			[

				'label'        => __('Padding', 'fbth'),

				'type'         => Controls_Manager::DIMENSIONS,

				'size_units'   => ['px', '%'],

				'default'      => [

					'top'      => '18',

					'right'    => '20',

					'bottom'   => '18',

					'left'     => '20',

					'unit'     => 'px',

					'isLinked' => false

				],

				'selectors'    => [

					'{{WRAPPER}} .fbth-modal-button .fbth-modal-image-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'               => 'fbth_modal_btn_border_normal',

				'selector'           => '{{WRAPPER}} .fbth-modal-button .fbth-modal-image-action'

			]

		);



		$this->add_responsive_control(

			'fbth_modal_btn_radius',

			[

				'label'      => __('Border Radius', 'fbth'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%'],

				'default'    => [

					'top'    => '50',

					'right'  => '50',

					'bottom' => '50',

					'left'   => '50',

					'unit'   => 'px'

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-modal-button .fbth-modal-image-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);







		$this->end_controls_tab();



		$this->start_controls_tab('fbth_modal_btn_typhography_color_hover_tab', ['label' => esc_html__('Hover', 'fbth')]);



		$this->add_control(

			'fbth_modal_btn_color_hover',

			[

				'label'     => __('Text Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '',

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-button .fbth-modal-image-action:hover' => 'color: {{VALUE}};'

				]

			]

		);



		$this->add_control(

			'fbth_modal_btn_background_hover',

			[

				'label'     => __('Background Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '',

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-button .fbth-modal-image-action:hover' => 'background-color: {{VALUE}};'

				]

			]

		);

		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'     => 'fbth_modal_btn_border_hover',

				'selector' => '{{WRAPPER}} .fbth-modal-button .fbth-modal-image-action:hover'

			]

		);



		$this->end_controls_tab();

		$this->end_controls_tabs();



		$this->end_controls_section();

	}



	/**

	 * fbth_modal_icon_section

	 */

	protected function fbth_modal_icon_section()

	{

		$this->start_controls_section(

			'fbth_modal_icon_section',

			[

				'label' => __('Icon', 'fbth'),

				'tab'   => Controls_Manager::TAB_STYLE

			]

		);



		$this->start_controls_tabs(

			'btn_icon_style_tabs'

		);



		$this->start_controls_tab(

			'fbth_modal_btn_icon_color_normal_tab',

			[

				'label' => esc_html__('Normal', 'fbth')

			]

		);

		$this->add_responsive_control(

			'fbth_modal_btn_icon_size',

			[

				'label'       => __('Icon Size', 'fbth'),

				'type'        => Controls_Manager::SLIDER,

				'range'       => [

					'px'      => [

						'max' => 50

					]

				],

				'selectors'   => [

					'{{WRAPPER}} .fbth-modal-wrapper .fbth-midal-btn-icon i' => 'font-size: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}} .fbth-modal-wrapper .fbth-midal-btn-icon svg' => 'width: {{SIZE}}{{UNIT}};',

				],



			]

		);

		$this->add_responsive_control(

			'fbth_modal_btn_icon_indent',

			[

				'label'       => __('Icon Spacing', 'fbth'),

				'type'        => Controls_Manager::SLIDER,

				'range'       => [

					'px'      => [

						'max' => 50

					]

				],

				'default'    => [

					'unit'   => 'px',

					'size'   => 10

				],

				'selectors'   => [

					'{{WRAPPER}} .fbth-modal-wrapper .fbth-midal-btn-icon.modal-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}} .fbth-modal-wrapper .fbth-midal-btn-icon.modal-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};'

				],

				'condition'   => [

					'fbth_modal_btn_icon[value]!' => ''

				]

			]

		);



		$this->add_control(

			'fbth_modal_btn_icon_color_normal',

			[

				'label'     => __('Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#ffffff',

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-wrapper span.fbth-midal-btn-icon i' => 'color: {{VALUE}};',

					'{{WRAPPER}} .fbth-modal-wrapper span.fbth-midal-btn-icon svg' => 'stroke: {{VALUE}};'

				]

			]

		);



		$this->add_control(

			'fbth_modal_icon_fixed_width_height',

			[

				'label' => __('Enable Fixed Height & Width?', 'fbth'),

				'type' => Controls_Manager::SWITCHER,

				'label_on' => __('Show', 'fbth'),

				'label_off' => __('Hide', 'fbth'),

				'return_value' => 'yes',

				'default' => 'no',

			]

		);



		$this->add_responsive_control(

			'fbth_modal_btn_icon_fixed_width',

			[

				'label'      => esc_html__('Width', 'fbth'),

				'type'       => Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'range'      => [

					'px'     => [

						'min'  => 0,

						'max'  => 500,

						'step' => 1

					],

					'%'        => [

						'min'  => 0,

						'max'  => 100

					]

				],

				'default'    => [

					'unit'   => '%',

					'size'   => 100

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-modal-wrapper span.fbth-midal-btn-icon' => 'width: {{SIZE}}{{UNIT}};'



				],

				'condition' => [

					'fbth_modal_icon_fixed_width_height' => 'yes'

				]

			]

		);



		$this->add_responsive_control(

			'fbth_modal_btn_icon_fixed_height',

			[

				'label'      => esc_html__('Height', 'fbth'),

				'type'       => Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'range'      => [

					'px'     => [

						'min'  => 0,

						'max'  => 500,

						'step' => 1

					],

					'%'        => [

						'min'  => 0,

						'max'  => 100

					]

				],

				'default'    => [

					'unit'   => '%',

					'size'   => 100

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-modal-wrapper span.fbth-midal-btn-icon' => 'height: {{SIZE}}{{UNIT}};'

				],

				'condition' => [

					'fbth_modal_icon_fixed_width_height' => 'yes'

				]

			]

		);



		$this->add_control(

			'fbth_modal_btn_icon_background_normal',

			[

				'label'     => __('Background Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '',

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-wrapper span.fbth-midal-btn-icon' => 'background-color: {{VALUE}};'

				],

				'condition' => [

					'fbth_modal_icon_fixed_width_height' => 'yes'

				]

			]

		);



		$this->add_responsive_control(

			'fbth_modal_btn_icon_padding',

			[

				'label'        => __('Padding', 'fbth'),

				'type'         => Controls_Manager::DIMENSIONS,

				'size_units'   => ['px', '%'],

				'default'      => [

					'top'      => '20',

					'right'    => '0',

					'bottom'   => '20',

					'left'     => '0',

					'unit'     => 'px',

					'isLinked' => false

				],

				'selectors'    => [

					'{{WRAPPER}} .fbth-modal-wrapper span.fbth-midal-btn-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'               => 'fbth_modal_btn_icon_border_normal',

				'selector'           => '{{WRAPPER}} .fbth-modal-wrapper span.fbth-midal-btn-icon'

			]

		);



		$this->add_responsive_control(

			'fbth_modal_btn_icon_radius',

			[

				'label'      => __('Border Radius', 'fbth'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%'],

				'default'    => [

					'top'    => '50',

					'right'  => '50',

					'bottom' => '50',

					'left'   => '50',

					'unit'   => 'px'

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-modal-wrapper span.fbth-midal-btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->end_controls_tab();



		$this->start_controls_tab('fbth_modal_btn_icon_color_hover_tab', ['label' => esc_html__('Hover', 'fbth')]);



		$this->add_control(

			'fbth_modal_btn_icon_color_hover',

			[

				'label'     => __('Icon Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '',

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-button .fbth-modal-image-action:hover span.fbth-midal-btn-icon i' => 'color: {{VALUE}};',

					'{{WRAPPER}} .fbth-modal-button .fbth-modal-image-action:hover span.fbth-midal-btn-icon svg' => 'stroke: {{VALUE}};'

				]

			]

		);



		$this->add_control(

			'fbth_modal_btn_icon_background_hover',

			[

				'label'     => __('Background Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '',

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-button .fbth-modal-image-action:hover span.fbth-midal-btn-icon i' => 'background-color: {{VALUE}};',

					'{{WRAPPER}} .fbth-modal-button .fbth-modal-image-action:hover span.fbth-midal-btn-icon svg' => 'background-color: {{VALUE}};'

				]

			]

		);

		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'     => 'fbth_modal_btn_icon_border_hover',

				'selector' => '{{WRAPPER}} .fbth-modal-wrapper span.fbth-midal-btn-icon:hover'

			]

		);



		$this->end_controls_tab();

		$this->end_controls_tabs();



		$this->end_controls_section();

	}



	/**

	 * fbth_modal_container_section

	 */

	protected function fbth_modal_container_section()

	{

		$this->start_controls_section(

			'fbth_modal_container_section',

			[

				'label' => __('Container', 'fbth'),

				'tab'   => Controls_Manager::TAB_STYLE

			]

		);



		$this->add_control(

			'fbth_modal_content_align',

			[

				'label'     => __('Alignment', 'fbth'),

				'type'      => Controls_Manager::CHOOSE,

				'toggle'    => false,

				'default'   => 'center',

				'options'   => [

					'left'  => [

						'title' => __('Left', 'fbth'),

						'icon'  => 'eicon-text-align-left'

					],

					'center'    => [

						'title' => __('Center', 'fbth'),

						'icon'  => 'eicon-text-align-center'

					],

					'right'     => [

						'title' => __('Right', 'fbth'),

						'icon'  => 'eicon-text-align-right'

					]

				],

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-item .fbth-modal-content .fbth-modal-element' => 'text-align: {{VALUE}};'

				],

				'condition' => [

					'fbth_modal_content' => ['image-gallery', 'html_content']

				]

			]

		);



		$this->add_responsive_control(

			'fbth_modal_content_height',

			[

				'label' => __('Contant Height for Tablet & Mobile', 'fbth'),

				'type' => Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'range'        => [

					'px'       => [

						'min'  => 0,

						'max'  => 500,

						'step' => 1

					],

					'%'        => [

						'min'  => 0,

						'max'  => 100

					]

				],

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-item.modal-vimeo' => 'height: {{SIZE}}{{UNIT}};',

				],

			]

		);



		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name'      => 'fbth_modal_image_gallery_description_typography',

				'selector'  => '{{WRAPPER}} .fbth-modal-content .fbth-modal-element .fbth-modal-element-card .fbth-modal-element-card-body p',

				'condition' => [

					'fbth_modal_content' => ['image-gallery']

				]

			]

		);



		$this->add_control(

			'fbth_modal_image_gallery_description_color',

			[

				'label'     => __('Description Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-content .fbth-modal-element .fbth-modal-element-card .fbth-modal-element-card-body p'  => 'color: {{VALUE}};'

				],

				'condition' => [

					'fbth_modal_content' => ['image-gallery']

				]

			]

		);



		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'     => 'fbth_modal_content_border',

				'selector' => '{{WRAPPER}} .fbth-modal-item .fbth-modal-content .fbth-modal-element'

			]

		);



		$this->add_control(

			'fbth_modal_image_gallery_bg',

			[

				'label'     => __('Background Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#ffffff',

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-item .fbth-modal-content .fbth-modal-element'  => 'background: {{VALUE}};'

				],

				'condition' => [

					'fbth_modal_content' => ['image-gallery', 'html_content']

				]

			]

		);



		$this->add_control(

			'fbth_modal_image_gallery_padding',

			[

				'label'      => __('Padding', 'fbth'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'default'    => [

					'top'    => '10',

					'right'  => '10',

					'bottom' => '10',

					'left'   => '10',

					'unit'   => 'px'

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-modal-item .fbth-modal-content .fbth-modal-element .fbth-modal-element-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .fbth-modal-item .fbth-modal-content .fbth-modal-element' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				],

				'condition'  => [

					'fbth_modal_content' => ['image-gallery', 'html_content']

				]

			]

		);



		$this->add_responsive_control(

			'fbth_modal_image_gallery_description_margin',

			[

				'label'      => __('Margin(Description)', 'fbth'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%'],

				'selectors'  => [

					'{{WRAPPER}} .fbth-modal-item .fbth-modal-content .fbth-modal-element .fbth-modal-element-card-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				],

				'condition'  => [

					'fbth_modal_content' => ['image-gallery']

				]

			]

		);



		$this->add_control(

			'fbth_modal_overlay_overflow_x',

			[

				'label'        => __('Overflow X', 'fbth'),

				'type'         => Controls_Manager::SWITCHER,

				'label_on'     => __('Yes', 'fbth'),

				'label_off'    => __('No', 'fbth'),

				'default'      => 'yes',

			]

		);



		$this->add_control(

			'fbth_modal_overlay_overflow_y',

			[

				'label'        => __('Overflow Y', 'fbth'),

				'type'         => Controls_Manager::SWITCHER,

				'label_on'     => __('Yes', 'fbth'),

				'label_off'    => __('No', 'fbth'),

				'default'      => 'yes',

			]

		);



		$this->end_controls_section();

	}



	/**

	 * fbth_modal_animation_tab

	 */

	protected function fbth_modal_animation_tab()

	{

		$this->start_controls_section(

			'fbth_modal_animation_tab',

			[

				'label' => __('Animation', 'fbth'),

				'tab'   => Controls_Manager::TAB_STYLE

			]

		);



		$this->add_control(

			'fbth_modal_transition',

			[

				'label'   => __('Style', 'fbth'),

				'type'    => Controls_Manager::SELECT,

				'default' => 'top-to-middle',

				'options' => [

					'top-to-middle'    => __('Top To Middle', 'fbth'),

					'bottom-to-middle' => __('Bottom To Middle', 'fbth'),

					'right-to-middle'  => __('Right To Middle', 'fbth'),

					'left-to-middle'   => __('Left To Middle', 'fbth'),

					'zoom-in'          => __('Zoom In', 'fbth'),

					'zoom-out'         => __('Zoom Out', 'fbth'),

					'left-rotate'      => __('Rotation', 'fbth')

				]

			]

		);



		$this->end_controls_section();

	}



	/**

	 * fbth_modal_overlay_tab

	 */

	protected function fbth_modal_overlay_tab()

	{

		$this->start_controls_section(

			'fbth_modal_overlay_tab',

			[

				'label'     => __('Overlay', 'fbth'),

				'tab'       => Controls_Manager::TAB_STYLE,

				'condition' => [

					'fbth_modal_overlay' => 'yes'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Background::get_type(),

			[

				'name'            => 'fbth_modal_overlay_color',

				'types'           => ['classic'],

				'selector'        => '{{WRAPPER}} .fbth-modal-overlay',

				'fields_options'  => [

					'background'  => [

						'default' => 'classic'

					],

					'color'       => [

						'default' => 'rgba(0,0,0,.5)'

					]

				]

			]

		);



		$this->end_controls_section();

	}



	/**

	 * fbth_modal_close_btn_style

	 */

	protected function fbth_modal_close_btn_style()

	{

		$this->start_controls_section(

			'fbth_modal_close_btn_style',

			[

				'label' => __('Close Button', 'fbth'),

				'tab'   => Controls_Manager::TAB_STYLE

			]

		);



		$this->add_control(

			'fbth_modal_close_btn_position',

			[

				'label' => __('Close Button Position', 'fbth'),

				'type' => Controls_Manager::POPOVER_TOGGLE,

				'label_off' => __('Default', 'fbth'),

				'label_on' => __('Custom', 'fbth'),

				'return_value' => 'yes',

				'default' => 'yes',

			]

		);



		$this->start_popover();



		$this->add_responsive_control(

			'fbth_modal_close_btn_position_x_offset',

			[

				'label' => __('X Offset', 'fbth'),

				'type' => Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'range' => [

					'px' => [

						'min' => -4000,

						'max' => 4000,

					],

					'%' => [

						'min' => -100,

						'max' => 100,

					],

				],

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-item.modal-vimeo .fbth-modal-content .fbth-close-btn' => 'left: {{SIZE}}{{UNIT}};',

				],

			]

		);



		$this->add_responsive_control(

			'fbth_modal_close_btn_position_y_offset',

			[

				'label' => __('Y Offset', 'fbth'),

				'type' => Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'range' => [

					'px' => [

						'min' => -4000,

						'max' => 4000,

					],

					'%' => [

						'min' => -100,

						'max' => 100,

					],

				],

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-item.modal-vimeo .fbth-modal-content .fbth-close-btn' => 'top: {{SIZE}}{{UNIT}};',

				],

			]

		);



		$this->end_popover();



		$this->add_responsive_control(

			'fbth_modal_close_btn_icon_size',

			[

				'label'      => __('Icon Size', 'fbth'),

				'type'       => Controls_Manager::SLIDER,

				'size_units' => ['px'],

				'range'      => [

					'px'       => [

						'min'  => 0,

						'max'  => 30,

					],

				],

				'default'   => [

					'unit'  => 'px',

					'size'  => 20

				],

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-item.modal-vimeo .fbth-modal-content .fbth-close-btn span::before' => 'width: {{SIZE}}{{UNIT}}',

					'{{WRAPPER}} .fbth-modal-item.modal-vimeo .fbth-modal-content .fbth-close-btn span::after' => 'height: {{SIZE}}{{UNIT}}'

				],

			]

		);



		$this->add_control(

			'fbth_modal_close_btn_color',

			[

				'label'     => __('Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#ffffff',

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-item.modal-vimeo .fbth-modal-content .fbth-close-btn span::before, {{WRAPPER}} .fbth-modal-item.modal-vimeo .fbth-modal-content .fbth-close-btn span::after'  => 'background: {{VALUE}};'

				]

			]

		);



		$this->add_control(

			'fbth_modal_close_btn_bg_color',

			[

				'label'    => __('Background Color', 'fbth'),

				'type'     => Controls_Manager::COLOR,

				'default'  => 'transparent',

				'selectors' => [

					'{{WRAPPER}} .fbth-modal-item.modal-vimeo .fbth-modal-content .fbth-close-btn'  => 'background: {{VALUE}};'

				]

			]

		);



		$this->end_controls_section();

	}



	protected function render()

	{

		$settings            = $this->get_settings_for_display();



		if ('youtube' === $settings['fbth_modal_content']) {

			$url = $settings['fbth_modal_youtube_video_url'];
			preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches);
			$youtube_id = $matches[1];

		}

		if ('vimeo' === $settings['fbth_modal_content']) {
			$vimeo_url       = $settings['fbth_modal_vimeo_video_url'];
			$vimeo_id_select = explode('/', $vimeo_url);
			$vidid           = explode('&', str_replace('https://vimeo.com', '', end($vimeo_id_select)));
			$vimeo_id        = $vidid[0];

		}



		$this->add_render_attribute('fbth_modal_action', [

			'class'             => 'fbth-modal-image-action image-modal',

			'data-fbth-modal'   => '#fbth-modal-' . $this->get_id(),

			'data-fbth-overlay' => esc_attr($settings['fbth_modal_overlay'])

		]);



		$this->add_render_attribute('fbth_modal_overlay', [

			'class'                         => 'fbth-modal-overlay',

			'data-fbth_overlay_click_close' => $settings['fbth_modal_overlay_click_close']

		]);



		$this->add_render_attribute('fbth_modal_item', 'class', 'fbth-modal-item');

		$this->add_render_attribute('fbth_modal_item', 'class', 'modal-vimeo');

		$this->add_render_attribute('fbth_modal_item', 'class', $settings['fbth_modal_transition']);

		$this->add_render_attribute('fbth_modal_item', 'class', $settings['fbth_modal_content']);

		$this->add_render_attribute('fbth_modal_item', 'class', esc_attr('fbth-content-overflow-x-' . $settings['fbth_modal_overlay_overflow_x']));

		$this->add_render_attribute('fbth_modal_item', 'class', esc_attr('fbth-content-overflow-y-' . $settings['fbth_modal_overlay_overflow_y']));

?>



		<div class="fbth-modal">

			<div class="fbth-modal-wrapper">



				<div class="fbth-modal-button">

					<a href="#" <?php echo $this->get_render_attribute_string('fbth_modal_action'); ?>>

						<?php if ('left' === $settings['text_icon_align'] && !empty($settings['fbth_modal_btn_icon']['value'])) : ?>

							<span class="fbth-midal-btn-icon modal-icon-<?php echo esc_attr($settings['text_icon_align']); ?>">

								<?php Icons_Manager::render_icon($settings['fbth_modal_btn_icon'], ['aria-hidden' => 'true']); ?>

							</span>

						<?php endif; ?>

						<span class="fbth-modal-txt"> <?php echo esc_html($settings['fbth_modal_btn_text']); ?></span>

						<?php if ('right' === $settings['text_icon_align'] && !empty($settings['fbth_modal_btn_icon']['value'])) : ?>

							<span class="fbth-midal-btn-icon modal-icon-<?php echo esc_attr($settings['text_icon_align']); ?>">

								<?php Icons_Manager::render_icon($settings['fbth_modal_btn_icon'], ['aria-hidden' => 'true']); ?>

							</span>

						<?php endif; ?>

					</a>

				</div>



				<div id="fbth-modal-<?php echo esc_attr($this->get_id()); ?>" <?php echo $this->get_render_attribute_string('fbth_modal_item'); ?>>

					<div class="fbth-modal-content">

						<div class="fbth-modal-element <?php echo esc_attr($settings['fbth_modal_image_gallery_column']); ?>">

							<?php if ('image' === $settings['fbth_modal_content']) {

								echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'fbth_modal_image');

							}



							if ('image-gallery' === $settings['fbth_modal_content']) {

								foreach ($settings['fbth_modal_image_gallery_repeater'] as $gallery) : ?>

									<div class="fbth-modal-element-card">

										<div class="fbth-modal-element-card-thumb">

											<?php echo Group_Control_Image_Size::get_attachment_image_html($gallery, 'thumbnail', 'fbth_modal_image_gallery'); ?>

										</div>

										<?php if (!empty($gallery['fbth_modal_image_gallery_text'])) { ?>

											<div class="fbth-modal-element-card-body">

												<p><?php echo wp_kses_post($gallery['fbth_modal_image_gallery_text']); ?></p>

											</div>

										<?php }; ?>

									</div>

								<?php

								endforeach;

							}



							if ('html_content' === $settings['fbth_modal_content']) { ?>

								<div class="fbth-modal-element-body">

									<p><?php echo wp_kses_post($settings['fbth_modal_html_content']); ?></p>

								</div>

							<?php }



							if ('youtube' === $settings['fbth_modal_content']) { ?>

								<iframe src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>" frameborder="0" allowfullscreen></iframe>

							<?php }



							if ('vimeo' === $settings['fbth_modal_content']) { ?>

								<iframe id="vimeo-video" src="https://player.vimeo.com/video/<?php echo esc_attr($vimeo_id); ?>" frameborder="0" allowfullscreen></iframe>

							<?php }



							if ('external-video' === $settings['fbth_modal_content']) { ?>

								<video class="fbth-video-hosted" src="<?php echo esc_url($settings['fbth_modal_external_video']['url']); ?>" controls="" controlslist="nodownload">

								</video>

							<?php }



							if ('external_page' === $settings['fbth_modal_content']) { ?>

								<iframe src="<?php echo esc_url($settings['fbth_modal_external_page_url']); ?>" frameborder="0" allowfullscreen></iframe>

							<?php }



							if ('shortcode' === $settings['fbth_modal_content']) {

								echo do_shortcode($settings['fbth_modal_shortcode']);

							}; ?>



							<div class="fbth-close-btn">

								<span></span>

							</div>



						</div>

					</div>

				</div>

			</div>

			<div <?php echo $this->get_render_attribute_string('fbth_modal_overlay'); ?>></div>

		</div>

<?php

	}

}

$widgets_manager->register(new \Fbth_Addons\Widgets\Fbth_Modal_Popup());

