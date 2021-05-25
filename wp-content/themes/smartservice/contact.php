<?php
/**
 *  Template Name: Контакти
 */

get_header();
?>
<?php get_hero(); ?>

    <section class="contacts">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="contacts_info">
                        <h6 class="text-blue wow animated fadeInright"><?php the_field('ct_subtitle'); ?></h6>
                        <h2 class="wow  fadeInUp animated"><?php the_field('ct_title'); ?></h2>
                        <?php
                        $img_arr = get_field('ct_img');
                        $img = $img_arr['sizes']['thumbnail'];
                        ?>
                        <div class="contacts_info_wrapper wow animated fadeInLeft">
                            <div class="contacts_row contacts_location">
                                <h6><?php the_field('ct_address_title'); ?></h6>
                                <p><?php the_field('ct_adressa'); ?></p>
                            </div>
                            <div class="contacts_row contacts_data">
                                <h6><?php the_field('ct_phone_title') ?></h6>
                                <?php echo get_phone(); ?>
                                <?php echo get_email(); ?>
                            </div>
                            <div class="contacts_row">
                            <p class="social">
                                <a href="<?php the_field('facebook', 'option'); ?>"><i
                                            class="fab fa-facebook-f"></i></a>
                                <a href="<?php the_field('insta', 'option'); ?>""><i class=" fab fa-instagram"></i></a>
                                <a href="<?php the_field('viber', 'option'); ?>""><i class=" fab fa-viber"></i></a>
                                <a href="<?php the_field('telegram', 'option'); ?>""><i
                                        class=" fab fa-telegram-plane"></i></a>
                            </p>
                            </div>
                            <div class="contacts_row contacts_shedule">
                                <h6><?php the_field('ct_time_title'); ?></h6>
                                <p><?php the_field('ct_time'); ?></p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 col-12">
                    <div class="info_form contacts_form wow animated fadeInRight">
                        <h4 class="info_form_title"><?php the_field('ct_form_title'); ?></h4>
                        <div class="info_form_place">
                            <?php echo do_shortcode('' . get_field('ct_form') . ''); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="map">
        <?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false) : ?>
            <?php
            $map = get_field('ct_map');
            echo $map;
            ?>
        <?php endif; ?>
    </section>

<?php get_footer(); ?>