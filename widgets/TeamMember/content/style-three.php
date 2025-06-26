<?php


use \Elementor\Controls_Manager;

use \Elementor\Repeater;

use \Elementor\Group_Control_Border;

use \Elementor\Group_Control_Box_Shadow;

use \Elementor\Group_Control_Image_Size;

use \Elementor\Group_Control_Background;

use \Elementor\Control_Media;

use \Elementor\Icons_Manager;

use \Elementor\Group_Control_Typography;

use \Elementor\Group_Control_Css_Filter;

use \Elementor\Utils;

use \Elementor\Widget_Base;


?>

<div class="fbth-team-item style-three">

    <div <?php echo $this->get_render_attribute_string('fbth_team_member_item'); ?>>

        <?php do_action('fbth_team_member_wrapper_before'); ?>

        <?php

        if ($settings['fbth_team_member_image']['url'] || $settings['fbth_team_member_image']['id']) { ?>

            <div class="fbth-team-member-thumb">

                <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'team_member_image_size', 'fbth_team_member_image'); ?>

            </div>

        <?php

        }

        ?>



        <div class="fbth-team-member-content">



            <div class="member-identity-name">

                <?php if (!empty($settings['fbth_team_member_name'])) : ?>

                    <h2 <?php echo $this->get_render_attribute_string('fbth_team_member_name'); ?>><?php echo wp_kses_post($settings['fbth_team_member_name']); ?></h2>

                <?php endif; ?>



                <?php if (!empty($settings['fbth_team_member_designation'])) : ?>

                    <span <?php echo $this->get_render_attribute_string('fbth_team_member_designation'); ?>><?php echo wp_kses_post($settings['fbth_team_member_designation']); ?></span>

                <?php endif; ?>

                <?php if (!empty($settings['fbth_team_member_description'])) : ?>

<p class="team-description" <?php echo $this->get_render_attribute_string('fbth_team_member_description'); ?>><?php echo wp_kses_post($settings['fbth_team_member_description']); ?></p>

<?php endif; ?>

            </div>

            <?php do_action('fbth_team_member_content_area_before'); ?>

            <?php if ('yes' === $settings['fbth_section_team_members_cta_btn'] && !empty($settings['fbth_team_members_cta_btn_text'])) : ?>

                <a <?php echo $this->get_render_attribute_string('fbth_team_members_cta_btn_link'); ?>>

                    <?php echo $this->team_member_cta(); ?>

                    <span class="team_btn_iocn">

                        <?php \Elementor\Icons_Manager::render_icon($settings['team_btn_icon'], ['aria-hidden' => 'true']); ?>

                    </span>

                </a>

            <?php

            endif;

            ?>
            <?php

            if ('yes' === $settings['fbth_team_member_enable_social_profiles']) : ?>

                <ul class="list-inline fbth-team-member-social">

                    <?php

                    foreach ($settings['fbth_team_member_social_profile_links'] as $index => $item) :

                        $social   = '';

                        $link_key = 'link_' . $index;



                        if ('svg' !== $item['social_icon']['library']) {

                            $social = explode(' ', $item['social_icon']['value'], 2);

                            if (empty($social[1])) {

                                $social = '';
                            } else {

                                $social = str_replace('fa-', '', $social[1]);
                            }
                        }

                        if ('svg' === $item['social_icon']['library']) {

                            $social = '';
                        }



                        if ($item['link']['url']) {

                            $this->add_render_attribute($link_key, 'href', esc_url($item['link']['url']));

                            if ($item['link']['is_external']) {

                                $this->add_render_attribute($link_key, 'target', '_blank');
                            }

                            if ($item['link']['nofollow']) {

                                $this->add_render_attribute($link_key, 'rel', 'nofollow');
                            }
                        }



                        $this->add_render_attribute($link_key, 'class', [

                            'fbth-social-icon',

                            'elementor-repeater-item-' . $item['_id'],

                        ]);

                    ?>

                        <li>

                            <a <?php echo $this->get_render_attribute_string($link_key); ?>>

                                <?php Icons_Manager::render_icon($item['social_icon'], ['aria-hidden' => 'true']); ?>

                            </a>

                        </li>

                    <?php endforeach; ?>

                </ul>

            <?php

            endif; ?>

        </div>

        <?php do_action('fbth_team_member_content_area_after'); ?>



    </div>

    <?php do_action('fbth_team_member_wrapper_after'); ?>

</div>

