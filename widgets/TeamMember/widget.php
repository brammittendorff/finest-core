<?php

namespace Fbth_Addons\Widgets;



if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;

use \Elementor\Repeater;

use \Elementor\Group_Control_Border;

use \Elementor\Group_Control_Box_Shadow;

use \Elementor\Group_Control_Image_Size;

use \Elementor\Group_Control_Background;

use \Elementor\Control_Media;

use \Elementor\Icons_Manager;

use \Elementor\Group_Control_Typography;

use \Elementor\Group_Control_Css_Filter;

use \Elementor\Utils;

use \Elementor\Widget_Base;



class Fbth_Team_Member extends Widget_Base
{

	public function get_name()
	{

		return 'fbth-team-member';
	}

	public function get_title()
	{

		return esc_html__('Team Member', 'fbth');
	}

	public function get_icon()
	{

		return 'eicon-lock-user';
	}

	public function get_categories()
	{

		return ['fbth'];
	}

	public function get_keywords()
	{

		return ['fbth', 'employee', 'staff', 'team', 'member'];
	}

	protected function register_controls()
	{

		/**

		 * Team Member Content Section

		 */

		$this->start_controls_section(

			'fbth_team_content',

			[

				'label' => esc_html__('Content', 'fbth')

			]

		);

		$this->add_control(
			'team_style',
			[
				'label'             => __('Team Style', 'qweb-hp'),
				'type'              => Controls_Manager::SELECT,
				'default'           => 'style-one',
				'options'           => [
					'style-one'   =>   __('Style One',    'qweb-hp'),
					'style-two'   =>   __('Style Two',    'qweb-hp'),
					'style-three'   =>   __('Style Three',    'qweb-hp'),
					'style-four'   =>   __('Style Four',    'qweb-hp'),
					
				],
				'separator' => 'after',
			]
		);

		$this->add_control(

			'fbth_team_member_image',

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

		$this->add_group_control(

			Group_Control_Image_Size::get_type(),

			[

				'name'      => 'team_member_image_size',

				'default'   => 'medium_large',

				'condition' => [

					'fbth_team_member_image[url]!' => ''

				]

			]

		);



		$this->add_control(

			'fbth_team_member_mask_shape_position',

			[

				'label'       => __('Position', 'fbth'),

				'type'        => Controls_Manager::SELECT,

				'default'     => 'center',

				'label_block' => true,

				'options'     => [

					'top'     => __('Top', 'fbth'),

					'center'  => __('Center', 'fbth'),

					'left'    => __('Left', 'fbth'),

					'right'   => __('Right', 'fbth'),

					'bottom'  => __('Bottom', 'fbth'),

					'custom'  => __('Custom', 'fbth')

				],

				'selectors'   => [

					'{{WRAPPER}} .fbth-team-member-thumb img' => '-webkit-mask-position: {{VALUE}};'

				],

				'condition' 		   => [

					'fbth_team_member_enable_image_mask' => 'yes'

				]

			]

		);



		$this->add_control(

			'fbth_team_member_mask_shape_position_x_offset',

			[

				'label'       => __('X Offset', 'fbth'),

				'type'        => Controls_Manager::SLIDER,

				'size_units'  => ['px', '%'],

				'range'       => [

					'px'      => [

						'min' => 0,

						'max' => 500

					],

					'%'       => [

						'min' => 0,

						'max' => 100

					]

				],

				'selectors'   => [

					'{{WRAPPER}} .fbth-team-member-thumb img' => '-webkit-mask-position-y: {{SIZE}}{{UNIT}};'

				],

				'condition'   => [

					'fbth_team_member_enable_image_mask' => 'yes',

					'fbth_team_member_mask_shape_position' => 'custom'

				]

			]

		);



		$this->add_control(

			'fbth_team_member_mask_shape_position_y_offset',

			[

				'label'       => __('Y Offset', 'fbth'),

				'type'        => Controls_Manager::SLIDER,

				'size_units'  => ['px', '%'],

				'range'       => [

					'px'      => [

						'min' => 0,

						'max' => 500

					],

					'%'       => [

						'min' => 0,

						'max' => 100

					]

				],

				'selectors'   => [

					'{{WRAPPER}} .fbth-team-member-thumb img' => '-webkit-mask-position-x: {{SIZE}}{{UNIT}};'

				],

				'condition'   => [

					'fbth_team_member_enable_image_mask' => 'yes',

					'fbth_team_member_mask_shape_position' => 'custom'

				]

			]

		);



		$this->add_control(

			'fbth_team_member_mask_shape_size',

			[

				'label'       => __('Size', 'fbth'),

				'type'        => Controls_Manager::SELECT,

				'default'     => 'auto',

				'label_block' => true,

				'options'     => [

					'auto'    => __('Auto', 'fbth'),

					'contain' => __('Contain', 'fbth'),

					'cover'   => __('Cover', 'fbth'),

					'custom'  => __('Custom', 'fbth')

				],

				'selectors'   => [

					'{{WRAPPER}} .fbth-team-member-thumb img' => '-webkit-mask-size: {{VALUE}};'

				],

				'condition' 		   => [

					'fbth_team_member_enable_image_mask' => 'yes'

				]

			]

		);



		$this->add_control(

			'fbth_team_member_mask_shape_custome_size',

			[

				'label'       => __('Mask Size', 'fbth'),

				'type'        => Controls_Manager::SLIDER,

				'size_units'  => ['px', '%'],

				'range'       => [

					'px'      => [

						'min' => 0,

						'max' => 600

					],

					'%'       => [

						'min' => 0,

						'max' => 100

					]

				],

				'selectors'   => [

					'{{WRAPPER}} .fbth-team-member-thumb img' => '-webkit-mask-size: {{SIZE}}{{UNIT}};'

				],

				'condition'   => [

					'fbth_team_member_enable_image_mask' => 'yes',

					'fbth_team_member_mask_shape_size' => 'custom'

				]

			]

		);



		$this->add_control(

			'fbth_team_member_mask_shape_repeat',

			[

				'label'         => __('Repeat', 'fbth'),

				'type'          => Controls_Manager::SELECT,

				'default'       => 'no-repeat',

				'label_block'   => true,

				'options'       => [

					'no-repeat' => __('No repeat', 'fbth'),

					'repeat'    => __('Repeat', 'fbth')

				],

				'selectors'     => [

					'{{WRAPPER}} .fbth-team-member-thumb img' => '-webkit-mask-repeat: {{VALUE}};'

				],

				'condition' 	=> [

					'fbth_team_member_enable_image_mask' => 'yes'

				]

			]

		);



		$this->add_control(

			'fbth_team_member_name',

			[

				'label'       => esc_html__('Name', 'fbth'),

				'type'        => Controls_Manager::TEXT,

				'label_block' => true,

				'default'     => esc_html__('John Doe', 'fbth'),

				'dynamic' => [

					'active' => true,

				]

			]

		);



		$this->add_control(

			'fbth_team_member_designation',

			[

				'label'       => esc_html__('Designation', 'fbth'),

				'type'        => Controls_Manager::TEXT,

				'label_block' => true,

				'default'     => esc_html__('Designation', 'fbth'),

				'dynamic' => [

					'active' => true,

				]

			]

		);

		$this->add_control(
			'show_description',
			[
				'label'        => __('Show Description', 'fbth'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'fbth'),
				'label_off'    => __('Hide', 'fbth'),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(

			'fbth_team_member_description',

			[

				'label'       => esc_html__('Description', 'fbth'),

				'type'        => Controls_Manager::TEXT,

				'label_block' => true,

				'default'     => esc_html__('As the CEO of the company, Esther Howard is a visionary leader with a wealth of experience.', 'fbth'),

				'dynamic' => [

					'active' => true,

				],
				'condition'   => [
					'show_description' => 'yes',
				],

			]

		);

		$this->add_control(

			'fbth_section_team_members_cta_btn',

			[

				'label'        => __('Call To Action', 'fbth'),

				'type'         => Controls_Manager::SWITCHER,

				'label_on'     => __('ON', 'fbth'),

				'label_off'    => __('OFF', 'fbth'),

				'return_value' => 'yes',

				'default'      => 'no'

			]

		);



		$this->add_control(

			'fbth_team_members_cta_btn_text',

			[

				'label'       => esc_html__('Text', 'fbth'),

				'type'        => Controls_Manager::TEXT,

				'label_block' => true,

				'default'     => esc_html__('Read More', 'fbth'),

				'condition'   => [

					'fbth_section_team_members_cta_btn' => 'yes'

				],

				'dynamic' => [

					'active' => true,

				]

			]

		);



		$this->add_control(

			'fbth_team_members_cta_btn_link',

			[

				'label'       => esc_html__('Link', 'fbth'),

				'type'        => Controls_Manager::URL,

				'label_block' => true,

				'default'     => [

					'url'         => '#',

					'is_external' => ''

				],

				'show_external' => true,

				'condition' => [

					'fbth_section_team_members_cta_btn' => 'yes'

				]

			]

		);

		$this->add_control(

			'team_btn_icon',

			[

				'label' => esc_html__('Icon', 'plugin-name'),

				'type' => \Elementor\Controls_Manager::ICONS,

				'condition'   => [

					'fbth_section_team_members_cta_btn' => 'yes'

				],

			]

		);

		$this->end_controls_section();

		/*

		* Team member Social profiles section

		*/

		$this->start_controls_section(

			'fbth_section_team_member_social_profiles',

			[

				'label' => esc_html__('Social Profiles', 'fbth')

			]

		);

		$this->add_control(

			'fbth_team_member_enable_social_profiles',

			[

				'label'   => esc_html__('Display Social Profiles?', 'fbth'),

				'type'    => Controls_Manager::SWITCHER,

				'default' => 'yes'

			]

		);

		$repeater = new Repeater();

		$repeater->add_control(

			'social_icon',

			[

				'label'            => __('Icon', 'fbth'),

				'type'             => Controls_Manager::ICONS,

				'label_block'      => true,

				'default'          => [

					'value'        => 'fab fa-wordpress',

					'library'      => 'fa-brands'

				]



			]

		);



		$repeater->add_control(

			'link',

			[

				'label'       => __('Link', 'fbth'),

				'type'        => Controls_Manager::URL,

				'label_block' => true,

				'default'     => [

					'url'         => '#',

					'is_external' => 'true'

				],

				'dynamic'     => [

					'active'  => true

				],

				'placeholder' => __('https://your-link.com', 'fbth')

			]

		);



		$this->add_control(

			'fbth_team_member_social_profile_links',

			[

				'label'       => __('Social Icons', 'fbth'),

				'type'        => Controls_Manager::REPEATER,

				'fields'      => $repeater->get_controls(),

				'condition'   => [

					'fbth_team_member_enable_social_profiles!' => ''

				],

				'default'     => [

					[

						'social_icon' => [

							'value'   => 'fab fa-facebook-f',

							'library' => 'fa-brands'

						]

					],

					[

						'social_icon' => [

							'value'   => 'fab fa-twitter',

							'library' => 'fa-brands'

						]

					],

					[

						'social_icon' => [

							'value'   => 'fab fa-linkedin-in',

							'library' => 'fa-brands'

						],

					],

					[

						'social_icon' => [

							'value'   => 'fab fa-google-plus-g',

							'library' => 'fa-brands',

						]

					]

				],

				'title_field' => '{{{ elementor.helpers.getSocialNetworkNameFromIcon( social_icon, false, true, false, true ) }}}'

			]

		);

		$this->end_controls_section();

		/*

		* Team Members Styling Section

		*/



		/*

		* Team Members Container Style

		*/

		$this->start_controls_section(

			'fbth_section_team_members_styles_preset',

			[

				'label' => esc_html__('Container', 'fbth'),

				'tab'   => Controls_Manager::TAB_STYLE

			]

		);
		$this->start_controls_tabs(
			'container_style_tabs'
		);
		$this->start_controls_tab(
			'container_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'textdomain' ),
			]
		);
		$this->add_group_control(

			Group_Control_Background::get_type(),

			[

				'name'     => 'fbth_team_members_bg',

				'types'    => ['classic', 'gradient'],

				'selector' => '{{WRAPPER}} .fbth-team-member'

			]

		);

		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'     => 'fbth_team_members_border',

				'selector' => '{{WRAPPER}} .fbth-team-member'

			]

		);



		$this->add_responsive_control(

			'fbth_team_members_radius',

			[

				'label'      => __('Border radius', 'fbth'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'default'    => [

					'top'    => '0',

					'right'  => '0',

					'bottom' => '0',

					'left'   => '0'

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-team-member' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'fbth_team_members_padding',

			[

				'label'      => __('Padding', 'fbth'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'default'    => [

					'top'    => '0',

					'right'  => '0',

					'bottom' => '0',

					'left'   => '0'

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-team-member' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);

		

		$this->add_responsive_control(

			'fbth_team_members_margin',

			[

				'label'      => __('Margin', 'fbth'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'default'    => [

					'top'    => '0',

					'right'  => '0',

					'bottom' => '0',

					'left'   => '0'

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-team-member' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Box_Shadow::get_type(),

			[

				'name'     => 'fbth_team_members_box_shadow',

				'selector' => '{{WRAPPER}} .fbth-team-member',

				'fields_options'         => [

					'box_shadow_type'    => [

						'default'        => 'yes'

					],

					'box_shadow'         => [

						'default'        => [

							'horizontal' => 0,

							'vertical'   => 20,

							'blur'       => 49,

							'spread'     => 0,

							'color'      => 'rgba(24, 27, 33, 0.1)'

						]

					]

				]

			]

		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'container_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'textdomain' ),
			]
		);
		$this->add_control(
			'team_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fbth-team-member:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();



		/**

		 * For Thumbnail style

		 */



		$this->start_controls_section(

			'fbth_section_team_members_image_style',

			[

				'label' => esc_html__('Image', 'fbth'),

				'tab'   => Controls_Manager::TAB_STYLE

			]

		);




		$this->start_controls_tabs(

			'image_style_tabs'

		);



		$this->start_controls_tab(

			'image_normal_tab',

			[

				'label' => esc_html__('Normal', 'plugin-name'),

			]

		);



		$this->add_control(

			'fbth_section_team_members_thumbnail_box',

			[

				'label'        => __('Image Box', 'fbth'),

				'type'         => Controls_Manager::SWITCHER,

				'label_on'     => __('Show', 'fbth'),

				'label_off'    => __('Hide', 'fbth'),

				'return_value' => 'yes',

				'default'      => 'no'

			]

		);



		$this->add_responsive_control(

			'fbth_section_team_members_thumbnail_box_height',

			[

				'label'      => __('Height', 'fbth'),

				'type'       => Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'default'    => [

					'unit'   => 'px',

					'size'   => 100

				],

				'range'        => [

					'px'       => [

						'min'  => 50,

						'max'  => 500,

						'step' => 5

					],

					'%'        => [

						'min'  => 1,

						'max'  => 100,

						'step' => 2

					]

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-team-member-thumb img' => 'height: {{SIZE}}{{UNIT}};'

				],

				'condition'  => [

					'fbth_section_team_members_thumbnail_box' => 'yes'

				]

			]

		);



		$this->add_responsive_control(

			'fbth_section_team_members_thumbnail_box_width',

			[

				'label'      => __('Width', 'fbth'),

				'type'       => Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'default'    => [

					'unit'   => 'px',

					'size'   => 100

				],

				'range'        => [

					'px'       => [

						'min'  => 50,

						'max'  => 500,

						'step' => 5

					],

					'%'        => [

						'min'  => 1,

						'max'  => 100,

						'step' => 2

					]

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-team-member-thumb img' => 'width: {{SIZE}}{{UNIT}};'

				],

				'condition'  => [

					'fbth_section_team_members_thumbnail_box' => 'yes'

				]

			]

		);


	$this->add_group_control(

			Group_Control_Background::get_type(),

			[

				'name'     => 'fbth_team_members_image_background',

				'types'    => ['classic', 'gradient'],

				'selector' => '{{WRAPPER}} .fbth-team-member-thumb'

			]

		);


		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'      => 'fbth_section_team_members_thumbnail_box_border',

				'selector'  => '{{WRAPPER}} .fbth-team-member-thumb img',

				'condition' => [

					'fbth_section_team_members_thumbnail_box' => 'yes'

				]

			]

		);



		$this->add_responsive_control(

			'fbth_section_team_members_thumbnail_box_radius',

			[

				'label'      => __('Border radius', 'fbth'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'separator'  => 'after',

				'default'    => [

					'top'    => '0',

					'right'  => '0',

					'bottom' => '0',

					'left'   => '0'

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-team-member-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .fbth-team-member-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'fbth_section_team_members_thumbnail_box_margin_top',

			[

				'label'      => __('Top Spacing', 'fbth'),

				'type'       => Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'default'    => [

					'unit'   => 'px',

					'size'   => 0

				],

				'range'        => [

					'px'       => [

						'min'  => -300,

						'max'  => 300,

						'step' => 5

					],

					'%'        => [

						'min'  => -50,

						'max'  => 50,

						'step' => 2

					]

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-team-member-thumb img' => 'margin-top: {{SIZE}}{{UNIT}};'

				],

				'condition'  => [

					'fbth_section_team_members_thumbnail_box' => 'yes'

				]

			]

		);



		$this->add_responsive_control(

			'fbth_section_team_members_thumbnail_box_margin_bottom',

			[

				'label'      => __('Bottom Spacing', 'fbth'),

				'type'       => Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'default'    => [

					'unit'   => 'px',

					'size'   => 0

				],

				'range'        => [

					'px'       => [

						'min'  => -300,

						'max'  => 300,

						'step' => 5

					],

					'%'        => [

						'min'  => -50,

						'max'  => 50,

						'step' => 2

					]

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-team-member-thumb img' => 'margin-bottom: {{SIZE}}{{UNIT}};'

				],

				'condition'  => [

					'fbth_section_team_members_thumbnail_box' => 'yes'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Box_Shadow::get_type(),

			[

				'name'      => 'fbth_section_team_members_thumbnail_box_shadow',

				'selector'  => '{{WRAPPER}} .fbth-team-member-thumb img',

				'condition' => [

					'fbth_section_team_members_thumbnail_box' => 'yes'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Css_Filter::get_type(),

			[

				'name' => 'fbth_section_team_members_thumbnail_css_filter',

				'selector' => '{{WRAPPER}} .fbth-team-member-thumb img',

			]

		);

		$this->end_controls_tab();

		$this->start_controls_tab(

			'image_style_hover_tab',

			[

				'label' => esc_html__('Hover', 'plugin-name'),

			]

		);

		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'      => 'image_hover_border',

				'selector'  => '{{WRAPPER}} .fbth-team-member-thumb img:hover',

			]

		);



		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();



		/*

		* Team Members Content Style

		*/

		$this->start_controls_section(

			'fbth_section_team_members_content_style',

			[

				'label' => esc_html__('Content', 'fbth'),

				'tab'   => Controls_Manager::TAB_STYLE

			]

		);


		$this->add_control(

			'content_position',

			[

				'label' => esc_html__('Content Position', 'plugin-name'),

				'type' => \Elementor\Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'range' => [

					'px' => [

						'min' => 0,

						'max' => 1000,

						'step' => 5,

					],

					'%' => [

						'min' => 0,

						'max' => 100,

					],

				],

				'default' => [

					'unit' => 'px',

					'size' => 5,

				],

				'selectors' => [

					'{{WRAPPER}} .fbth-team-item.style-one .fbth-team-member-content' => 'transform: translateY({{SIZE}}{{UNIT}});',

				],

			]

		);




		$this->add_responsive_control(

			'width',

			[

				'label' => esc_html__('Width', 'plugin-name'),

				'type' => \Elementor\Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'range' => [

					'px' => [

						'min' => 0,

						'max' => 1000,

						'step' => 1,

					],

					'%' => [

						'min' => 0,

						'max' => 100,

					],

				],

				'default' => [

					'unit' => '%',

					'size' => 60,

				],

				'selectors' => [

					'{{WRAPPER}} .fbth-position-left .fbth-team-member-content' => 'width: {{SIZE}}{{UNIT}};',

				],

			]

		);



		$this->add_control(

			'fbth_team_member_content_alignment',

			[

				'label'   => __('Alignment', 'fbth'),

				'type'    => Controls_Manager::CHOOSE,

				'toggle'  => false,

				'options' => [

					'fbth-left'   => [

						'title'   => __('Left', 'fbth'),

						'icon'    => 'eicon-text-align-left'

					],

					'fbth-center' => [

						'title'   => __('Center', 'fbth'),

						'icon'    => 'eicon-text-align-center'

					],

					'fbth-right'  => [

						'title'   => __('Right', 'fbth'),

						'icon'    => 'eicon-text-align-right'

					]

				],

				'default' => 'fbth-center'

			]

		);



		$this->add_group_control(

			Group_Control_Background::get_type(),

			[

				'name'     => 'fbth_team_members_content_background',

				'types'    => ['classic', 'gradient'],

				'selector' => '{{WRAPPER}} .fbth-team-member-content'

			]

		);



		$this->add_responsive_control(

			'fbth_section_team_members_content_padding',

			[

				'label'      => __('Padding', 'fbth'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'default'    => [

					'top'    => '30',

					'right'  => '30',

					'bottom' => '30',

					'left'   => '30'

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-team-member-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);
		$this->add_responsive_control(

			'fbth_team_members_padding_hover',

			[

				'label'      => __('Padding on hover', 'fbth'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				

				'selectors'  => [

					'{{WRAPPER}} .fbth-team-item.style-one:hover .fbth-team-member-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				],
				'condition'  => [

					'team_style' => 'style-one'

				],


			]

		);


		$this->add_responsive_control(

			'fbth_section_team_members_content_margin',

			[

				'label'      => __('Margin', 'fbth'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'default'    => [

					'top'    => '0',

					'right'  => '0',

					'bottom' => '0',

					'left'   => '0'

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-team-member-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'fbth_team_member_content_border_radius',

			[

				'label'      => __('Border Radius', 'fbth'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'default'    => [

					'top'    => '0',

					'right'  => '0',

					'bottom' => '0',

					'left'   => '0'

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-team-member-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Box_Shadow::get_type(),

			[

				'name'     => 'fbth_section_team_members_content_box_shadow',

				'selector' => '{{WRAPPER}} .fbth-team-member-content'

			]

		);



		$this->end_controls_section();



		/*

		* Name style

		*/

		$this->start_controls_section(

			'section_team_carousel_name',

			[

				'label' => __('Name', 'fbth'),

				'tab'   => Controls_Manager::TAB_STYLE

			]

		);



		$this->add_control(

			'fbth_team_name_color',

			[

				'label'     => __('Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#000000',

				'selectors' => [

					'{{WRAPPER}} .fbth-team-member-name' => 'color: {{VALUE}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name'     => 'fbth_team_name_typography',

				'selector' => '{{WRAPPER}} .fbth-team-member-name'

			]

		);



		$this->add_responsive_control(

			'fbth_team_members_name_margin',

			[

				'label'        => __('Margin', 'fbth'),

				'type'         => Controls_Manager::DIMENSIONS,

				'size_units'   => ['px', '%', 'em'],

				'default'      => [

					'top'      => '0',

					'right'    => '0',

					'bottom'   => '20',

					'left'     => '0',

					'isLinked' => false

				],

				'selectors'    => [

					'{{WRAPPER}} .fbth-team-member-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->end_controls_section();




		/**

		 * Designation Style

		 */

		$this->start_controls_section(

			'section_team_member_designation',

			[

				'label' => __('Designation', 'fbth'),

				'tab'   => Controls_Manager::TAB_STYLE

			]

		);



		$this->add_control(

			'fbth_team_designation_color',

			[

				'label'     => __('Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#8a8d91',

				'selectors' => [

					'{{WRAPPER}} span.fbth-team-member-designation' => 'color: {{VALUE}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name'     => 'fbth_team_designation_typography',

				'selector' => '{{WRAPPER}} span.fbth-team-member-designation'

			]

		);



		$this->add_responsive_control(

			'fbth_team_members_designation_margin',

			[

				'label'        => __('Margin', 'fbth'),

				'type'         => Controls_Manager::DIMENSIONS,

				'size_units'   => ['px', '%', 'em'],

				'default'      => [

					'top'      => '0',

					'right'    => '0',

					'bottom'   => '20',

					'left'     => '0',

					'isLinked' => false

				],

				'selectors'    => [

					'{{WRAPPER}} span.fbth-team-member-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);

		$this->end_controls_section();






		/*

		* Description style

		*/

		$this->start_controls_section(

			'section_team_desc_name',

			[

				'label' => __('Description', 'fbth'),

				'tab'   => Controls_Manager::TAB_STYLE

			]

		);



		$this->add_control(

			'fbth_team_desc_color',

			[

				'label'     => __('Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#000000',

				'selectors' => [

					'{{WRAPPER}} p.team-description' => 'color: {{VALUE}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name'     => 'fbth_team_desc_typography',

				'selector' => '{{WRAPPER}} p.team-description'

			]

		);



		$this->add_responsive_control(

			'fbth_team_members_desc_margin',

			[

				'label'        => __('Margin', 'fbth'),

				'type'         => Controls_Manager::DIMENSIONS,

				'size_units'   => ['px', '%', 'em'],

				'default'      => [

					'top'      => '0',

					'right'    => '0',

					'bottom'   => '20',

					'left'     => '0',

					'isLinked' => false

				],

				'selectors'    => [

					'{{WRAPPER}} p.team-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->end_controls_section();


	
		/**

		 * Call to action Style

		 */

		$this->start_controls_section(

			'fbth_team_member_cta_btn_style',

			[

				'label'     => __('Call To Action', 'fbth'),

				'tab'       => Controls_Manager::TAB_STYLE,

				'condition' => [

					'fbth_section_team_members_cta_btn' => 'yes'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name'     => 'fbth_team_member_cta_btn_typography',

				'selector' => '{{WRAPPER}} .fbth-team-member-cta'

			]

		);



		$this->add_responsive_control(

			'fbth_team_member_cta_btn_margin',

			[

				'label'        => __('Margin', 'fbth'),

				'type'         => Controls_Manager::DIMENSIONS,

				'size_units'   => ['px', '%', 'em'],

				'default'      => [

					'top'      => '0',

					'right'    => '0',

					'bottom'   => '20',

					'left'     => '0',

					'isLinked' => false

				],

				'selectors'    => [

					'{{WRAPPER}} .fbth-team-member-cta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'fbth_team_member_cta_btn_padding',

			[

				'label'        => __('Padding', 'fbth'),

				'type'         => Controls_Manager::DIMENSIONS,

				'size_units'   => ['px', '%', 'em'],

				'default'      => [

					'top'      => '15',

					'right'    => '30',

					'bottom'   => '15',

					'left'     => '30',

					'isLinked' => false

				],

				'selectors'    => [

					'{{WRAPPER}} .fbth-team-member-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'fbth_team_member_cta_btn_radius',

			[

				'label'      => __('Border Radius', 'fbth'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'default'    => [

					'top'    => '0',

					'right'  => '0',

					'bottom' => '0',

					'left'   => '0'

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-team-member-cta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->start_controls_tabs('fbth_team_member_cta_btn_tabs');



		$this->start_controls_tab('fbth_team_member_cta_btn_tab_normal', ['label' => esc_html__('Normal', 'fbth')]);



		$this->add_control(

			'fbth_team_member_cta_btn_text_color_normal',

			[

				'label'     => esc_html__('Text Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#222222',

				'selectors' => [

					'{{WRAPPER}} .fbth-team-member-cta' => 'color: {{VALUE}};'

				]

			]

		);



		$this->add_control(

			'fbth_team_member_cta_btn_background_normal',

			[

				'label'     => esc_html__('Background Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#d6d6d6',

				'selectors' => [

					'{{WRAPPER}} .fbth-team-member-cta' => 'background-color: {{VALUE}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'     => 'fbth_team_member_cta_btn_border_normal',

				'selector' => '{{WRAPPER}} .fbth-team-member-cta'

			]

		);



		$this->end_controls_tab();



		$this->start_controls_tab('fbth_team_member_cta_btn_tab_hover', ['label' => esc_html__('Hover', 'fbth')]);



		$this->add_control(

			'fbth_team_member_cta_btn_text_color_hover',

			[

				'label'     => esc_html__('Text Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#d6d6d6',

				'selectors' => [

					'{{WRAPPER}} .fbth-team-member-cta:hover' => 'color: {{VALUE}};'

				]

			]

		);



		$this->add_control(

			'fbth_team_member_cta_btn_background_hover',

			[

				'label'     => esc_html__('Background Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#222222',

				'selectors' => [

					'{{WRAPPER}} .fbth-team-member-cta:hover' => 'background-color: {{VALUE}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'     => 'fbth_team_member_cta_btn_border_hover',

				'selector' => '{{WRAPPER}} .fbth-team-member-cta:hover'

			]

		);



		$this->end_controls_tab();



		$this->end_controls_tabs();

		$this->add_control(

			'team_icon_options',

			[

				'label' => esc_html__('Icon Options', 'plugin-name'),

				'type' => \Elementor\Controls_Manager::HEADING,

				'separator' => 'before',

			]

		);



		$this->add_control(

			'icon_gap',

			[

				'label' => esc_html__('Icon Gap', 'plugin-name'),

				'type' => \Elementor\Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'range' => [

					'px' => [

						'min' => 0,

						'max' => 1000,

						'step' => 5,

					],

					'%' => [

						'min' => 0,

						'max' => 100,

					],

				],

				'default' => [

					'unit' => 'px',

					'size' => 5,

				],

				'selectors' => [

					'{{WRAPPER}} span.team_btn_iocn svg' => 'margin-left: {{SIZE}}{{UNIT}};',

				],

			]

		);



		$this->add_control(

			'icon_svg_top_gap',

			[

				'label' => esc_html__('Svg Top Gap', 'plugin-name'),

				'type' => \Elementor\Controls_Manager::SLIDER,

				'size_units' => ['px', '%'],

				'range' => [

					'px' => [

						'min' => 0,

						'max' => 1000,

						'step' => 5,

					],

					'%' => [

						'min' => 0,

						'max' => 100,

					],

				],

				'default' => [

					'unit' => 'px',

					'size' => 3,

				],

				'selectors' => [

					'{{WRAPPER}} span.team_btn_iocn svg' => 'margin-top: {{SIZE}}{{UNIT}};',

				],

			]

		);

		$this->end_controls_section();



		/**

		 * Social icons style

		 */

		$this->start_controls_section(

			'fbth_team_member_social_section',

			[

				'label'     => __('Social Icons', 'fbth'),

				'tab'       => Controls_Manager::TAB_STYLE,

				'condition' => [

					'fbth_team_member_enable_social_profiles!' => ''

				]

			]

		);





		$this->add_responsive_control(

			'fbth_team_members_social_icon_size',

			[

				'label'        => __('Size', 'fbth'),

				'type'         => Controls_Manager::SLIDER,

				'size_units'   => ['px'],

				'range'        => [

					'px'       => [

						'min'  => 0,

						'max'  => 50,

						'step' => 1

					]

				],

				'default'      => [

					'unit'     => 'px',

					'size'     => 14

				],

				'selectors'    => [

					'{{WRAPPER}} .fbth-team-member-social li a i' => 'font-size: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}} .fbth-team-member-social li a svg' => 'height: {{SIZE}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'fbth_team_member_social_padding',

			[

				'label'      => __('Padding', 'fbth'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'separator'  => 'after',

				'default'    => [

					'top'    => '15',

					'right'  => '15',

					'bottom' => '15',

					'left'   => '15'

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-team-member-social li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'fbth_team_members_social_box_radius',

			[

				'label'      => __('Border radius', 'fbth'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'default'    => [

					'top'    => '0',

					'right'  => '0',

					'bottom' => '0',

					'left'   => '0'

				],

				'selectors'  => [

					'{{WRAPPER}} .fbth-team-member-social li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->add_responsive_control(

			'fbth_team_member_social_margin',

			[

				'label'      => __('Margin', 'fbth'),

				'type'       => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'separator'  => 'after',

				'selectors'  => [

					'{{WRAPPER}} .fbth-team-member-social li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

				]

			]

		);



		$this->start_controls_tabs('fbth_team_members_social_icons_style_tabs');



		$this->start_controls_tab('fbth_team_members_social_icon_tab', ['label' => esc_html__('Normal', 'fbth')]);



		$this->add_control(

			'fbth_team_carousel_social_icon_color_normal',

			[

				'label'     => esc_html__('Icon Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#a4a7aa',

				'selectors' => [

					'{{WRAPPER}} .fbth-team-member-social li a i' => 'color: {{VALUE}};',

					'{{WRAPPER}} .fbth-team-member-social li a svg path' => 'fill: {{VALUE}};'

				]

			]

		);



		$this->add_control(

			'fbth_team_carousel_social_bg_color_normal',

			[

				'label'     => esc_html__('Background Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '',

				'selectors' => [

					'{{WRAPPER}} .fbth-team-member-social li a' => 'background-color: {{VALUE}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'     => 'fbth_team_carousel_social_border_normal',

				'selector' => '{{WRAPPER}} .fbth-team-member-social li a'

			]

		);



		$this->end_controls_tab();



		$this->start_controls_tab('fbth_team_members_social_icon_hover', ['label' => esc_html__('Hover', 'fbth')]);



		$this->add_control(

			'fbth_team_carousel_social_icon_color_hover',

			[

				'label'     => esc_html__('Icon Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'default'   => '#8a8d91',

				'selectors' => [

					'{{WRAPPER}} .fbth-team-member-social li a:hover i' => 'color: {{VALUE}};',

					'{{WRAPPER}} .fbth-team-member-social li a:hover svg path' => 'fill: {{VALUE}};'

				]

			]

		);



		$this->add_control(

			'fbth_team_carousel_social_bg_color_hover',

			[

				'label'     => esc_html__('Background Color', 'fbth'),

				'type'      => Controls_Manager::COLOR,

				'selectors' => [

					'{{WRAPPER}} .fbth-team-member-social li a:hover' => 'background-color: {{VALUE}};'

				]

			]

		);



		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name'     => 'fbth_team_carousel_social_border_hover',

				'selector' => '{{WRAPPER}} .fbth-team-member-social li a:hover'

			]

		);



		$this->end_controls_tab();



		$this->end_controls_tabs();



		$this->end_controls_section();
	}

	private function team_member_cta()
	{

		$settings = $this->get_settings_for_display();



		$this->add_render_attribute('fbth_team_members_cta_btn_text', 'class', 'fbth-team-cta-button-text');

		$this->add_inline_editing_attributes('fbth_team_members_cta_btn_text', 'none');

?>

		<span <?php echo $this->get_render_attribute_string('fbth_team_members_cta_btn_text'); ?>>

			<?php echo esc_html($settings['fbth_team_members_cta_btn_text']); ?>

		</span>

	<?php

	}

	protected function render()
	{

		$settings = $this->get_settings_for_display();
		$team_style = $settings['team_style'];


		$this->add_render_attribute('fbth_team_member_name', 'class', 'fbth-team-member-name');

		$this->add_inline_editing_attributes('fbth_team_member_name', 'basic');

		$this->add_render_attribute('fbth_team_member_designation', 'class', 'fbth-team-member-designation');

		$this->add_inline_editing_attributes('fbth_team_member_designation', 'basic');

		$this->add_render_attribute('fbth_team_member_item', [

			'class' => [

				'fbth-team-member',

				esc_attr($settings['fbth_team_member_content_alignment'])

			]

		]);

		$this->add_render_attribute('fbth_team_members_cta_btn_link', 'class', 'fbth-team-member-cta');

		if (isset($settings['fbth_team_members_cta_btn_link']['url'])) {

			$this->add_render_attribute('fbth_team_members_cta_btn_link', 'href', esc_url($settings['fbth_team_members_cta_btn_link']['url']));

			if (!empty($settings['fbth_team_members_cta_btn_link']['is_external'])) {

				$this->add_render_attribute('fbth_team_members_cta_btn_link', 'target', '_blank');
			}

			if (!empty($settings['fbth_team_members_cta_btn_link']['nofollow'])) {

				$this->add_render_attribute('fbth_team_members_cta_btn_link', 'rel', 'nofollow');
			}
		}


	?>

		<?php if ($team_style) {
			include('content/' . $team_style . '.php');
		} ?>




<?php

	}
}

$widgets_manager->register(new \Fbth_Addons\Widgets\Fbth_Team_Member());
