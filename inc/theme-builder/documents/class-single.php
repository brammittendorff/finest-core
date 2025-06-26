<?php
namespace FBTH\Elementor\ThemeBuilder\Documents;

defined('ABSPATH') || exit();

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Single extends Base {

    public static function get_editor_panel_config() {
		$config = parent::get_editor_panel_config();

		$config['widgets_settings']['fbth-theme-builder'] = [
			'show_in_panel' => true,
		];

		return $config;
	}

	protected static function get_editor_panel_categories() {
		// Move to top as active.
		$categories = [
			'fbth-theme-builder' => [
				'title' => esc_html__( 'Theme Builder', 'fbth' ),
				'active' => true,
			],
		];

		return $categories + parent::get_editor_panel_categories();
	}

    // public function before_get_content() {
	// 	parent::before_get_content();

	// 	// For `loop_start` hook.
	// 	if ( have_posts() ) {
	// 		the_post();
	// 	}
	// }

	// public function after_get_content() {
	// 	wp_reset_postdata();

	// 	parent::after_get_content();
	// }
}
