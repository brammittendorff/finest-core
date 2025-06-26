<?php

use  Elementor\Icons_Manager;
?>

<div class="fbth-testimonial_five_single fbth-testimonial__single">

    <div class="fbth-testimonial-img-identi">
		<div class="user-identy-wrapper">
			<div class="user-image">
				 <?php if ('yes' == $item['enable_show_img']) : ?>
            <div class="fbth-testimonial__img">
                <img src="<?php echo $item['fbth_testimonial_user_img']['url'] ?>" alt="">
            </div>
        <?php endif; ?>
			</div>
			<div class="name-designation-wrapper">
				<div class="fbth-testimonial__name">
                <?php
                if (!empty($item['fbth_testimonial_name'])) :
                    printf('<%1$s class="tm-name" >%2$s</%1$s>', $item['name_size'], $item['fbth_testimonial_name']);
                endif; ?>
					<div class="name-verified-icon">
						 <img src="<?php echo $item['fbth_testimonial_verify_img']['url'] ?>" alt="">
					</div>
            </div>
            <div class="fbth-testimonial__position">
                <?php
                if (!empty($item['fbth_testimonial_position'])) : ?>
                    <p class="fbth-size-<?php echo $item['position_size'] ?>"><?php echo esc_html($item['fbth_testimonial_position']) ?></p>
                <?php endif; ?>
            </div>
			</div>
		</div>
		<div class="social-icon">
    <div class="social-icon">
        <?php
        $socialIconClass = $item['social_icon'];
        $socialLink = $item['link']['url'];

        // Render the social icon with a link
        if (!empty($socialIconClass) && !empty($socialLink)) {
            echo '<a href="' . esc_url($socialLink) . '" aria-hidden="true">';
            Icons_Manager::render_icon($socialIconClass);
            echo '</a>';
        } else {
            // If either the icon class or link is empty, only render the icon without a link
            Icons_Manager::render_icon($socialIconClass, ['aria-hidden' => 'true']);
        }
        ?>
    </div>
</div>
		
		<div class="fbth-testimonial__decription">
			   <?php
            if (!empty($item['text_editor_text'])) : ?>
                <?php echo $item['text_editor_text'] ?>
            <?php endif; ?>
		</div>
		
		 <div class="testimonial_bottom_image">
                <img src="<?php echo $item['logo_image']['url'] ?>" alt="">
            </div>
       
        <div class="testimonial-content">
            <?php if (!empty($item['rating_icon'])) : ?>
                <div class="rating_area">
                    <?php for ($i = 0; $i < 5; $i++) :
                        $class = '';
                    ?>
                        <?php if ($ratting > $i) {
                            $class = "active_color";
                        } ?>
                        <span class="inactive_color"><?php Icons_Manager::render_icon($item['rating_icon'], ['class' => $class, 'aria-hidden' => 'true']) ?></span>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
            <div class="quote-icon">
                <?php \Elementor\Icons_Manager::render_icon($settings['quote_icon'], ['aria-hidden' => 'true']); ?>
            </div>
            <?php
            if (!empty($item['fbth_testimonial_content'])) : ?>
                <p class="fbth-size-<?php echo $item['size'] ?> fbth-testimonial__decription"> <?php echo $item['fbth_testimonial_content'] ?></p>
            <?php endif; ?>
        </div>
        <div class="user-identity">
        <div class="rated-text">
                        <?php
                        if ('yes' == $item['enable_rated_text']) {
                            echo '<p class="tm-bottom-text fbth-size-' . $item['review_size'] . '"><span class="bottom-rated-text fbth-size-' . $item['rated_size'] . '" >' . $item['rated_text'] . '</span>' . $item['review_text'] . '</p>';
                        }
                        ?>
                        </div>
            
        </div>
    </div>
</div>