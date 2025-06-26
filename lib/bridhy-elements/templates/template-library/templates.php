<?php
/**
 * Template library templates
 */

defined( 'ABSPATH' ) || exit;

?>
<script type="text/template" id="tmpl-bridhyElements__header-logo">
    <span class="bridhyElements__logo-wrap">
	<svg width="12" viewBox="0 0 161 163" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="69" height="50" rx="8" fill="white" fill-opacity="0.4"/><rect width="69" height="50" rx="8" transform="matrix(1 0 0 -1 91 163)" fill="white" fill-opacity="0.4"/><rect y="71" width="70" height="92" rx="8" fill="white"/><rect width="70" height="92" rx="8" transform="matrix(1 0 0 -1 91 92)" fill="white"/></svg>
	</span>
    <span class="bridhyElements__logo-title">Bridhy Blocks</span>
</script>

<script type="text/template" id="tmpl-bridhyElements__header-back">
	<i class="eicon-" aria-hidden="true"></i>
	<span><?php echo __( 'Back to Library', 'bridhy-elements' ); ?></span>
</script>

<script type="text/template" id="tmpl-bridhyElements__header-menu">
	<# _.each( tabs, function( args, tab ) { var activeClass = args.active ? 'elementor-active' : ''; #>
		<div class="elementor-component-tab elementor-template-library-menu-item {{activeClass}}" data-tab="{{{ tab }}}">{{{ args.title }}}</div>
		<# } ); #>

</script>

<script type="text/template" id="tmpl-bridhyElements__header-menu-responsive">
	<div class="elementor-component-tab bridhyElements__responsive-menu-item elementor-active" data-tab="desktop">
		<i class="eicon-device-desktop" aria-hidden="true" title="<?php esc_attr_e( 'Desktop view', 'bridhy-elements' );?>"></i>
		<span class="elementor-screen-only"><?php esc_html_e( 'Desktop view', 'bridhy-elements' );?></span>
	</div>
	<div class="elementor-component-tab bridhyElements__responsive-menu-item" data-tab="tab">
		<i class="eicon-device-tablet" aria-hidden="true" title="<?php esc_attr_e( 'Tab view', 'bridhy-elements' );?>"></i>
		<span class="elementor-screen-only"><?php esc_html_e( 'Tab view', 'bridhy-elements' );?></span>
	</div>
	<div class="elementor-component-tab bridhyElements__responsive-menu-item" data-tab="mobile">
		<i class="eicon-device-mobile" aria-hidden="true" title="<?php esc_attr_e( 'Mobile view', 'bridhy-elements' );?>"></i>
		<span class="elementor-screen-only"><?php esc_html_e( 'Mobile view', 'bridhy-elements' );?></span>
	</div>
</script>

<script type="text/template" id="tmpl-bridhyElements__header-actions">
	<div id="bridhyElements__header-sync" class="elementor-templates-modal__header__item">
		<i class="eicon-sync" aria-hidden="true" title="<?php esc_attr_e( 'Sync Library', 'bridhy-elements' );?>"></i>
		<span class="elementor-screen-only"><?php esc_html_e( 'Sync Library', 'bridhy-elements' );?></span>
	</div>
</script>

<script type="text/template" id="tmpl-bridhyElements__preview">
    <iframe></iframe>
</script>

<script type="text/template" id="tmpl-bridhyElements__header-insert">
	<div id="elementor-template-library-header-preview-insert-wrapper" class="elementor-templates-modal__header__item">
		{{{ bridhy.library.getModal().getTemplateActionButton( obj ) }}}
	</div>
</script>

<script type="text/template" id="tmpl-bridhyElements__insert-button">
	<a class="elementor-template-library-template-action elementor-button bridhyElements__insert-button">
		<i class="eicon-file-download" aria-hidden="true"></i>
		<span class="elementor-button-title"><?php esc_html_e( 'Insert', 'bridhy-elements' );?></span>
	</a>
</script>

<script type="text/template" id="tmpl-bridhyElements__pro-button">
	<a class="elementor-template-library-template-action elementor-button bridhyElements__pro-button" href="https://UxthemeElements.com/pricing/" target="_blank">
		<i class="eicon-external-link-square" aria-hidden="true"></i>
		<span class="elementor-button-title"><?php esc_html_e( 'Get Pro', 'bridhy-elements' );?></span>
	</a>
