<?php

use  Elementor\Icons_Manager;

?>

<div class="fbth-testimonial_six_single fbth-testimonial__single">
    <div class="tm-two-style-wrap">
		
    <div class="testimonial-two-bottom-area">
        <div class="user-image">
            <?php
            if (!empty($item['fbth_testimonial_user_img'])) : ?>
                <div class="fbth-testimonial__img">
                    <img src="<?php echo $item['fbth_testimonial_user_img']['url'] ?>" alt="">
                </div>
            <?php endif; ?>
        </div>
    </div>
		
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
        <div class="testimonial-two-top-meta">
            <?php
            if (!empty($item['fbth_testimonial_content'])) {
                echo '<p class="fbth-testimonial__decription  fbth-size-' . $item['size'] . '">' . $item['fbth_testimonial_content'] . '</p>';
            }
            ?>
            <div class="quote-icon">
                <?php \Elementor\Icons_Manager::render_icon($settings['quote_icon'], ['aria-hidden' => 'true']); ?>
            </div>
        </div>
    </div>

    <div class="testimonial-image-wrapper">
    <div class="rated-text">
                        <?php
                        if ('yes' == $item['enable_rated_text']) {
                            echo '<p class="tm-bottom-text fbth-size-' . $item['review_size'] . '"><span class="bottom-rated-text fbth-size-' . $item['rated_size'] . '" >' . $item['rated_text'] . '</span>' . $item['review_text'] . '</p>';
                        }
                        ?>
                        </div>
        <div class="user-identity">
            <div class="user-name-pos">
                <div class="fbth-testimonial__name">
                    <?php
                    if (!empty($item['fbth_testimonial_name'])) {
                        printf('<%1$s class="tm-name" >%2$s</%1$s>', $item['name_size'], $item['fbth_testimonial_name']);
                    }
                    ?>
                </div>
                <div class="fbth-testimonial__position">
                    <?php
                    if (!empty($item['fbth_testimonial_position'])) {
                        echo '<p class="fbth-size-' . $item['position_size'] . '">' . $item['fbth_testimonial_position'] . '</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>