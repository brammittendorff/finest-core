<?php
namespace FBTH\Elementor\ThemeBuilder\Documents;
use \Elementor\Core\DocumentTypes\Post as Post;

defined('ABSPATH') || exit();

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Base extends Post {

	public static function get_properties() {
		$properties = parent::get_properties();
		$properties['cpt'] = ['fbth-tb'];
		$properties['support_kit'] = true;

		return $properties;
	}

	/**
	 * @access public
	 */
	public function get_name() {
		return 'fbth-tb';
	}

	/**
	 * @access public
	 * @static
	 */
	public static function get_title() {
		return __( 'FBTH TB', 'fbth' );
	}
}