</script>

<script type="text/template" id="tmpl-bridhyElements__theme-button">
<!-- <a class="elementor-template-library-template-action elementor-button bridhyElements__theme-button">
		<i class="eicon-file-download" aria-hidden="true"></i>
		<span class="elementor-button-title"><?php esc_html_e( 'Check', 'bridhy-elements' );?></span>
	</a> -->
</script>

<script type="text/template" id="tmpl-bridhyElements__loading">
	<div class="elementor-loader-wrapper">
		<div class="elementor-loader">
			<div class="elementor-loader-boxes">
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
			</div>
		</div>
		<div class="elementor-loading-title"><?php esc_html_e( 'Loading', 'bridhy-elements' );?></div>
	</div>
</script>

<script type="text/template" id="tmpl-bridhyElements__templates">
	<div id="bridhyElements__toolbar">
		<div id="bridhyElements__toolbar-filter" class="bridhyElements__toolbar-filter">
			<# if (bridhy.library.getTypeTags()) { var selectedTag = bridhy.library.getFilter( 'tags' ); #>
				<# if ( selectedTag ) { #>
				<span class="bridhyElements__filter-btn">{{{ bridhy.library.getTags()[selectedTag] }}} <i class="eicon-caret-right"></i></span>
				<# } else { #>
				<span class="bridhyElements__filter-btn"><?php esc_html_e( 'Filter', 'bridhy-elements' );?> <i class="eicon-caret-right"></i></span>
				<# } #>
				<ul id="bridhyElements__filter-tags" class="bridhyElements__filter-tags">
					<li data-tag="">All</li>
					<# _.each(bridhy.library.getTypeTags(), function(slug) {
						var selected = selectedTag === slug ? 'active' : '';
						#>
						<li data-tag="{{ slug }}" class="{{ selected }}">{{{ bridhy.library.getTypeTags()[slug] }}}</li>
					<# } ); #>
				</ul>
			<# } #>
		</div>
		<div id="bridhyElements__toolbar-counter"></div>
		<div id="bridhyElements__toolbar-search">
			<label for="bridhyElements__search" class="elementor-screen-only"><?php esc_html_e( 'Search Templates:', 'bridhy-elements' );?></label>
			<input id="bridhyElements__search" placeholder="<?php esc_attr_e( 'Search', 'bridhy-elements' );?>">
			<i class="eicon-search"></i>
		</div>
	</div>

	<div class="bridhyElements__templates-window">
		<div id="bridhyElements__templates-list"></div>
	</div>
</script>

<script type="text/template" id="tmpl-bridhyElements__template">
	<div class="bridhyElements__template-body" id="uxelementTemplate-{{ template_id }}">
		<div class="bridhyElements__template-preview">
			<i class="eicon-zoom-in-bold" aria-hidden="true"></i>
		</div>
		<# if ( obj.images && obj.images.length > 0 ) { #>
		<# _.each(obj.images, function(img, index) { #>
			<img class="bridhyElements__template-thumbnail hover-image image-{{ index + 1 }}" src="{{ img }}">
		<# }); #>
		<# } else{ #>
			<img class="bridhyElements__template-thumbnail" src="{{ thumbnail }}">
		<# } #>

		<# if ( obj.isPro ) { #>
		<span class="bridhyElements__template-badge"><?php esc_html_e( 'Pro', 'bridhy-elements' );?></span>
		<# } #>
	</div>
	<div class="bridhyElements__template-footer">
	    <h4 class="bridhyElements__elementsTitle">{{ obj.title }}</h4>
		{{{ bridhy.library.getModal().getTemplateActionButton( obj ) }}}
		<a href="#" class="elementor-button bridhyElements__preview-button">
			<i class="eicon-device-desktop" aria-hidden="true"></i>
			<?php esc_html_e( 'Preview', 'bridhy-elements' );?>
		</a>
	</div>
</script>

<script type="text/template" id="tmpl-bridhyElements__empty">
	<div class="elementor-template-library-blank-icon">
		<img src="<?php echo ELEMENTOR_ASSETS_URL . 'images/no-search-results.svg'; ?>" class="elementor-template-library-no-results" />
	</div>
	<div class="elementor-template-library-blank-title"></div>
	<div class="elementor-template-library-blank-message"></div>
	<div class="elementor-template-library-blank-footer">

	</div>
</script>
