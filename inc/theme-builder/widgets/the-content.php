<?php
namespace FBTH\Elementor\ThemeBuilder\Widgets;

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use FBTH\Elementor\ThemeBuilder\Common;

defined('ABSPATH') || exit();

/**
 * Scripts and Styles Class
 */
class TheContent extends Widget_Base
{
    public function get_name() {
		return 'fbth-the-content';
	}

	public function get_title() {
		return esc_html__( 'Post Content', 'fbth' );
	}

	public function get_icon() {
		return 'eicon-post-content';
	}

	public function get_categories() {
		return [ 'uicore', 'fbth-theme-builder' ];
	}

	public function get_keywords() {
		return [ 'content', 'post' ];
	}

	public function show_in_panel() {
		return true;
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'fbth' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'fbth' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'fbth' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'fbth' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'fbth' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'fbth' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'fbth' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
    //     $post = get_post();
    //     $elementor_instance = \Elementor\Plugin::instance();
	// 	if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
	// 		$id = 1991;
	//    } else {
	// 	   $id = $post->ID;
	//    }
    //     echo $elementor_instance->frontend->get_builder_content_for_display( $id, true );
	return $this->render_post_content();
	}

	public function render_plain_content() {}

	public function render_post_content( $with_wrapper = false ) {
		static $did_posts = [];
		$elementor_instance = \Elementor\Plugin::instance();
		$post = get_post();

		if ( post_password_required( $post->ID ) ) {
			echo get_the_password_form( $post->ID );
			return;
		}

		// Avoid recursion
		if ( isset( $did_posts[ $post->ID ] ) ) {
			return;
		}

		$did_posts[ $post->ID ] = true;
		// End avoid recursion

		$editor = $elementor_instance->editor;
		$is_edit_mode = $editor->is_edit_mode();

		if ( !$is_edit_mode && !is_preview() ) { //
			// $content = $elementor_instance->preview->builder_wrapper( '' ); // XSS ok
				// $content = Common::get_elementor_content($post->ID);

			the_content();
		} else {
			echo 'This is a dummy text to demonstration purposes. It will be replaced with the post content/excerpt. <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi scelerisque luctus velit. Etiam quis quam. Duis viverra diam non justo. Suspendisse sagittis ultrices augue. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. Donec ipsum massa, ullamcorper in, auctor et. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Aenean placerat. Pellentesque sapien. Mauris metus. Maecenas libero. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. In rutrum. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Praesent in mauris eu tortor porttitor accumsan. Nunc tincidunt ante vitae massa. Curabitur bibendum justo non orci. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Curabitur vitae diam non enim vestibulum interdum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Et harum quidem rerum facilis est et expedita distinctio. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus.</p><p>Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Aenean placerat. Pellentesque sapien. Mauris metus. Maecenas libero. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. In rutrum. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Praesent in mauris eu tortor porttitor accumsan. Nunc tincidunt ante vitae massa. Curabitur bibendum justo non orci. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Curabitur vitae diam non enim vestibulum interdum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Et harum quidem rerum facilis est et expedita distinctio. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus.</p> End of the dummy content.';
		} // End if().

		// Restore edit mode state
		$elementor_instance->editor->set_edit_mode( $is_edit_mode );

		// if ( $with_wrapper ) {
		// 	echo '<div class="elementor-post__content">' . balanceTags( $content, true ) . '</div>';  // XSS ok.
		// } else {
		// 	echo $content; // XSS ok.
		// }
	}
}
\Elementor\Plugin::instance()->widgets_manager->register (new TheContent());

