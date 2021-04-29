<?php
/**
 *  Front page template
 */

get_header();

$id = get_the_ID();
$hero_img = get_the_post_thumbnail_url($id, 'full');

?>

<section class="section hero bg_yellow">
    <?php include_once 'templates/svg_hero_top.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-12">
                <div class="hero_content wow animated fadeInUp delay-15s">
                    <div class="hero_subtitle"><?php the_field('hm_subtitle'); ?></div>
                    <h1><?php the_field('hm_title'); ?></h1>
                    <p><?php the_field('hm_text'); ?></p>
                </div>
                <div class="hero_buttons wow animated fadeInUp delay-2s">
                    <a class="btn hero_btn"
                       href="<?php the_field('Перетелефонуйте мені') ?>"><?php the_field('hm_hero_btn_title'); ?></a>
                    <a href="<?php the_field('hm_video_btn_link'); ?>" data-fancybox class="hero_video">
                        <b><i class="fas fa-play"></i></b>
                        <span><?php the_field('hm_video_btn_title'); ?></span>
                    </a>
                </div>
                <div class="hero_info wow animated fadeInDown delay-3s">
                    <div class="hero_shedule">
                        <p><?php the_field('grafyk_roboty', 'option'); ?></p>
                        <span><?php the_field('hm_schedule'); ?></span>
                    </div>
                    <div class="hero_contact">
                        <?php echo get_phone(); ?>
                        <?php echo get_email(); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-4 col-12 hero_img_wrapper">
                <div class="hero_img wow animated fadeInUp delay-15s">
                    <img class="iamge" src="<?php echo $hero_img ?>" alt="img">
                </div>
            </div>
        </div>
    </div>

    <?php include_once 'templates/svg_bottom.php'; ?>
</section>

<?php
$boss_img = get_field('hm_bs_img');
$boss_link = $boss_img['url'];
$boss_alt = ($boss_img['alt'] !== "") ? $boss_img['alt'] : get_field('hm_bs_title');
$aut_img = get_field('hm_bs_writes_img');
$aut_link = $aut_img['sizes']['medium'];
$aut_alt = ($aut_img['alt'] !== "") ? $aut_img['alt'] : get_field('hm_bs_writes_txt');

?>
<section class="boss">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-12 boss_img_wrap">
                <img class="boss_img wow animated fadeInUp " src="<?php echo $boss_link; ?>"
                     alt="<?php echo $boss_alt; ?>">
            </div>
            <div class="col-lg-7 col-12 flex-end">
                <h2 class="h2 wow animated fadeInUp"><?php the_field('hm_bs_title'); ?></h2>
                <div class="boss_text wow animated fadeInUp">
                    <?php the_field('hm_bs_txt'); ?>
                </div>
                <div class="boss_aut">
                    <img class="wow animated fadeInUp" src="<?php echo $aut_link; ?>" alt="<?php echo $aut_alt; ?>">
                    <h6 class="wow animated fadeInUp delay-1s"><?php the_field('hm_bs_writes_txt') ?></h6>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="services" class="services">
    <div class="services_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-12">
                    <div class="services_left">
                        <h6 class="text-blue wow animated fadeInUp"><?php the_field('hm_srv_subtitile'); ?></h6>
                        <h2 class="wow animated fadeInUp"><?php the_field('hm_srv_title'); ?></h2>
                        <p><?php the_field('hm_srv_text'); ?></p>
                    </div>
                </div>
                <div class="col-lg-7 col-12">
                    <div class="services_slider_wrap">
                        <div class="js-service">
                            <?php
                            $services = get_field('hm_srv_slider');

                            foreach ($services as $service) :
                                ?>
                                <div class="services_item">
                                    <div class="services_item_body">
                                        <div>
                                            <div class="services_icon"
                                                 style="background-image: url(<?php echo $service['hm_srv_sl_icon']; ?>)">
                                            </div>
                                            <h5 class="h5"><?php echo $service['hm_srv_sl_title']; ?></h5>
                                            <p><?php echo $service['hm_srv_sl_text']; ?></p>
                                        </div>
                                        <a class="btn services_btn"
                                           href="<?php echo $service['hm_srv_sl_link']; ?>"><?php the_field('detalnishe', 'option'); ?></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php $packeges = get_field('desible_packs'); ?>
