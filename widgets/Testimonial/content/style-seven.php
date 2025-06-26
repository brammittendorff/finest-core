<?php

/**
 * @author [jaism]
 * @email [jasimnwu41@gmail.com]
 * @create date 2022-08-23 12:15:00
 * @modify date 2022-08-23 12:15:00
 * @desc [description]
 */
?>
<?php

use  Elementor\Icons_Manager;
?>
<div class="fbth-testimonial_seven_single fbth-testimonial__single">
    <div class="fbth-testimonial__meta-content d-flex d-flex align-items-center">
        
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
            <div class="rated-text">
                <?php
                if ('yes' == $item['enable_rated_text']) {
                    echo '<p class="tm-bottom-text fbth-size-' . $item['review_size'] . '"><span class="bottom-rated-text fbth-size-' . $item['rated_size'] . '" >' . $item['rated_text'] . '</span>' . $item['review_text'] . '</p>';
                }
                ?>
            </div>
    
        </div>
        <div class="user-all-content">
            <div class="user-image">
                <?php
                if (!empty($item['fbth_testimonial_user_img'])) : ?>
                    <div class="fbth-testimonial__img">
                        <img src="<?php echo $item['fbth_testimonial_user_img']['url'] ?>" alt="">
                    </div>
                <?php endif; ?>
            </div>
            <div class="user-identity">
                <div class="fbth-testimonial__name">
                    <?php
                    if (!empty($item['fbth_testimonial_name'])) :
                        printf('<%1$s class="tm-name" >%2$s</%1$s>',$item['name_size'],$item['fbth_testimonial_name']);
                        endif; ?>
                </div>
                <div class="fbth-testimonial__position">
                    <?php
                    if (!empty($item['fbth_testimonial_position'])) : ?>
                        <p class="fbth-size-<?php echo $item['position_size'] ?>"><?php echo esc_html($item['fbth_testimonial_position']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>