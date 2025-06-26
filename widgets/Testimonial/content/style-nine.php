<?php

use  Elementor\Icons_Manager;
?>
<div class="fbth-testimonial__single">
    <div class="fbth-testimonial__meta-content fbth-testimonial-nine">
        <?php if (!empty($item['fbth_testimonial_user_img'])) : ?>
            <div class="fbth-testimonial__img">
                <img src="<?php echo $item['fbth_testimonial_user_img']['url'] ?>" alt="">
                <div class="fbth-testimonial-name-position">
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
                            echo '<p class="fbth-size-' . $item['position_size'] . '" >' . $item['fbth_testimonial_position'] . '</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="testimonial-content-area">
            <div class="quote-icon">
                <?php \Elementor\Icons_Manager::render_icon($settings['quote_icon'], ['aria-hidden' => 'true']); ?>
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
                <?php
                if (!empty($item['fbth_testimonial_content'])) {
                    echo '<p class="fbth-testimonial__decription fbth-size-' . $item['size'] . '">' . $item['fbth_testimonial_content'] . '</p>';
                }
                ?>
        </div>
    </div>


</div>