<?php if ($packeges) : ?>
    <section id="packages" class="packages">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="packages_uniq">
                        <h2 class="text-center packages_uniq_title"><?php the_field('packs_sttitle'); ?></h2>
                        <p class="text-center packages_uniq_text"><?php the_field('packs_st_text'); ?></p>
                    </div>
                </div>
            </div>
            <div class="row packages_btn_row">
                <?php
                $flats_tax = wp_count_terms([
                    'taxonomy' => 'packages_flats',
                    'hide_empty' => true
                ]);

                if ($flats_tax) :
                    ?>
                    <div class="packages_btn_col wow animated fadeInUp">
                        <a class="btn packages_btn active"
                           href="javascript:;" data-tax="packages_flats"><?php the_field('kvartyry', 'option'); ?></a>
                    </div>
                <?php endif; ?>

                <?php
                $houses_tax = wp_count_terms([
                    'taxonomy' => 'packages_home',
                    'hide_empty' => true
                ]);

                if ($houses_tax) :
                    ?>
                    <div class="packages_btn_col wow animated fadeInUp">
                        <a class="btn packages_btn" href="javascript:;"
                           data-tax="packages_home"><?php the_field('budynky', 'option'); ?></a>
                    </div>
                <?php endif; ?>

                <?php
                $business_tax = wp_count_terms([
                    'taxonomy' => 'packages_bussiness',
                    'hide_empty' => true
                ]);

                if ($business_tax) :
                    ?>
                    <div class="packages_btn_col wow animated fadeInUp">
                        <a class="btn packages_btn" href="javascript:;"
                           data-tax="packages_bussiness"><?php the_field('biznes', 'option'); ?></a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="packages_wrapper wow animated fadeInUp">
                <?php require 'templates/packeges-flats.php'; ?>
            </div>

            <div class="packages_uniq">
                <h2 class="text-center packages_uniq_title"><?php the_field('packs_uniq_title'); ?></h2>
                <p class="text-center packages_uniq_text"><?php the_field('packs_uniq_text'); ?></p>
                <div class="packages_uniq_button">
                    <a class="btn packages_uniq_btn" href="<?php the_field('packs_uniq_link'); ?>"><?php the_field('detalnishe', 'option'); ?></a>
                </div>
            </div>

        </div>
    </section>
<?php endif; ?>


<?php
$freedom_img = get_field('fr_img');
?>
<section class="freedom" style="background-image: url(<?php echo $freedom_img['url']; ?>)">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-6 col-12">
                <div class="freedom_wrapper">
                    <h2 class="h2 wow animated fadeInUp"><?php the_field('fr_title'); ?></h2>
                    <div class="freedom_text wow animated fadeInUp">
                        <?php the_field('fr_text'); ?>
                    </div>
                    <a class="btn btn-standart freedom_btn wow animated fadeInUp delay-1s"
                       href="<?php the_field('fr_link'); ?>"><?php the_field('detalnishe', 'option'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $waranty_bg = get_field('wt_img'); ?>
<section class="waranty" style="background-image: url(<?php echo $waranty_bg['url']; ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="waranty_wrapper">
                    <h2 class="h2 wow animated fadeInUp"><?php the_field('wt_title'); ?></h2>
                    <?php
                    $akks = get_field('wt_akkr');

                    if ($akks) :
                        ?>
                        <ul class="accordion-small wow animated fadeInUp delay-1s">
                            <?php foreach ($akks as $akk) : ?>
                                <li>
                                    <div class="accordion-small_title">
                                        <h6><?php echo $akk['wt_akkr_title']; ?> </h6>
                                        <i aria-hidden="true" class="fas fa-plus"></i>
                                    </div>
                                    <div class="accordion-small-content" style="display: none;">
                                        <?php echo $akk['wt_akkr_text']; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <a class="btn btn-standart freedom_btn wow animated fadeInUp delay-2s"
                       href="<?php the_field('fr_link'); ?>"><?php the_field('ynteresno', 'option'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="reviews">
    <?php include_once 'templates/svg_top.php'; ?>
    <div class="container">
        <div class="row reviews_row">
            <div class="col-lg-8 col-12">
                <?php
                $reviews = get_field('rv_reviwes');

                if ($reviews) :
                    ?>
                    <div class="reviews_slider">
                        <?php foreach ($reviews as $review) :
                            $rew_img = $review['rv_img'];
                            $thumb = $rew_img['sizes']['thumbnail'];
                            ?>
                            <div class="reviews_item_wrapper">
                                <div class="reviews_item">
                                    <div class="reviews_ava">
                                        <img src="<?php echo $thumb; ?>" alt="<?php echo $review['rv_name']; ?>">
                                    </div>
                                    <h6 class="reviews_name"><?php echo $review['rv_name']; ?></h6>
                                    <div class="reviews_position"><?php echo $review['rv_pos']; ?></div>
                                    <div class="reviews_text">
                                        <p><?php echo $review['rv_text']; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-4 col-12">
                <div class="reviews_header wow animated fadeInUp">
                    <i class="quote"
                       style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/quote_icon_128x128.svg);"></i>
                    <h2 class="h2"><?php the_field('rv_title'); ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once 'templates/bottom-form.php'; ?>

<?php get_footer(); ?>
