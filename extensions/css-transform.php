<?php
/**
 * CSS Transform extension class.
 *
 * @package fbthppy_Addons
 */
namespace FBTH\Elementor\Modulis;

use Elementor\Element_Base;
use Elementor\Controls_Manager;

// defined( 'ABSPATH' ) || die();

class FBTH_CSS_Transform {

	public static function init() {
		add_action( 'elementor/element/common/_section_style/after_section_end', [ __CLASS__, 'register' ], 1 );
	}

	public static function register( Element_Base $element ) {
		$element->start_controls_section(
			'fbth_addons_section_css_transform',
			[
				'label' => __( 'CSS Transform', 'fbth' ),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'fbth_transform_fx',
			[
				'label' => __( 'Enable', 'fbth' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'fbth-css-transform-',
			]
		);

		$element->start_controls_tabs(
			'_tabs_fbth_transform',
			[
				'condition' => [
					'fbth_transform_fx' => 'yes',
				],
			]
		);

		$element->start_controls_tab(
			'_tabs_fbth_transform_normal',
			[
				'label' => __( 'Normal', 'fbth' ),
				'condition' => [
					'fbth_transform_fx' => 'yes',
				],
			]
		);

		$element->add_control(
			'fbth_transform_fx_translate_toggle',
			[
				'label' => __( 'Translate', 'fbth' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'condition' => [
					'fbth_transform_fx' => 'yes',
				],
			]
		);

		$element->start_popover();

		$element->add_responsive_control(
			'fbth_transform_fx_translate_x',
			[
				'label' => __( 'Translate X', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					]
				],
				'condition' => [
					'fbth_transform_fx_translate_toggle' => 'yes',
					'fbth_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-translate-x: {{SIZE}}px;'
				],
			]
		);

		$element->add_responsive_control(
			'fbth_transform_fx_translate_y',
			[
				'label' => __( 'Translate Y', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					]
				],
				'condition' => [
					'fbth_transform_fx_translate_toggle' => 'yes',
					'fbth_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-translate-y: {{SIZE}}px;'
				],
			]
		);

		$element->end_popover();

		$element->add_control(
			'fbth_transform_fx_rotate_toggle',
			[
				'label' => __( 'Rotate', 'fbth' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'fbth_transform_fx' => 'yes',
				],
			]
		);

		$element->start_popover();

		$element->add_control(
			'fbth_transform_fx_rotate_mode',
			[
				'label' => __( 'Mode', 'fbth' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'compact' => [
						'title' => __( 'Compact', 'fbth' ),
						'icon' => 'eicon-plus-circle',
					],
					'loose' => [
						'title' => __( 'Loose', 'fbth' ),
						'icon' => 'eicon-minus-circle',
					],
				],
				'default' => 'loose',
				'toggle' => false
			]
		);

		$element->add_control(
			'fbth_transform_fx_rotate_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$element->add_responsive_control(
			'fbth_transform_fx_rotate_x',
			[
				'label' => __( 'Rotate X', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fbth_transform_fx_rotate_toggle' => 'yes',
					'fbth_transform_fx' => 'yes',
					'fbth_transform_fx_rotate_mode' => 'loose'
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-rotate-x: {{SIZE}}deg;'
				],
			]
		);

		$element->add_responsive_control(
			'fbth_transform_fx_rotate_y',
			[
				'label' => __( 'Rotate Y', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fbth_transform_fx_rotate_toggle' => 'yes',
					'fbth_transform_fx' => 'yes',
					'fbth_transform_fx_rotate_mode' => 'loose'
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-rotate-y: {{SIZE}}deg;'
				],
			]
		);

		$element->add_responsive_control(
			'fbth_transform_fx_rotate_z',
			[
				'label' => __( 'Rotate (Z)', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fbth_transform_fx_rotate_toggle' => 'yes',
					'fbth_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-rotate-z: {{SIZE}}deg;'
				],
			]
		);

		$element->end_popover();

		$element->add_control(
			'fbth_transform_fx_scale_toggle',
			[
				'label' => __( 'Scale', 'fbth' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'condition' => [
					'fbth_transform_fx' => 'yes',
				],
			]
		);

		$element->start_popover();

		$element->add_control(
			'fbth_transform_fx_scale_mode',
			[
				'label' => __( 'Mode', 'fbth' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'compact' => [
						'title' => __( 'Compact', 'fbth' ),
						'icon' => 'eicon-plus-circle',
					],
					'loose' => [
						'title' => __( 'Loose', 'fbth' ),
						'icon' => 'eicon-minus-circle',
					],
				],
				'default' => 'loose',
				'toggle' => false
			]
		);

		$element->add_control(
			'fbth_transform_fx_scale_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$element->add_responsive_control(
			'fbth_transform_fx_scale_x',
			[
				'label' => __( 'Scale (X)', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default' => [
					'size' => 1
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step' => .1
					]
				],
				'condition' => [
					'fbth_transform_fx_scale_toggle' => 'yes',
					'fbth_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-scale-x: {{SIZE}}; --fbth-tfx-scale-y: {{SIZE}};'
				],
			]
		);

		$element->add_responsive_control(
			'fbth_transform_fx_scale_y',
			[
				'label' => __( 'Scale Y', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default' => [
					'size' => 1
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step' => .1
					]
				],
				'condition' => [
					'fbth_transform_fx_scale_toggle' => 'yes',
					'fbth_transform_fx' => 'yes',
					'fbth_transform_fx_scale_mode' => 'loose',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-scale-y: {{SIZE}};'
				],
			]
		);

		$element->end_popover();

		$element->add_control(
			'fbth_transform_fx_skew_toggle',
			[
				'label' => __( 'Skew', 'fbth' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'condition' => [
					'fbth_transform_fx' => 'yes',
				],
			]
		);

		$element->start_popover();

		$element->add_responsive_control(
			'fbth_transform_fx_skew_x',
			[
				'label' => __( 'Skew X', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fbth_transform_fx_skew_toggle' => 'yes',
					'fbth_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-skew-x: {{SIZE}}deg;'
				],
			]
		);

		$element->add_responsive_control(
			'fbth_transform_fx_skew_y',
			[
				'label' => __( 'Skew Y', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fbth_transform_fx_skew_toggle' => 'yes',
					'fbth_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-skew-y: {{SIZE}}deg;'
				],
			]
		);

		$element->end_popover();

		$element->end_controls_tab();

		$element->start_controls_tab(
            '_tabs_fbth_transform_hover',
            [
				'label' => __( 'Hover', 'fbth' ),
				'condition' => [
					'fbth_transform_fx' => 'yes',
				],
            ]
		);

		$element->add_control(
			'fbth_transform_fx_translate_toggle_hover',
			[
				'label' => __( 'Translate', 'fbth' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'condition' => [
					'fbth_transform_fx' => 'yes',
				],
			]
		);

		$element->start_popover();

		$element->add_responsive_control(
			'fbth_transform_fx_translate_x_hover',
			[
				'label' => __( 'Translate X', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					]
				],
				'condition' => [
					'fbth_transform_fx_translate_toggle_hover' => 'yes',
					'fbth_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-translate-x-hover: {{SIZE}}px;'
				],
			]
		);

		$element->add_responsive_control(
			'fbth_transform_fx_translate_y_hover',
			[
				'label' => __( 'Translate Y', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					]
				],
				'condition' => [
					'fbth_transform_fx_translate_toggle_hover' => 'yes',
					'fbth_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-translate-y-hover: {{SIZE}}px;'
				],
			]
		);

		$element->end_popover();

		$element->add_control(
			'fbth_transform_fx_rotate_toggle_hover',
			[
				'label' => __( 'Rotate', 'fbth' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'fbth_transform_fx' => 'yes',
				],
			]
		);

		$element->start_popover();

		$element->add_control(
			'fbth_transform_fx_rotate_mode_hover',
			[
				'label' => __( 'Mode', 'fbth' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'compact' => [
						'title' => __( 'Compact', 'fbth' ),
						'icon' => 'eicon-plus-circle',
					],
					'loose' => [
						'title' => __( 'Loose', 'fbth' ),
						'icon' => 'eicon-minus-circle',
					],
				],
				'default' => 'loose',
				'toggle' => false
			]
		);

		$element->add_control(
			'fbth_transform_fx_rotate_hr_hover',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$element->add_responsive_control(
			'fbth_transform_fx_rotate_x_hover',
			[
				'label' => __( 'Rotate X', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fbth_transform_fx_rotate_toggle_hover' => 'yes',
					'fbth_transform_fx' => 'yes',
					'fbth_transform_fx_rotate_mode_hover' => 'loose'
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-rotate-x-hover: {{SIZE}}deg;'
				],
			]
		);

		$element->add_responsive_control(
			'fbth_transform_fx_rotate_y_hover',
			[
				'label' => __( 'Rotate Y', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fbth_transform_fx_rotate_toggle_hover' => 'yes',
					'fbth_transform_fx' => 'yes',
					'fbth_transform_fx_rotate_mode_hover' => 'loose'
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-rotate-y-hover: {{SIZE}}deg;'
				],
			]
		);

		$element->add_responsive_control(
			'fbth_transform_fx_rotate_z_hover',
			[
				'label' => __( 'Rotate (Z)', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fbth_transform_fx_rotate_toggle_hover' => 'yes',
					'fbth_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-rotate-z-hover: {{SIZE}}deg;'
				],
			]
		);

		$element->end_popover();

		$element->add_control(
			'fbth_transform_fx_scale_toggle_hover',
			[
				'label' => __( 'Scale', 'fbth' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'condition' => [
					'fbth_transform_fx' => 'yes',
				],
			]
		);

		$element->start_popover();

		$element->add_control(
			'fbth_transform_fx_scale_mode_hover',
			[
				'label' => __( 'Mode', 'fbth' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'compact' => [
						'title' => __( 'Compact', 'fbth' ),
						'icon' => 'eicon-plus-circle',
					],
					'loose' => [
						'title' => __( 'Loose', 'fbth' ),
						'icon' => 'eicon-minus-circle',
					],
				],
				'default' => 'loose',
				'toggle' => false
			]
		);

		$element->add_control(
			'fbth_transform_fx_scale_hr_hover',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$element->add_responsive_control(
			'fbth_transform_fx_scale_x_hover',
			[
				'label' => __( 'Scale (X)', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default' => [
					'size' => 1
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step' => .1
					]
				],
				'condition' => [
					'fbth_transform_fx_scale_toggle_hover' => 'yes',
					'fbth_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-scale-x-hover: {{SIZE}}; --fbth-tfx-scale-y-hover: {{SIZE}};'
				],
			]
		);

		$element->add_responsive_control(
			'fbth_transform_fx_scale_y_hover',
			[
				'label' => __( 'Scale Y', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default' => [
					'size' => 1
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step' => .1
					]
				],
				'condition' => [
					'fbth_transform_fx_scale_toggle_hover' => 'yes',
					'fbth_transform_fx' => 'yes',
					'fbth_transform_fx_scale_mode_hover' => 'loose',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-scale-y-hover: {{SIZE}};'
				],
			]
		);

		$element->end_popover();

		$element->add_control(
			'fbth_transform_fx_skew_toggle_hover',
			[
				'label' => __( 'Skew', 'fbth' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'condition' => [
					'fbth_transform_fx' => 'yes',
				],
			]
		);

		$element->start_popover();

		$element->add_responsive_control(
			'fbth_transform_fx_skew_x_hover',
			[
				'label' => __( 'Skew X', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fbth_transform_fx_skew_toggle_hover' => 'yes',
					'fbth_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-skew-x-hover: {{SIZE}}deg;'
				],
			]
		);

		$element->add_responsive_control(
			'fbth_transform_fx_skew_y_hover',
			[
				'label' => __( 'Skew Y', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fbth_transform_fx_skew_toggle_hover' => 'yes',
					'fbth_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-skew-y-hover: {{SIZE}}deg;'
				],
			]
		);

		$element->end_popover();

		$element->add_control(
			'fbth_transform_fx_transition_duration',
			[
				'label' => __( 'Transition Duration', 'fbth' ),
				'type' => Controls_Manager::SLIDER,
				'separator' => 'before',
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3,
						'step' => .1,
					]
				],
				'condition' => [
					'fbth_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fbth-tfx-transition-duration: {{SIZE}}s;'
				],
			]
		);

		$element->end_controls_tab();

		$element->end_controls_tabs();

		$element->end_controls_section();
	}
}
FBTH_CSS_Transform::init();
