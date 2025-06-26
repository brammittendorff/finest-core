<div class="post-content-wrap">
    <div class="post-thumbnail">
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail-wrapper">
                <a href="<?php echo esc_url(get_the_permalink()); ?>" class="post-link">
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                </a>
            </div>
        <?php endif; ?>
    </div>
    <div class="post-content">
        <?php if ($top_meta) : ?>
            <div class="post-top-meta">
                <?php printf($top_meta); ?>
            </div>
        <?php endif; ?>
        
        <?php printf('<a href="%s" ><h3 class="post-title">%s</h3></a>', get_the_permalink(), esc_html($title));
        echo 'yes' == $settings['show_excerpt'] ? sprintf('<p> %s </p>', esc_html($excerpt)) : ''; ?>
        <div class="author-info d-flex">
              <?php if ($bottom_meta) : ?>
            <div class="post-meta-bottom">
                <?php printf($bottom_meta); ?>
            </div>
        <?php endif; ?>
        </div>
      
        <?php if ('yes' == $settings['show_readmore']) : ?>
            <div class="post-btn-wrap">
                <a class='post-btn' href="<?php the_permalink() ?>">
                    <?php if ('before' == $settings['icon_position'] && !empty($settings['btn_icon']['value'])) : ?>
                        <span class="icon-before btn-icon"><?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']) ?></span>
                    <?php endif; ?>
                    <span class="content"><?php echo esc_html($settings['readmore_text']); ?></span>
                    <?php if ('after' == $settings['icon_position'] && !empty($settings['btn_icon']['value'])) : ?>
                        <span class="icon-after btn-icon"><?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']) ?></span>
                    <?php endif; ?>
                </a>
            </div>
        <?php endif; ?>
        <?php if ( 'yes' == $settings['enable_author_info'] ): ?>
        <div class="post-author-info" >
            <div class="author-img">
                <?php  echo get_avatar( get_the_author_meta( 'ID' )); ?>
            </div>
            <div class="author-name-date">
                <div class="author-name">
                    <span><?php  echo get_the_author(); ?></span>
                </div>
                <div class="author-date">
                    <span><?php echo get_the_date(); ?></span>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>