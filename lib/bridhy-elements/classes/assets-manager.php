<?php
namespace Uxtheme_Elements\Elementor;

use Elementor\Core\Files\CSS\Post as Post_CSS;
use Elementor\Core\Settings\Manager as SettingsManager;

defined('ABSPATH') || die();

class Assets_Manager {

	/**
	 * Bind hook and run internal methods here
	 */
	public static function init() {
		// Frontend scripts
	
		add_action( 'elementor/css-file/post/enqueue', [ __CLASS__, 'frontend_enqueue_exceptions' ] );

	

		// Enqueue editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ __CLASS__, 'editor_enqueue' ] );



	
	}

	



	/**
	 * Handle exception cases where regular enqueue won't work
	 *
	 * @param Post_CSS $file
	 *
	 * @return void
	 */
	public static function frontend_enqueue_exceptions( Post_CSS $file ) {
		$post_id = $file->get_post_id();

		if ( get_queried_object_id() === $post_id ) {
			return;
		}

		$template_type = get_post_meta( $post_id, '_elementor_template_type', true );

		if ( $template_type === 'kit' ) {
			return;
		}

		self::enqueue( $post_id );
	}

	/**
	 * Enqueue fontend assets
	 *
	 * @return void
	 */
	public static function frontend_enqueue() {
		if ( ! is_singular() ) {
			return;
		}

		self::enqueue( get_the_ID() );
	}

	/**
	 * Just enqueue the assets
	 *
	 * It just processes the assets from cache if avilable
	 * otherwise raw assets
	 *
	 * @param int $post_id
	 *
	 * @return void
	 */
	public static function enqueue( $post_id ) {
	
	}





	/**
	 * Enqueue editor assets
	 *
	 * @return void
	 */
	 
	
	public static function editor_enqueue() {
	
		// wp_enqueue_style(
		// 	'bridhy-elements-addons-editor',
		// 	BRIDHY_ELEMENTS_ASSETS . 'admin/css/editor.min.css',
		// 	null,
		// 	BRIDHY_ELEMENTS_VERSION
		// );

		// wp_enqueue_script(
		// 	'bridhy-elements-addons-editor',
		// 	BRIDHY_ELEMENTS_ASSETS . 'admin/js/editor.min.js',
		// 	['elementor-editor', 'jquery'],
		// 	BRIDHY_ELEMENTS_VERSION,
		// 	true
		// );

		Library_Manager::enqueue_assets();

	
	

		$localize_data = [
			'placeholder_widgets' => [],
		
			'editor_nonce'            => wp_create_nonce( 'ha_editor_nonce' ),
		
			'i18n' => [
				'promotionDialogHeader'     => esc_html__( '%s Widget', 'bridhy-elements' ),
				'promotionDialogMessage'    => esc_html__( 'Use %s widget with other exclusive pro widgets and 100% unique features to extend your toolbox and build sites faster and better.', 'bridhy-elements' ),
				'templatesEmptyTitle'       => esc_html__( 'No Templates Found', 'bridhy-elements' ),
				'templatesEmptyMessage'     => esc_html__( 'Try different category or sync for new templates.', 'bridhy-elements' ),
				'templatesNoResultsTitle'   => esc_html__( 'No Results Found', 'bridhy-elements' ),
				'templatesNoResultsMessage' => esc_html__( 'Please make sure your search is spelled correctly or try a different words.', 'bridhy-elements' ),
			],
		];

		

		wp_localize_script(
			'bridhy-elements-addons-editor',
			'UxthemeElementsEditor',
			$localize_data
		);
	}



	
}

Assets_Manager::init();
