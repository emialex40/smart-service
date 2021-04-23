<?php
/**
 *  Template Name: Про нас
 */

get_header();

?>

<?php get_hero(); ?>

<section class="cool">
    <div class="container">
        <div class="row cool_wrapper">
            <div class="col-lg-6 col-12">
                <h6 class="text-blue wow animated fadeInLeft"><?php the_field('ab_subtitle_top'); ?></h6>
                <h2 class="h2 cool_header wow animated fadeInLeft"><?php the_field('ab_title'); ?></h2>
                <span class="cool_subtitle wow animated fadeInUp"><?php the_field('ab_subtitle'); ?></span>
                <div class="cool_text"><?php the_field('ab_text'); ?></div>
            </div>

            <?php
            $img_top = get_field('ab_img_top');
            $img_bottom = get_field('ab_img_bottom');
            $alt_top = ($img_top['alt']) ? $img_top['alt'] : get_field('ab_title');
            $alt_bottom = ($img_bottom['alt']) ? $img_bottom['alt'] : get_field('ab_title');
            ?>
            <div class="col-lg-6 col-12 cool_images">
                <div class="cool_imgs">
                    <div class="cool_imgs_item cool_imgs_top">
                        <img src="<?php echo $img_top['sizes']['flags-thumb']; ?>" alt="<?php echo $alt_top; ?>">
                    </div>
                    <div class="cool_imgs_item cool_imgs_bottom">
                        <img src="<?php echo $img_bottom['sizes']['flags-thumb']; ?>"
                             alt="<?php echo $alt_bottom; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="cool_counter" class="col-lg-6 col-12 cool_counter">
                <?php
                $counters = get_field('ab_counts');

                if ($counters) :
                    $count = 0;
                    ?>
                    <div class="cool_counter_wrapper">
                        <?php
                        foreach ($counters as $counter) :
                            $count++;
                            ?>
                            <div class="cool_counter_item">
                        <span class="cool_counter_num num<?= $count; ?> wow"
                              data-num="<?php echo $counter['ab_count_dig']; ?>">0</span>
                                <strong class="cool_counter_name">
                                    <?php echo $counter['ab_count_name']; ?>
                                </strong>
                                <p class="cool_counter_text"><?php echo $counter['opys_lichylnyka']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="always">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-12">
                <?php include_once 'templates/video-template.php'; ?>
            </div>
            <div class="col-lg-5 col-12 always_wrap">
                <h2 class="h2 always_header wow animated fadeInRight"><?php the_field('ab_vd_title'); ?></h2>
                <div class="always_text wow animated fadeInRight">
                    <?php the_field('ab_vd_text'); ?>
                </div>
                <?php
                $adv_arr = get_field('ab_vd_adventage');

                if ($adv_arr) :
                    ?>
                    <div class="always_adventages wow animated fadeInUp">
                        <?php
                        foreach ($adv_arr as $adv) :
                            $img = $adv['adventage_icon'];
                            $thumb = $img['url'];
                            $title = $adv['adventage_title'];
                            $adv_text = $adv['adventage_text'];
                            ?>
                            <div class="always_adv">
                                <div class="always_icon" style="background-image: url(<?php echo $thumb; ?>);"></div>
                                <h5><?php echo $title; ?></h5>
                                <div class="always_adv_text"><?php echo $adv_text; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="always_button">
                    <a class="btn btn-padd"
                       href="<?php the_field('ab_btn_link'); ?>"><?php the_field('perejty_do_poslug', 'option'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="principles">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="principles_titles">
                    <h6 class="text-blue text-center wow animated fadeInUp"><?php the_field('pc_top_subtitle'); ?></h6>
                    <h2 class="principles_header text-center wow animated fadeInUp"><?php the_field('pc_title'); ?></h2>
                    <p class="principles_text text-center wow animated fadeInUp"><?php the_field('pc_text'); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php
                $pr_items = get_field('pc_advs');

                if ($pr_items) :
                    ?>
                    <div class="principles_wrapper wow animated fadeInUp">
                        <?php foreach ($pr_items as $pr_item) : ?>
                            <div class="principles_item">
                                <div class="principles_item_icon">
                                    <img src="<?php echo $pr_item['pc_icon']; ?>"
                                         alt="<?php echo $pr_item['pc_advs_title']; ?>">
                                </div>
                                <h5 class="principles_item_title text-center"><?php echo $pr_item['pc_advs_title']; ?></h5>
                                <div class="principles_item_text text-center"><?php echo $pr_item['pc_advs_text']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="principles_button">
                <a class="btn btn-padd btn-border wow animated fadeInUp"
                   href="<?php the_field('pc_btn_linc'); ?>"><?php the_field('pc_btn_name') ?></a>
            </div>
        </div>
    </div>
</section>

<section class="time">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="time_wrapper">
                    <h6 class="text-blue wow animated fadeInLeft"><?php the_field('tm_subtitle'); ?></h6>
                    <h2 class="time_header wow animated fadeInLeft"><?php the_field('tm_title'); ?></h2>
                    <p class="time_text wow animated fadeInUp"><?php the_field('tm_text'); ?></p>
                    <div class="time_button wow animated fadeInUp">
                        <a class="btn btn-padd btn-border"
                           href="<?php the_field('posylannya_knopky'); ?>"><?php the_field('tm_btn_name'); ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 time_none">
                <div class="time_image wow animated fadeIn">
                    <img src="<?php the_field('tm_img') ?>" alt="<?php the_field('tm_title'); ?>">
                </div>
            </div>
        </div>
    </div>

    <?php
    $team = get_field('cll_enbl');


    if ($team) :

        $args = [
            'post_type' => 'team',
            'order' => 'ASC',
            'post_status' => 'publish',
            'posts_per_page' => -1
        ];

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            ?>
            <div class="container-big">
                <div class="team">
                    <?php while ($query->have_posts()) :
                        $query->the_post();
                        $id = get_the_ID();
                        $image = get_the_post_thumbnail_url($id, 'flags-thumb');
                        ?>
                        <div class="team_item">
                            <div class="team_item_body js-hover" style="background-image: url(<?php echo $image; ?>);">
                                <div class="team_title_block">
                                    <div class="team_item_show">
                                        <h6><?php the_title(); ?></h6>
                                        <span><?php the_field('posada'); ?></span>
                                    </div>
                                    <div class="team_item_hide" style="display: none;">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif;
        wp_reset_postdata(); ?>
    <?php endif; ?>
</section>

<section class="call">
    <div class="call_bg bg_fixed" style="background-image: url(<?php the_field('cll_bg'); ?>);"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h6 class="call_subtitle text-white wow animatetd fadeInLeft"><?php the_field('sll_subtitle'); ?></h6>
                <h2 class="call_header wow animated fadeInLeft"><?php the_field('cll_title'); ?></h2>
                <div class="call_button wow animated fadeInUp">
                    <a class="btn btn-padd call_btn wow animated fadeInUp" href="<?php the_field('cll_link') ?>">
                        <span><?php the_field('pakety_poslug', 'option'); ?></span>
                        <i class="fas fa-caret-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
