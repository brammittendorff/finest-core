<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php if ( ! current_theme_supports( 'title-tag' ) ) : ?>
		<title><?php echo wp_get_document_title(); ?></title>
	<?php endif; ?>
	<?php wp_head(); ?>
	<?php
	//Megamenu Custom Width;
		$settings = get_post_meta(get_the_ID(), 'tb_settings', true);
		if(isset($settings['width']) && $settings['width'] === 'custom'){
	?>
	<style id='megamenu-custom-width'>
	.elementor-edit-mode{
		max-width: <?php echo $settings['widthCustom']; ?>px;
		margin: 0 auto;
	}
	</style>
	<?php } 

	?>
</head>
<body <?php body_class(); ?>>
	<?php

	\Elementor\Plugin::$instance->modules_manager->get_modules( 'page-templates' )->print_content();

	wp_footer();
	?>
	</body>
</html>